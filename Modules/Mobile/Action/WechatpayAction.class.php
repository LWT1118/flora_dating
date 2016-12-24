<?php
require_once('PayNotifyCallBack.php');

class WechatpayAction extends PublicAction{

	public function payCallback($out_trade_no){
		$order = M('orders');
		$order->where("id='{$out_trade_no}'")->find();
		if($order){
			$time = time();
			$order->pay_time = $time;
			$order->status = 1;
			$userId = $order->uid;
			$redline = intval($order->ship_fee);
			$order->save();
			$cfg = $this->cfg();
			$vipmonth = $cfg['vip_price_month'];
			$vipyear = $cfg['vip_price_year']; 
			$user = M('user');
			$user->where("id={$userId}")->find();
			if($redline >= $vipyear){
				$user->vip = $time;
				$user->vipendtime = $time+3600*24*30*12;
				$user->redline += $redline;
			}elseif($redline >= $vipmonth){
				$user->vip = $time;
				$user->vipendtime = $time+3600*24*30;
				$user->redline += $redline;
			}else{
				$user->redline += $redline;
			}
			$user->save();
		}
	}

	public function payNotify()
	{
		$notify = new PayNotifyCallBack(array($this, 'payCallback'));
		$notify->Handle(false);
	}
}
?>