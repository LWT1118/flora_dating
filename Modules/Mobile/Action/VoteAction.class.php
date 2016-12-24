<?php
class VoteAction extends HomeAction {
	public function index(){					
		$id = intval($_GET['id']);
		$data = VoteModel::getInstance()->find($id);
		$data['content'] = str_replace("\r\n", "\\r\\n", $data['content']);
		$this->data = $data;
		$this->options = VoteSelectModel::getInstance()->where("vote_id={$id}")->order("`order` asc")->select();
		$manualVote = array();
		foreach($this->options as $option){
		    $manualVote[$option[id]] = intval($option['add_num']);
		}
		$voteRecordModel = VoteRecordModel::getInstance();
		if($data['end_time'] < time()){
		    $this->voted = 1;
		}else{
		    $this->voted = $voteRecordModel->where("open_id='{$this->open_id}' and vote_id={$id}")->count();
		}
		if($this->voted){	
			//$this->redirect(U('Mobile/Vote/result', array('id'=>$id)));
			$total = $voteRecordModel->where("vote_id={$id}")->count();
			$total += array_sum($manualVote);
			$result = $voteRecordModel->query("select option_id,count(id) as amount from wjw_vote_record where vote_id={$id} group by option_id");
			$statistic = array();
			foreach($result as $value){
			    $amount = isset($manualVote[$value['option_id']]) ? ($manualVote[$value['option_id']] + $value['amount']) : $value['amount'];			   
				$statistic[$value['option_id']] = array('percent'=>($total == 0 ? 0 : round($amount/$total, 2) * 100), 'amount'=>$amount);
			}					
			$this->statistic = $statistic;
		}				
		
		import("@.Action.WechatJssdk");
		$cfg = parent::wechat_cfg();
		$jssdk = new JSSDK($cfg['appid'], $cfg['appsecret']);
		$this->signPackage = $jssdk->GetSignPackage();	
		
		$this->display();
	}
	
	public function vote()
	{					
		$voteId = $_GET['vote_id'];				
		$weObj = $this->wechat();
		$wechatInfo = $weObj->getUserInfo($this->open_id);
		if($wechatInfo === false || !isset($wechatInfo['subscribe'])){
			die(json_encode(array('msg'=>'拉取微信用户信息失败，请重试')));
		}
		if(!$wechatInfo['subscribe']){
			die(json_encode(array('msg'=>'您还没有关注姻缘德国公众号，不能投票','url'=>U('Mobile/Vote/qrcode'))));
		}				
		$voteInfo = VoteModel::getInstance()->find($voteId);
		if($voteInfo['start_time'] > time()){
			die(json_encode(array('msg'=>'还没有开始投票')));
		}else if(time() > $voteInfo['end_time']){
			die(json_encode(array('msg'=>'投票已经结束')));
		}
		$options = explode(',' ,I('options'));
		$voteRecordModel = VoteRecordModel::getInstance();	
		if($voteRecordModel->where("open_id='{$this->open_id}' and vote_id={$voteId}")->select()){
			die(json_encode(array('msg'=>'您已经投过票了，不能重复投票')));
		}		
		foreach($options as $option){
			$voteRecordModel->add(array('open_id'=>$this->open_id, 'vote_time'=>time(), 'option_id'=>$option, 'vote_id'=>$voteId));
		}	
		die(json_encode(array('msg'=>'投票成功', 'err_code'=>'1')));		
	}
	/* 废弃 */
	public function result()
	{
		$voteId = $_GET['id'];					
		$this->assign('data', VoteModel::getInstance()->find($voteId));						
		$this->assign('options', VoteSelectModel::getInstance()->where("vote_id={$voteId}")->order("`order` asc")->select());		
		$voteRecordModel = VoteRecordModel::getInstance();
		$total = $voteRecordModel->where("vote_id={$voteId}")->count();		
		$result = $voteRecordModel->query("select option_id,count(id) as amount from wjw_vote_record where vote_id={$voteId} group by option_id");
		$statistic = array();
		foreach($result as $value){			
			$statistic[$value['option_id']] = array('percent'=>($total == 0 ? 0 : round($value['amount']/$total, 2) * 100), 'amount'=>$value['amount']);
		}			
		$this->statistic = $statistic;
		$this->display();
	}
}
?>