<?php

	$GameRoom = M('game_room'); 			//游戏房间表
	$GameJoin = M('game_join');			//游戏参与表
	$GameRole = M('game_role');			//游戏角色表
	switch ($content) {
		case 0: //看看自己参加的游戏
			$arr = array('openid'=>$openid);
			$host = $GameRoom->where($arr)->select();
			$gamer = $GameJoin->where($arr)->select();
			$txt = "";
			if($host){
				$txt .= "你是大话骰子".implode(',', $re)."房间的房主";
			}else{
				$txt .= "你没有发起游戏，回复数字【2】，玩大话骰子！回复数字【3】，玩狼人杀！";
			}
			
			if($re2){
				$txt .= "你是大话骰子".implode(',', $re2)."房间的玩家";
			}else{
				$txt .= "你还没有进入任何游戏房间，回复房间号码，进入游戏！";
			}
			
			break;
		case 1: //进入游戏选择菜单
			$txt = "欢迎来到游戏中心！回复数字【2】，玩大话骰子！回复数字【3】，玩狼人杀！";
			break;
		case 2: //选择大话骰子游戏
			$txt = "欢迎来到大话骰子，你可以<a href='http://".$this->_server('HTTP_HOST')."/Wechat/diceCreate/openid/".$openid."'>点击这里创建房间</a>，或者直接输入房间号，进入别人创建的房间";
			break;
		case 3: //选择狼人杀
			$txt = "欢迎来到狼人杀，你可以<a href='http://".$this->_server('HTTP_HOST')."/Wechat/wolfCreate/openid/".$openid."'>点击这里创建房间</a>，或者直接输入房间号，进入别人创建的房间";
			break;
		case 4: //创建房间或者提示进入其它房间
			$txt = "请回复房间号，或者回复数字【2】创建房间！";
			break;
		case 5: //开始游戏
			$arr = array('openid'=>$openid);
			$re = $GameJoin->where($arr)->find();
			if($re){
				$arr['roomid'] = $re['roomid'];
				if($re['dice']>0){
					$txt = "你已经投过骰子了，点数是".$re['dice']."，坐等房主公布结果";

				}else{
					$dice = $this->diceValue(5); //

					$GameJoin->where($arr)->setField('dice',$dice);
					$txt = "你刚投的点数：".$dice."，坐等房主公布结果";

				}
			}else{
				$txt = "你还没加入游戏，
回复房间号，进入游戏！
回复数字【2】创建房间！";
			}
			

			break;
		case 6: //查看游戏结果
			$arr = array('openid'=>$openid);
			$re = $GameRoom->where($arr)->find();
			if($re){
				$arr2['roomid'] = array('eq',$re['id']);
				$arr2['dice'] = array('gt',0);

				$re2 = $GameJoin->where($arr2)->getField('dice',true);
				if(count($re2) != $re['qty']){
					$txt = "还有人没有开始游戏";

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
					
				}

				if($re['dice']>0){
					$txt = "你已经投过骰子了，
点数是".$re['dice']."，
坐等房主公布结果";

				}else{
					$dice = $this->diceValue(5); //

					$GameJoin->where($arr)->setField('dice',$dice);
					$txt = "你刚投的点数：".$re['dice']."，坐等房主公布结果";

				}
			}else{
				$txt = "你不是房主，回复数字【5】看你自己的点数";
			}
			break;
		case 7: //游戏惩罚
			$txt = "游戏惩罚"
			break;
		case 8: //查看游戏
			$txt = "回复数字【8】的人是213"
			break;
		case 9: //重新开始游戏
			$arr = array('openid'=>$openid);
			$re = $GameRoom->where($arr)->find();
			if($re){
				$GameJoin->where('roomid='.$re['id'])->delete();
				$txt = "你已经重置游戏，可以邀请小伙伴进来玩，
房间号：【".$re['id']."】";
			}else{
				$txt = "不是房主，不能重置游戏";
			}
			break;				
		default:
			if($content>=1000){ //加入游戏

				$arr = array(
					'roomid'=>$content,
					'openid'=>$openid,
				);
				$arr2 = array('id'=>$content);

				$room = $GameRoom->where($arr2)->find(); //找到对应房间
				$count = $GameJoin->where($arr)->count();//获得参与人数
				if($count < $room['qty']){
					$re = $GameJoin->where($arr)->find();//找到参加记录
					if(!$re){
						$data['roomid'] = $content;
						$data['openid'] = $openid;
						$data['dice'] = 0;
						$GameJoin->add($data);
						$txt = "成功加入 ".$content." 房间！回复数字“5”开始游戏!";
	
					}else{
						$txt = "已经在 ".$content." 房间！回复数字“5”开始游戏!";
	
					}
				}else{
					$txt = "房间已满，请回复其它房间号，或者回复数字【2】开设新房间";

				}
				
											
			}else{
				$txt = "房间不存在，输入数字【0】，查看你目前加入的游戏房间";
			}
			break;
		}
?>