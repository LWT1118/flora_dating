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
	<li><a href="<?php echo U('/'.GROUP_NAME.'/VoteSelect/index');?>"><i class='icon-plus'></i> 添加选项</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/VoteSelect/voteList');?>"><i class='icon-list'></i> 投票列表</a></li>
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
	<form method='post' action='<?php echo U('cfgUpdate');?>'>
		<input value='<?php echo ($data["id"]); ?>' name='id' type="hidden">
		<article class="module width_full">
			<header>
				<h3><?php echo ($location); ?></h3>
			</header>
				<div class="module_content">
						
<fieldset>
	<label>网站名称</label>
	<input value='<?php echo ($data["site_name"]); ?>' class='txt_input' name='site_name' placeholder='网站名称'>
</fieldset>

<fieldset>
	<label>关键字列表</label>
	<input value='<?php echo ($data["kw"]); ?>' class='txt_input' name='kw' placeholder='关键字列表'>
</fieldset>

<fieldset>
	<label>网页描述</label>
	<input value='<?php echo ($data["description"]); ?>' class='txt_input' name='description' placeholder='网页描述'>
</fieldset>

<fieldset>
	<label>网站域名</label>
	<input value='<?php echo ($data["domain"]); ?>' class='txt_input' name='domain' placeholder='网站域名'>
</fieldset>

<fieldset>
	<label>客服邮件地址</label>
	<input value='<?php echo ($data["email"]); ?>' class='txt_input' name='email' placeholder='客服邮件地址'>
</fieldset>

<fieldset>
	<label>客服电话</label>
	<input value='<?php echo ($data["tel"]); ?>' class='txt_input' name='tel' placeholder='客服电话'>
</fieldset>

<fieldset>
	<label>公司名称</label>
	<input value='<?php echo ($data["company"]); ?>' class='txt_input' name='company' placeholder='公司名称'>
</fieldset>

<fieldset>
	<label>红线价格</label>
	<input value='<?php echo ($data["redline_price"]); ?>' class='txt_input' name='redline_price' placeholder='红线价格'>
</fieldset>

<fieldset><!--style="width:49%; float:left"-->
	<label>购买红线送月VIP数量</label>
	<input value='<?php echo ($data["vip_price_month"]); ?>' class='txt_input' name='vip_price_month' placeholder='VIP月价格（1个月）'>
</fieldset>

<!--fieldset style="width:49%; margin-left:2%; float:left;">
	<label>月度VIP会员</label>
	<input value='<?php echo ($data["vip_price_month_redline"]); ?>' class='txt_input' name='vip_price_month_redline' placeholder='赠送红线条数'>
</fieldset-->

<!--<fieldset style="width:49%; float:left">
	<label>购买红线</label>
	<input value='<?php echo ($data["vip_price_quarter"]); ?>' class='txt_input' name='vip_price_quarter' placeholder='VIP季度价格（3个月）'>
</fieldset>

<fieldset style="width:49%; margin-left:2%; float:left">
	<label>季度VIP会员</label>
	<input value='<?php echo ($data["vip_price_quarter_redline"]); ?>' class='txt_input' name='vip_price_quarter_redline' placeholder='赠送红线条数'>
</fieldset>

<fieldset style="width:49%; float:left">
	<label>购买红线</label>
	<input value='<?php echo ($data["vip_price_half_year"]); ?>' class='txt_input' name='vip_price_half_year' placeholder='VIP半年价格（6个月）'>
</fieldset>

<fieldset style="width:49%; margin-left:2%; float:left">
	<label>半年度VIP会员</label>
	<input value='<?php echo ($data["vip_price_half_year_redline"]); ?>' class='txt_input' name='vip_price_half_year_redline' placeholder='赠送红线条数'>
</fieldset>-->

<fieldset><!--style="width:49%; float:left"-->
	<label>购买红线送年VIP数量</label>
	<input value='<?php echo ($data["vip_price_year"]); ?>' class='txt_input' name='vip_price_year' placeholder='VIP年价格（12个月）'>
</fieldset>

<!--fieldset style="width:49%; margin-left:2%; float:left">
	<label>年度VIP会员</label>
	<input value='<?php echo ($data["vip_price_year_redline"]); ?>' class='txt_input' name='vip_price_year_redline' placeholder='赠送红线条数'>
</fieldset-->

<fieldset>
	<label>新注册用户赠送免费机会</label>
	<input value='<?php echo ($data["new_user_redline_free"]); ?>' class='txt_input' name='new_user_redline_free' placeholder='新注册用户赠送红线'>
</fieldset>

<fieldset>
	<label>会员红线赠送周期</label>
	<input value='<?php echo ($data["redline_free_frequence_days"]); ?>' class='txt_input' name='redline_free_frequence_days' placeholder='会员红线赠送周期'>
</fieldset>

<fieldset>
	<label>同时聊天最大组数</label>
	<input value='<?php echo ($data["max_group"]); ?>' class='txt_input' name='max_group' placeholder='同时聊天最大组数'>
</fieldset>

<fieldset>
	<label>未认证链接地址</label>
	<input value='<?php echo ($data["audit_url"]); ?>' class='txt_input' name='audit_url' placeholder='未认证链接地址'>
</fieldset>


				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="提交" class="alt_btn">
					<input onclick='history.go(-1)' type="button" value="返回">
				</div>
			</footer>
		</article><!-- end of post new article -->
	</form
	</section>

</body>

</html>