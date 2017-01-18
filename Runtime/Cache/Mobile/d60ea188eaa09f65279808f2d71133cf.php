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



  <div class='container bony-login'>
    <div class="row">

      <form class="form-signin" method='post' action='<?php echo U('Mobile/Member/checklogin');?>'>
        <h2 class="form-signin-heading">会员登录</h2>
        <label for="inputEmail" class="sr-only">邮箱地址</label>
        <input name='user' type="email" id="inputEmail" class="form-control" placeholder="邮箱地址"  value="<?php echo ($username); ?>" required autofocus>
        <label for="inputPassword" class="sr-only">登录密码</label>
        <input name='pwd' type="password" id="inputPassword" class="form-control" placeholder="登录密码" required>
		<label>记住用户名<input name="remember" type="checkbox" checked="checked" value="1"></label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>
<!-- http://mp.weixin.qq.com/s?__biz=MzA3MTQzOTA3OA==&mid=207440771&idx=1&sn=ed6055714d51d5fc690c5767982ccce5#rd -->
        <a href="<?php echo U('Mobile/Member/register');?>" class="btn btn-lg btn-success btn-block" type="button">注册会员</a>
        <a href="<?php echo U('Mobile/Member/getBackPWD');?>" >找回密码</a>
      </form>   

    </div>
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