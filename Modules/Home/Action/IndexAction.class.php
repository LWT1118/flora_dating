<?php

class IndexAction extends PublicAction{

	public function index(){
		//p($_SESSION);
		$this->cat = parent::_last('cat','1','id desc',20);
		$this->notify = parent::_last('news','status=1','pos',9);
		//p($this->notify);
		//$this->city = parent::_list2('city',"class_type='1'",0);
		//$this->slide = parent::_list2('slide',"1",0);

		//$this->link = M('nav')->where('cat=2 and status=1')->order('pos asc,id asc')->select();
		$this->user = M('user')->field('id,realname,img,arrival')->where("redline1=1 and status=1")->limit(12)->select();
		//p($this->user);
		$this->page_title = '首页';
		$this->display();
	}

	public function user(){
		$id = I('id',0,'intval');
		$this->qrcode($id);
		if($id==0)$this->error('用户信息不存在');
		$this->m = R('Member/userinfo',array($id));
		$this->page_title = '用户信息';
		$this->display();
	}


	public function qrcode($id)
	{
		$id != 0 or die();
		$src = "{$_SERVER['DOCUMENT_ROOT']}/Upload/qrcode/qr_{$id}.png";
		if(!file_exists($src)){
			$link = "http://{$_SERVER['HTTP_HOST']}/User/detail/id/{$id}";
			$url = "http://qr.liantu.com/api.php?w=400&h=400&text=".urlencode($link);	
			$cp = curl_init($url);
			$fp = fopen($src,"w");
			curl_setopt($cp, CURLOPT_FILE, $fp);
			curl_setopt($cp, CURLOPT_HEADER, 0);
			curl_exec($cp);
			curl_close($cp);
			fclose($fp);
		}
		//$this->render('qrcode', array('src'=>$src));
		//echo "<img src='{$src}'>";exit;
	}

	public function yinyuan()
	{
		$this->display();
	}

	/*测试方法*/
	public function info(){
		require_once('./Modules/Home/Action/wechat.class.php');
		$wid = $_GET['wid'];
		$wid or die();
		$options = parent::wechat_cfg();
		$we_obj = new Wechat($options);
		$userInfo = $we_obj->getUserInfo($wid);
		var_dump($userInfo);exit;
	}

	public function test(){
		$this->message = '您已经成功唤醒';
		$this->display('wakeup');
	}
}

?>