<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "./lib/WxPay.Api.php";
require_once './lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("./logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		$this->updateOrder($data['out_trade_no']);
		return true;
	}

	private function updateOrder($out_trade_no){
		require_once 'db.php';
		$result = mysql_query("select * from `wjw_orders` where id=".$out_trade_no);
		if(mysql_num_rows($result)==1){
			$row = mysql_fetch_array($result);
			if($row['status']==0){
				mysql_query("update `wjw_orders` set pay_time='".time()."',status=1 where id=".$out_trade_no);
				$redline = $row['pay_price'];
				$remarks = "微信充值红线";
				mysql_query("update `wjw_user` set redline = redline+".$redline." where id=".$row['uid']);
				mysql_query("insert into `wjw_yyb_log` (uid,redline,remarks,addtime) values ('".$row['uid']."','".$redline."','".$remarks."','".time()."')");
			}
		}
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
