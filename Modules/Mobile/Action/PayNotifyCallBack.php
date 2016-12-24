<?php
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Notify.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';
class PayNotifyCallBack extends WxPayNotify
{
	private $_callback = null;
	public function __construct($callback)
	{
		$logHandler= new CLogFileHandler("./Runtime/Logs/".date('Y-m-d').'.log');
		WLog::Init($logHandler, 15);
		$this->_callback = $callback;		
	}

	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		WLog::DEBUG("query:" . json_encode($result));
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
		call_user_func($this->_callback, $data['out_trade_no']);
		//$this->updateOrder($data['out_trade_no']);
		return true;
	}
}
?>