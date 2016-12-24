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
		<div class="row bony-mt2">
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="col-sm-4 col-md-6 col-xs-12">
				<a href='<?php echo U('Mobile/News/detail','id='.$data['id']);?>'>
				<?php if(strlen($data['img']) > 0): ?><img src='__UPLOAD__/news/thumb300_<?php echo ($data["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img src="holder.js/360x200/text:<?php echo (left_title($data["title"],16)); ?>" class='img-responsive'><?php endif; ?>
				</a>

<div class="bony-h bony-text-pink"><?php echo (left_title($data["title"],12)); ?></div>
<!-- <div class="well bony-mt2"><?php echo ($data["content"]); ?></div> -->
<div class="bony-p">地点：<?php echo ($data["summary"]); ?></div>
<div class="bony-p">时间：<?php echo (date('Y-m-d H:i',$data["start_time"])); ?>——<?php echo (date('Y-m-d H:i',$data["end_time"])); ?></div>
<a href="<?php echo U('Mobile/News/detail','id='.$data['id']);?>" class="button button-rounded button-caution button-block">已报<?php echo ($data["reg"]); ?>人次 查看详情</a>
	          <hr> 
			
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="pages"><?php echo ($page); ?></div>
		</div>
	</div>
	
	

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