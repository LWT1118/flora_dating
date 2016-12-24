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




<!-- 	<div class='container bony-ads'>

		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<?php echo ($ads["content"]); ?>
			</div>
			<div class="col-sm-6 col-xs-12">
				<?php echo ($ads2["content"]); ?>
			</div>
		</div>
	</div> -->
	


	<div class='container bony-nav'>
		<div class='myh2 mt20 bg3'><a href='<?php echo U('News/index');?>' class='pull-right'>more&raquo;</a>最新活动</div>
		<div class="row mt20">
			<?php if(is_array($notify)): $i = 0; $__LIST__ = $notify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notify): $mod = ($i % 2 );++$i;?><div class="col-sm-4 col-xs-12" style="float:right">
				<a href='<?php echo U('News/detail','id='.$notify['id']);?>'>
				<?php if(strlen($notify['img']) > 0 AND file_exists('./Upload/news/thumb300_'.$notify['img'])): ?><img src='__UPLOAD__/news/thumb300_<?php echo ($notify["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img src="holder.js/360x200/random/text:<?php echo ($notify["title"]); ?>" class='img-responsive'><?php endif; ?>
				</a>
				<a href='<?php echo U('News/detail','id='.$notify['id']);?>'>
				<p>
					<span class='bg3'>
						报名：<?php echo ($notify["reg"]); ?><br>
						签到：<?php echo ($notify["arrival"]); ?>
					</span>
					<h3><?php echo (left_title($notify["title"],12)); ?></h3>
					<b><i class='icon-time'></i> <?php echo (date('Y-m-d H:i',$notify["start_time"])); ?>——<?php echo (date('Y-m-d H:i',$notify["end_time"])); ?><a href="/Home/Index/yinyuan">报名</a></b>
					<b><i class='icon-map-marker'></i> <?php echo ($notify["summary"]); ?></b>

				</p>
				</a>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

<div class='container bony-member'>
	<div class='myh2 mt20 bg1'>优秀会员</div>
	<div class="row">
		<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><div class="col-sm-3 col-xs-6">
			<a href='<?php echo U('Home/Index/yinyuan');?>'>
			<img src="<?php echo ($user["img"]); ?>" class='img-circle img-thumbnail img-responsive'>
			<b><?php echo ($user["nickname"]); ?></b>
			<!--b>活跃度：<?php echo ($user["arrival"]); ?></b-->
			</a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="row">
		<div class="form-group">
			<a class="from-control btn btn-primary" href="/Home/Index/yinyuan">会员搜索</a>
		</div>
	</div>
</div>


<!-- <div class='container bony-link'>
	<div class='myh2 mt20 bg3'>合作伙伴</div>
	<div class="row mt20">
		
		<?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><div class="col-sm-2 col-xs-4 text-center"><a target='_blank' href="<?php echo ($link["url"]); ?>">
			<?php if(strlen($link['img']) > 0): ?><img src='__UPLOAD__/nav/thumb200_<?php echo ($link["img"]); ?>' class='img-thumbnail img-responsive'>
			<?php else: ?>
			<img src="holder.js/120x42/random/<?php echo ($link["title"]); ?>" class='img-thumbnail img-responsive'><?php endif; ?>	    	
	    </a></div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div> 
</div> -->


	<hr>
	<p class='text-center'>版权所有：天津乐聚中德商贸有限公司</p>
	<p class='text-center'>电子邮箱：yinyuan.de@hotmail.com</p>
	<p class='text-center'>津ICP备：15004935号-2</p>
</body>
</html>