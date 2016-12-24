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



	<div class='container bony-nav'>
		<div class='myh1 bg1'><?php echo ($news["title"]); ?></div>
		<div class='row mt20'>
			<div class='col-md-8 col-xs-12'>
				<?php if(strlen($news['img']) > 0): ?><img src='__UPLOAD__/news/thumb400_<?php echo ($news["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img src="holder.js/720x400/random/text:暂无活动主图" class='img-responsive'><?php endif; ?>				
			</div>
			<div class='col-md-4 col-xs-12'>
				<table class='table table-hover'>
					<tr>
						<td width='30%'>活动地点：</td>
						<td><?php echo ($news["summary"]); ?></td>
					</tr>
					<tr>
						<td>开始时间：</td>
						<td><?php echo (date('Y-m-d H:i',$news["start_time"])); ?></td>
					</tr>
					<tr>
						<td>结束时间：</td>
						<td><?php echo (date('Y-m-d H:i',$news["end_time"])); ?></td>
					</tr>
					<tr>
						<td>报名人数：</td>
						<td><?php echo ($news["reg"]); ?></td>
					</tr>
					<tr>
						<td>签到人数：</td>
						<td><?php echo ($news["arrival"]); ?></td>
					</tr>
					<tr>
						<td>活动说明：</td>
						<td><?php echo (nl2br($news["content"])); ?></td>
					</tr>
				</table>
				<a href='/Home/Index/yinyuan' class='button button-primary button-block button-rounded button-raised button-large'>报名参加</a>
				<?php if(($reg) == "0"): ?><!--a href='<?php echo U('Home/News/reg','id='.$news['id']);?>' class='button button-primary button-block button-rounded button-raised button-large'>报名参加</a-->
				<?php else: ?>
				<!--span class='button button-default button-block button-rounded button-raised button-large'>您已经报过名了</span--><?php endif; ?>
			</div>
				<div class="clearfix"></div>			
		</div>
		<div class='myh2 mt20 bg3'><a href='<?php echo U('News/index');?>' class='pull-right'>more</a>更多活动</div>
		<div class="row mt20">

			<?php if(is_array($more)): $i = 0; $__LIST__ = $more;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$more): $mod = ($i % 2 );++$i;?><div class="col-sm-4 col-xs-12">
				<a href='<?php echo U('News/detail','id='.$more['id']);?>'>
				<?php if(strlen($more['img']) > 0): ?><img src='__UPLOAD__/news/thumb300_<?php echo ($more["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img src="__PUBLIC__/images/no_pic.gif" class='img-responsive'><?php endif; ?>
				<p>
					<span class='pull-right bg3'>
						报名：<?php echo ($more["reg"]); ?><br>
						签到：<?php echo ($more["arrival"]); ?>
					</span>
					<b><?php echo (left_title($more["title"],16)); ?></b>
					<b>时间：<?php echo (date('Y-m-d H:i',$more["start_time"])); ?> — <?php echo (date('Y-m-d H:i',$more["end_time"])); ?></b>
					<b>地点：<?php echo ($more["summary"]); ?></b>

				</p>
			</a>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>		

		</div>
	</div>


	<hr>
	<p class='text-center'>版权所有：天津乐聚中德商贸有限公司</p>
	<p class='text-center'>电子邮箱：yinyuan.de@hotmail.com</p>
	<p class='text-center'>津ICP备：15004935号-2</p>
</body>
</html>