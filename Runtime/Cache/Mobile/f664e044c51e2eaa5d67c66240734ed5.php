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

	<div class="row mt10">
		
		<div class='col-sm-12 col-xs-12'>



  	<div class="container-fluid">
  		
  		<div class="row">
  			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notify): $mod = ($i % 2 );++$i;?><div class="col-xs-12 col-md-6">
	          <a href='<?php echo U('Mobile/News/detail','id='.$notify['id']);?>'>
				<?php if(strlen($notify['img']) > 0 AND file_exists('./Upload/news/thumb300_'.$notify['img'])): ?><img width='100%' src='__UPLOAD__/news/thumb300_<?php echo ($notify["img"]); ?>' class='img-responsive'>
				<?php else: ?>
					<img width='100%' src="holder.js/360x200/random/text:<?php echo ($notify["title"]); ?>" class='img-responsive'><?php endif; ?>
	          </a>

	          <div class="bony-h"><?php echo (left_title($notify["title"],12)); ?></div>
	          <div class="bony-p"><?php echo (left_title($notify["content"],30)); ?></div>
	          <div class="bony-p">地点：<?php echo ($notify["summary"]); ?></div>
	          <div class="bony-p">时间：<?php echo (date('Y-m-d H:i',$notify["start_time"])); ?>——<?php echo (date('Y-m-d H:i',$notify["end_time"])); ?></div>
	          <a href="#" class="button button-rounded button-caution button-block">报名时间：<?php echo (date('Y-m-d H:i',$notify["reg_time"])); ?></a>
	          <hr>    
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		
	</div>

		
		</div>

	</div>

</div>


<script type="text/javascript" src="__PUBLIC__/js/jquery-ui-1.10.4.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/datepicker.zh.cn.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/jquery-ui.min-1.10.4.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/jquery.ui.datepicker-1.10.4.min.css">
<style type="text/css">
#ui-datepicker-div{
    /*width: 400px !important;*/
}
.ui-datepicker-year,.ui-datepicker-month{
    width: 45% !important;
}
</style>

<script>

$(function() {
    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        defaultDate: $( "#datepicker" ).val(),
        minDate: "<?php echo (date('Y-m-d g:i a',time())); ?>",       
    });    
});
</script>


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