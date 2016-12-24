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
    <div class="row">
        <form class='bony-info form-inline' method='post' action='<?php echo U('Mobile/Member/infoUpdate ');?>'>
            <input type='hidden' name='id' value='<?php echo ($data["id"]); ?>'>


            <div class='form-group'>
                <label>年龄范围：</label>
				  <select class='form-control' name='age_scope'>
					<option <?php if(($data['age_scope']) == "不限"): ?>selected='selected'<?php endif; ?> value='不限'>不限</option>
                    <option <?php if(($data['age_scope']) == "16-19"): ?>selected='selected'<?php endif; ?> value='16-19'>16-19</option>
                    <option <?php if(($data['age_scope']) == "20-24"): ?>selected='selected'<?php endif; ?> value='20-24'>20-24</option>
                    <option <?php if(($data['age_scope']) == "25-29"): ?>selected='selected'<?php endif; ?> value='25-29'>25-29</option>
                    <option <?php if(($data['age_scope']) == "30-34"): ?>selected='selected'<?php endif; ?> value='30-34'>30-34</option>
                    <option <?php if(($data['age_scope']) == "35-39"): ?>selected='selected'<?php endif; ?> value='35-39'>35-39</option>
					<option <?php if(($data['age_scope']) == "40以上"): ?>selected='selected'<?php endif; ?> value='40以上'>40以上</option>
				  </select>				        
            </div>
            <div class='form-group'>
                <label>身高范围：</label>
				  <select class='form-control' name='h_scope'>				      
					<option <?php if(($data['h_scope']) == "不限"): ?>selected='selected'<?php endif; ?> value='不限'>不限</option>
                    <option <?php if(($data['h_scope']) == "150-160"): ?>selected='selected'<?php endif; ?> value='150-160'>150-160</option>
                    <option <?php if(($data['h_scope']) == "160-170"): ?>selected='selected'<?php endif; ?> value='160-170'>160-170</option>
                    <option <?php if(($data['h_scope']) == "170-180"): ?>selected='selected'<?php endif; ?> value='170-180'>170-180</option>
                    <option <?php if(($data['h_scope']) == "180以上"): ?>selected='selected'<?php endif; ?> value='180以上'>180以上</option>
				  </select>
            </div>
            <div class='form-group'>
                <label>学历要求：</label>
                <select class='form-control' name='edu_scope'>
					<option <?php if(($data['edu_scope']) == "无要求"): ?>selected='selected'<?php endif; ?> value='无要求'>无要求</option>
                    <option <?php if(($data['edu_scope']) == "高中及以下"): ?>selected='selected'<?php endif; ?> value='高中及以下'>高中及以下</option>
                    <option <?php if(($data['edu_scope']) == "大专"): ?>selected='selected'<?php endif; ?> value='大专'>大专</option>
                    <option <?php if(($data['edu_scope']) == "本科"): ?>selected='selected'<?php endif; ?> value='本科'>本科</option>
                    <option <?php if(($data['edu_scope']) == "硕士"): ?>selected='selected'<?php endif; ?> value='硕士'>硕士</option>
                    <option <?php if(($data['edu_scope']) == "博士及以上"): ?>selected='selected'<?php endif; ?> value='博士及以上'>博士及以上</option>
                </select>
            </div>
            <div class='form-group'>
                <label>婚姻状况：</label>
                <select class='form-control' name='love2'>
                    <option <?php if(($data['love2']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
                    <option <?php if(($data['love2']) == "单身"): ?>selected='selected'<?php endif; ?> value='单身'>单身</option>
                    <option <?php if(($data['love2']) == "有稳定伴侣"): ?>selected='selected'<?php endif; ?> value='有稳定伴侣'>有稳定伴侣</option>
                    <option <?php if(($data['love2']) == "已婚"): ?>selected='selected'<?php endif; ?> value='已婚'>已婚</option>
                    <option <?php if(($data['love2']) == "离异"): ?>selected='selected'<?php endif; ?> value='离异'>离异</option>
                    <option <?php if(($data['love2']) == "丧偶"): ?>selected='selected'<?php endif; ?> value='丧偶'>丧偶</option>
                </select>
            </div> 
            <!--div class='form-group'>
                <label>有无照片：</label>
                <select class='form-control' name='i_scope'>
                    <option <?php if(($data['i_scope']) == "无照片"): ?>selected='selected'<?php endif; ?> value='无照片'>无照片</option>
                    <option <?php if(($data['i_scope']) == "有照片"): ?>selected='selected'<?php endif; ?> value='有照片'>有照片</option>
                </select>
            </div>
            <div class='form-group'>
                <label>诚信星级：</label>
                <select class='form-control' name='star'>
                    <option <?php if(($data['star']) == "一星期以上"): ?>selected='selected'<?php endif; ?> value='一星期以上'>一星期以上</option>
                    <option <?php if(($data['star']) == "二星期以上"): ?>selected='selected'<?php endif; ?> value='二星期以上'>二星期以上</option>
                    <option <?php if(($data['star']) == "三星期以上"): ?>selected='selected'<?php endif; ?> value='三星期以上'>三星期以上</option>
                    <option <?php if(($data['star']) == "四星期以上"): ?>selected='selected'<?php endif; ?> value='四星期以上'>四星期以上</option>
                    <option <?php if(($data['star']) == "五星期以上"): ?>selected='selected'<?php endif; ?> value='五星期以上'>五星期以上</option>
                    
                </select>
            </div-->
            <div class='form-group text-center'>
                <button class='btn btn-block btn-sm btn-danger'>提交修改</button>
            </div>  

        </form>
    </div>
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