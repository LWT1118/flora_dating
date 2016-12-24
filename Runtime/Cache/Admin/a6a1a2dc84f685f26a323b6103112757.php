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
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Vote/index');?>"><i class='icon-list'></i> 投票列表</a></li>
	<li><a href="<?php echo U('/'.GROUP_NAME.'/Vote/catList');?>"><i class='icon-check'></i> 活动分类</a></li>
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
		<form method='post' action='<?php echo U('update','action=save');?>'>
		<input type='hidden' name='id' value='<?php echo ($data["id"]); ?>'>



		<article class="module width_full">
			<header><h3><?php echo ($location); ?></h3></header>
				<div class="module_content">
					<div class='solid-info'>
						<input type='hidden' id='img_input' name='img' value='<?php echo ($data["img"]); ?>'>
						<div class='info-face' data-toggle="modal" data-target="#myModal" title='修改照片'>
							<?php if(strlen($data['img']) > 0): ?><img width='100%' src='/Upload/user/<?php echo ($data["img"]); ?>' class='shop_pic img-responsive img-circle img-thumbnail'>
		   					<?php else: ?>
		   						<img width='100%' src="/Upload/user/no_face.gif" class='shop_pic img-responsive img-circle img-thumbnail'><?php endif; ?>
						</div>
						<!--p>会员类型：<?php echo ($data["vip"]); ?></p-->
						<p>注册时间：<?php echo (date('y/m/d H:i',$data["regtime"])); ?></p>
						<p>最近登录：<?php echo (date('y/m/d H:i',$data["logtime"])); ?></p>
						<p>报名次数：<?php echo ($data["reg"]); ?></p>
						<p>签到次数：<?php echo ($data["arrival"]); ?></p>
						<p>openid：<?php echo ($data["openid"]); ?></p>
					</div>
					<ul class='info-ul'>
						<li>
							<label>优秀会员：</label>
							<select name="redline1">
							<option <?php if($data["redline1"] == '0'): ?>selected<?php endif; ?> value="0">否</option>
							<option <?php if($data["redline1"] == '1'): ?>selected<?php endif; ?> value="1">是</option>
							</select>
						</li>
						<li>
							<label>手机：</label>
							<input type='text' name='tel' value='<?php echo ($data["tel"]); ?>'>
						</li>
						<li>
							<label>邮箱：</label>
							<input type='text' name='email' value='<?php echo ($data["email"]); ?>'>
						</li>
						<li>
							<label>昵称：</label>
							<input type='text' name='nickname' value='<?php echo ($data["nickname"]); ?>'>
						</li>
						<li>
							<label>性别：</label>
							<select name='gender'>
							<option <?php if(($data['gender']) == "0"): ?>selected='selected'<?php endif; ?> value='0'>男生</option>
							<option <?php if(($data['gender']) == "1"): ?>selected='selected'<?php endif; ?> value='1'>女生</option>
							</select>							
						</li>

						<li>
							<label>微信：</label>
							<input type='text' name='wechat' value='<?php echo ($data["wechat"]); ?>'>
						</li>
						
						<li>
							<label>会员类型：</label>
							<select name="vip">
							<option <?php if($vip_type == '0'): ?>selected<?php endif; ?> value="0">普通会员</option>
							<option <?php if($vip_type == '30'): ?>selected<?php endif; ?> value="30">月会员</option>
							<option <?php if($vip_type == '360'): ?>selected<?php endif; ?> value="360">年会员</option></select>
						</li>
						<li>
							<label>红线余额：</label>
							<input type='text' name='redline' value='<?php echo ($data["redline"]); ?>'>
						</li>
						<li>
							<label>免费机会：</label>
							<input type='text' name='redlinefree' value='<?php echo ($data["redlinefree"]); ?>'>
						</li>

						<li>
							<label>年龄：</label>
							<input type='text' name='age' value='<?php echo ($data["age"]); ?>'>
						</li>

						<li>
							<label>身高：</label>
							<input type='text' name='height' value='<?php echo ($data["height"]); ?>'>
						</li>

						<li>
							<label>教育程度：</label>
							<select name='edu'>
								<option <?php if(($data['edu']) == "不详"): ?>selected='selected'<?php endif; ?> value='不详'>不详</option>
			                    <option <?php if(($data['edu']) == "高中及以下"): ?>selected='selected'<?php endif; ?> value='高中及以下'>高中及以下</option>
			                    <option <?php if(($data['edu']) == "大专"): ?>selected='selected'<?php endif; ?> value='大专'>大专</option>
			                    <option <?php if(($data['edu']) == "本科"): ?>selected='selected'<?php endif; ?> value='本科'>本科</option>
			                    <option <?php if(($data['edu']) == "硕士"): ?>selected='selected'<?php endif; ?> value='硕士'>硕士</option>
			                    <option <?php if(($data['edu']) == "博士及以上"): ?>selected='selected'<?php endif; ?> value='博士及以上'>博士及以上</option>
			                </select>
						</li>

						<li>
							<label>所在地区：</label>
							<select name='area'>
							<option <?php if(($data['area']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
							<option <?php if(($data['area']) == "巴登-符腾堡"): ?>selected='selected'<?php endif; ?> value='巴登-符腾堡'>巴登-符腾堡</option>
							<option <?php if(($data['area']) == "巴伐利亚"): ?>selected='selected'<?php endif; ?> value='巴伐利亚'>巴伐利亚</option>
							<option <?php if(($data['area']) == "柏林"): ?>selected='selected'<?php endif; ?> value='柏林'>柏林</option>
							<option <?php if(($data['area']) == "勃兰登堡"): ?>selected='selected'<?php endif; ?> value='勃兰登堡'>勃兰登堡</option>
							<option <?php if(($data['area']) == "不来梅"): ?>selected='selected'<?php endif; ?> value='不来梅'>不来梅</option>
							<option <?php if(($data['area']) == "汉堡"): ?>selected='selected'<?php endif; ?> value='汉堡'>汉堡</option>
							<option <?php if(($data['area']) == "黑森"): ?>selected='selected'<?php endif; ?> value='黑森'>黑森</option>
							<option <?php if(($data['area']) == "梅克伦堡-前波莫瑞"): ?>selected='selected'<?php endif; ?> value='梅克伦堡-前波莫瑞'>梅克伦堡-前波莫瑞</option>
							<option <?php if(($data['area']) == "下萨克森"): ?>selected='selected'<?php endif; ?> value='下萨克森'>下萨克森</option>
							<option <?php if(($data['area']) == "北莱茵-威斯特法伦"): ?>selected='selected'<?php endif; ?> value='北莱茵-威斯特法伦'>北莱茵-威斯特法伦</option>
							<option <?php if(($data['area']) == "莱茵兰-普法尔茨"): ?>selected='selected'<?php endif; ?> value='莱茵兰-普法尔茨'>莱茵兰-普法尔茨</option>
							<option <?php if(($data['area']) == "萨尔"): ?>selected='selected'<?php endif; ?> value='萨尔'>萨尔</option>
							<option <?php if(($data['area']) == "萨克森"): ?>selected='selected'<?php endif; ?> value='萨克森'>萨克森</option>
							<option <?php if(($data['area']) == "萨克森-安哈尔特"): ?>selected='selected'<?php endif; ?> value='萨克森-安哈尔特'>萨克森-安哈尔特</option>
							<option <?php if(($data['area']) == "石勒苏益格-荷尔斯泰因"): ?>selected='selected'<?php endif; ?> value='石勒苏益格-荷尔斯泰因'>石勒苏益格-荷尔斯泰因</option>
							<option <?php if(($data['area']) == "图林根"): ?>selected='selected'<?php endif; ?> value='图林根'>图林根</option>
							<option <?php if(($data['area']) == "中国"): ?>selected='selected'<?php endif; ?> value='中国'>中国</option>
							<option <?php if(($data['area']) == "欧洲其他国家"): ?>selected='selected'<?php endif; ?> value='欧洲其他国家'>欧洲其他国家</option>
							<option <?php if(($data['area']) == "北美洲"): ?>selected='selected'<?php endif; ?> value='北美洲'>北美洲</option>
							<option <?php if(($data['area']) == "南美洲"): ?>selected='selected'<?php endif; ?> value='南美洲'>南美洲</option>
							<option <?php if(($data['area']) == "非洲"): ?>selected='selected'<?php endif; ?> value='非洲'>非洲</option>
							<option <?php if(($data['area']) == "亚洲"): ?>selected='selected'<?php endif; ?> value='亚洲'>亚洲</option>
							</select>
						</li>

						<li>
							<label>月薪：</label>
							<select name='income'>
							<option <?php if(($data['income']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
							<option <?php if(($data['income']) == "低于800欧"): ?>selected='selected'<?php endif; ?> value='低于800欧'>低于800欧</option>
							<option <?php if(($data['income']) == "800-1500欧"): ?>selected='selected'<?php endif; ?> value='800-1500欧'>800-1500欧</option>
							<option <?php if(($data['income']) == "1500-2500欧"): ?>selected='selected'<?php endif; ?> value='1500-2500欧'>1500-2500欧</option>
							<option <?php if(($data['income']) == "2500欧-4000欧"): ?>selected='selected'<?php endif; ?> value='2500欧-4000欧'>2500欧-4000欧</option>
							<option <?php if(($data['income']) == "4000欧以上"): ?>selected='selected'<?php endif; ?> value='4000欧以上'>4000欧以上</option>
		                	</select>
						</li>
						<li>
							<label>情感状况：</label>
			                <select name='love'>
			                    <option <?php if(($data['love']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
			                    <option <?php if(($data['love']) == "单身"): ?>selected='selected'<?php endif; ?> value='单身'>单身</option>
			                    <option <?php if(($data['love']) == "有稳定伴侣"): ?>selected='selected'<?php endif; ?> value='有稳定伴侣'>有稳定伴侣</option>
			                    <option <?php if(($data['love']) == "已婚"): ?>selected='selected'<?php endif; ?> value='已婚'>已婚</option>
			                    <option <?php if(($data['love']) == "离异"): ?>selected='selected'<?php endif; ?> value='离异'>离异</option>
			                    <option <?php if(($data['love']) == "丧偶"): ?>selected='selected'<?php endif; ?> value='丧偶'>丧偶</option>
			                </select>
						</li>
						<li>
							<label for="">是否买房</label>
							<select name='buyhouse'>
			                    <option <?php if(($data['buyhouse']) == "暂未购房"): ?>selected='selected'<?php endif; ?> value='暂未购房'>暂未购房</option>
			                    <option <?php if(($data['buyhouse']) == "与人合租"): ?>selected='selected'<?php endif; ?> value='与人合租'>与人合租</option>
			                    <option <?php if(($data['buyhouse']) == "独自租房"): ?>selected='selected'<?php endif; ?> value='独自租房'>独自租房</option>
			                    <option <?php if(($data['buyhouse']) == "与父母同住"): ?>selected='selected'<?php endif; ?> value='与父母同住'>与父母同住</option>
			                    <option <?php if(($data['buyhouse']) == "住亲朋家"): ?>selected='selected'<?php endif; ?> value='住亲朋家'>住亲朋家</option>
			                    <option <?php if(($data['buyhouse']) == "住单位房"): ?>selected='selected'<?php endif; ?> value='住单位房'>住单位房</option>
			                    <option <?php if(($data['buyhouse']) == "需要时购置"): ?>selected='selected'<?php endif; ?> value='需要时购置'>需要时购置</option>
			                    <option <?php if(($data['buyhouse']) == "已购房（有贷款）"): ?>selected='selected'<?php endif; ?> value='已购房（有贷款）'>已购房（有贷款）</option>
			                    <option <?php if(($data['buyhouse']) == "已购房（无贷款）"): ?>selected='selected'<?php endif; ?> value='已购房（无贷款）'>已购房（无贷款）</option>
			                </select>
						</li>

						<li>
						<label>购车情况：</label>
		                <select name='buycar'>
		                    <option <?php if(($data['buycar']) == "暂未购车"): ?>selected='selected'<?php endif; ?> value='暂未购车'>暂未购车</option>
		                    <option <?php if(($data['buycar']) == "已购车（经济型）"): ?>selected='selected'<?php endif; ?> value='已购车（经济型）'>已购车（经济型）</option>
		                    <option <?php if(($data['buycar']) == "已购车（中档型）"): ?>selected='selected'<?php endif; ?> value='已购车（中档型）'>已购车（中档型）</option>
		                    <option <?php if(($data['buycar']) == "已购车（豪华型）"): ?>selected='selected'<?php endif; ?> value='已购车（豪华型）'>已购车（豪华型）</option>
		                </select>
						</li>

						<li>
		                <label>公司类型：</label>
		                <select name='com_type'>
							<option <?php if(($data['com_type']) == "不详"): ?>selected='selected'<?php endif; ?> value='不详'>不详</option>
		                    <option <?php if(($data['com_type']) == "政府机关"): ?>selected='selected'<?php endif; ?> value='政府机关'>政府机关</option>
		                    <option <?php if(($data['com_type']) == "事业单位"): ?>selected='selected'<?php endif; ?> value='事业单位'>事业单位</option>
		                    <option <?php if(($data['com_type']) == "外企企业"): ?>selected='selected'<?php endif; ?> value='外企企业'>外企企业</option>
		                    <option <?php if(($data['com_type']) == "世界500强"): ?>selected='selected'<?php endif; ?> value='世界500强'>世界500强</option>
		                    <option <?php if(($data['com_type']) == "上市公司"): ?>selected='selected'<?php endif; ?> value='上市公司'>上市公司</option>
		                    <option <?php if(($data['com_type']) == "国有企业"): ?>selected='selected'<?php endif; ?> value='国有企业'>国有企业</option>
		                    <option <?php if(($data['com_type']) == "私营企业"): ?>selected='selected'<?php endif; ?> value='私营企业'>私营企业</option>
		                    <option <?php if(($data['com_type']) == "自有公司"): ?>selected='selected'<?php endif; ?> value='自有公司'>自有公司</option>
		                    <option <?php if(($data['com_type']) == "学生在学"): ?>selected='selected'<?php endif; ?> value='学生在学'>学生在学</option>
		                </select>							
						</li>

						<li>
						    <label>户口：</label>
						    <input name='hukou' type='text' value='<?php echo ($data["hukou"]); ?>'>
						</li>
						<li>
						    <label>籍贯：</label>
						    <input name='jiguan' type='text' value='<?php echo ($data["jiguan"]); ?>'>
						</li>
						<li>
						    <label>家中排行：</label>
						    <select name='ranking'>
								<option <?php if(($data['ranking']) == "不详"): ?>selected='selected'<?php endif; ?> value='不详'>不详</option>
						        <option <?php if(($data['ranking']) == "独生子女"): ?>selected='selected'<?php endif; ?> value='独生子女'>独生子女</option>
						        <option <?php if(($data['ranking']) == "老大"): ?>selected='selected'<?php endif; ?> value='老大'>老大</option>
						        <option <?php if(($data['ranking']) == "老二"): ?>selected='selected'<?php endif; ?> value='老二'>老二</option>
						        <option <?php if(($data['ranking']) == "老三"): ?>selected='selected'<?php endif; ?> value='老三'>老三</option>
						        <option <?php if(($data['ranking']) == "老四"): ?>selected='selected'<?php endif; ?> value='老四'>老四</option>
						        <option <?php if(($data['ranking']) == "老五及更小"): ?>selected='selected'<?php endif; ?> value='老五及更小'>老五及更小</option>
						        <option <?php if(($data['ranking']) == "老幺"): ?>selected='selected'<?php endif; ?> value='老幺'>老幺</option>
						    </select>
						</li>
						<li>
						    <label>父母状态：</label>
						    <select name='parent_sta'>
						        <option <?php if(($data['parent_sta']) == "退休"): ?>selected='selected'<?php endif; ?> value='退休'>退休</option>
						        <option <?php if(($data['parent_sta']) == "上班"): ?>selected='selected'<?php endif; ?> value='上班'>上班</option>
						        <option <?php if(($data['parent_sta']) == "有企业"): ?>selected='selected'<?php endif; ?> value='有企业'>有企业</option>
						        <option <?php if(($data['parent_sta']) == "健康"): ?>selected='selected'<?php endif; ?> value='健康'>健康</option>
						        <option <?php if(($data['parent_sta']) == "单亲"): ?>selected='selected'<?php endif; ?> value='单亲'>单亲</option>
						        <option <?php if(($data['parent_sta']) == "和谐幸福"): ?>selected='selected'<?php endif; ?> value='和谐幸福'>和谐幸福</option>
						        <option <?php if(($data['parent_sta']) == "务农"): ?>selected='selected'<?php endif; ?> value='务农'>务农</option>
						        <option <?php if(($data['parent_sta']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
						    </select>
						</li>


			            <li>
			                <label>谈过几次恋爱：</label>
			                <select name='jici'>
			                    <option <?php if(($data['jici']) == "没有"): ?>selected='selected'<?php endif; ?> value='没有'>没有</option>
			                    <option <?php if(($data['jici']) == "1次"): ?>selected='selected'<?php endif; ?> value='1次'>1次</option>
			                    <option <?php if(($data['jici']) == "2次"): ?>selected='selected'<?php endif; ?> value='2次'>2次</option>
			                    <option <?php if(($data['jici']) == "3次"): ?>selected='selected'<?php endif; ?> value='3次'>3次</option>
			                    <option <?php if(($data['jici']) == "4次"): ?>selected='selected'<?php endif; ?> value='4次'>4次</option>
			                    <option <?php if(($data['jici']) == "大于4次"): ?>selected='selected'<?php endif; ?> value='大于4次'>大于4次</option>
			                    <option <?php if(($data['jici']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
			                </select>
			            </li>
			            <li>
			                <label>近期是否有结婚打算：</label>
			                <select name='plan'>
			                    <option <?php if(($data['plan']) == "近期有结婚打算"): ?>selected='selected'<?php endif; ?> value='近期有结婚打算'>近期有结婚打算</option>
			                    <option <?php if(($data['plan']) == "想要谈恋爱"): ?>selected='selected'<?php endif; ?> value='想要谈恋爱'>想要谈恋爱</option>
			                    <option <?php if(($data['plan']) == "找人聊天"): ?>selected='selected'<?php endif; ?> value='找人聊天'>找人聊天</option>
			                </select>
			            </li>
			            <li>
			                <label>婚后是否愿意要小孩：</label>
			                <select name='kid'>
			                    <option <?php if(($data['kid']) == "愿意"): ?>selected='selected'<?php endif; ?> value='愿意'>愿意</option>
			                    <option <?php if(($data['kid']) == "不愿意"): ?>selected='selected'<?php endif; ?> value='不愿意'>不愿意</option>
			                    <option <?php if(($data['kid']) == "视情况而定"): ?>selected='selected'<?php endif; ?> value='视情况而定'>视情况而定</option>
			                </select>
			            </li>
			            <li>
			                <label>是否愿意和父母同住：</label>
			                <select name='live'>
			                    <option <?php if(($data['live']) == "愿意"): ?>selected='selected'<?php endif; ?> value='愿意'>愿意</option>
			                    <option <?php if(($data['live']) == "不愿意"): ?>selected='selected'<?php endif; ?> value='不愿意'>不愿意</option>
			                    <option <?php if(($data['live']) == "视情况而定"): ?>selected='selected'<?php endif; ?> value='视情况而定'>视情况而定</option>
			                </select>
			            </li>




						<li>
						<label>收入描述：</label>
		                <select name='income2'>
		                    <option <?php if(($data['income2']) == "福利优越"): ?>selected='selected'<?php endif; ?> value='福利优越'>福利优越</option>
		                    <option <?php if(($data['income2']) == "奖金丰富"): ?>selected='selected'<?php endif; ?> value='奖金丰富'>奖金丰富</option>
		                    <option <?php if(($data['income2']) == "事业稳定上升"): ?>selected='selected'<?php endif; ?> value='事业稳定上升'>事业稳定上升</option>
		                    <option <?php if(($data['income2']) == "事业刚起步"): ?>selected='selected'<?php endif; ?> value='事业刚起步'>事业刚起步</option>
		                    <option <?php if(($data['income2']) == "投资高回报"): ?>selected='selected'<?php endif; ?> value='投资高回报'>投资高回报</option>
		                </select>							
						</li>


						<li>
						<label>专业：</label>
						<input name='Professional' type='text' value='<?php echo ($data["Professional"]); ?>'>
						</li>
						<li>
						<label>民族：</label>
						<input name='nation' type='text' value='<?php echo ($data["nation"]); ?>'>
						</li>
						<li>
						<label>信仰：</label>
						<input name='faith' type='text' value='<?php echo ($data["faith"]); ?>'>
						</li>



						<li>
							<label>个性签名：</label>
							<textarea name='sign'><?php echo ($data["sign"]); ?></textarea>
						</li>

						<li>
							<label>兴趣爱好：</label>
							<textarea name='interest'><?php echo ($data["interest"]); ?></textarea>
						</li>
						
						<li>
							<label>备注：</label>
							<textarea name='remark' style="height:80px;"><?php echo ($data["remark"]); ?></textarea>
						</li>


			            <li>
			                <label>交友状态：</label>
			                <select name='friend_sta'>
			                    <option <?php if(($data['friend_sta']) == "正在征友"): ?>selected='selected'<?php endif; ?> value='正在征友'>正在征友</option>
			                    <option <?php if(($data['friend_sta']) == "约会中"): ?>selected='selected'<?php endif; ?> value='约会中'>约会中</option>
			                    <option <?php if(($data['friend_sta']) == "结束交友"): ?>selected='selected'<?php endif; ?> value='结束交友'>结束交友</option>
			                </select>
			            </li> 

						<div class="clearfix"></div>
						<b>角色</b>

						<ol class='role'>
						<?php if(C('RBAC_SUPERADMIN') == $data['username']): ?>超级管理员
						<?php else: ?>							
							<div class="clear"></div>
							<?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><input value='<?php echo ($vo["id"]); ?>' name='role[]' type='checkbox'><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
							<div class="clear"></div><?php endif; ?>

						</ol>
						
					</ul>

					<div class="clearfix"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="提 交" class="alt_btn">
					<input onclick='history.go(-1)' type="button" value="返 回">
				</div>
			</footer>
		</article><!-- end of styles article -->
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/rbac.css" />





		</form>

	</section>

<!-- Modal -->
<!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method='post' enctype='multipart/form-data' id='myForm' action='<?php echo U('upload');?>'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">成员照片</h4>
      </div>
      <div class="modal-body">
        	<fieldset>
        		<label>当前图片</label>
        		<div class="clear"></div>
        		<p align='center'>	
				<?php if(strlen($data['img']) > 0): ?><img src='__UPLOAD__/user/<?php echo ($data["img"]); ?>' class='shop_pic img-responsive img-rounded img-thumbnail'>
				<?php else: ?>
					<img src="__HOMEPUBLIC__/images/no_face.gif" class='shop_pic img-responsive img-rounded img-thumbnail'><?php endif; ?>
				</p>
			</fieldset>
        	<fieldset>
        		<label>上传新图</label>
        		<div class="clear"></div>
        		<p align='center'>
        		<input name='pic' type='file'>
        		</p>
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
<js file="__PUBLIC__/js/jquery.form.js" /-->
<script type="text/javascript">

    /*$(document).ready(function() {
    	var path = '__UPLOAD__/user/';
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
    });*/


</script>
</body>

</html>