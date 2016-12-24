<?php

Class SlideAction extends AdminAction{


	function index(){
		$Data = M('slide');
		$this->data = $Data->order('type asc, pos asc, id asc')->select();
		//dump($this->data);
		$this->location = '幻灯片管理';
		$this->display();
	}

	function edit(){
		parent::_edit('slide');
		$this->location = '幻灯片编辑';
		$this->display();
	}

	function add(){
		$this->location = '幻灯片增加';
		$this->display();
	}

	function update(){
		$id = I('id',0,'intval');
		$Data = M('slide');
		$data = $Data->field('img')->find($id);
		$img = 'Upload/slide/'.$data['img'];
		if(file_exists($img))unlink($img);

		parent::_update('slide',U('Slide/index'),0);
	}

	function pos(){
		$Data = M('slide');
		foreach ($_POST['id'] as $key => $value) {
			$data = array('pos'=>$_POST['pos'][$key]);
			$Data->where('id='.$value)->setField($data);
		}
		$this->success('更新成功',U('Slide/index'));
	}

	function upload(){
		parent::_upload('slide/',800,300);
	}

	function del(){
		$id = I('id',0,'intval');
		$Data = M('slide');
		$data = $Data->field('img')->find($id);
		$img = 'Upload/slide/'.$data['img'];

		if(file_exists($img)){
			unlink($img);
			$Data->where('id='.$id)->delete();
			$this->success('操作成功！',U('Slide/index'));
		}else{
			$this->error('文件不存在！');
		}
	}

}

?>