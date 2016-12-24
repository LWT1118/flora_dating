<?php
session_start();
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "./lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("./logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}
$oid = $_GET['oid'];
$total_fee = $_GET['oprice'];

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("姻缘德国-红线订单，订单总额".$oprice."元");
$input->SetAttach("姻缘德国-红线订单，订单总额".$oprice."元");

$input->SetOut_trade_no($oid);
$input->SetTotal_fee($total_fee);

//$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));

$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));

$input->SetGoods_tag("姻缘德国-订单，订单总额".$oprice."元");

$input->SetNotify_url("http://yinyuan.de/wechatPay/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>姻缘德国-姻缘币订单</b></font><br/>';
//printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);
$editAddress = $tools->GetEditAddressParameters();
$key = rand(1000,9999);
$code = md5("flora{$key}");
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>


    <link href="/Modules/Mobile/Tpl/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Modules/Mobile/Tpl/Public/css/button.css" rel="stylesheet">
    <link href="/Modules/Mobile/Tpl/Public/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Modules/Mobile/Tpl/Public/css/bony.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="/Modules/Mobile/Tpl/Public/js/vendor/html5shiv.js"></script>
      <script src="/Modules/Mobile/Tpl/Public/js/vendor/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="/Modules/Mobile/Tpl/Public/js/vendor/jquery.min.js"></script> 


    <title>姻缘德国-红线订单</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			//<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
			    switch(res.err_msg){
                    case "get_brand_wcpay_request:cancel":
                        alert('支付取消，返回我的订单');
						<?php
							echo "document.location = '/Mobile/Member/order/oid/{$oid}/status/0/key/{$key}/code/{$code}';";
						?>                        
                        break;
                    case "get_brand_wcpay_request:ok":
                        alert('支付成功，返回我的订单');
						<?php
							echo "document.location = '/Mobile/Member/order/oid/{$oid}/status/1/key/{$key}/code/{$code}';";
						?>                        
                        break;
                    default:
                        alert('支付失败，返回我的订单');
						<?php
							echo "document.location = '/Mobile/Member/order/oid/{$oid}/status/-1/key/{$key}/code/{$code}';";
						?>                        
                }
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
</head>
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">{$oprice}</span>元钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>







    <div style="height:6rem;"></div>
    <nav class="bony-nav bony-pink navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="container-fluid">
            <div class="col-xs-4">
                <a href="/">
                    <i class="icon-home icon-large"></i>
                    <p>首页</p>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="/Search/index">
                    <i class="icon-search"></i>
                    <p>搜索</p>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="/Member/index">
                    <i class="icon-user"></i>
                    <p>会员</p>
                </a>
            </div>
        </div>
    </nav>

</body>
</html>