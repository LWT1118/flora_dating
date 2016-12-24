<?php

Class CatAction extends AdminAction{
	function index(){
		$Data = M('cat');
		$data = $Data->select();
		$data = infiniteCategory($data,0,0,'————');
		$this->data = $data;
		$this->location='商品分类列表';
		$this->display();
	}

	function type(){

	}

	function add(){
		$pid = I('pid',0,'intval');
		if($pid>0){
			$Taxonomy = M('cat');
			$taxonomy = $Taxonomy->where('id='.$pid)->getField('id,title,taxonomy');
			//echo $Taxonomy->getLastSql();
			//dump($taxonomy[$pid]);
			$location = '添加 <b class=\'text-primary\'>'.$taxonomy[$pid]['title'].'</b> 子分类';
			$tax = $taxonomy[$pid]['taxonomy'];
		}else{
			$tax = NULL;
			$location = '添加新分类';
		}
		$this->taxonomy = $tax;
		//dump($this->taxonomy);
		$this->pid = $pid;
		$this->location = $location;
		$this->display();		
	}

	function edit($type='category'){
		parent::_edit('cat');
		$this->location='分类编辑';
		$this->display();	
	}

	function update(){
		parent::_update('cat',U('index'));
	}

	function posUpdate(){
		//dump($_POST);
		$taxonomy = I('taxonomy');
		$Data = M('cat');
		foreach ($_POST as $key => $value) {
			$Data->where('id='.$key)->setField('pos',$value);
		}
		$this->success('更新成功',U('index','type='.$taxonomy));
	}	

	function del(){
		$id = I('id',0,'intval');
		M('cat_relationship')->where('cat_id='.$id)->delete();
		parent::_del('cat',U('index'));
	}

}

?>