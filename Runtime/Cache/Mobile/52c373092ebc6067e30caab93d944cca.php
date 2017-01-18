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

    <div class="bony-pink bony-info-header">
        <div class='face'>
          <a href="<?php echo U('Mobile/Member/face');?>">
          <img src="<?php echo ($m["img"]); ?>" class='img-responsive img-circle' alt="头像照片">
          </if>
          </a>
        </div>
        <h3><?php echo (($m["nickname"])?($m["nickname"]):'未填写昵称'); ?>(<?php if(($m["audit"] > 1)): ?>已认证<?php else: echo ($audit_url); endif; ?>)</h3>
		<?php if($m["vip"] == 0): ?><p>您还不是VIP会员</p>
		 <?php else: ?>
		 <p>您的VIP会员将于<?php echo (date("Y-m-d",$m["vipendtime"])); ?>到期</p><?php endif; ?>
        <p>红线：<span><?php echo ($m["redline"]); ?></span>根 <a class='button button-tiny button-rounded button-primary' href="<?php echo U('yyb');?>">购买</a></p>
        <p style='padding:0 8px'><?php echo (($m["sign"])?($m["sign"]):'未填写个性签名'); ?></p>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	<?php echo ($script); ?>
});
</script>
<div class="modal fade" id="showBase" tabindex="-1" role="dialog" aria-labelledby="showWechatLabel" aria-hidden="true">
  <div class="modal-dialog">
	<form class="modal-content" method='post'>
	  <div class="modal-header">
		<!--button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button-->
		<h4 class="modal-title" id="showWechatLabel">提示信息</h4>
	  </div>
	  <div class="modal-body">
		  <p id='info-container' class='text-primary text-center'><?php echo ($scriptMsg); ?></p>
	  </div>
	  <div class="modal-footer">
		<a id='showwechat-btn' href="<?php echo U('info_base');?>" class="btn btn-primary">现在就去</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">稍后再改</button>
	  </div>

	</form>
  </div>
</div>

<div class="list-group bony-font-2">
  
  <a class="list-group-item" href='<?php echo U('yyb');?>'>
    红线购买
    <span class='pull-right icon-chevron-right'></span>
  </a>


  <a class="list-group-item" href='<?php echo U('myNews');?>'>
    我的活动
    <span class='badge'><?php echo ($ok); ?></span>
  </a>

  <!--a class="list-group-item" href='<?php echo U('myUser');?>'>
    我的关注
    <span class='badge'><?php echo ($follow); ?></span>
  </a-->

  <a class="list-group-item" href='<?php echo U('redlineDetail');?>?types=buy'>
    我的红线
    <span class='badge'><?php echo ($m['redline']); ?></span>
  </a>
<a class="list-group-item" href='<?php echo U('redlineDetail');?>?types=free'>
    免费机会
    <span class='badge'><?php echo ($m['redlinefree']); ?></span>
  </a>
  <a class="list-group-item" href='<?php echo U('order');?>'>
    我的订单
    <span class='pull-right icon-chevron-right'></span>
  </a>

  <a class="list-group-item" href='<?php echo U('info');?>'>
    我的资料
    <span class='pull-right icon-chevron-right'></span>
  </a>

  <!--a class="list-group-item" href='<?php echo U('myShow');?>'>
    微展示
    <span class='pull-right icon-chevron-right'></span>
  </a-->

 <a class="list-group-item" href='<?php echo U('pwd');?>'>
    修改密码
    <span class='pull-right icon-chevron-right'></span>

  <a class="list-group-item" href='<?php echo U('logout');?>'>
    注销退出
    <span class='pull-right icon-chevron-right'></span>
  </a>

  
</div>


    <div style="height:7rem;"></div>
    <nav class="bony-nav bony-pink navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="container-fluid">
            <div class="col-xs-4">
                <a href="<?php echo U('/Mobile/Classify/index');?>">
                    <i class="icon-home icon-large"></i>
                    <p>主页</p>
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