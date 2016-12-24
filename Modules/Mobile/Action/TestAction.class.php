<?php

class TestAction extends HomeAction{
	public function index(){
		$str = uniqid();
		$img = './Upload/user/'.$str;
		$url = "http://wx.qlogo.cn/mmopen/ibfOkDPoWicJhkuklT0icXmMjtgBSDIyTFUIvk7oDzmn9AaEW9epS8Crct98fS6CyZEwLoQK5IA0MhhgOUCzn1WydZhxTaj2zH7/0";
		import('ORG.Net.Http');
		Http::curlDownload($url,$img);
		import('ORG.Util.Image');
		$temp = Image::getImageInfo($img);
		var_dump($temp);
		p($temp);
		if($temp){
			$ext = '.'.$temp['type'];
		$img400 = './Upload/user/thumb400_'.$str.$ext;
		$img300 = './Upload/user/thumb300_'.$str.$ext;
		$img200 = './Upload/user/thumb200_'.$str.$ext;
		$img100 = './Upload/user/thumb_'.$str.$ext;
		Image::thumb2($img, $img400, $type='jpeg', $maxWidth=400, $maxHeight=400, $interlace=true);
		Image::thumb2($img, $img300, $type='jpeg', $maxWidth=300, $maxHeight=300, $interlace=true);
		Image::thumb2($img, $img200, $type='jpeg', $maxWidth=200, $maxHeight=200, $interlace=true);
		Image::thumb2($img, $img100, $type='jpeg', $maxWidth=100, $maxHeight=100, $interlace=true);
		unlink($img);
		}else{
			//return '';
		}
	}
}


?>