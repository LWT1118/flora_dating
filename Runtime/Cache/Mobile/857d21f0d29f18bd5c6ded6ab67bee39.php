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


	<div class='container-fluid'>
		<div class='bony-h1 bony-text-pink'>
			<a href='<?php echo U('News/index');?>' class='pull-right'>更多&gt;</a>
			<i class="icon icon-tags"></i>
			最新活动
		</div>

		<div class="row">
			<?php if(is_array($notify)): $i = 0; $__LIST__ = $notify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notify): $mod = ($i % 2 );++$i;?><div class="col-xs-12 col-md-6">
	          <a href='<?php echo U('News/detail','id='.$notify['id']);?>'>
				<?php if(strlen($notify['img']) > 0 AND file_exists('./Upload/news/thumb300_'.$notify['img'])): ?><img width='100%' src='__UPLOAD__/news/thumb300_<?php echo ($notify["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img width='100%' src="holder.js/360x200/random/text:<?php echo ($notify["title"]); ?>" class='img-responsive'><?php endif; ?>
	          </a>

	          <div class="bony-h"><?php echo (left_title($notify["title"],12)); ?></div>
	          <div class="bony-p"><?php echo (left_title($notify["content"],30)); ?></div>
	          <div class="bony-p">地点：<?php echo ($notify["summary"]); ?></div>
	          <div class="bony-p">时间：<?php echo (date('Y-m-d H:i',$notify["start_time"])); ?>——<?php echo (date('Y-m-d H:i',$notify["end_time"])); ?></div>
	          <a href="<?php echo U('News/detail','id='.$notify['id']);?>" class="button button-rounded button-caution button-block">已报<?php echo ($notify["reg"]); ?>人次 查看详情</a>
	          <hr>    
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>

		</div>
	</div>


<!-- <div class='container bony-member'>
	<div class='myh2 mt20 bg1'>活跃会员</div>
	<div class="row">
		<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><div class="col-sm-3 col-xs-6">
			<a href='<?php echo U('Mobile/Index/user','id='.$user['id']);?>'>
			<?php if(strlen($user['img']) > 0): ?><img src='__UPLOAD__/user/thumb_<?php echo ($user["img"]); ?>' class='img-circle img-thumbnail img-responsive'>
			<?php else: ?>
			<img src="__PUBLIC__/images/no_face.gif" class='img-circle img-thumbnail img-responsive'><?php endif; ?>
			<b><?php echo ($user["realname"]); ?></b>
			<b>活跃度：<?php echo ($user["arrival"]); ?></b>
			</a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div> -->


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