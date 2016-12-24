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
    <!--li><a href="<?php echo U('/'.GROUP_NAME.'/Classify/index');?>"><i class='icon-plus'></i> 添加主分类</a></li-->
    <li><a href="<?php echo U('/'.GROUP_NAME.'/Classify/childIndex');?>"><i class='icon-plus'></i> 添加分类</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Classify/image');?>"><i class='icon-plus'></i> 宣传图片</a></li>
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
    
        <article class="module width_full">
		<form method='post' action="__URL__/addChildClass">
			<input type="hidden" name="id" value="<?php echo ($current_class['id']); ?>">
            <header><h3>添加分类</h3></header>
            <div class="module_content">
                <fieldset>
                    <label>父分类</label>
                    <select name='pid'>
						<option value='0'>无</option>
                        <?php if(is_array($mainclass)): $i = 0; $__LIST__ = $mainclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$main): $mod = ($i % 2 );++$i;?><option value='<?php echo ($main["id"]); ?>' <?php if((!empty($current_class) and ($main["id"] == $current_class['pid']))): ?>selected<?php endif; ?>><?php echo ($main["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </fieldset>
                <div class="clear"></div>
                <fieldset>
                    <label>分类名称</label>
                    <input name='childname' type="text" value="<?php echo ($current_class["classname"]); ?>">
                </fieldset>
                <div class="clear"></div>
                <fieldset>
                    <label>URL</label>
                    <input name='childurl' type="text" value='<?php echo ($current_class["url"]); ?>'>
                </fieldset>
                <fieldset>
                    <label>序号</label>
                    <input name='no' type="text" value='<?php echo ($current_class["no"]); ?>'>
                </fieldset>				
            </div>
			
            <footer>
                <div class="submit_link">
                    <input type="submit" value="提 交" class="alt_btn">
                    <input onclick='history.go(-1)' type="button" value="返 回">
                </div>
            </footer>
		</form>
        </article><!-- end of post new article -->
		
		<article class="module width_full">
			<div class="tab_container">
			<header><h3>分类列表</h3></header>
            <div id="tab1" class="tab_content">
                <table class="tablesorter" cellspacing="0">
                    <thead>
                    <tr>
                        <th width='5%'>ID</th>
                        <th width='10%'>父分类</th>
                        <th>分类名称</th>                       
						<th>URL</th>
						<th>序号</th>
                        <th width='15%'>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($ls["id"]); ?></td>
                            <td><?php echo ($ls["parent"]); ?></td>
                            <td><?php echo ($ls["classname"]); ?></td>
                            <td><?php echo ($ls["url"]); ?></td>
							<td><?php echo ($ls["no"]); ?></td>
                            <td>
                                <a class='my-icon' href='<?php echo U('childIndex','id='.$ls['id']);?>' title="编辑"><i class='icon-pencil'></i></a>
                                <a class='my-icon' href='javascript:sure("<?php echo U('classdelete','id='.$ls['id']);?>")' title="删除"><i class='icon-trash'></i></a>                                
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div><!-- end of #tab1 -->

			</div><!-- end of .tab_container -->
		</article>
</section>
</body>

</html>