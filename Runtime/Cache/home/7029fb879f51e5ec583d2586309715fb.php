<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo ($page_title); ?> <?php echo ($site["name"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<meta name="keywords" content="<?php echo ($site["keyword"]); ?>" />
<meta name="description" content="<?php echo ($site["descreption"]); ?>" />


<script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/buttons.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/holder.min.js"></script>


<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/buttons.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/bony.css" rel="stylesheet" type="text/css" />


</head>
<body>


	<div class='container bony-ads'>

		<div class="row">
			<div class="col-sm-2">
				<?php echo ($ads1["content"]); ?>
			</div>
			<div class="col-sm-8">
				<?php echo ($ads2["content"]); ?>
			</div>
			<div class="col-sm-2">
				<?php echo ($ads3["content"]); ?>
			</div>
		</div>
	</div>



  <div class='container bony-login'>
    <div class="row">

      <form class="form-signin" method='post' action='<?php echo U('checklogin');?>'>
        <h2 class="form-signin-heading">登录 Login</h2>
        <label for="inputEmail" class="sr-only">邮箱地址</label>
        <input name='user' type="email" id="inputEmail" class="form-control" placeholder="邮箱地址" required autofocus>
        <label for="inputPassword" class="sr-only">登录密码</label>
        <input name='pwd' type="password" id="inputPassword" class="form-control" placeholder="登录密码" required>
        <button style='width:100%' class="button button-rounded button-large button-primary button-block" type="submit">登 录</button> 
      </form>   

    </div>
  </div>

	<hr>
	<p class='text-center'>版权所有：天津乐聚中德商贸有限公司</p>
	<p class='text-center'>电子邮箱：yinyuan.de@hotmail.com</p>
	<p class='text-center'>津ICP备：15004935号-2</p>
</body>
</html>