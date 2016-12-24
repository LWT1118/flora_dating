<?php if (!defined('THINK_PATH')) exit();?><html>
<!DOCTYPE html>
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

<script type="text/javascript">
function complain(id)
{
	if(!confirm("确定要投诉吗？"))	return;
	document.location.href = "<?php echo U('Mobile/Member/complain');?>" + "/?pid=" + id;
}
</script>

<div class="list-group bony-font-2">
  
<table class='table'>
	<tr>
		<th>数量</th>
		<th>原因</th>
		<th>时间</th>
		<th>查看微信</th>
		<th>虚假微信号</th>

	</tr>
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		<td><?php echo ($vo["num"]); ?></td>
		<td><?php echo (rtrim($vo["remarks"],'号')); ?></td>
		<td><?php echo (date('Y/m/d H:i:s',$vo["addtime"])); ?></td>
		<td><a href="<?php echo U('Mobile/User/detail', array('id'=>$vo['user']['id']));?>"><?php echo ($vo["user"]["wechat"]); ?></a></td>
 		<?php if($vo["status"] == 0): ?><td><a href="#" onclick="javascript:complain(<?php echo ($vo['pid']); ?>)">举报</a></td>
		<?php elseif($vo["status"] == -1): ?>
		<td>已举报</td>
		<?php elseif($vo["status"] == 1): ?>
		<td>已返还</td>
		<?php else: ?><td>已受理</td><?php endif; ?>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="pages"><?php echo ($page); ?></div>
</div

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



</html>