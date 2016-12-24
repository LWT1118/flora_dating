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



    <div class="bony-pink bony-info-header">
        <div class='face'>
          <a href="#">
          <img src="<?php echo ($user["img"]); ?>" class='img-responsive img-circle' alt="头像照片">
          </a>
        </div>
        <h3><?php echo (($user["nickname"])?($user["nickname"]):'未填写昵称'); ?></h3>
        <p><?php echo (($user["sign"])?($user["sign"]):'未填写个性签名'); ?></p>
    </div>

    <div class="container">        
    
        <input type="hidden" name='userid' value='<?php echo ($user["id"]); ?>'>
        <script type="text/javascript">
        $url = "<?php echo U('Member/followTa');?>";
        $url2 = "<?php echo U('Member/showWechat');?>";
        $(document).ready(function(){
          $("a.follow").click(function(){
            $action = 'follow';
            $uid = $('input[name=userid]').val();
            $.post($url,{pid:$uid,action:$action},function(result){
              alert(result.info);
              if(result.status==1){
                $("a.follow").addClass('hidden');
                $('a.unfollow').removeClass('hidden');
              }
            });
          });
          $("a.unfollow").click(function(){
            $action = 'unfollow';
            $uid = $('input[name=userid]').val();
            $.post($url,{pid:$uid,action:$action},function(result){
              alert(result.info);
              if(result.status==1){
                $("a.follow").removeClass('hidden');
                $('a.unfollow').addClass('hidden');
              }
            });
          });

          $("a.showwechat").click(function(){
            $('#showWechat').modal('show');
          });

          $("#showwechat-btn").click(function(){
            $uid = $('input[name=userid]').val();
			$('#showWechat').modal('hide');
			var wxLink = $('a.showwechat');
			wxLink.text('正在拉取微信号……');
			wxLink.unbind('click');
            $.post($url2, {pid:$uid},function(result){
              //$("#info-container").html(result.info);
			  //$('#showWechat').modal('');
			  //wxLink.text(result.info);			  
			  if(result.status == 1){
				  location.reload();
			  }else{
				  wxLink.text(result.info);
				  wxLink.attr('href', '/Mobile/Member/yyb');
			  }
            });

          });


        });
        </script>

        <div class="row bony-mt2">
            <div class="col-xs-12">
			<?php if(($paid) == "0"): ?><a class='showwechat w100 button button-small button-action button-rounded w100'>查看微信号(需花费1根红线或使用一次免费机会)</a>
			<?php else: ?>
			<a class='w100 button button-small button-action button-rounded w100'>微信号：<?php echo ($user["wechat"]); ?>(您已花费红线或免费机会)</a><?php endif; ?>
            </div>
        </div>

       
    </div> 

	<div class="modal fade" id="showWechat" tabindex="-1" role="dialog" aria-labelledby="showWechatLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<form class="modal-content" method='post'>
		  <div class="modal-header">
			<!--button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button-->
			<h4 class="modal-title" id="showWechatLabel">提示信息</h4>
		  </div>
		  <div class="modal-body">
			  <p id='info-container' class='text-primary text-center'><?php echo ($msg); ?></p>
		  </div>
		  <div class="modal-footer">
			<button id='showwechat-btn' type="button" class="btn btn-primary">确认</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		  </div>

		</form>
	  </div>
	</div>
        
       

    <div class=" bony-mt2">
    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">内心独白</p>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                
                <td colspan="4 "><?php echo ($user["sign"]); ?></td>
            </tr>  
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">基本信息</p>                    
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>昵称：</td>
                <td><?php echo ($user["nickname"]); ?></td>
                <td>年龄：</td>
                <td><?php echo ($user["age"]); ?></td>
            </tr>
            <tr>
                <td>性别：</td>
				<?php if($user["gender"] == 0): ?><td>男</td>
		      <?php else: ?>
		        <td>女</td><?php endif; ?>
                
                <td>身高：</td>
                <td><?php echo ($user["height"]); ?></td>
            </tr>
            <tr>
                <td>学历：</td>
                <td><?php echo ($user["edu"]); ?></td>
                <td>婚姻状况：</td>
                <td><?php echo ($user["love"]); ?></td>
            </tr>
            <tr>
                <td>所在地区：</td>
                <td><?php echo ($user["area"]); ?></td>
                <td>所在城市：</td>
                <td><?php echo ($user["city"]); ?></td>
            </tr>
            <tr>
                <td>血型：</td>
                <td><?php echo ($user["blood"]); ?></td>
                <td>收入：</td>
                <td><?php echo ($user["income"]); ?></td>
            </tr>
            <tr>
                <td>购房情况：</td>
                <td><?php echo ($user["buyhouse"]); ?></td>
                <td>购车情况：</td>
                <td><?php echo ($user["buycar"]); ?></td>
            </tr>
            <tr>
                <td>公司类型：</td>
                <td><?php echo ($user["com_type"]); ?></td>
                <td>收入描述：</td>
                <td><?php echo ($user["income2"]); ?></td>
            </tr> 
            <tr>
                <td>专业：</td>
                <td><?php echo ($user["Professional"]); ?></td>
                <td>民族：</td>
                <td><?php echo ($user["nation"]); ?></td>
            </tr>
            <tr>                
                <td>信仰：</td>
                <td colspan="3"><?php echo ($user["faith"]); ?></td>
            </tr> 
            <tr>                
                <td>兴趣及爱好：</td>
                <td colspan="3"><?php echo ($user["interest"]); ?></td>
            </tr>   
        </tbody>
    </table>
	<?php if(($paid) == "1"): ?><table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">择偶要求</p>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>年龄范围：</td>
                <td><?php echo ($user["age_scope"]); ?></td>
                <td>身高范围：</td>
                <td><?php echo ($user["h_scope"]); ?></td>
            </tr>
            <tr>
                <td>学历要求：</td>
                <td><?php echo ($user["edu_scope"]); ?></td>
                <td>婚姻状况：</td>
                <td><?php echo ($user["love2"]); ?></td>
            </tr>
            <tr>
                <td>有无照片：</td>
                <td><?php echo ($user["i_scope"]); ?></td>
                <td>诚信星级：</td>
                <td><?php echo ($user["star"]); ?></td>
            </tr>   
        </tbody>
    </table>

     <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">家庭资料</p>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>户口：</td>
                <td colspan="3"><?php echo ($user["hukou"]); ?></td>
            </tr>
            <tr>
                <td>籍贯：</td>
                <td colspan="3"><?php echo ($user["jiguan"]); ?></td>
            </tr>
            <tr>
                <td>家中排行：</td>
                <td><?php echo ($user["ranking"]); ?></td>
                <td>父母状态：</td>
                <td><?php echo ($user["parent_sta"]); ?></td>
            </tr> 

        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">爱情规划</p>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>谈过几次恋爱：</td>
                <td colspan="3"><?php echo ($user["jici"]); ?></td>
            </tr>
            <tr>
                <td>近期是否有结婚打算：</td>
                <td colspan="3"><?php echo ($user["plan"]); ?></td>
            </tr>
            <tr>
                <td>婚后是否愿意要小孩：</td>
                <td colspan="3"><?php echo ($user["kid"]); ?></td>
            </tr> 
            <tr>
                <td>是否愿意和父母同住：</td>
                <td colspan="3"><?php echo ($user["live"]); ?></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">交友状态</p>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>交友状态：</td>
                <td colspan="3"><?php echo ($user["friend_sta"]); ?></td>
            </tr>
        </tbody>
    </table><?php endif; ?>

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