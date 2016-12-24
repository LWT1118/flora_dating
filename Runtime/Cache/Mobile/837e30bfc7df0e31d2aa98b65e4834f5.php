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


<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script type="text/javascript">
wx.config({
    debug: false,
    appId: '<?php echo ($signPackage["appId"]); ?>',
    timestamp: <?php echo ($signPackage["timestamp"]); ?>,
    nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
    signature: '<?php echo ($signPackage["signature"]); ?>',
    jsApiList: ['checkJsApi', 'downloadVoice', 'chooseImage', 'previewImage', 'uploadImage', 'downloadImage']
});

wx.ready(function () {
	var images = {localId: [], serverId: []};
	document.querySelector('#chooseImage').onclick = function (){
		wx.chooseImage({
			count: 1,
			success: function (res) {
				images.localId = res.localIds;
				alert('已选择 ' + res.localIds.length + ' 张图片');
			}
		});
	};
  // 5.2 图片预览
  /*document.querySelector('#previewImage').onclick = function () {
    wx.previewImage({
      current: 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
      urls:['http://img3.douban.com/view/photo/photo/public/p2152117150.jpg', 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg', 'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg']
    });
  };*/
  $url = "<?php echo U('/Mobile/Member/WechatFaceUpload');?>";
  // 5.3 上传图片
  document.querySelector('#uploadImage').onclick = function () {
    if (images.localId.length == 0) {
      alert('请先选择图片');
      return;
    }
    var i = 0, length = images.localId.length;
    images.serverId = [];
    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          i++;
          //alert('已上传：' + i + '/' + length);
          images.serverId.push(res.serverId);
          //alert(res.serverId);
          $.post($url,{serverId:res.serverId},function(data) {
            if(data.status==1){
              $('#bony-face-img').attr('src',data.url);
            }else{
              alert(data.info);
            }
          });
          if (i < length) {
            upload();
          }
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    }
    upload();
  };

  // 5.4 下载图片
  document.querySelector('#downloadImage').onclick = function () {
    if (images.serverId.length === 0) {
      alert('请先使用 uploadImage 上传图片');
      return;
    }
    var i = 0, length = images.serverId.length;
    images.localId = [];
    function download() {
      wx.downloadImage({
        serverId: images.serverId[i],
        success: function (res) {
          i++;
          alert('已下载：' + i + '/' + length);
          images.localId.push(res.localId);
          if (i < length) {
            download();
          }
        }
      });
    }
    download();
  };
});
wx.error(function(res){
	alert(res.errMsg);
});
</script>

<div class="bony-pink bony-info-header">
    <div class='face'>
       <img id='bony-face-img' src="/Upload/user/<?php echo ($m["img"]); ?>" class='img-responsive img-circle' alt="头像照片">
    </div>
</div>
<div class='container'>
    <div class='row'>

      <!--span class="desc"></span-->
      <button class="btn btn-block btn-primary" id="chooseImage">第一步 拍照或从手机相册中选头像</button>
      <!--span class="desc">预览图片接口</span>
      <button class="btn btn-block btn-primary" id="previewImage">previewImage</button-->
      <!--span class="desc">上传图片接口</span-->
      <button class="btn btn-block btn-primary" id="uploadImage">第二步 点击上传头像</button>
      <!--span class="desc">下载图片接口</span>
      <button class="btn btn-block btn-primary" id="downloadImage">downloadImage</button-->

        
    </div>
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