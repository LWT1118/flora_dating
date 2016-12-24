<?php

class GameAction extends HomeAction{

	//获得随机骰子点数
	private function diceValue($len){
		$dice = "";
		for($i=0;$i<$len;$i++){
			$dice .= mt_rand(1,6);
		}
		return (int)$dice;
	}

	//删除游戏
	private function deleteGame($roomid){
		$this->deleteJoin($roomid);
		$this->deleteRole($roomid);
		M('game_room')->where(array('id'=>$roomid))->delete();
	}

	//删除参与记录
	private function deleteJoin($roomid){
		M('game_join')->where(array('roomid'=>$roomid))->delete();
	}	

	//删除角色分配记录
	private function deleteRole($roomid){
		M('game_role')->where(array('roomid'=>$roomid))->delete();
	}

	//是否存在该房间
	private function isRoom($roomid){
		return M('game_room')->find($roomid);
	}

	private function isRoomJoinable($roomid){
		$room = $this->isRoom($roomid);
		if($room){
			$count = M('game_join')->where(array('roomid'=>$roomid))->count();
			if($count<$room['qty']){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//房主身份检测
	private function isHost($openid){
		return M('game_room')->where(array('openid'=>$openid))->find();
	}

	//房客身份检测
	private function isGuest($openid){
		return M('game_join')->where(array('openid'=>$openid))->find();
	}	

	//是否是该房间房主
	private function ThisHost($openid,$roomid){
		$arr = array(
			'id'=>$roomid,
			'openid'=>$openid,
		);
		return M('game_room')->where($arr)->find();
	}


	//是否是该房间房客
	private function ThisGuest($openid,$roomid){
		$arr = array(
			'roomid'=>$roomid,
			'openid'=>$openid,
		);
		return M('game_join')->where($arr)->find();
	}

	//返回游戏名称
	private function getTypes($types){
		switch ($types) {
			case 'dice':
				return '大话骰子';
				break;
			case 'wolf':
				return '狼人杀';
				break;
		}
	}


	private function getRole($roomid){
		$roleChosen = M('game_join')->where(array('roomid'=>$roomid))->getField('role',true);
		$roleChosen = array_count_values($roleChosen);
		$roleList = M('game_role')->where(array('roomid'=>$roomid))->getField('role,qty',true);
		$roleAvailable = array();
		foreach ($roleList as $key => $value) {
			if(!array_key_exists($key, $roleChosen) || $roleChosen[$key]<$value){
				$roleAvailable[] = $key;
			}			
		}
		if(count($roleAvailable)>0){
			return $roleAvailable[array_rand($roleAvailable,1)];
		}else{
			return false;
		}		
	}


	public function index(){

	$content = I('content',0);
	$openid = "ooooooooooooooooooooooooooox";
	//$openid = "ooooooooooooooooooooooooooow";

	$reset = "
【以下操作有风险，请慎用】
回复数字【7】，重新开始游戏，参与者不变
回复数字【8】，重新开始游戏，清空参与者
回复数字【9】，关闭游戏房间，游戏结束";

	$GameRoom = M('game_room'); 		//游戏房间表
	$GameJoin = M('game_join');			//游戏参与表
	$GameRole = M('game_role');			//游戏角色表

	$host = $this->isHost($openid); 	//返回房间信息
	$guest = $this->isGuest($openid);	//返回参与记录信息



	switch ($content) {
		case 0: //看看自己参加的游戏
			
			if($host){
				$game = $this->getTypes($host['types']);
				$txt = "你是".$game."游戏 ".$host['id']." 房间的房主
回复房间号【".$host['id']."】，进入游戏！";
			}elseif($guest){
				$room = $this->isRoom($guest['roomid']);
				$game = $this->getTypes($room['types']);
				$txt = "你正在参与 ".$guest['roomid']." 房间的".$game."游戏
回复房间号【".$guest['roomid']."】，进入游戏！";
			}else{
				$txt = "目前还没参加任何游戏！回复数字【1】看看有什么游戏可玩！";
			}
			
			break;
		case 1: //进入游戏选择菜单
			$txt = "回复数字【2】，大话骰子！
回复数字【3】，狼人杀！
直接回复房间号加入游戏！";
			break;
		case 2: //选择大话骰子游戏
			if($host || $guest){
				$txt = "你已经参与了游戏，不能新开房间！
回复数字【4】，退出当前游戏";
			}else{
				$txt = "欢迎来到大话骰子，你可以<a href='http://".$this->_server('HTTP_HOST')."/Wechat/diceCreate/openid/".$openid."'>点击这里创建房间</a>，或者直接输入房间号，进入别人创建的房间";
			}
			break;
		case 3: //选择狼人杀
			if($host || $guest){
				$txt = "你已经参与了游戏，不能新开房间！
回复数字【4】，退出当前游戏";
			}else{		
				$txt = "欢迎来到狼人杀，你可以<a href='http://".$this->_server('HTTP_HOST')."/Wechat/wolfCreate/openid/".$openid."'>点击这里创建房间</a>，或者直接输入房间号，进入别人创建的房间";
			}
			break;
		case 4: //退出你正在参与的游戏
			if($guest){
				//if($guest['num']==0 && $guest['dice']==0 && $guest['role']==NULL){
					$arr = array(
						'roomid'=>$guest['roomid'],
						'openid'=>$guest['openid'],
					);
					$GameJoin->where($arr)->delete();
					$txt = "成功退出【".$guest['roomid']."】房间，回复房间号进入其它游戏";
				//}else{
				//	$txt = "如果你已经回复【5】开始了游戏，则无法中途退出";
				//}

				
			}else{
				$txt = "游戏玩家才能退出房间";
			}
			break;
		case 5: //开始游戏

			

			if($host){
				$roomid = $host['id'];
				$game = $this->getTypes($host['types']);
				$ThisHost = $this->ThisHost($openid,$roomid);
				$ThisGuest = $this->ThisGuest($openid,$roomid);
				if($ThisHost){//房主看房间情况
					$txt = "你是".$game."游戏 ".$ThisHost['id']." 房间的房主";
					$player = M('game_join')->where(array('roomid'=>$roomid))->order('num')->select();
					if($host['types']=='dice'){
						$i=1;
						foreach ($player as $key => $value) {
							$txt .= "
玩家【".$i."】,骰子点数：【".$value['dice']."】";
							$i++;
						}
					}else{
						$i=1;
						foreach ($player as $key => $value) {
							$txt .= "
玩家【".$value['num']."】,身份【".$value['role'].",】";
							$i++;
						}
					}
					$txt .= $reset;
				}else{
					$txt = "房主不能参与游戏！
回复房间号，查看游戏结果";	
				}

				
			}elseif($guest){


				$ThisGuest = $this->ThisGuest($openid,$guest['roomid']);
				$Room = $this->isRoom($guest['roomid']);
				if($ThisGuest){
					//$txt = "我是进来开始游戏的！";
					switch ($Room['types']) {
						case 'dice':
							$arr = array(
								'roomid'=>$Room['id'],
								'openid'=>$openid,
							);
							//die;
							$dice = $ThisGuest['dice'];
							if($dice>0){
								$txt = "骰子点数【".$dice."】";
							}else{
								$dice = $this->diceValue(5);
								$GameJoin->where($arr)->setField('dice',$dice);
								$txt = "骰子点数【".$dice."】";
							}
							

							break;
						case 'wolf':

							$txt = "你的狼人杀身份是【".$guest['role']."】,号码是【".$guest['num']."】";
							break;
					}
				}else{
					$txt = "你正在参与 ".$guest['roomid']." 房间的游戏，不能参与本房间游戏！";
				}


			}else{
				$txt = "请先回复房间号，参与游戏！";
			}	

			break;
		case 6: //查看游戏惩罚
			$txt = "游戏惩罚写在这里";
			break;
		case 7: //重新开始游戏，参与者不变
			if($host){
				switch ($host['types']) {
					case 'dice':
						$data = array(
							'num'=>0,
							'dice'=>0,
							'role'=>NULL,
						);				
						break;
					case 'wolf':
						$data = array(
							'dice'=>0,
							'role'=>NULL,
						);	
						break;
				}
				$GameJoin->where(array('roomid'=>$host['id']))->save($data);
				$txt = "游戏数据清空，玩家可以重新回复数字【5】开始游戏";
			}else{
				$txt = "房主才有权利重启游戏";
			}
			break;
		case 8: //重新开始游戏，清空参与者
			if($host){
				$GameJoin->where(array('roomid'=>$host['id']))->delete();
				$txt = "游戏玩家清空，玩家可以重新回复房间号【".$host['id']."】开始游戏";
			}else{
				$txt = "房主才有权利重启游戏";
			}
			break;
		case 9: //关闭游戏房间
			if($host){
				$GameJoin->where(array('roomid'=>$host['id']))->delete();
				$GameRole->where(array('roomid'=>$host['id']))->delete();
				$GameRoom->where(array('id'=>$host['id']))->delete();
				$txt = "游戏玩家清空，玩家可以重新回复房间号【".$host['id']."】开始游戏";
			}else{
				$txt = "房主才有权利重启游戏";
			}			
			break;	
		default:

			if($content>500 && $content<600){//选择号码

				if($guest){
					$room = $this->isRoom($guest['roomid']);
					if($room['types']=='wolf'){
						if($guest['num']==0 && $guest['role']==''){

							$roomid = $room['id'];
							$num = $content-500;
							if($num<=$room['qty']){
								$arr = array(
									'roomid'=>$guest['roomid'],
									'num'=>$num,
								);
								$count = $GameJoin->where($arr)->count();
								if($count==0){

									$role = $this->getRole($roomid);

									$arr = array(
										'roomid'=>$guest['roomid'],
										'openid'=>$guest['openid'],
									);
									$data['num'] = $num;
									$data['role'] = $role;
									$GameJoin->where($arr)->save($data);
									$txt = "你的号码是【".$num."】
		分配的角色是【".$role."】";
								}else{
									$txt = "来晚一步，号码已经被别人抢走啦";
								}			
							}else{
								$txt = "号码不在可选范围内";
							}

						}else{
							$txt = "你的号码是【".$guest['num']."】
		分配的角色是【".$guest['role']."】";
						}
					}else{
						$txt = "你参与的不是狼人杀，无需选择号码";
					}
				}else{
					$txt = "你没有进入任何游戏房间，请先回复房间号进入游戏房间";
				}

			}elseif($content>=1000){ //加入游戏

				$room = $this->isRoom($content);

				//房间存在
				if($room){
					$game = $this->getTypes($room['types']);
					$ThisHost = $this->ThisHost($openid,$content);
					$ThisGuest = $this->ThisGuest($openid,$content);
					if($ThisHost){//房主看房间情况
						
						$txt = "你是".$game."游戏 ".$ThisHost['id']." 房间的房主";
						$player = M('game_join')->where(array('roomid'=>$content))->select();
						if($room['types']=='dice'){
							$i=1;
							foreach ($player as $key => $value) {
								$txt .= "
玩家【".$i."】,骰子点数：【".$value['dice']."】";
								$i++;
							}
						}else{
							$i=1;
							foreach ($player as $key => $value) {
								$txt .= "
玩家【".$value['num']."】,身份【".$value['role'].",】";
								$i++;
							}
						}
						$txt .= $reset;


					}elseif($ThisGuest){//玩家，判断是否能加入房间

						if($room['types']=='dice'){
							if($ThisGuest['dice']==0){
								$txt = "回复数字【5】，开始游戏";
							}else{
								$txt = "你的骰子点数是 ".$guest['dice'];
							}
							
						}else{
							if($ThisGuest['num']==0 || $ThisGuest['role']==''){
$numChosen = $GameJoin->where(array('roomid'=>$content))->getField('num',true);
$numAvailable = array();
for ($i=1; $i <= $room['qty']; $i++) {
	if(!in_array($i, $numChosen))$numAvailable[] = $i;
}
$list = '';
foreach ($numAvailable as $num) {
	$list .= "
回复【5".str_pad($num, 2, '0', STR_PAD_LEFT)."】选择【".$num."】号";
}
$txt = "欢迎来到狼人杀【".$content."】房间！".$list;
							}else{
								$txt = "你的狼人杀身份是【".$guest['role']."】,号码是【".$guest['num']."】";
							}							
							
						}


					//不是本房间的房主或玩家，判断能否加入房间
						
					}else{

						if($host){
							$txt = "你是".$host['id']."的房主，暂时不能参与游戏！
回复数字【4】，关闭当前正在游戏的房间";
						}elseif($guest){
							$txt = "你正在".$guest['roomid']."房间参加游戏，不能参与本房间游戏！
回复数字【4】，离开正在参与游戏的房间";
						}else{

							$isRoomJoinable = $this->isRoomJoinable($content);

							if($isRoomJoinable){
								$data['roomid'] = $content;
								$data['openid'] = $openid;
								$GameJoin->add($data);
								if($room['types']=='dice'){
									$txt = "成功加入 ".$content." 房间！回复数字“5”开始游戏!";
								}else{


$numChosen = $GameJoin->where(array('roomid'=>$content))->getField('num',true);
$numAvailable = array();
for ($i=1; $i <= $room['qty']; $i++) {
	if(!in_array($i, $numChosen))$numAvailable[] = $i;
}
$list = '';
foreach ($numAvailable as $num) {
	$list .= "
回复【5".str_pad($num, 2, '0', STR_PAD_LEFT)."】选择【".$num."】号";
}
$txt = "欢迎来到狼人杀【".$content."】房间！".$list;



								}



							}else{
								$txt = "房间已满，请回复其它房间号，或者回复数字【1】看看有什么游戏可玩";
							}


						}

					}


				//房间不存在

				}else{
					$txt = "房间不存在，回复数字【0】，查看你目前加入的游戏房间";
				}		
											
			}else{
				$txt = "不知道你在搞啥！！！";
			}
			break;
		}

		echo $txt;
	}

}

?>