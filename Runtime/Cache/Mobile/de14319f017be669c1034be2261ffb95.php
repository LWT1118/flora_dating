<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; 

transform: rotate(90deg);
-ms-transform: rotate(90deg);		/* IE 9 */
-webkit-transform: rotate(90deg);	/* Safari and Chrome */
-o-transform: rotate(90deg);		/* Opera */
-moz-transform: rotate(90deg);	

}
.system-message .jump{ padding-top: 10px; text-align: center;}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 16px; text-align: center;}
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<h1 style='text-align:center'>:(</h1>
<p class="error">请先长按识别二维码关注我们的公众号</p>
<p style="text-align:center"><img src="/Modules/Mobile/Tpl/Public/img/264160874289164525.jpg"></p>
<p class="detail"></p>
</div>
</body>
</html>