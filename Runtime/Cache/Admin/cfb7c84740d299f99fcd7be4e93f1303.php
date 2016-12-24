<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>管理员后台</title>
	<link href="__HOMEPUBLIC__/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="__PUBLIC__/css/layout.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="__PUBLIC__/css/bony.css" type="text/css" media="screen" />
	<link href="__HOMEPUBLIC__/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="__HOMEPUBLIC__/css/buttons.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="__HOMEPUBLIC__/js/jquery-1.11.1.min.js"></script>
    <script src="__HOMEPUBLIC__/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="__HOMEPUBLIC__/js/buttons.js"></script>	
    <script type="text/javascript" src="__HOMEPUBLIC__/js/holder.min.js"></script>
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="__PUBLIC__/css/ie.css" type="text/css" media="screen" />
	<script src="http://libs.useso.com/js/html5shiv/3.6/html5shiv.min.js"></script>
	<![endif]-->
	<script src="__PUBLIC__/js/hideshow.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() { 
      	  $(".tablesorter").tablesorter(); 
   	});
	$(document).ready(function() {

		//When page loads...
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(".tab_content:first").show(); //Show first tab content

		//On Click Event
		$("ul.tabs li").click(function() {

			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content

			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
		});
	});
    </script>
	<script type="text/javascript">
	    $(function(){
	        $('.column').equalHeight();
	    });
	    function sure(url){
			var x = confirm('确定要执行该操作？');
			if(x){
				document.location=url;
			}
		}
	</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="<?php echo U('/Admin/Index');?>">管理菜单</a></h1>
			<h2 class="section_title"></h2>
			<div class="btn_view_site">
				<a target='_blank' href="<?php echo U('/');?>">前台首页</a>
			</div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><a href='<?php echo U('/Home/Member/');?>'><?php echo (session('id')); ?></a><!--  (<a href="<?php echo U('/Admin/Index/');?>">3 条信息</a>) --></p>
			<!--<a class="logout_user" href="#" title="Logout">注销</a>  -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="<?php echo U('/Admin/Index/index');?>">后台首页</a> <div class="breadcrumb_divider"></div> <a class="current"><?php echo ($location); ?></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
<aside id="sidebar" class="column">
<!-- 		<form class="quick_search">
		<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
	</form> -->


<hr>
<h3>活动管理</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/News/add');?>"><i class='icon-plus'></i> 添加活动</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/News/index');?>"><i class='icon-list'></i> 活动列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/News/catList');?>"><i class='icon-check'></i> 活动分类</a></li>
	
</ul>

<h3>用户管理</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/index');?>"><i class='icon-user'></i> 用户列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/node');?>"><i class='icon-user'></i> 节点列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/role');?>"><i class='icon-user'></i> 角色列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/complain');?>"><i class='icon-user'></i> 投诉列表</a></li>
</ul>

<!-- <h3>消费日志</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Log/yyb');?>"><i class='icon-user'></i> 姻缘币日志</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Log/redline');?>"><i class='icon-user'></i> 红线日志</a></li>
</ul> -->

<h3>微信管理</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Wechat/tplMsg');?>"><i class='icon-plus'></i> 模板消息</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Wechat/index');?>"><i class='icon-reorder'></i> 图文列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Wechat/menu');?>"><i class='icon-reorder'></i> 自定义菜单</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Wechat/cfg','id=1');?>"><i class='icon-gear'></i> 接口设置</a></li>
</ul>


<h3>广告与链接</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Nav/index');?>"><i class='icon-picture'></i> 超链接</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Ads/index');?>"><i class='icon-list'></i> 广告位</a></li>
</ul>


<h3>个人设置</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Index/cfg','id=1');?>"><i class='icon-key'></i> 参数设置</a></li>	
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Index/pwd');?>"><i class='icon-key'></i> 修改密码</a></li>
	<li><a href="<?php echo U('/Home/Member/logout');?>"><i class='icon-signout'></i> 注销退出</a></li>
</ul>

	
	<footer>
		<hr />
		<p><strong>Copyright &copy; Weizixun</strong></p>
		<p>Theme by <a href="#">Weizixun</a></p>
	</footer>
</aside>

	<section id="main" class="column">
		<form method='post' action='<?php echo U('Wechat/update','action=save');?>'>
		<input type='hidden' name='id' value='<?php echo ($data["id"]); ?>'>
		<article class="module width_full">
			<header><h3><?php echo ($location); ?></h3></header>
				<div class="module_content">


<fieldset style="width:24%; float:left; margin-right:1%; margin-top:0">
	<label>文章主图</label>
	<input type='hidden' id='img_input' name='img' value='<?php echo ($data["img"]); ?>'>
	<div class="clear"></div>
	<div data-toggle="modal" data-target="#myModal" title='修改图片' style='display:block; width:200px; margin:0 auto; overflow:hidden'>
		<?php if(strlen($data['img']) > 0 AND (file_exists('Upload/wechat/thumb200_'.$data['img']))): ?><img src='__UPLOAD__/wechat/thumb200_<?php echo ($data["img"]); ?>' class='shop_pic img-responsive img-rounded img-thumbnail'>
		<?php else: ?>
			<img src="__PUBLIC__/images/add.gif" class='shop_pic img-responsive img-rounded img-thumbnail'><?php endif; ?>
	</div>
	<label>&nbsp;</label>
	<div class="clear"></div>
