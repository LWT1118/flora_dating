<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo ($page_title); ?> <?php echo ($site["name"]); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Loading Bootstrap -->
    <link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet">
    <!-- Loading button -->
    <link href="__PUBLIC__/css/button.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="__PUBLIC__/css/flat-ui.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link href="__PUBLIC__/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="__PUBLIC__/css/bony.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="__PUBLIC__/js/vendor/html5shiv.js"></script>
      <script src="__PUBLIC__/js/vendor/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="__PUBLIC__/js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="__PUBLIC__/js/vendor/video.js"></script>
    <script src="__PUBLIC__/js/flat-ui.min.js"></script>
    <script src="__PUBLIC__/js/holder.min.js"></script>
    <script type="text/javascript">
    function sure(url){
        var x = confirm('确定要执行该操作？');
        if(x){
            document.location=url;
        }
    }
    </script>       
</head>

<body>
    <header class='bony-topbar bony-pink hidden'>
        <a href="javascript:void(0)"><i class="icon icon-arrow-left"></i></a>
        <?php echo ($page_title); ?>
    </header>



    <div class="container">
        <form action="<?php echo U('Mobile/Member/orderAdd');?>">
          <div class="form-group">
            <label for="redline">购买红线数量（1红线=<?php echo ($cfg['redline_price']); ?>元人民币）一次购买<?php echo ($cfg['vip_price_month']); ?>根送月VIP，一次购买<?php echo ($cfg['vip_price_year']); ?>根送年VIP</label>
            <input required min='1' max='1000' name='redline' type="number" class="form-control" id="redline" placeholder="输入1-1000之间的数字">
          </div>
          <button type="submit" class="w100 button button-block button-rounded button-caution">购买红线</button>
        </form>

		<p>
			<img src="/Modules/Mobile/Tpl/Public/img/zhongwei_pay.jpg" class="img-responsive center-block" />
		</p>

    	<div class="well bony-mt2">
    		<h6>红线购买说明</h6>
    		<p class="font-small">红线用于查看您感兴趣的会员信息。</p>
    		<p class="font-small">在完善好自己的资料后，系统会按时赠送您免费红线。免费红线不能累积，用掉后系统才会再次按时赠送。</p>
			<p class="font-small">红线代表了您的缘分，一旦使用，不能返还，请您谨慎的选择使用对象。</p>
			<p class="font-small">购买红线可通过微信支付（系统分配），扫描二维码向管理员付款支付（人工分配）以及联系管理员通过转账或者现金方式支付欧元。</p>
			<p class="font-small">管理员微信号 27511946</p>
    	</div>
       
    </div>



    <div style="height:7rem;"></div>
    <nav class="bony-nav bony-pink navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="container-fluid">
            <div class="col-xs-4">
                <a href="/Mobile/">
                    <i class="icon-home icon-large"></i>
                    <p>首页</p>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo U('Search/advance');?>">
                    <i class="icon-search"></i>
                    <p>搜索</p>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo U('Member/index');?>">
                    <i class="icon-user"></i>
                    <p>会员</p>
                </a>
            </div>
        </div>
    </nav>
</body>
</html>