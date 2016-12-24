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
    <!-- <div class="well text-danger text-center bony-font-2">
        高级搜索只对VIP会员开放
    </div> -->
    <form method='post' action='<?php echo U('vipsearch');?>'>
		
        <div class="form-group has-error bony-form">

            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">关键词:</label>
                </div>
                <div class="col-xs-9" style="padding:0">
                    <input name='kw' type="text" class="form-control" placeholder="兴趣及爱好">
                </div>
            </div>
            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">性 别:</label>
                </div>
                <div class="col-xs-9" style="padding:0">
                    <select class='form-control' name='gender'>
                        <option value=''>不限</option>
						<option value='0'>男</option>
						<option value='1'>女</option>
                    </select>
                </div>
            </div>
            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">婚姻状态:</label>
                </div>
                <div class="col-xs-9" style="padding:0">
					<label><input type="checkbox" name="love[]" value="保密">保密</label>
					<label><input type="checkbox" name="love[]" value="单身">单身</label>
					<label><input type="checkbox" name="love[]" value="离异">离异</label>
					<label><input type="checkbox" name="love[]" value="丧偶">丧偶</label>
					<label><input type="checkbox" name="love[]" value="有稳定伴侣">有稳定伴侣</label>
					<label><input type="checkbox" name="love[]" value="已婚">已婚</label>																				                 
                </div>
            </div>			
            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; padding-right:1rem; text-align:right; ">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">年龄范围:</label>
                </div>
                <div class="col-xs-4">
                    <input name='age1' min='16' max='80' type="number" class="form-control" placeholder="年龄">
                </div>
                <div class="col-xs-1" style="padding:0; padding-top:0.8rem; text-align:center;"><i class="icon-minus icon-x" style="color:#CC3300;"></i></div>
                <div class="col-xs-4">
                    <input name='age2' min='16' max='80' type="number" class="form-control" placeholder="年龄">
                </div>
            </div>
            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">身高范围:</label>
                </div>
                <div class="col-xs-4">
                    <input name='height1' min='130' max='220' type="number" class="form-control" placeholder="身高">
                </div>
                <div class="col-xs-1" style="padding:0; padding-top:0.8rem; text-align:center;"><i class="icon-minus icon-x" style="color:#CC3300;"></i></div>
                <div class="col-xs-4">
                    <input name='height2' min='130' max='220' type="number" class="form-control" placeholder="身高">
                </div>
            </div>
            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">学 历:</label>
                </div>
                <div class="col-xs-9" style="padding:0">
                    <select class='form-control' name='edu'>
                        <option value=''>不限</option>
						<option value='无要求'>无要求</option>
						<option value='高中及以下'>高中及以下</option>
						<option value='大专'>大专</option>
						<option value='本科'>本科</option>
						<option value='硕士'>硕士</option>
						<option value='博士及以上'>博士及以上</option>
                    </select>
                </div>
            </div>
            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">月 薪:</label>
                </div>
                <div class="col-xs-9" style="padding:0">
                    <select class='form-control' name='income'>
                        <option value=''>不限</option>
						<option value='保密'>保密</option>
						<option value='低于800欧'>低于800欧</option>
						<option value='800-1500欧'>800-1500欧</option>
						<option value='1500-2500欧'>1500-2500欧</option>
						<option value='2500欧-4000欧'>2500欧-4000欧</option>
						<option value='4000欧以上'>4000欧以上</option>
                    </select>
                </div>
            </div>

            <div class="row bony-form">
                <div class="col-xs-3" style="padding:0; text-align:right; padding-right:1rem;">
                    <label class="control-label" style="font-size:1.6rem; color:#000000;">所在地区:</label>
                </div>
                <div class="col-xs-9" style="padding:0">
<select class='form-control' name='area'>
<option value="">不限地区</option>
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
                </div>
            </div>
        </div>
        <button type='submit' class="w100 button button-large button-caution button-rounded">查找</button>
    </form>
</div>
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