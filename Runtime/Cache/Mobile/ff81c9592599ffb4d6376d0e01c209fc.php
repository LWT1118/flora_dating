<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">
    <meta name="apple-mobile-web-app-title" content="携程旅行">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" href="__PUBLIC__/css/search.css" type="text/css">
    <script type="text/javascript" src="__PUBLIC__/js/aSlider.h5.min.js"></script>
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="browsermode" content="application">
    <meta name="x5-page-mode" content="app">
    <script type="text/javascript">window.onload=function(){(new AdSlider).Load({BizType:0,PageCode:1,TagId:"img_wrap",BackupImageUrl:"",IsNoAdHide:!0,PageId:212044})},addEventListener("DOMContentLoaded",function(){setTimeout(function(){scrollTo(0,1)},100)},!1);</script>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/abase.css">
</head>
<body id="ctripPage">
<div id="js-index-page">
    <noscript>&lt;div id=noscript style="background: #EA6201; width: 100%; color: #fff; border-top: 1px solid #cf5702; padding: 5px 0px;"&gt;您当前的浏览器不支持JavaSctip脚本，请确认浏览器是否开启JavaSctip脚本或点击访问携程旅行 &lt;a href="http://m.ctrip.com/wap/" style="text-decoration: underline;"&gt;简版&lt;/a&gt;&lt;/div&gt;</noscript>
    <header class="jsmodule" id="js_module">
        <div id="img_wrap" style="height: 107px;">
            <div class="cm-slide cm-slide--full-img" id="d3175de6-ff92-32dc-4baa-18ff16657023" style="height:107px;">
                <ul class="cm-slide-list js_scroller" id="ul_d3175de6-ff92-32dc-4baa-18ff16657023" style="position: absolute; width: 3780px; transform: translate(-540px, 0px) translateZ(0px); transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms;">
                    <li class="cm-slide-item" id="1102a6b3-c7d6-d375-abbe-1472373b7041" style="width: 540px; height: 107px; font-size: 107px;"><img src="__PUBLIC__/img/banner01.jpg"></li>
                    <li class="cm-slide-item" id="5bee4f0c-0642-6cf5-766e-c6d876657040" style="width: 540px; height: 107px; font-size: 107px;"><img src="__PUBLIC__/img/banner02.jpg"></li>
                    <li class="cm-slide-item" id="b778ea7d-4f69-acd6-199b-14728748f041" style="width: 540px; height: 107px; font-size: 107px;"><img src="__PUBLIC__/img/banner03.jpg"></li>
                    <li class="cm-slide-item" id="27a9159d-c1c7-9cea-511e-1472602c7041" style="width: 540px; height: 107px; font-size: 107px;"><img src="__PUBLIC__/img/banner04.jpg"></li>
                </ul>
                <div class="cui-navContainer" id="nav_d3175de6-ff92-32dc-4baa-18ff16657023" style="color: rgb(20, 145, 197); z-index: 10; position: absolute; left: 220px; bottom: 10px;">
                    <span class="cui-slide-nav-item cui-slide-nav-item-current" id="nav_5bee4f0c-0642-6cf5-766e-c6d876657040"></span>
                    <span class="cui-slide-nav-item" id="nav_b778ea7d-4f69-acd6-199b-14728748f041"></span>
                    <span class="cui-slide-nav-item" id="nav_27a9159d-c1c7-9cea-511e-1472602c7041"></span>
                    <span class="cui-slide-nav-item" id="nav_3ba5fc67-7be8-92e5-61f8-1406ed657041"></span>
                </div>
            </div>
        </div>
    </header>
    <nav id="nav" class="nav-entry">
        <?php if(is_array($allclass)): $i = 0; $__LIST__ = $allclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$all): $mod = ($i % 2 );++$i;?><div class="row">
            <div class="col col-33"><a id="c_hotel" title="<?php echo ($all["main"]); ?>" data-href="/webapp/hotel/" data-type="transition" href="<?php echo ($all["url"]); ?>"><?php echo ($all["main"]); ?></a></div>
            <div class="col col-33">
               <?php if(is_array($all["child"])): $i = 0; $__LIST__ = $all["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><a id="c_hotel_international" title="<?php echo ($child["classname"]); ?>" data-href="/webapp/hotel/oversea/?otype=1" data-type="transition" href="<?php echo ($child["url"]); ?>"><em><?php echo ($child["classname"]); ?></em></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
       <!-- <div class="row">
            <div class="col col-33"><a id="c_flight" title="机票" data-href="/html5/flight/matrix.html" data-type="transition" href="http://m.ctrip.com/html5/flight/matrix.html">机 票</a></div>
            <div class="col col-33">
                <a id="c_train_ticket" title="火车票·抢票" data-href="/webapp/train/" data-type="transition" href="http://m.ctrip.com/html5/Trains/"><em>火车票<span class="point">·</span>抢票</em></a>
                <a id="c_flight_international" title="国际机票" data-href="/webapp/flightactivity/assets/preciseLowprice/preciseLowprice.html?from=http://m.ctrip.com/html5/" data-type="transition" href="http://m.ctrip.com/html5/flight/matrix.html/international/">特价机票</a>
            </div>
            <div class="col col-33">
                <a id="c_bus_ticket" title="汽车票" data-href="/webapp/bus/" data-type="transition" href="http://m.ctrip.com/html5/Trains/bus/"><em>汽车票<span class="point">·</span>船票</em></a>
                <a id="c_car" title="专车·租车" data-href="/webapp/car/" data-type="transition" href="http://m.ctrip.com/html5/car/"><em>专车<span class="point">·</span>租车</em></a>
            </div>
        </div>
        <div class="row">
            <div class="col col-33"><a id="c_vacation" title="旅游" data-href="/webapp/tour/vacations?from=ctrip_home" data-type="transition" href="http://m.ctrip.com/html5/tour/vacations/">旅游</a></div>
            <div class="col col-33">
                <a id="c_entrance" title="攻略·身边" data-href="/webapp/you/" data-type="transition" href="http://m.ctrip.com/html5/you/"><em>目的地攻略</em></a>
                <a id="c_weekend" title="周边游" data-href="/webapp/weekend" data-type="transition" href="http://m.ctrip.com/html5/you/around"><em>周边游</em></a>
            </div>
            <div class="col col-33">
                <a id="c_cruise" title="邮轮" data-href="/webapp/cruise/index?ctm_ref=C_vac_cruise&amp;from=/html5" data-type="transition" href="http://m.ctrip.com/webapp/cruise/index?from=/html5"><em>邮 轮</em></a>
                <a id="c_custom" title="定制·包团" data-href="/webapp/dingzhi?ctm_ref=C_vac_custom&amp;from=%2Fhtml5" data-type="transition" href="http://m.ctrip.com/webapp/dingzhi?from=%2Fhtml5"><em>定制<span class="point">·</span>包团</em></a>
            </div>
        </div>
        <div class="row">
            <div class="col col-33">
                <a id="c_ticket" title="景点·玩乐" data-href="/webapp/ticket/index" data-type="transition" href="http://m.ctrip.com/html5/ticket/"><em>景点<span class="point">·</span>玩乐</em></a>
                <a id="c_trip_finance" title="礼品卡" data-href="/webapp/lipin/money" data-type="transition" href="http://m.ctrip.com/html5/lipin/"><em>礼品卡</em></a>
            </div>
            <div class="col col-33">
                <a id="c_food" title="美食" data-href="/webapp/you/foods/address.html?new=1" data-type="transition" href="http://m.ctrip.com/webapp/you/foods/address.html?new=1"><em>美 食</em></a>
                <a id="c_wifi" title="出境WiFi" data-href="/webapp/activity/wifi?from=ctrip_home" data-type="transition" href="http://m.ctrip.com/webapp/activity/wifi?from=ctrip_home"><em>出境WiFi</em></a>
            </div>
            <div class="col col-33">
                <a id="c_global_shopping" title="全球购·换汇" data-href="/webapp/gshop/" data-type="transition" href="http://m.ctrip.com/webapp/gshop/"><em>全球购<span class="point">·</span>换汇</em></a>
                <a id="c_visa" title="保险·签证" data-href="/webapp/tourvisa/entry?ctm_ref=C_vac_visa" data-type="transition" href="http://m.ctrip.com/webapp/tourvisa/entry"><em>保险<span class="point">·</span>签证</em></a>
            </div>
        </div>-->
    </nav>
</div>
</body>
</html>