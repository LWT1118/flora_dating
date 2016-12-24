<?php

Class NavAction extends AdminAction{
	function index(){
		$cat = I('cat',false,'intval');
		if($cat){
			$where='nav.cat='.$cat;
		}else{
			$where='1';
		}
		$perpage = 10;
		import('ORG.Util.Page');
		$Data = M('nav');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$this->data = $Data->where($where)->order('id')->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		$this->cat = array('顶部导航','页脚文本','首页图文');
		$this->page = $Page->show();
		$this->location='链接列表';
		$this->display();
	}

	function add(){
		$this->location='添加链接';
		$this->display();
	}

	function edit($id=0){
		parent::_edit('nav');	
		$this->location='链接编辑';
		$this->display();
	}


	function update(){
		parent::_update('nav',U('index'),0);
	}

	function statusUpdate(){
		parent::_statusUpdate('nav',U('index'));
	}

	function posUpdate(){//更新排序
		$p = I('p',1);
		$Data = M('nav');
		$id = I('id');
		$pos = I('pos');
		for($i=0;$i<count($id);$i++){
			$data['pos'] = $pos[$i];
			$Data->where('id='.$id[$i])->save($data);
		}
		$this->success('更新成功',U('index','p='.$p));
	}


	function upload(){
		$p1 = '88,120,160,200';
		$p2 = '31,42,56,70';
		$prefix = 'thumb_,thumb200_,thumb300_,thumb400_';
		parent::_upload('nav/',$p1,$p2,$prefix);
	}

	function del(){
		$id = I('id',0,'intval');
		$p = I('p',1,'intval');
		$obj = M('nav');
		$data = $obj->find($id);
		$img = './Upload/nav/'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);
		$img = './Upload/nav/thumb_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);			
		$obj->where('id='.$id)->delete();//删除主表中数据
		$this->success('操作成功',U('index','p='.$p));
	}

}

?>