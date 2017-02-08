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

	private function subReply($content = '关注自动回复'){
		$DB = M('wechat');
		$data = $DB->where("keyword='".$content."'")->find();
		//echo $DB->getLastSql();
		if($data){
			if($data['img']==''){
				return $data['summary'];
			}else{
				$picUrl = strpos($data['img'], 'http://') === false ? 'http://'.$this->_server('HTTP_HOST').'/Upload/wechat/thumb_'.$data['img'] : $data['img'];
				$news[0] = array(
					'Title'=>$data['title'],
					'Description'=>$data['summary'],
					'PicUrl'=> $picUrl,
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

	private function autoReply($content){		
		$DB = M('wechat');
		$data = $DB->where("keyword='".$content."'")->find();
		if($data){
			if($data['img']==''){
				//$weObj->text($data['summary'])->reply();
				return $data['summary'];
			}else{				
				/*if($data['url']=='http://'.$this->_server('HTTP_HOST').'/Mobile/Member/register'){
					$url = 'http://'.$this->_server('HTTP_HOST').'/Mobile/Member/register/openid/'.$openid;
				}else{
					$url = $data['url'];
				}*/
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
				//$weObj->news($news)->reply();
				return $news;
			}
		}else{
			//$weObj->text($defaultReply)->reply();
			return false;
		}
	}

	private function SubscribeEventProcessor(){
		//$this->_weObj = $this->wechat();
		$reply = $this->subReply();
		if($reply){
			if(is_array($reply)){
				$this->_weObj->news($reply)->reply();
			}else{
				$this->_weObj->text($reply)->reply();
			}
		}
	}

	private function UnsubscribeEventProcessor(){
	}

	private function TextEventProcessor(){
		//$openid = $this->_weObj->getRev()->getRevFrom();
		$content = $this->_weObj->getRev()->getRevContent();
		$reply = $this->autoReply($content);
		if($reply){
			if(is_array($reply)){
				$this->_weObj->news($reply)->reply();
			}else{
				$this->_weObj->text($reply)->reply();
			}
			//return;
		}
		/*$wxMsger = new Weixin($this->account);
		//$this->_weObj = $this->wechat();
		$fromUserId = $this->GetUserId($openid);
		if($fromUserId == 0){
			$wxMsger->sendMessage($openid, '您还没有登录，点击会员中心登录');
			return;
		}		
		$cache = Cache::getInstance('Db');
		$id = $cache->get("date_{$fromUserId}") or die('success');
		$record = M('date_record')->where("id={$id}")->find() or die('success');
		$remains = time() - $record['to_user_time'];		
		if($remains > 480){ //超过8分钟
			$cache->rm("date_{$fromUserId}");
			$news[0] = array(
					'Title'=>'8分钟时间已到，点击唤醒',
					'Description'=>'点击图片，唤醒上次聊天（仅限vip）',
					'PicUrl'=> 'https://mmbiz.qlogo.cn/mmbiz/tV6icBsC5ZthsJOaI9yHb1rml0q74ccuiaexFRLq6zTs4aTxRXWkhcUP2vp5O5ZsWicKZW8aNT6wBNxAu7yNfQ9Qw/0?wx_fmt=jpeg',
					'Url'=> "http://yinyuan.de/Mobile/Member/wakeup?id={$id}",
				);
			$this->_weObj->news($news)->reply();
		}else{
			$toUserInfo = M('user')->find($record['to_user_id'] == $fromUserId ? $record['from_user_id'] : $record['to_user_id']);
			$minutes = ceil((480 - $remains) / 60);
			$wxMsger->sendMessage($toUserInfo['openid'], "{$content}(系统提示：剩余{$minutes}分钟)");
		}
		*/
	}

	private function CustomEventProcessor($eventKey){
		$openid = $this->_weObj->getRev()->getRevFrom();
		$wxMsger = new Weixin($this->account);
		$fromUserId = $this->GetUserId($openid);
		if($fromUserId == 0){
			$wxMsger->sendMessage($openid, '您还没有登录，请先登陆');
			die('success');
		}
		$eventMenu = M('wechat_menu')->where(array('val'=>$eventKey))->find() or die('success');
		$cfg = parent::cfg();
		$maxGroup = intval($cfg['max_group']); //设置同时聊天的人有多少组
		if($eventKey == 'date'){ //8分钟约会			
			$dateRecordModel = M('date_record');
			$userModel = M('user');
			$timestamp = time();
			$groups = $dateRecordModel->where("{$timestamp}-from_user_time<=480 and to_user_id=0")->count('id'); //有多少人在排队
			$dateGroups = $dateRecordModel->where("{$timestamp}-to_user_time<=480")->count('id'); //当前聊天组数 
			$fromUserInfo = $userModel->find($fromUserId);			
			if($dateGroups >= $maxGroup && $fromUserInfo['vipendtime'] < $timestamp){ //达到最大组数并且不是VIP
				$vipGroups = $dateGroups - $maxGroup; //vip组数等于当前聊天人数减去$maxGroup			
				if($vipGroups < 0) $vipGroups = 0;
				$record = $dateRecordModel->where("from_user_id={$fromUserId} and to_user_id=0")->find();
				if($record){//更新时间及用户信息
					$dateRecordModel->where("id={$record['id']}")->data(array('from_user_time'=>$timestamp, 'from_vip'=>$fromUserInfo['vipendtime'] < $timestamp ? 0 : 1, 'from_sex'=>$fromUserInfo['gender']))->save();
				}else{
					$dateRecordModel->data(array('from_user_id'=>$fromUserId, 'from_user_time'=>$timestamp, 'from_vip'=>$fromUserInfo['vipendtime'] < $timestamp ? 0 : 1, 'from_sex'=>$fromUserInfo['gender']))->add();						
				}
				$wxMsger->sendMessage($openid, "已达到最大聊天人数，前面有{$groups}人排队，有{$vipGroups}VIP在插队，请耐心等待");
			}else{
				$record = $dateRecordModel->where("from_sex != {$fromUserInfo['gender']} and {$timestamp}-from_user_time<=480 and to_user_id=0")->order('id asc')->find(); //匹配
				if($record){
					$cache = Cache::getInstance('Db');
					$dateRecordModel->where("id={$record['id']}")->data(array('to_user_id'=>$fromUserId, 'to_user_time'=>$timestamp))->save();//匹配
					$cache->set("date_{$fromUserId}", $record['id'], time());
					$wxMsger->sendMessage($openid, '已经为您匹配到一个' . ($fromUserInfo['gender'] == 1 ? '帅哥' : '美女') . "\r\n您将有8分钟的时间,通过点击左下角键盘标记,在本公众号输入文字的方式,与跟您连线的异性聊天。\r\n8分钟之后连接将中断,非vip无法唤醒同一个人继续聊天,只能随机匹配。\r\n如果聊得开心,不要忘记互留联系方式。\r\n祝您聊天愉快。");
					$toUserInfo = $userModel->find($record['from_user_id']);
					$cache->set("date_{$toUserInfo['id']}", $record['id'], time());
					$wxMsger->sendMessage($toUserInfo['openid'], '已经为您匹配到一个' . ($toUserInfo['gender'] == 1 ? '帅哥' : '美女') . "\r\n您将有8分钟的时间,通过点击左下角键盘标记,在本公众号输入文字的方式,与跟您连线的异性聊天。\r\n8分钟之后连接将中断,非vip无法唤醒同一个人继续聊天,只能随机匹配。\r\n如果聊得开心,不要忘记互留联系方式。\r\n祝您聊天愉快。");
				}else{
					$record = $dateRecordModel->where("from_user_id={$fromUserId} and to_user_id=0")->find();
					if($record){//更新时间及用户信息
						$dateRecordModel->where("id={$record['id']}")->data(array('from_user_time'=>$timestamp, 'from_vip'=>$fromUserInfo['vipendtime'] < $timestamp ? 0 : 1, 'from_sex'=>$fromUserInfo['gender']))->save();
					}else{
						$dateRecordModel->data(array('from_user_id'=>$fromUserId, 'from_user_time'=>$timestamp, 'from_vip'=>$fromUserInfo['vipendtime'] < $timestamp ? 0 : 1, 'from_sex'=>$fromUserInfo['gender']))->add();						
					}
					$wxMsger->sendMessage($openid, '暂时未匹配到合适的人，如果8分钟之内仍旧匹配不成功，请重试');
				}
			}
			die('success');
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
			//$this->CustomEventProcessor($eventData['key']);
		}			
	}

	/* 包含8分钟约会，因服务器压力较大，暂时去掉 */
	/*public function index(){
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
					echo 'success';
				}else{
					echo 'success';
				}
				break;
			case Wechat::MSGTYPE_EVENT:
				$cache = Cache::getInstance('Db');
				$key = "{$openid}_{$createTime}";
				if($cache->get($key) === false){ 
					$cache->set($key, 1, 60);  //缓存60秒防止过快点击
					$this->EventProcessor();
					echo 'success';
				}else{
					echo 'success';
				}
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			default:
				$this->_weObj->text($defaultReply)->reply();
		}		
	}*/

	/* 不包含8分钟约会 */
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
                $this->TextEventProcessor();
                break;
            case Wechat::MSGTYPE_EVENT:
                $this->EventProcessor();
                break;
            case Wechat::MSGTYPE_IMAGE:
                break;
            default:
                $this->_weObj->text($defaultReply)->reply();
        }
        echo 'success';
    }
}
?>