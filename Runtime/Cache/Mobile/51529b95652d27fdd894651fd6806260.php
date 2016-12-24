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

<script type="text/javascript">
function checkForm(){
	var wechat = $('#txt_wechat').val();
	if(wechat == ''){
		alert('微信号不能为空');
		$('#txt_wechat').focus();
		return false;
	}
	return true;
}
</script>
<div class="container bony-mt2">
    <div class="row">
        <form id="info_form" class='bony-info form-inline' method='post' action='<?php echo U('infoUpdate ');?>' onsubmit="return checkForm()">
            <input type='hidden' name='id' value='<?php echo ($data["id"]); ?>'>

            <div class='form-group'>
                <label>昵称：</label>
                <input class='form-control' name='nickname' type='text' value='<?php echo ($data["nickname"]); ?>'>
            </div>
            
            <div class='form-group'>
                <label>年龄：</label>
                <select class='form-control' name='age'>
                    <?php $__FOR_START_5296__=16;$__FOR_END_5296__=80;for($i=$__FOR_START_5296__;$i < $__FOR_END_5296__;$i+=1){ ?><option <?php if(($i) == $data['age']): ?>selected='selected'<?php endif; ?> value='<?php echo ($i); ?>'><?php echo ($i); ?>岁</option><?php } ?>
                </select>
            </div>
            <div class='form-group'>
                <label>性别：</label>
                <select class='form-control' name='gender'>
                <option <?php if(($data['gender']) == "0"): ?>selected='selected'<?php endif; ?> value='0'>男生</option>
                <option <?php if(($data['gender']) == "1"): ?>selected='selected'<?php endif; ?> value='1'>女生</option>
                </select>
            </div>
            <div class='form-group'>
                <label>身高：</label>
                <select class='form-control' name='height'>
                    <?php $__FOR_START_7977__=130;$__FOR_END_7977__=200;for($i=$__FOR_START_7977__;$i < $__FOR_END_7977__;$i+=1){ ?><option <?php if(($i) == $data['height']): ?>selected='selected'<?php endif; ?> value='<?php echo ($i); ?>'><?php echo ($i); ?>cm</option><?php } ?>
                </select>
            </div>
            <div class='form-group'>
                <label>学历：</label>
                <select class='form-control' name='edu'>
					<option <?php if(($data['edu']) == "无要求"): ?>selected='selected'<?php endif; ?> value='无要求'>无要求</option>
                    <option <?php if(($data['edu']) == "高中及以下"): ?>selected='selected'<?php endif; ?> value='高中及以下'>高中及以下</option>
                    <option <?php if(($data['edu']) == "大专"): ?>selected='selected'<?php endif; ?> value='大专'>大专</option>
                    <option <?php if(($data['edu']) == "本科"): ?>selected='selected'<?php endif; ?> value='本科'>本科</option>
                    <option <?php if(($data['edu']) == "硕士"): ?>selected='selected'<?php endif; ?> value='硕士'>硕士</option>
                    <option <?php if(($data['edu']) == "博士及以上"): ?>selected='selected'<?php endif; ?> value='博士及以上'>博士及以上</option>
                </select>
            </div>
            <div class='form-group'>
                <label>婚姻状况：</label>
                <select class='form-control' name='love'>
                    <option <?php if(($data['love']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
                    <option <?php if(($data['love']) == "单身"): ?>selected='selected'<?php endif; ?> value='单身'>单身</option>
                    <option <?php if(($data['love']) == "有稳定伴侣"): ?>selected='selected'<?php endif; ?> value='有稳定伴侣'>有稳定伴侣</option>
                    <option <?php if(($data['love']) == "已婚"): ?>selected='selected'<?php endif; ?> value='已婚'>已婚</option>
                    <option <?php if(($data['love']) == "离异"): ?>selected='selected'<?php endif; ?> value='离异'>离异</option>
                    <option <?php if(($data['love']) == "丧偶"): ?>selected='selected'<?php endif; ?> value='丧偶'>丧偶</option>
                </select>
            </div>
            <div class='form-group'>
                <label>所在地区：</label>                
				<select class='form-control' name='area'>
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
            </div>
			<div class='form-group'>
                <label>真名：</label>
                <input class='form-control' name='realname' type='text' value='<?php echo ($data["realname"]); ?>'>
            </div>
			<!--div class='form-group'>
                <label>手机号码：</label>
                <input class='form-control' name='tel' type='text' value='<?php echo ($data["tel"]); ?>'>
            </div-->
            <div class='form-group'>
                <label>微信：</label>
                <input id="txt_wechat" class='form-control' name='wechat'  type='text' value='<?php echo ($data["wechat"]); ?>'>
            </div>
            <div class='form-group'>
                <label>所在城市：</label>
                <input class='form-control' name='city' type='text' value='<?php echo ($data["city"]); ?>'>
            </div>

            <div class='form-group'>
                <label>血型：</label>
                <select class='form-control' name='blood'>
                    <option <?php if(($data['blood']) == "A型"): ?>selected='selected'<?php endif; ?> value='A型'>A型</option>
                    <option <?php if(($data['blood']) == "B型"): ?>selected='selected'<?php endif; ?> value='B型'>B型</option>
                    <option <?php if(($data['blood']) == "O型"): ?>selected='selected'<?php endif; ?> value='O型'>O型</option>
                    <option <?php if(($data['blood']) == "AB型"): ?>selected='selected'<?php endif; ?> value='AB型'>AB型</option>
                    <option <?php if(($data['blood']) == "其他"): ?>selected='selected'<?php endif; ?> value='其他'>其他</option>
                    <option <?php if(($data['blood']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
                </select>
            </div>
            <div class='form-group'>
                <label>月薪：</label>
                <select class='form-control' name='income'>
                    <option <?php if(($data['income']) == "保密"): ?>selected='selected'<?php endif; ?> value='保密'>保密</option>
                    <option <?php if(($data['income']) == "低于800欧"): ?>selected='selected'<?php endif; ?> value='低于800欧'>低于800欧</option>
                    <option <?php if(($data['income']) == "800-1500欧"): ?>selected='selected'<?php endif; ?> value='800-1500欧'>800-1500欧</option>
                    <option <?php if(($data['income']) == "1500-2500欧"): ?>selected='selected'<?php endif; ?> value='1500-2500欧'>1500-2500欧</option>
                    <option <?php if(($data['income']) == "2500欧-4000欧"): ?>selected='selected'<?php endif; ?> value='2500欧-4000欧'>2500欧-4000欧</option>
                    <option <?php if(($data['income']) == "4000欧以上"): ?>selected='selected'<?php endif; ?> value='4000欧以上'>4000欧以上</option>
                </select>
            </div>
            <div class='form-group'>
                <label>购房情况：</label>
                <select class='form-control' name='buyhouse'>
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
            </div>
            <div class='form-group'>
                <label>购车情况：</label>
                <select class='form-control' name='buycar'>
                    <option <?php if(($data['buycar']) == "暂未购车"): ?>selected='selected'<?php endif; ?> value='暂未购车'>暂未购车</option>
                    <option <?php if(($data['buycar']) == "已购车（经济型）"): ?>selected='selected'<?php endif; ?> value='已购车（经济型）'>已购车（经济型）</option>
                    <option <?php if(($data['buycar']) == "已购车（中档型）"): ?>selected='selected'<?php endif; ?> value='已购车（中档型）'>已购车（中档型）</option>
                    <option <?php if(($data['buycar']) == "已购车（豪华型）"): ?>selected='selected'<?php endif; ?> value='已购车（豪华型）'>已购车（豪华型）</option>
                    
                </select>
            </div>
            <div class='form-group'>
                <label>公司类型：</label>
                <select class='form-control' name='com_type'>
                    <option <?php if(($data['com_type']) == "政府机关"): ?>selected='selected'<?php endif; ?> value='政府机关'>政府机关</option>
                    <option <?php if(($data['com_type']) == "事业单位"): ?>selected='selected'<?php endif; ?> value='事业单位'>事业单位</option>
                    <option <?php if(($data['com_type']) == "外企企业"): ?>selected='selected'<?php endif; ?> value='外企企业'>外企企业</option>
                    <option <?php if(($data['com_type']) == "世界500强"): ?>selected='selected'<?php endif; ?> value='世界500强'>世界500强</option>
                    <option <?php if(($data['com_type']) == "上市公司"): ?>selected='selected'<?php endif; ?> value='上市公司'>上市公司</option>
                    <option <?php if(($data['com_type']) == "国有企业"): ?>selected='selected'<?php endif; ?> value='国有企业'>国有企业</option>
                    <option <?php if(($data['com_type']) == "私营企业"): ?>selected='selected'<?php endif; ?> value='私营企业'>私营企业</option>
                    <option <?php if(($data['com_type']) == "自有公司"): ?>selected='selected'<?php endif; ?> value='自有公司'>自有公司</option>
                    
                </select>
            </div>
            <div class='form-group'>
                <label>收入描述：</label>
                <select class='form-control' name='income2'>
                    <option <?php if(($data['income2']) == "福利优越"): ?>selected='selected'<?php endif; ?> value='福利优越'>福利优越</option>
                    <option <?php if(($data['income2']) == "奖金丰富"): ?>selected='selected'<?php endif; ?> value='奖金丰富'>奖金丰富</option>
                    <option <?php if(($data['income2']) == "事业稳定上升"): ?>selected='selected'<?php endif; ?> value='事业稳定上升'>事业稳定上升</option>
                    <option <?php if(($data['income2']) == "事业刚起步"): ?>selected='selected'<?php endif; ?> value='事业刚起步'>事业刚起步</option>
                    <option <?php if(($data['income2']) == "投资高回报"): ?>selected='selected'<?php endif; ?> value='投资高回报'>投资高回报</option>
                </select>
            </div>
            <div class='form-group'>
                <label>专业：</label>
                <input class='form-control' name='Professional' type='text' value='<?php echo ($data["Professional"]); ?>'>
            </div>
            <div class='form-group'>
                <label>民族：</label>
                <input class='form-control' name='nation' type='text' value='<?php echo ($data["nation"]); ?>'>
            </div>
            <div class='form-group'>
                <label>信仰：</label>
                <input class='form-control' name='faith' type='text' value='<?php echo ($data["faith"]); ?>'>
            </div>
            <div class='form-group'>
                <label>兴趣及爱好：</label>
                <input class='form-control' name='interest' type='text' value='<?php echo ($data["interest"]); ?>'>
            </div>
            <div class='form-group text-center'>
                <button class='btn btn-block btn-sm btn-danger' type="submit">提交修改</button>
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