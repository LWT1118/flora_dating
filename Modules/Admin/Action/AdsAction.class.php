<?php

Class AdsAction extends AdminAction{


	function index(){
		$Data = M('ads');
		$this->data = $Data->order('id asc')->select();
		//dump($this->data);
		$this->location = '广告位管理';
		$this->display();
	}

	function edit(){
		parent::_edit('ads');
		$this->location = '广告位编辑';
		$this->display();
	}

	function add(){
		$this->location = '广告位增加';
		$this->display();
	}

	function update(){
		parent::_update('ads',U('Ads/index'),0);
	}
}

?>