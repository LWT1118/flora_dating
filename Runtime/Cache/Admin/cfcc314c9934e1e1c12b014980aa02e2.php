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


    <article class="module width_full">
      <header><h3>用户搜索</h3></header>
      <div class="module_content">
        <form action="<?php echo U('index');?>" method='get'>
            <a class='button button-small button-caution pull-right' href="javascript:sure('<?php echo U('arrivalEmpty');?>')">清空用户签到记录</a>
            <input name='kw' style='width:60%' type='text' placeholder='输入昵称、邮箱、地址进行搜索'>
            <button>搜索</button>
        </form>
        <div class="clear"></div>
      </div>
    </article>



	<form method='post' action='<?php echo U('posUpdate');?>'>
		<article class="module width_full">
		<header>
      <h3 class="tabs_involved"><?php echo ($location); ?>&nbsp;&nbsp;(用户总数：<?php echo ($total); ?>)</h3>
      <ul class="tabs">
          <li>
            <a href="<?php echo U('add');?>"><i class='icon-plus'></i> 添加新用户</a>
          </li>
      </ul>      
		</header>


			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th width='40' id='checkall'>全选</th> 
    				<th width='120'>头像</th>
    				<th width='150'>基本信息</th>
					<th width='120'>个性签名</th>
                    <!--th width='80'>活动参与</th-->
    				<th width='80'>所属角色</th> 
    				<th width='100'>排序</th>
    				<th width='60'>状态</th>
					<th width='60'>认证</th>
    				<th width='100'>操作</th> 
				</tr> 
			</thead> 
			

			<tbody>
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr> 
   					<td><input class='cb' type="checkbox" value='<?php echo ($vo["id"]); ?>'></td>
   					<td>
            <a href="<?php echo U('edit',array('id'=>$vo['id']));?>">
   						<img src='<?php echo ($vo["img"]); ?>' width='100%' class='img-responsive img-circle img-thumbnail'>
            </a>
					</td> 
    				<td>
              <p>昵称：<?php echo (($vo["nickname"])?($vo["nickname"]):'暂未填写'); ?></p>
              <p>手机：<?php echo (($vo["tel"])?($vo["tel"]):'暂未填写'); ?></p>
              <p>姓名：<?php echo (($vo["realname"])?($vo["realname"]):'暂未填写'); ?></p>
              <p>微信：<?php echo (($vo["wechat"])?($vo["wechat"]):'暂未填写'); ?></p>
			  <p>兴趣爱好：<?php echo (($vo["interest"])?($vo["interest"]):'暂未填写'); ?> </p>
              <p>免费机会：<?php echo ($vo["redlinefree"]); ?> </p>
			  <p>红线余额：<?php echo ($vo["redline"]); ?></p>
			  
            </td> 
			<td><?php echo (($vo["sign"])?($vo["sign"]):'暂未填写'); ?> </td>
            <!--td>
              <p>发布：<?php echo ($vo["post"]); ?></p>
              <p>报名：<?php echo ($vo["reg"]); ?></p>
              <p>签到：<?php echo ($vo["arrival"]); ?></p>
            </td-->             
    				<td>
            <?php if(C('RBAC_SUPERADMIN') == $vo['username']): ?>超级管理员
            <?php else: ?>
              <?php if(is_array($vo['role'])): $i = 0; $__LIST__ = $vo['role'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><p><?php echo ($role["name"]); ?></p><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </td> 
    				<td><input style='width:100px' name='<?php echo ($vo["id"]); ?>' type='number' min="1" max="999999" value='<?php echo ($vo["pos"]); ?>'></td>
    				<td>
                     <?php echo (is_status($vo["status"],U('statusUpdate',array('id'=>$vo['id'],'status'=>$vo['status'])))); ?>					 
    				</td> 
    				<td>
                     <?php echo (is_audit($vo["audit"],U('auditUpdate',array('id'=>$vo['id'],'audit'=>$vo['audit'])))); ?>
    				</td> 					
    				<td>
    					<!-- <a class='my-icon' href='javascript:void(0)' onclick="pwd_reset(<?php echo ($vo["id"]); ?>,'<?php echo ($vo["username"]); ?>')" title="重置密码"><i class='icon-lock'></i></a>-->
              <a class='my-icon' href='<?php echo U('edit','id='.$vo['id']);?>' title="编辑"><i class='icon-pencil'></i></a>
    					<a class='my-icon' href='javascript:sure("<?php echo U('del','id='.$vo['id']);?>")' title="删除"><i class='icon-trash'></i></a>
    				</td> 
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>	 
			</tbody> 
			</table>


		<footer>
			<div class="submit_link">
				<input id='batch-redline' type="button" value="赠送红线" class="alt_btn">
        <input id='batch-msg' type="button" value="模板消息" class="alt_btn">
        <input id='batch-auth' type="button" value="批量审核" class="alt_btn">
        <input type="submit" value="提交" class="alt_btn">
				
			</div>
		</footer>
		
		</article><!-- end of content manager article -->

		<div class='page'><?php echo ($page); ?></div>
		

	</form>
</section>

<script type="text/javascript">
$(document).ready(function(){

  // 全选
  $('#checkall').click(function(){
    $txt = $(this).text();
    if($txt=='全选'){
      $(this).text('取消');
      $('.cb').prop('checked',true);      
    }else{
      $(this).text('全选');
      $('.cb').prop('checked',false); 
    }
  });
  
  //模板消息
  $('#batch-msg').click(function(){
    $list = new Array();
    $('input.cb:checked').each(function(){
     $list.push($(this).val());
    });
    $("#tm").modal('show');
    $('#tmidlist').val($list);
  });

  //红线
  $('#batch-redline').click(function(){
    $list = new Array();
    $('input.cb:checked').each(function(){
     $list.push($(this).val());
    });
    $("#redline").modal('show');
    $('#idlist').val($list);
  });

  //批量审核
  $('#batch-auth').click(function(){
    $list = new Array();
    $('input.cb:checked').each(function(){
     $list.push($(this).val());
    });
    $("#auth").modal('show');
    $('#authidlist').val($list);
  });



});

function pwd_reset($id,$username){
  $("#myModal").modal('show');
  $("#username_span").text($username);
  $(".modal-body input[name=id]").val($id);
  $("#my-submit").click(function(){
    $id = $(".modal-body input[name=id]").val();
    $pwd = $(".modal-body input[name=pwd]").val();
    $.post("<?php echo U('pwdUpdate');?>",{id:$id,pwd:$pwd},function(data){
      if(data=='1'){
        $(".modal-body p").remove();
        $(".modal-body fieldset").before("<p align='center' class='text-success'>密码修改成功！</p>");
        setTimeout(function(){
          $("#username_span").text('');
          $id = $(".modal-body input[name=id]").val('');
          $pwd = $(".modal-body input[name=pwd]").val('');
          $(".modal-body p").remove();    
          $("#myModal").modal('hide');

        },3000);
      }else{
        $(".modal-body p").remove();
        $(".modal-body fieldset").before("<p align='center' class='text-danger'>密码修改失败！</p>");
        setTimeout(function(){
          $("#username_span").text('');
          $id = $(".modal-body input[name=id]").val('');
          $pwd = $(".modal-body input[name=pwd]").val('');
          $(".modal-body p").remove(); 
          $("#myModal").modal('hide');
        },3000);
      }
    });
  });
}
</script>

<!-- Modal -->
<div class="modal fade" id="redline" tabindex="-1" role="dialog" aria-labelledby="redlineLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method='post' action='<?php echo U('redlinefree');?>'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="redlineLabel">赠送红线</h4>
      </div>
      <div class="modal-body">
          <fieldset>
            <label>赠送数量</label>
            <input name='num' type='text' placeholder='1-100之间的整数'>
          </fieldset>
          <fieldset>
            <label>赠送对象</label>
            <input id='idlist' name='idlist' type='text'>
            <div style='margin:10px;'>
              <input name='alluser' value='0' type='radio' checked='checked'>勾选会员
              <input name='alluser' value='1' type='radio'>全体会员
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">提交</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </form>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tm" tabindex="-1" role="dialog" aria-labelledby="tmLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method='post' action='<?php echo U('tplMsgSend');?>'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="tmLabel">模板消息</h4>
      </div>
      <div class="modal-body">
          <fieldset>
            <label>消息标题</label>
            <input name='title' type='text' placeholder='消息标题'>
          </fieldset>
          <fieldset>
            <label>消息备注</label>
            <input name='remark' type='text' placeholder='消息备注'>
          </fieldset>
          <fieldset>
            <label>选择模板</label>
            <select name='tpl'>
              <?php if(is_array($tpl)): $i = 0; $__LIST__ = $tpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tpl): $mod = ($i % 2 );++$i;?><option value='<?php echo ($tpl["id"]); ?>'><?php echo ($tpl["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </fieldset>
          <fieldset>
            <label>发送对象</label>
            <input id='tmidlist' name='idlist' type='text'>
            <div style='margin:10px;'>
              <input name='alluser' value='0' type='radio' checked='checked'>勾选会员
              <input name='alluser' value='1' type='radio'>全体会员
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">提交</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </form>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="auth" tabindex="-1" role="dialog" aria-labelledby="authLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method='post' action='<?php echo U('statusUpdateBatch');?>'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="authLabel">批量审核</h4>
      </div>
      <div class="modal-body">

          <fieldset>
            <label>审核结果</label>
            <div style='margin:10px;'>
              <input name='status' value='1' type='radio' checked='checked'>通过
              <input name='status' value='0' type='radio'>拒绝
            </div>
          </fieldset>

          <fieldset>
            <label>发送对象</label>
            <input id='authidlist' name='idlist' type='text'>
            <div style='margin:10px;'>
              <input name='alluser' value='0' type='radio' checked='checked'>勾选会员
              <input name='alluser' value='1' type='radio'>全体会员
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">提交</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">重设用户<span id='username_span'></span>密码</h4>
      </div>
      <div class="modal-body">

          <fieldset>
            <label>新密码</label>
            <input name='pwd' type='text'>
            <input name='id' type='hidden'>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button id='my-submit' type="button" class="btn btn-primary">确定修改</button>
        <button id='my-close' type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div>
  </div>
</div>





</body>

</html>