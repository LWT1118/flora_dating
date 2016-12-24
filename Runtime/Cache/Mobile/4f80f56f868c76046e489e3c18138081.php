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
			【<?php echo ($data["title"]); ?>】
			<input type="hidden" id="hid_select_type" value="<?php echo ($data["status"]); ?>">
		</div>

		<div class="row">
			
			<div class="col-xs-12 col-md-6">	         
			<?php if(!empty($data['image']) AND file_exists('.'.$data['img'])): ?><div class="bony-p"><img src='<?php echo ($data["image"]); ?>' class='img-responsive'></div><?php endif; ?>	          
			<div class="bony-h"></div>
	          <div class="bony-p">投票截止时间：<?php echo (date('Y-m-d H:i',$data["start_time"])); ?> —— <?php echo (date('Y-m-d H:i',$data["end_time"])); ?></div>
	          <div class="bony-p">
			  <ul class="list-group">				  
				  <?php if(is_array($options)): $i = 0; $__LIST__ = $options;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><li class="list-group-item">			  				  				 
				  <?php if(!empty($option['image'])): ?><img src="<?php echo ($option["image"]); ?>" class="img-thumbnail"><?php endif; ?>
				  <?php echo ($option["title"]); ?>				 
				    <div class="progress" style="margin-top:5px">
					  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($statistic[$option['id']]['percent']); ?>%;">
						<?php echo ($statistic[$option['id']]['percent']); ?>%(<?php echo ($statistic[$option['id']]['amount']); ?>票)
					  </div>
					</div>
				  </li><?php endforeach; endif; else: echo "" ;endif; ?>			 				  
				</ul>
	          </div>    
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