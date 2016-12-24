<?php

class IndexAction extends HomeAction{

	public function index(){
		//p($_SESSION);
		//$this->cat = parent::_last('cat','1','id desc',20);
		$this->notify = parent::_last('news','status=1','pos',9);
		//p($this->notify);
		//$this->city = parent::_list2('city',"class_type='1'",0);
		//$this->slide = parent::_list2('slide',"1",0);
		//$this->ads = M('ads')->find(1);
		//$this->ads2 = M('ads')->find(2);
		//$this->link = M('nav')->where('cat=2 and status=1')->order('pos asc,id asc')->select();
		$this->user = M('user')->field('id,realname,img,arrival')->where("realname<>''")->order('arrival desc')->limit(12)->select();
		//p($this->user);
		$this->page_title = $this->site['site_name'];
		$this->display();
	}

	public function user(){
		$id = I('id',0,'intval');
		if($id==0)$this->error('用户信息不存在');
		$this->m = R('Member/userinfo',array($id));
		$this->display();
	}

}

?>