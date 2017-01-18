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



	<div class='container'>
		<div class='row bony-mt2'>
			<div class='col-md-8 col-xs-12'>
				<?php if(strlen($news['img']) > 0): ?><img src='__UPLOAD__/news/thumb400_<?php echo ($news["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img src="holder.js/720x400/random/text:<?php echo ($news["title"]); ?>" class='img-responsive'><?php endif; ?>				
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
				<?php if($time_stamp > $news['end_time']): ?><span class='button button-default button-block button-rounded'>活动已结束</span>
				<?php else: ?>				
					<?php if(($reg) == "0"): if($news["alive"] == 0): ?><a href='<?php echo U('Mobile/News/reg','id='.$news['id']);?>' class='button button-caution button-block button-rounded'>报名参加</a>
						<?php elseif($news["alive"] == 1): ?>
						<a href='<?php echo U('Mobile/News/reg','id='.$news['id']);?>' class='button button-caution button-block button-rounded'>只接受男士报名(女士已满)</a>
						<?php elseif($news["alive"] == 2): ?>
						<a href='<?php echo U('Mobile/News/reg','id='.$news['id']);?>' class='button button-caution button-block button-rounded'>只接受女士报名(男士已满)</a>
						<?php elseif($news["alive"] == 3): ?>
						<span class='button button-default button-block button-rounded'>报名结束</span><?php endif; ?>
					<?php else: ?>
					<a href="#" onclick='javascript:sure("<?php echo U('Mobile/News/cancel','id='.$news['id']);?>")' class='button button-caution button-block button-rounded'>取消报名</a><?php endif; endif; ?>
			</div>
				<div class="clearfix"></div>			
		</div>

		<div class='bony-h1 bony-mt2'>更多活动</div>
		<div class="row bony-more-list">

			<?php if(is_array($more)): $i = 0; $__LIST__ = $more;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$more): $mod = ($i % 2 );++$i;?><div class="col-sm-4 col-xs-6">
				<a href='<?php echo U('Mobile/News/detail','id='.$more['id']);?>'>
				<?php if(strlen($more['img']) > 0): ?><img src='__UPLOAD__/news/thumb300_<?php echo ($more["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img src="__PUBLIC__/images/no_pic.gif" class='img-responsive'><?php endif; ?>
				</a>
				<!-- <span class='pull-right bg3'>
					报名：<?php echo ($more["reg"]); ?><br>
					签到：<?php echo ($more["arrival"]); ?>
				</span> -->
				<h3><?php echo (left_title($more["title"],16)); ?></h3>
				<p>开始：<?php echo (date('Y-m-d H:i',$more["start_time"])); ?></p>
				<p>结束：<?php echo (date('Y-m-d H:i',$more["end_time"])); ?></p>
				<p>地点：<?php echo ($more["summary"]); ?></p>
				
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="clearfix"></div>
			

		</div>
		<a href='<?php echo U('Mobile/News/index');?>' class='bony-mt2 button button-glow button-royal button-rounded button-small button-block'>查看更多</a>
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