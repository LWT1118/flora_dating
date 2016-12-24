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

<h3>投票管理</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Vote/add');?>"><i class='icon-plus'></i> 添加投票</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Vote/voteList');?>"><i class='icon-list'></i> 投票列表</a></li>
</ul>

<h3>用户管理</h3>
<ul class="toggle">
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/index');?>"><i class='icon-user'></i> 用户列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/node');?>"><i class='icon-user'></i> 节点列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/role');?>"><i class='icon-user'></i> 角色列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/User/complain');?>"><i class='icon-user'></i> 投诉列表</a></li>
</ul>

<h3>分类管理</h3>
<ul class="toggle">
    <li><a href="<?php echo U('/'.GROUP_NAME.'/Classify/index');?>"><i class='icon-plus'></i> 添加主分类</a></li>
    <li><a href="<?php echo U('/'.GROUP_NAME.'/Classify/childIndex');?>"><i class='icon-plus'></i> 添加子类</a></li>
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
    <form method='post' action="__URL__/doUpdate">
        <article class="module width_full">
            <header><h3><?php echo ($location); ?></h3></header>
            <div class="module_content">
                <fieldset style="width:24%; float:left; margin-right:1%; margin-top:0">
                    <label>活动主图</label>
                    <input type='hidden' id='img_input' name='img' value='<?php echo ($voteinfo["image"]); ?>'>
                    <div class="clear"></div>
                    <div data-toggle="modal" data-target="#myModal" title='修改图片' style='display:block; width:200px; height:200px;margin:0 auto; overflow:hidden'>
                        <img src="<?php echo ($voteinfo["image"]); ?>" class='shop_pic_1 img-responsive img-rounded img-thumbnail'>
                    </div>
                    <label>&nbsp;</label>
                    <div class="clear"></div>
                </fieldset>

                <fieldset>
                    <label>活动标题</label>
                    <input name='title' type="text" value='<?php echo ($voteinfo["title"]); ?>'>
                </fieldset>

                <fieldset style='width:37%; margin-top:0; float:left'>
                    <label>开始时间</label>
                    <input class='datepicker' type='text' name='start_time' value='<?php echo (date("Y-m-d H:i:s",$voteinfo["start_time"])); ?>'>
                </fieldset>

                <fieldset style='width:37%; margin-top:0; float:left; margin-left:1%'>
                    <label>结束时间</label>
                    <input class='datepicker' type='text' name='end_time' value='<?php echo (date("Y-m-d H:i:s",$voteinfo["end_time"])); ?>'>
                </fieldset>                

                <fieldset style='width:75%; margin-top:0; float:right;'>
                    <label>投票类型</label>
                    <span style="margin-left:1.5%">单选</span>&nbsp;&nbsp;<input type='radio' name='select_type' value='0'<?php if($voteinfo["status"] == '0'): ?>checked<?php endif; ?>>
                    <span style="margin-left:3%">多选</span>&nbsp;&nbsp;<input type='radio' name='select_type' value='1' <?php if($voteinfo["status"] == '1'): ?>checked<?php endif; ?>>
                </fieldset>
                <div class="clear"></div>

                <fieldset>
                    <label>活动详情</label>
                    <textarea style='height:100px' name='content'><?php echo ($voteinfo["content"]); ?></textarea>
                </fieldset>
                <div class="clear"></div>
            </div>
            <footer>
                <div class="submit_link">
                    <input type="submit" value="提 交" class="alt_btn">
                    <input onclick='history.go(-1)' type="button" value="返 回">
                    <input type="hidden" name="vote_id" value="<?php echo ($voteinfo["id"]); ?>">
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
                <h4 class="modal-title" id="myModalLabel">活动主图上传</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <label>当前图片</label>
                    <div class="clear"></div>
                    <p align='center'>
                        <?php if($voteinfo["image"] != ''): ?><img class='shop_pic_2' src='<?php echo ($voteinfo["image"]); ?>' class='img-responsive img-rounded img-thumbnail'>
                            <?php else: ?>
                            <img class='shop_pic_2' src="holder.js/360x200/#f90:#000/text:点击下面浏览按钮上传图片" class='img-responsive img-rounded img-thumbnail'><?php endif; ?>
                    </p>
                </fieldset>
                <fieldset>
                    <label>上传新图</label>
                    <div class="clear"></div>
                    <div style='padding:10px'>
                        <p><input name='pic' type='file'></p>
                    </div>
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

<!-- 时间选择文件 -->
<script src="__HOMEPUBLIC__/js/mobiscroll.core-2.5.2.js" type="text/javascript"></script>
<script src="__HOMEPUBLIC__/js/mobiscroll.core-2.5.2-zh.js" type="text/javascript"></script>
<link href="__HOMEPUBLIC__/css/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css" />
<link href="__HOMEPUBLIC__/css/mobiscroll.animation-2.5.2.css" rel="stylesheet" type="text/css" />
<script src="__HOMEPUBLIC__/js/mobiscroll.datetime-2.5.1.js" type="text/javascript"></script>
<script src="__HOMEPUBLIC__/js/mobiscroll.datetime-2.5.1-zh.js" type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.js"></script>
<script type="text/javascript">
    $url = "<?php echo U('News/time');?>";
    $(document).ready(function() {
        $(function () {
            var currYear = (new Date()).getFullYear();
            var opt={};
            opt.date = {preset : 'date'};
            //opt.datetime = { preset : 'datetime', minDate: new Date(2012,3,10,9,22), maxDate: new Date(2014,7,30,15,44), stepMinute: 5  };
            opt.datetime = {preset : 'datetime'};
            opt.time = {preset : 'time'};
            opt.default = {
                theme: 'android-ics light', //皮肤样式
                display: 'modal', //显示方式
                mode: 'scroller', //日期选择模式
                lang:'zh',
                startYear:currYear - 10, //开始年份
                endYear:currYear + 10 //结束年份
            };
            $("#appDate").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
            var optDateTime = $.extend(opt['datetime'], opt['default']);
            var optTime = $.extend(opt['time'], opt['default']);
            $(".datepicker").mobiscroll(optDateTime).datetime(optDateTime);
            $("#appTime").mobiscroll(optTime).time(optTime);
        });

        var path = '__UPLOAD__/vote/';
        var options = {
            success	: function (data) {
                $src_1 = path+'thumb200_'+data;
                $src_2 = path+'thumb300_'+data;
                $src = data;

                $(".shop_pic_1").attr('src',$src_1);
                $(".shop_pic_2").attr('src',$src_2);
                $("#img_input").val($src);
                $("#my-submit").remove();
                $("#my-close").text('确定使用');
                //alert('上传成功');
            }
        };
        $('#myForm').on('submit', function(e) {
            e.preventDefault(); // <-- important
            $(this).ajaxSubmit(options);
        });

    });
</script>
</body>

</html>