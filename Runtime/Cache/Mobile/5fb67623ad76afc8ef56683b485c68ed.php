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


	



	<div class='container-fluid bony-search'>

		<h3 class='text-center'><?php echo ($h3); ?></h3>

		<div class="list-group bony-font-2 bony-search">

			<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notify): $mod = ($i % 2 );++$i;?><a class="list-group-item" href='<?php echo U('User/detail','id='.$notify['id']);?>'>
	          	
				<div class="pic pull-left">
					<img width='100%' src='<?php echo ($notify["img"]); ?>' class='img-circle img-responsive'>
				</div>
				<div class="txt">
					<span class="icon-angle-right pull-right" style='position:absolute;right:5%;top:48%'></span>
					<h3><?php echo (($notify["nickname"])?($notify["nickname"]):'暂未填写昵称'); if(($m["audit"] > 0)): ?>(已认证)<?php endif; ?></h3>
					<!--<p><?php echo ($notify["age"]); ?>岁 <?php echo ($notify["height"]); ?>cm，<?php echo ($notify["edu"]); ?> 月收入：<?php echo ($notify["income"]); ?></p>
					<p>地区：<?php echo (($notify["area"])?($notify["area"]):'-'); ?> 城市：<?php echo (($notify["city"])?($notify["city"]):'-'); ?></p>-->
					<p>个性签名：<?php echo (($notify["sign"])?($notify["sign"]):'未填写个性签名'); ?></p>
					<p>兴趣爱好：<?php echo (($notify["interest"])?($notify["interest"]):'暂未填写兴趣爱好'); ?></p>
					
				</div>
				
				<div class="clearfix"></div>
	          </a><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="pages"><?php echo ($page); ?></div>
		</div>


		<a class='bony-mt2 button button-rounded button-block button-caution' href="<?php echo U('advance');?>">重新搜索</a>

	</div>




    <div style="height:7rem;"></div>
    <nav class="bony-nav bony-pink navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="container-fluid">
            <div class="col-xs-4">
                <a href="/Mobile/">
                    <i class="icon-home icon-large"></i>
                    <p>活动</p>
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