</fieldset>


<fieldset style="width:75%; margin-top:0; float:right">
  <label>关键字</label>
  <input name='keyword' type="text" value='<?php echo ($data["keyword"]); ?>'>
</fieldset>

<fieldset style="width:75%; margin-top:0; float:right">
	<label>文章标题</label>
	<input name='title' type="text" value='<?php echo ($data["title"]); ?>'>
</fieldset>

<fieldset style="width:75%; margin-top:0; float:right">
	<label>文章摘要</label>
	<textarea style='height:73px' name='summary'><?php echo ($data["summary"]); ?></textarea>
</fieldset>

<fieldset style="width:75%; margin-top:0; float:right">
	<label>链接地址</label>
	<input name='url' type="text" value='<?php echo ($data["url"]); ?>'>	
</fieldset>

<fieldset style="width:75%; margin-top:0; float:right">
  <label>多图文列表（请勿超过9个）</label>
  <input readonly name='itemlist' type="text" value='<?php echo ($data["itemlist"]); ?>'>  
</fieldset> 					

<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="提 交" class="alt_btn">
					<input onclick='history.go(-1)' type="button" value="返 回">
				</div>
			</footer>
		</article><!-- end of post new article -->

		</form>

	</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method='post' enctype='multipart/form-data' id='myForm' action='<?php echo U('upload');?>'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">主图上传</h4>
      </div>
      <div class="modal-body">
        	<fieldset>
        		<label>当前图片</label>
        		<div class="clear"></div>
        		<p align='center'>	
<?php if(strlen($data['img']) > 0 AND (file_exists('Upload/wechat/thumb200_'.$data['img']))): ?><img src='__UPLOAD__/wechat/thumb200_<?php echo ($data["img"]); ?>' class='shop_pic img-responsive img-rounded img-thumbnail'>
<?php else: ?>
  <img src="__PUBLIC__/images/add.gif" class='shop_pic img-responsive img-rounded img-thumbnail'><?php endif; ?>
				</p>
			</fieldset>
        	<fieldset>
        		<label>上传新图</label>
        		<div class="clear"></div>
        		<p align='center'><input name='pic' type='file'></p>
        	</fieldset>
      </div>
      <div class="modal-footer">
        <button id='my-submit' type="submit" class="btn btn-primary">上传图片</button>
        <button id='my-close' type="button" class="btn btn-default" data-dismiss="modal">关闭取消</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="itemlistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">选择图文条目</h4>
      </div>
      <div class="modal-body" style="max-height:400px; overflow-y:auto">

      <table class="tablesorter" cellspacing="0"> 
      <tbody>
      <?php if(is_array($reply)): $i = 0; $__LIST__ = $reply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>   
            <td width='60'>
              <div style='width:60px; height:60px; over-flow:hidden'>
            <?php if(strlen($vo['img']) > 0): ?><img src='__UPLOAD__/wechat/thumb200_<?php echo ($vo["img"]); ?>' class='img-responsive img-rounded img-thumbnail'>
            <?php else: ?>
              <img src="__HOMEPUBLIC__/images/no_pic.gif" class='img-responsive img-rounded img-thumbnail'><?php endif; ?>
              </div>
            </td> 
            <td><?php echo ($vo["title"]); ?></td>
            <td><button class='btn btn-xs btn-primary add-btn' type="button" value='<?php echo ($vo["id"]); ?>'>添加</button></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>  
      </tbody> 
      </table>
    
      </div>
      <div class="modal-footer">
        <button id='my-submit2' type="button" class="btn btn-primary" data-dismiss="modal">确定选择</button>
        <button id='my-close2' type="button" class="btn btn-default" data-dismiss="modal">关闭取消</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="__PUBLIC__/js/jquery.form.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

      /* 弹出模态框，显示可选的图文 */
      $("input[name=itemlist]").click(function(){
        $id = $(this).attr('itemid');
        $("#replyid").val($id);
        $("#itemlistModal").modal('show');
      });


      /*  上传主图 */
      var path = '__UPLOAD__/wechat/';
  		var options = {
        success	: function (data) {
        	$src_1 = path+'thumb_'+data;
        	$src_2 = data;
        	
            $(".shop_pic").attr('src',path+'thumb_'+data);
            $("#img_input").val($src_2);
            $("#my-submit").remove();
            $("#my-close").text('确定使用');
            alert('上传成功');
        }
      };
      $('#myForm').on('submit', function(e) {
          e.preventDefault(); // <-- important
          $(this).ajaxSubmit(options);
      });

      $count = 0;
      $('.add-btn').click(function(){
        if($count<9){
          $v = $(this).val();
          var dom = $("input[name=itemlist]");
          if(dom.val()==''){
            dom.val($v);
          }else{
            $vold = dom.val();
            dom.val($vold+','+$v);
          }
          $(this).parent().parent('tr').addClass('myhide');
        }else{
          alert('最多9个');
        }
        $count++;
      });

      $("#my-close2").click(function(){
        $count = 0;
        $('tr.myhide').removeClass('myhide');
        $("input[name=itemlist]").val('');
      });

    });


</script>
<style type="text/css">tr.myhide{display: none;}</style>
</body>

</html>