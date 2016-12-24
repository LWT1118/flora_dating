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

	public function index(){

		$weObj = $this->xwechat();
		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败

		$type = $weObj->getRev()->getRevType();
		$event = $weObj->getRev()->getRevEvent();
		$content = $weObj->getRev()->getRevContent();
		$openid = $weObj->getRev()->getRevFrom();
		switch($type) {
			case Wechat::MSGTYPE_TEXT:

			if(is_numeric($content)){
				$db = M('dice');
				$db2 = M('dice_join');
				switch ($content) {
					case 0: //看看自己参加的游戏
						$arr = array('openid'=>$openid);
						$re = $db->where($arr)->getField('id',true);
						$txt = "";
						if($re){
							$txt .= "你是大话骰子".implode(',', $re)."房间的房主";
						}else{
							$txt .= "你没有发起游戏，回复数字【2】，玩大话骰子！回复数字【3】，玩狼人杀！";
						}
						$re = $db2->where($arr)->getField('roomid',true);
						if($re){
							$txt .= "你是大话骰子".implode(',', $re)."房间的玩家";
						}else{
							$txt .= "你还没有进入任何游戏房间，回复房间号码，进入游戏！";
						}
						$weObj->text($txt)->reply();
						break;
					case 1: //进入游戏选择菜单
						$weObj->text("欢迎来到游戏中心！回复数字【2】，玩大话骰子！回复数字【3】，玩狼人杀！")->reply();
						break;
					case 2: //选择大话骰子游戏
						$weObj->text("欢迎来到大话骰子，你可以<a href='http://".$this->_server('HTTP_HOST')."/Wechat/diceCreate/openid/".$openid."'>点击这里创建房间</a>，或者直接输入房间号，进入别人创建的房间")->reply();
						break;
					case 3: //选择狼人杀
						$weObj->text("恩，狼人杀游戏升级中。。。")->reply();
						break;
					case 4: //创建房间或者提示进入其它房间
						$weObj->text("请回复房间号，或者回复数字【2】创建房间！")->reply();
						break;
					case 5: //开始游戏
						$arr = array('openid'=>$openid);
						$re = $db2->where($arr)->find();
						if($re){
							$arr['roomid'] = $re['roomid'];
							if($re['dice']>0){
								$weObj->text("你已经投过骰子了，点数是".$re['dice']."，坐等房主公布结果")->reply();
							}else{
								$dice = $this->diceValue(5); //

								$db2->where($arr)->setField('dice',$dice);
								$weObj->text("你刚投的点数：".$dice."，坐等房主公布结果")->reply();
							}
						}else{
							$weObj->text("你还没加入游戏，
回复房间号，进入游戏！
回复数字【2】创建房间！")->reply();
						}
						

						break;
					case 6: //查看游戏结果
						$arr = array('openid'=>$openid);
						$re = $db->where($arr)->find();
						if($re){
							$arr2['roomid'] = array('eq',$re['id']);
							$arr2['dice'] = array('gt',0);

							$re2 = $db2->where($arr2)->getField('dice',true);
							if(count($re2) != $re['qty']){
								$weObj->text("还有人没有开始游戏")->reply();
							}else{
								$txt = '';
								$i = 1;
								foreach ($re2 as $v) {
									$txt .= $i.'号玩家'.$v.'点
';
									$i++;
								}
								$txt .= "
回复数字【7】，看看有哪些惩罚[呲牙]
回复数字【9】，重新开始游戏[骷髅]";
								$weObj->text($txt)->reply();
							}

							if($re['dice']>0){
								$weObj->text("你已经投过骰子了，
点数是".$re['dice']."，
坐等房主公布结果")->reply();
							}else{
								$dice = $this->diceValue(5); //

								$db2->where($arr)->setField('dice',$dice);
								$weObj->text("你刚投的点数：".$re['dice']."，坐等房主公布结果")->reply();
							}
						}else{
							$weObj->text("你不是房主，回复数字【5】看你自己的点数")->reply();
						}
						break;
					case 7: //游戏惩罚
						$weObj->text("游戏惩罚")->reply();
						break;
					case 8: //查看游戏
						$weObj->text("回复数字【8】的人是213")->reply();
						break;
					case 9: //重新开始游戏
						$arr = array('openid'=>$openid);
						$re = $db->where($arr)->find();
						if($re){
							$db2->where('roomid='.$re['id'])->delete();
							$weObj->text("你已经重置游戏，可以邀请小伙伴进来玩，
房间号：【".$re['id']."】")->reply();
						}else{
							$weObj->text("不是房主，不能重置游戏")->reply();
						}
						break;				
					default:
						if($content>=1000 && $content<5000){ //加入游戏

							$arr = array(
								'roomid'=>$content,
								'openid'=>$openid,
							);
							$arr2 = array('id'=>$content);

							$room = $db->where($arr2)->find(); //找到对应房间
							$count = $db2->where($arr)->count();//获得参与人数
							if($count < $room['qty']){
								$re = $db2->where($arr)->find();//找到参加记录
								if(!$re){
									$data['roomid'] = $content;
									$data['openid'] = $openid;
									$data['dice'] = 0;
									$db2->add($data);
									$weObj->text("成功加入 ".$content." 房间！回复数字“5”开始游戏!")->reply();
								}else{
									$weObj->text("已经在 ".$content." 房间！回复数字“5”开始游戏!")->reply();
								}
							}else{
								$weObj->text("房间已满，请回复其它房间号，或者回复数字【2】开设新房间")->reply();
							}
							
														
						}elseif($content>=5000 && $content<10000){
							$weObj->text("房间不存在，输入数字【0】，查看你目前加入的游戏房间")->reply();
						}else{
							$weObj->text("房间不存在，输入数字【0】，查看你目前加入的游戏房间")->reply();
						}
						break;
				}

			}else{

			


	//$content='蛤蟆跳';
	$DB = M('wechat');
	$data = $DB->where("keyword='".$content."'")->find();
	//echo $DB->getLastSql();
	if($data){
		if($data['img']==''){
			$weObj->text($data['summary'])->reply();
		}else{
			
			if($data['url']=='http://'.$this->_server('HTTP_HOST').'/Member/register'){
				$url = 'http://'.$this->_server('HTTP_HOST').'/Member/register/openid/'.$openid;
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
			$weObj->news($news)->reply();
		}
	}else{
		$weObj->text("你的留言我们已经收到，建议留下你的微信号，我们微信你[呲牙]")->reply();
	}

			}


					exit;
					break;
			case Wechat::MSGTYPE_EVENT:
				
				switch ($event['event']) {

					case Wechat::EVENT_SUBSCRIBE:

	$content='关注自动回复';
	$DB = M('wechat');
	$data = $DB->where("keyword='".$content."'")->find();
	//echo $DB->getLastSql();
	if($data){
		if($data['img']==''){
			$weObj->text($data['summary'])->reply();
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
			$weObj->news($news)->reply();
		}
	}else{
		$weObj->text("感谢您的关注！")->reply();
	}

						break;
					case Wechat::EVENT_UNSUBSCRIBE:
						//$weObj->text($content)->reply();
						break;
					
					default:
						//$key = strtoupper($event['key']);
						$key = strtoupper($event['key']);
						$re = M('wechat_menu')->where(array('val'=>$key))->find();
						if($re && strlen($re['content'])>0){
							$weObj->text($re['content'])->reply();
						}else{
							$weObj->text('不要乱点啊，兄弟！')->reply();
						}
						break;
				}
				
					exit;
					break;
			case Wechat::MSGTYPE_IMAGE:
					break;
			default:
					$weObj->text("help info")->reply();
		}


		
	}

	public function diceCreate(){
		$openid = I('openid',false);
		if(strlen($openid)==28){
			$this->openid = $openid;
			$this->page_title = '大话骰子创建房间';
			$this->display();
		}else{
			$this->error('身份错误');
		}
	}

	public function diceCreateHandle(){
		$openid = I('openid');
		$db = M('dice');
		$re = $db->where(array('openid'=>$openid))->find();
		if($re){
			$id = $re['id'];
			$data = $db->create();
			$db->id = $re['id'];
			$db->addtime = time();
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
		$this->display();
	}

	private function diceValue($len){
		$dice = "";
		for($i=0;$i<$len;$i++){
			$dice .= mt_rand(1,6);
		}
		return (int)$dice;
	}
}

?>