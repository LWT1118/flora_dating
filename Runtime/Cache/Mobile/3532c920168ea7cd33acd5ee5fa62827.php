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
                <label>谈过几次恋爱：</label>
                <select class='form-control' name='jici'>
                    <option <?php if(($data['jici']) == "没有"): ?>selected='selected'<?php endif; ?> value='没有'>没有</option>
                    <option <?php if(($data['jici']) == "1次"): ?>selected='selected'<?php endif; ?> value='1次'>1次</option>
                    <option <?php if(($data['jici']) == "2次"): ?>selected='selected'<?php endif; ?> value='2次'>2次</option>
                    <option <?php if(($data['jici']) == "3次"): ?>selected='selected'<?php endif; ?> value='3次'>3次</option>
                    <option <?php if(($data['jici']) == "4次"): ?>selected='selected'<?php endif; ?> value='4次'>4次</option>
                    <option <?php if(($data['jici']) == "大于4次"): ?>selected='selected'<?php endif; ?> value='大于4次'>大于4次</option>
                    <option <?php if(($data['love2']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
                </select>
            </div>
            <div class='form-group'>
                <label>近期是否有结婚打算：</label>
                <select class='form-control' name='plan'>
                    <option <?php if(($data['plan']) == "近期有结婚打算"): ?>selected='selected'<?php endif; ?> value='近期有结婚打算'>近期有结婚打算</option>
                    <option <?php if(($data['plan']) == "想要谈恋爱"): ?>selected='selected'<?php endif; ?> value='想要谈恋爱'>想要谈恋爱</option>
                    <option <?php if(($data['plan']) == "找人聊天"): ?>selected='selected'<?php endif; ?> value='找人聊天'>找人聊天</option>
                </select>
            </div>
            <div class='form-group'>
                <label>婚后是否愿意要小孩：</label>
                <select class='form-control' name='kid'>
                    <option <?php if(($data['kid']) == "愿意"): ?>selected='selected'<?php endif; ?> value='愿意'>愿意</option>
                    <option <?php if(($data['kid']) == "不愿意"): ?>selected='selected'<?php endif; ?> value='不愿意'>不愿意</option>
                    <option <?php if(($data['kid']) == "视情况而定"): ?>selected='selected'<?php endif; ?> value='视情况而定'>视情况而定</option>
                </select>
            </div>
            <div class='form-group'>
                <label>是否愿意和父母同住：</label>
                <select class='form-control' name='live'>
                    <option <?php if(($data['live']) == "愿意"): ?>selected='selected'<?php endif; ?> value='愿意'>愿意</option>
                    <option <?php if(($data['live']) == "不愿意"): ?>selected='selected'<?php endif; ?> value='不愿意'>不愿意</option>
                    <option <?php if(($data['live']) == "视情况而定"): ?>selected='selected'<?php endif; ?> value='视情况而定'>视情况而定</option>
                </select>
            </div>
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