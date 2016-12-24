<?php
require_once('./Lib/Action/weixin.php');
class WechatAction extends PublicAction{
	private $_weObj = null;
	private $account = array('account'=>'yinyuan.de@hotmail.com','password' => 'testtest1234');

	public function media2server($mediaId,$path){
		//$media_id = I('mediaId');
		$this->_weObj = $this->wechat();
		$rawimage = $this->_weObj->getMedia($mediaId);
		$filename = uniqid().'.jpeg';
		$file = $path.$filename;
		$im = imagecreatefromstring($rawimage);
		imagejpeg($im,$file);
		return $filename;
	}

	private function subReply($content){
		$content='关注自动回复';
		$DB = M('wechat');
		$data = $DB->where("keyword='".$content."'")->find();
		//echo $DB->getLastSql();
		if($data){
			if($data['img']==''){
				return $data['summary'];
			}else{
				$news[0] = array(
					'Title'=>$data['title'],
					'Description'=>$data['summary'],
					'PicUrl'=> 'http://'.$this->_server('HTTP_HOST').'/Upload/wechat/thumb_'.$data['img'],
					'Url'=> $data['url']
				);

				if($data['itemlist']!=''){
					$newsMore = $DB->field('title as Title,summary as Description,img as PicUrl,url as Url')->where('id in ('.$data['itemlist'].')')->select();
					//echo $DB->getLastSql();
					for($i=0;$i<count($newsMore);$i++){
						$thumb = 'thumb200_';	
						$temp = $newsMore[$i]['PicUrl'];
						$temp = 'http://'.$this->_server('HTTP_HOST').'/Upload/wechat/'.$thumb.$temp;
						$newsMore[$i]['PicUrl'] = $temp;
					}
					$news = array_merge($news,$newsMore);
				}
				return $news;
			}
		}else{
			return false;
		}
	}

	private function autoReply($content,$openid){

		//return "hahahaha";
		//$content='蛤蟆跳';
		$DB = M('wechat');
		$data = $DB->where("keyword='".$content."'")->find();
		//echo $DB->getLastSql();
		if($data){
			if($data['img']==''){
				//$weObj->text($data['summary'])->reply();
				return $data['summary'];
			}else{
				
				if($data['url']=='http://'.$this->_server('HTTP_HOST').'/Mobile/Member/register'){
					$url = 'http://'.$this->_server('HTTP_HOST').'/Mobile/Member/register/openid/'.$openid;
				}else{
					$url = $data['url'];
				}
				$news[0] = array(
					'Title'=>$data['title'],
					'Description'=>$data['summary'],
					'PicUrl'=> 'http://'.$this->_server('HTTP_HOST').'/Upload/wechat/thumb_'.$data['img'],
					'Url'=> $url
				);

				if($data['itemlist']!=''){
					$newsMore = $DB->field('title as Title,summary as Description,img as PicUrl,url as Url')->where('id in ('.$data['itemlist'].')')->select();
					//echo $DB->getLastSql();
					for($i=0;$i<count($newsMore);$i++){
						$thumb = 'thumb200_';	
						$temp = $newsMore[$i]['PicUrl'];
						$temp = 'http://'.$this->_server('HTTP_HOST').'/Upload/wechat/'.$thumb.$temp;
						$newsMore[$i]['PicUrl'] = $temp;
					}
					$news = array_merge($news,$newsMore);
				}
				//$weObj->news($news)->reply();
				return $news;
			}
		}else{
			//$weObj->text($defaultReply)->reply();
			return false;
		}

	}

	private function SubscribeEventProcessor(){
		$this->_weObj = $this->wechat();
		$reply = $this->subReply($content);
		if($reply){
			if(is_array($reply)){
				$this->_weObj->news($reply)->reply();
			}else{
				$this->_weObj->text($reply)->reply();
			}
		}else{
			$this->_weObj->text($defaultReply)->reply();
		}
	}

	private function UnsubscribeEventProcessor(){
	}

