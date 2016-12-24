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


<ul class="list-group bony-font-2">
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item">
        

    <div>
		<?php if($vo["status"] == 0): ?><a class='pull-right' href="javascript:sure('<?php echo U('Mobile/Member/orderDel','id='.$vo['id']);?>')">取消</a><?php endif; ?>
        <span class='pull-left'><?php echo ($vo["id"]); ?></span>
        <div class="clearfix"></div>
    </div>
    
    <div>
        <?php if(($vo['status']) == "0"): ?>下单时间：<?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?>
        <?php else: ?>
        付款时间：<?php echo (date('Y-m-d H:i:s',$vo["pay_time"])); endif; ?>
        
        <div class="clearfix"></div>
    </div>

           

    <div>
		<form method="post" action="<?php echo U('Mobile/Member/orderPay');?>/">
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
        <span class='pull-left'>总价：￥<?php echo ($vo["pay_price"]); ?></span>
		<span class='pull-right'>
		<?php if($vo["status"] == 0): ?><button class="btn btn-xs btn-success" type="submit">马上付款</button><?php endif; ?>
		</span>
        <div class="clearfix"></div>
		</form>
    </div>
                   
        
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="pages"><?php echo ($page); ?></div>
</ul>


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