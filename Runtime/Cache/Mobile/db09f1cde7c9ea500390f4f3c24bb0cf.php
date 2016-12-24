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
		<div class='bony-h1 bony-text-pink' style="font-size:18px">			
			【<?php echo ($data["title"]); ?>——<?php if($data['status'] == 0): ?>单选<?php else: ?>多选<?php endif; ?>】
			<input type="hidden" id="hid_select_type" value="<?php echo ($data["status"]); ?>">
		</div>

		<div class="row">
			
			<div class="col-xs-12 col-md-6">	         
			<?php if(!empty($data['image']) AND file_exists('.'.$data['img'])): ?><div class="bony-p"><img src='<?php echo ($data["image"]); ?>' class='img-responsive'></div><?php endif; ?>	          
			<div class="bony-h"></div>
	          <div class="bony-p" style="font-size:18px;margin: 16px auto;">投票截止时间：<br><?php echo (date('Y-m-d H:i',$data["start_time"])); ?> —— <?php echo (date('Y-m-d H:i',$data["end_time"])); ?></div>
	          <div class="bony-p">
			  <ul class="list-group">				  
				  <?php if(is_array($options)): $i = 0; $__LIST__ = $options;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><li class="list-group-item">			  				  
				  <label style="font-size:18px">
				  <?php if(intval($voted) == 0): if($data['status'] == 0): ?><input type="radio" name="option" value="<?php echo ($option["id"]); ?>" />
					  <?php else: ?>
					  <input type="checkbox" name="option" value="<?php echo ($option["id"]); ?>" /><?php endif; endif; ?>
				  <?php echo ($option["title"]); ?>				  
				  </label>			  
				  <?php if(!empty($option['image'])): ?><div><img src="<?php echo ($option["image"]); ?>" class="img-thumbnail"></div><?php endif; ?>
				  <?php if(intval($voted) > 0): ?><div class="progress" style="margin-top:5px">
					  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($statistic[$option['id']]['percent']); ?>%;">
						<?php echo ($statistic[$option['id']]['percent']); ?>%(<?php echo ($statistic[$option['id']]['amount']); ?>票)
					  </div>
					</div><?php endif; ?>	
				  </li><?php endforeach; endif; else: echo "" ;endif; ?>	
				  <?php if($data['start_time'] > time()): ?><li class="list-group-item"><a class="button button-rounded button-caution button-block">未开始投票</a></li>				  
				  <?php elseif(time() > $data['end_time']): ?>				  
				  <li class="list-group-item"><a class="button button-rounded button-caution button-block">投票结束</a></li>
				  <?php else: ?>
					  <?php if(intval($voted) > 0): ?><li class="list-group-item"><a class="button button-rounded button-caution button-block">已投票</a></li>
					  <?php else: ?>
					  <li class="list-group-item"><a id="btn_vote" href="javascript:void" class="button button-rounded button-caution button-block">投票</a></li><?php endif; endif; ?>
				</ul>
	          </div>    
	        </div>			
		</div>
	</div>	

<div class="modal fade" id="showBase" tabindex="-1" role="dialog" aria-labelledby="showWechatLabel" aria-hidden="true">
  <div class="modal-dialog">	
  <form class="modal-content" method='post'>
	  <div class="modal-header">
		<!--button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button-->
		<h4 class="modal-title" id="showWechatLabel">提示信息</h4>
	  </div>
	  <div class="modal-body">
		  <p id='info-container' class='text-primary text-center'></p>
	  </div>
	  <div class="modal-footer">				
		<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
	  </div>
   </form>
  </div>
</div>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
wx.config({
    debug: false,
    appId: '<?php echo ($signPackage["appId"]); ?>',
    timestamp: <?php echo ($signPackage["timestamp"]); ?>,
    nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
    signature: '<?php echo ($signPackage["signature"]); ?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
});
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {    
	// 发送给好友  
	WeixinJSBridge.on('menu:share:appmessage', function(argv){  
		WeixinJSBridge.invoke('sendAppMessage',{  
		"appid": '<?php echo ($signPackage["appId"]); ?>',  
		"img_url": 'http://yinyuan.de<?php echo ($data["image"]); ?>',  
		//"img_width": "640",  
		//"img_height": "640",  
		"link": 'http://yinyuan.de/Mobile/Vote/index/?id=<?php echo ($data["id"]); ?>',  
		"desc": '<?php echo ($data["content"]); ?>',  
		"title": '<?php echo ($data["title"]); ?>' 
		}, function(res) {  
			_report('send_msg', res.err_msg);  
		});
	});  
	// 分享到朋友圈  
	WeixinJSBridge.on('menu:share:timeline', function(argv){  
		WeixinJSBridge.invoke('shareTimeline',{  
		"img_url": 'http://yinyuan.de<?php echo ($data["image"]); ?>',  
		//"img_width": "640",  
		//"img_height": "640",  
		"link": 'http://yinyuan.de/Mobile/Vote/index/?id=<?php echo ($data["id"]); ?>',  
		"desc": '<?php echo ($data["content"]); ?>',  
		"title": '<?php echo ($data["title"]); ?>' 
		}, function(res) {  
			_report('timeline', res.err_msg);  
		});    
	});  

	// 分享到微博  
	WeixinJSBridge.on('menu:share:weibo', function(argv){  
		//shareWeibo();  
	});  
}, false); 

$(document).ready(function(){
	$('#btn_vote').click(			
		function(){
			var multiple = $('#hid_select_type').val();			
			var options = '';
			if(multiple != '0'){
				$(':checkbox').each(function(i){
					var checkbox = $(this);
					if(checkbox.is(':checked')){
						options += checkbox.val() + ',';
					}
				});
			}else{
				$(':radio').each(function(i){
					var radio = $(this);					
					if(radio.is(':checked')){
						options = radio.val();
						return false;
					}
				});
			}						
			if(!options){
				alert('请选择投票选项');
				return false;
			}
			$.getJSON('<?php echo U('Vote/vote');?>', {options:options,vote_id:<?php echo $data['id']; ?>}, function(data){
				if(data.url){
					location.href = data.url;
				}else{
					$('#info-container').text(data.msg);				
					$('#showBase').modal('show');				
				}
			});			
		}
	);		
	$('#showBase').on('hide.bs.modal', function (e) {	
		if($('#info-container').text() == '投票成功'){	
			location.href = '/Mobile/Vote/index/?id=<?php echo ($data["id"]); ?>&r=' + Math.random();
		}
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