	private function TextEventProcessor(){
		$openid = $this->_weObj->getRev()->getRevFrom();
		$wxMsger = new Weixin($this->account);
		$this->_weObj = $this->wechat();
		$fromUserId = $this->GetUserId($openid);
		if($fromUserId == 0){
			$wxMsger->sendMessageByOpenId($openid, '您还没有登录，请先登陆');
			return;
		}		
		$content = $this->_weObj->getRev()->getRevContent();		
		$recordList = M('date_record')->where("from_user_id={$fromUserId} and status=1")->limit(1)->select() or die();
		$toUserRecord = $recordList[0];
		if(time() - $toUserRecord['create_time'] > 480){
			M('date_record')->where("id={$toUserRecord['id']}")->save(array('status'=>'-1'));
			$wxMsger->sendMessageByOpenId($openid, '8分钟已过');
		}else{
			$toUserInfo = M('user')->find($toUserRecord['to_user_id']);
			$toOpenId = $toUserInfo['openid'];
			$wxMsger->sendMessageByOpenId($toOpenId, $content);
		}
	}

	private function CustomEventProcessor($eventKey){
		$openid = $this->_weObj->getRev()->getRevFrom();
		$wxMsger = new Weixin($this->account);
		$fromUserId = $this->GetUserId($openid);
		if($fromUserId == 0){
			$wxMsger->sendMessageByOpenId($openid, '您还没有登录，请先登陆');
			return;
		}
		$eventMenu = M('wechat_menu')->where(array('val'=>$eventKey))->find() or die();				
		//如果有模板消息，显示模板消息(例：显示前面还有多少人排队)
		if(strlen($eventMenu['content']) > 0){
			$wxMsger->sendMessageByOpenId($openid, $eventMenu['content']);
			//return;
		}
		if($eventKey == 'date'){//8分钟约会
			$userModel = M('user');
			$fromUserInfo = $userModel->find($fromUserId);			
			//如果不是年会员或月会员提示还有多少人排队
			//判断是否存在from_user_id;
			$recordList = M('date_record')->where("from_user_id={$fromUserId} and status != -1")->order('id desc')->limit(1)->select();
			if(empty($recordList)){
				$insertId = M('date_record')->data(array('from_user_id'=>$fromUserId, 'create_time'=>time()))->add();
				$toGender = $fromUserInfo['gender'] == 0 ? 1 : 0;
				$toUserList = $userModel->query("select a.from_user_id from wjw_date_record a inner join wjw_user b on a.from_user_id=b.id where a.status!=1 and b.gender={$toGender} and a.from_user_id!={$fromUserId}");
				if($toUserList){
					$toUserId = $toUserList[rand(0, count($toUserList) - 1)];
					M('date_record')->where("id={$insertId}")->save(array('to_user_id'=>$toUserId['from_user_id'], 'status'=>'1'));
					M('date_record')->where("from_user_id={$toUserId['from_user_id']} and status=0")->save(array('to_user_id'=>$fromUserId, 'status'=>1));
					$wxMsger->sendMessageByOpenId($openid, '已经为您匹配到一个' . ($toGender == 0 ? '美女' : '帅哥'));
				}else{			
					$wxMsger->sendMessageByOpenId($openid, '暂时未匹配到合适的人');
				}		
			}
		}
	}

	private function EventProcessor(){
		$eventData = $this->_weObj->getRev()->getRevEvent();
		$event = $eventData['event'];
		if($event == Wechat::EVENT_SUBSCRIBE){
			$this->SubscribeEventProcessor();
		}elseif($event == Wechat::EVENT_UNSUBSCRIBE){
			$this->UnsubscribeEventProcessor();
		}elseif($event == Wechat::EVENT_MENU_CLICK){
			echo 'success';		
			$this->CustomEventProcessor($eventData['key']);
		}			
	}

	public function index(){
		//echo $this->autoReply();
		$defaultReply = "输入的内容不是关键字。输入【联络】联络我们。输入【帮助】查看帮助。";		
		$this->_weObj = $this->wechat();
		
		$this->_weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败		
		$type = $this->_weObj->getRev()->getRevType();				
		$createTime = $this->_weObj->getRev()->getRevCtime();
		$openid = $this->_weObj->getRev()->getRevFrom();
		switch($type) {
			case Wechat::MSGTYPE_TEXT:				
				$cache = Cache::getInstance('Db');
				$key = $this->_weObj->getRev()->getRevID();
				if($cache->get($key) === false){
					$cache->set($key, 1, 60);
					$this->TextEventProcessor();
				}else{
					echo 'success';
				}
				break;
			case Wechat::MSGTYPE_EVENT:
				$cache = Cache::getInstance('Db');
				$key = "{$openid}_{$createTime}";
				if($cache->get($key) === false){
					$cache->set($key, 1, 60);
					$this->EventProcessor();
				}else{
					echo 'success';
				}
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			default:
				//$this->_weObj->text($defaultReply)->reply();
		}		
	}
}
?>