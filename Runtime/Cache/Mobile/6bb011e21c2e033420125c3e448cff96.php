<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">
<meta name="apple-mobile-web-app-title" content="携程旅行">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta content="telephone=no" name="format-detection">
<link href="__PUBLIC__/css/classify.css" rel="stylesheet">
<link href="__PUBLIC__/css/abase.css" rel="stylesheet">
<link href="__PUBLIC__/css/swiper3.08.min.css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/swiper3.08.jquery.min.js"></script>
<meta name="full-screen" content="yes">
<meta name="x5-fullscreen" content="true">
<meta name="browsermode" content="application">
<meta name="x5-page-mode" content="app">
</head>
<body id="ctripPage">
<div id="js-index-page">
	<?php if(!empty($image_list)): ?><header class="jsmodule" id="js_module">
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php if(is_array($image_list)): $i = 0; $__LIST__ = $image_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img style="width:100%;height:auto" src="<?php echo ($image["image"]); ?>"></div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 如果需要分页器 -->
			<div class="swiper-pagination"></div>						
		</div>		
	</header><?php endif; ?>
	<nav id="nav" class="nav-entry">
	<?php if(is_array($relation_catalog)): $i = 0; $__LIST__ = $relation_catalog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parent): $mod = ($i % 2 );++$i;?><div class="row">
		<div class="col col-33"><a title="<?php echo ($parent['classname']); ?>" <?php if(!empty($parent['url'])): ?>href="<?php echo ($parent['url']); ?>"<?php endif; ?>><?php echo ($parent['classname']); ?></a></div>
		<?php if(is_array($parent['children'])): $i = 0; $__LIST__ = $parent['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chunk): $mod = ($i % 2 );++$i;?><div class="col col-33">
			<?php if(is_array($chunk)): $i = 0; $__LIST__ = $chunk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$catalog): $mod = ($i % 2 );++$i;?><a title="<?php echo ($catalog['classname']); ?>" <?php if(!empty($catalog['url'])): ?>href="<?php echo ($catalog['url']); ?>"<?php endif; ?>><em><?php echo ($catalog['classname']); ?></em></a><?php endforeach; endif; else: echo "" ;endif; ?>		
		</div><?php endforeach; endif; else: echo "" ;endif; ?>			
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	
	<div class="row">
	<?php if(is_array($single_catalog)): $i = 0; $__LIST__ = $single_catalog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chunk): $mod = ($i % 2 );++$i;?><div class="col col-33">
		<?php if(is_array($chunk)): $i = 0; $__LIST__ = $chunk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$catalog): $mod = ($i % 2 );++$i;?><a title="<?php echo ($catalog['classname']); ?>" <?php if(!empty($catalog['url'])): ?>href="<?php echo ($catalog['url']); ?>"<?php endif; ?>><em><?php echo ($catalog['classname']); ?></em></a><?php endforeach; endif; else: echo "" ;endif; ?>	
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>		
	</nav>		
</div>			
<script type="text/javascript">        
  var mySwiper = new Swiper ('.swiper-container', {
    loop: true,    
    autoplay: 1500,
    pagination: '.swiper-pagination',    
	paginationClickable:true,
	slideToClickedSlide:true,
	autoplayDisableOnInteraction:false
  });        
</script>