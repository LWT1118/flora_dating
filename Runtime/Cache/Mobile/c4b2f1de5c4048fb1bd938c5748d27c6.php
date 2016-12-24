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
  <div class="row">
    <div class='myh2 mt20'>会员注册</div>
    <div class="col-sm-12">

<form role="form" method='post' action='<?php echo U('Mobile/Member/checkregister');?>'>

  <input name='img' type='hidden' value='<?php echo ($img); ?>'>
  <div class="form-group">
    <label>邮箱</label>
    <input name='email' type="email" class="form-control" id="email" placeholder="邮箱" required="required">
  </div>

  <div class="form-group">
    <label>微信号</label>
    <input name='wechat' type="text" class="form-control" placeholder="微信号" required="required">
  </div>

  <div class="form-group">
    <label>手机号</label>
    <input name='tel' type="text" class="form-control" placeholder="手机号">
  </div>

  <div class="form-group">
    <label>昵称</label>
    <input name='nickname' type="text" class="form-control" placeholder="昵称">
  </div>

  <div class="form-group">
    <label>初始密码</label>
    <input name='p1' type="password" class="form-control" id="p1" placeholder="初始密码" required="required">
  </div>
  <div class="form-group">
    <label>确认密码</label>
    <input name='p2' type="password" class="form-control" id="p2" placeholder="确认密码" required="required">
  </div>
  <div class="form-group">
    <input name='p' type="checkbox" checked  id="p" value="1"><a href="<?php echo U('/Mobile/Member/protocol');?>">我已阅读并同意协议</a>
  </div>

  <button type="submit" class="btn btn-lg btn-block btn-primary">注 册</button>
</form>
  </div>
  </div>
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