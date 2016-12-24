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

<div class="container bony-mt2">
    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">内心独白</p>
                    <a href="<?php echo U('info_heart');?>" class="btn btn-inverse btn-xs pull-right" type="button">编辑</a>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                
                <td colspan="4 "><?php echo ($data["sign"]); ?></td>
            </tr>  
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">基本信息</p>
                    <a href="<?php echo U('info_base');?>" class="btn btn-inverse btn-xs pull-right" type="button">编辑</a>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>昵称：</td>
                <td><?php echo ($data["nickname"]); ?></td>
                <td>年龄：</td>
                <td><?php echo ($data["age"]); ?></td>
            </tr>
            <tr>
                <td>性别：</td>
				<?php if($data["gender"] == 0): ?><td>男</td>
		      <?php else: ?>
		        <td>女</td><?php endif; ?>
                
                <td>身高：</td>
                <td><?php echo ($data["height"]); ?></td>
            </tr>
            <tr>
                <td>学历：</td>
                <td><?php echo ($data["edu"]); ?></td>
                <td>婚姻状况：</td>
                <td><?php echo ($data["love"]); ?></td>
            </tr>
			 <!--<tr>
                <td>真名：</td>
                <td><?php echo ($data["realname"]); ?></td>
                <td>手机号：</td>
                <td><?php echo ($data["tel"]); ?></td>
            </tr>-->
            <tr>
                <td>微信号：</td>
                <td><?php echo ($data["wechat"]); ?></td>
                <td>所在地区：</td>
                <td><?php echo ($data["area"]); ?></td>
            </tr>
            <tr>
                <td>所在城市：</td>
                <td colspan="3"><?php echo ($data["city"]); ?></td>
            </tr>
            <tr>
                <td>血型：</td>
                <td><?php echo ($data["blood"]); ?></td>
                <td>收入：</td>
                <td><?php echo ($data["income"]); ?></td>
            </tr>
            <tr>
                <td>购房情况：</td>
                <td><?php echo ($data["buyhouse"]); ?></td>
                <td>购车情况：</td>
                <td><?php echo ($data["buycar"]); ?></td>
            </tr>
            <tr>
                <td>公司类型：</td>
                <td colspan="3"><?php echo ($data["com_type"]); ?></td>
                
            </tr>
            <tr>
                
                <td>收入描述：</td>
                <td colspan="3"><?php echo ($data["income2"]); ?></td>
            </tr> 
            <tr>
                <td>专业：</td>
                <td><?php echo ($data["Professional"]); ?></td>
                <td>民族：</td>
                <td><?php echo ($data["nation"]); ?></td>
            </tr>
            <tr>
                
                <td>信仰：</td>
                <td colspan="3"><?php echo ($data["faith"]); ?></td>
            </tr> 
            <tr>
                
                <td>兴趣及爱好：</td>
                <td colspan="3"><?php echo ($data["interest"]); ?></td>
            </tr>   
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">择偶要求</p>
                    <a href="<?php echo U('info_request');?>" class="btn btn-inverse btn-xs pull-right" type="button">编辑</a>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>年龄范围：</td>
                <td><?php echo ($data["age_scope"]); ?></td>
                <td>身高范围：</td>
                <td><?php echo ($data["h_scope"]); ?></td>
            </tr>
            <tr>
                <td>学历要求：</td>
                <td><?php echo ($data["edu_scope"]); ?></td>
                <td>婚姻状况：</td>
                <td><?php echo ($data["love2"]); ?></td>
            </tr>
            <tr>
                <td>有无照片：</td>
                <td><?php echo ($data["i_scope"]); ?></td>
                <td>诚信星级：</td>
                <td><?php echo ($data["star"]); ?></td>
            </tr>   
        </tbody>
    </table>

     <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">家庭资料</p>
                    <a href="<?php echo U('info_family');?>" class="btn btn-inverse btn-xs pull-right" type="button">编辑</a>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>户口：</td>
                <td colspan="3"><?php echo ($data["hukou"]); ?></td>
            </tr>
            <tr>
                <td>籍贯：</td>
                <td colspan="3"><?php echo ($data["jiguan"]); ?></td>
            </tr>
            <tr>
                <td>家中排行：</td>
                <td><?php echo ($data["ranking"]); ?></td>
                <td>父母状态：</td>
                <td><?php echo ($data["parent_sta"]); ?></td>
            </tr> 

        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">爱情规划</p>
                    <a href="<?php echo U('info_plan');?>" class="btn btn-inverse btn-xs pull-right" type="button">编辑</a>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>谈过几次恋爱：</td>
                <td colspan="3"><?php echo ($data["jici"]); ?></td>
            </tr>
            <tr>
                <td>近期是否有结婚打算：</td>
                <td colspan="3"><?php echo ($data["plan"]); ?></td>
            </tr>
            <tr>
                <td>婚后是否愿意要小孩：</td>
                <td colspan="3"><?php echo ($data["kid"]); ?></td>
            </tr> 
            <tr>
                <td>是否愿意和父母同住：</td>
                <td colspan="3"><?php echo ($data["live"]); ?></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <tr>
                <div class="info_head">
                    <p class="pull-left">交友状态</p>
                    <a href="<?php echo U('info_friend');?>" class="btn btn-inverse btn-xs pull-right" type="button">编辑</a>
                </div>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>交友状态：</td>
                <td colspan="3"><?php echo ($data["friend_sta"]); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<style type="text/css">
    .form-group label{
        font-size: 1rem;
    }
    .form-control{
        font-size: 1rem;
        border: 1px solid pink;
        padding: 0px 4px !important;
        height: 30px;
        line-height: 30px;
    }
    .bony-tab li{
        padding: 2px !important;
    }
    .bony-tab li a{
        padding: 4px 6px !important;
        font-size: 1.2rem;
        color: #222;
    }
</style>

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