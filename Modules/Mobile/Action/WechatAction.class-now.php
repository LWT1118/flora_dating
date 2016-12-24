<?php

class WechatAction extends HomeAction{

	private function xwechat(){
		$cfg = M('wechat_cfg')->find();
		import("@.Action.wechat");
		$options = array(
			'token'=>$cfg['token'], //填写你设定的key
	        'encodingaeskey'=>$cfg['encodingaeskey'], //填写加密用的EncodingAESKey，如接口为明文模式可忽略
	        'appid'=>$cfg['appid'], //填写高级调用功能的app id, 请在微信开发模式后台查询
			'appsecret'=>$cfg['appsecret']
		);
		$weObj = new Wechat($options);
		return $weObj;
	}



	private function subReply($content){
		//return "自动回复";
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

	private function autoReply($content){

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

	public function index(){
		//echo $this->autoReply();
		$defaultReply = "输入的内容不是关键字。
输入【联络】联络我们。
输入【帮助】查看帮助。";

		$weObj = $this->xwechat();
		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败

		$type = $weObj->getRev()->getRevType();
		$event = $weObj->getRev()->getRevEvent();
		$content = $weObj->getRev()->getRevContent();
		$openid = $weObj->getRev()->getRevFrom();
		switch($type) {
			case Wechat::MSGTYPE_TEXT:

				if(is_numeric($content)){
					$weObj->text($content)->reply();
				}else{
					$reply = $this->autoReply($content);
					if($reply){
						if(is_array($reply)){
							$weObj->news($reply)->reply();
						}else{
							$weObj->text($reply)->reply();
						}
					}else{
						$weObj->text($defaultReply)->reply();
					}
				}

					//$weObj->text($defaultReply)->reply();

					break;
			case Wechat::MSGTYPE_EVENT:
				
				switch ($event['event']) {

					case Wechat::EVENT_SUBSCRIBE:
						$reply = $this->subReply($content);
						if($reply){
							if(is_array($reply)){
								$weObj->news($reply)->reply();
							}else{
								$weObj->text($reply)->reply();
							}
						}else{
							$weObj->text($defaultReply)->reply();
						}
						break;
					case Wechat::EVENT_UNSUBSCRIBE:
						//$weObj->text($content)->reply();
						break;
					
					default:
						$weObj->text($defaultReply)->reply();
						break;
				}
				
					exit;
					break;
			case Wechat::MSGTYPE_IMAGE:
					break;
			default:
					$weObj->text($defaultReply)->reply();
		}


		
	}


	public function wolfCreateOk(){
		$id = I('id');
		$this->id = $id;
		$this->page_title = '狼人杀房间创建成功';
		$this->display();
	}

	public function wolfCreate(){
		$openid = I('openid',false);
		if($this->isHost($openid) || $this->isGuest($openid)){
			$this->error('你已经参与了游戏，回复数字0，查看自己参加的游戏');
		}else{
			if(strlen($openid)==28){
				$this->openid = $openid;
				$this->page_title = '狼人杀创建房间';
				$this->display();
			}else{
				$this->error('身份错误');
			}
		}
	}

	public function wolfCreateHandle(){
		$openid = I('openid');
		$role = I('role');
		$num = I('num');
		$qty = array_sum($num);		
		$db = M('dice');
		$Role = M('dice_role');
		$re = $db->where(array('openid'=>$openid))->find();
		if($re){
			switch ($re['types']) {
				case 'dice':
					$this->error('您的大话骰子房间存在，不能同时玩狼人杀！请先删除大话骰子房间');
					break;
				case 'wolf':

					
					$id = $re['id'];
					$data = $db->create();
					$db->id = $re['id'];
					$db->addtime = time();
					$db->types = 'wolf';
					$db->qty = $qty;
					$db->save();
					$this->success('房间 '.$id.' 创建成功',U('wolfCreateOk','id='.$id));				
					break;
				default:
					$this->error('房间创建失败');
					break;
			}
		}else{
			$data = $db->create();
			$db->addtime = time();
			$db->types = 'wolf';
			$db->qty = $qty;
			$id = $db->add();
			if($id){
				for ($i=0; $i<count($role); $i++) {
					$data['roomid'] = $id;
					$data['role'] = $role[$i];
					$data['qty'] = $num[$i];
					$Role->data($data)->add();
				}
				
				$this->success('房间 '.$id.' 创建成功',U('wolfCreateOk','id='.$id));
			}else{
				$this->error('房间创建失败');
			}
		}
	}


	public function diceCreate(){
		$openid = I('openid',false);
		if($this->isHost($openid) || $this->isGuest($openid)){
			$this->error('你已经参与了游戏，回复数字0，查看自己参加的游戏');
		}else{
			$db = M('game_room');
			if(strlen($openid)==28){
				$this->openid = $openid;
				$this->page_title = '大话骰子创建房间';
				$this->display();
			}else{
				$this->error('身份错误');
			}
		}
	}

	public function diceCreateHandle(){
		$openid = I('openid');
		$db = M('game_room');
		$re = $db->where(array('openid'=>$openid))->find();
		if($re){
			$id = $re['id'];
			$data = $db->create();
			$db->id = $re['id'];
			//$db->addtime = time();
			$db->save();
			$this->success('房间 '.$id.' 创建成功',U('diceCreateOk','id='.$id));
		}else{
			$data = $db->create();
			$db->addtime = time();
			$id = $db->add();
			if($id){
				$this->success('房间 '.$id.' 创建成功',U('diceCreateOk','id='.$id));
			}else{
				$this->error('房间创建失败');
			}
		}
	}

	public function diceCreateOk(){
		$id = I('id');
		$this->id = $id;
		$this->page_title = '大话骰子房间创建成功';
		$this->display();
	}

	private function diceValue($len){
		$dice = "";
		for($i=0;$i<$len;$i++){
			$dice .= mt_rand(1,6);
		}
		return (int)$dice;
	}


	private function isHost($openid){
		$db = M('game_room');
		$re = $db->where(array('openid'=>$openid))->find();
		if($re){
			return true;
		}else{
			return false;
		}
	}

	private function isGuest($openid){
		$db = M('game_join');
		$re = $db->where(array('openid'=>$openid))->find();
		if($re){
			return true;
		}else{
			return false;
		}
	}	


}

?>