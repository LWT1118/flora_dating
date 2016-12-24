<?php

Class ProductAction extends AdminAction{

	function index(){
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = D('productRelation');
		$total = $Data->field('id')->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$this->data = $Data->relation(true)->order('pos asc,id desc')->field('description',true)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		$this->page = $Page->show();
		$this->nowpage = $page;
		$this->location='商品列表';
		$this->display();
	}	

	function picList(){
		$tt = array('顶图','幻灯片','小图');
		$size = array(
			array(1200,600),
			array(1200,600),
			array(300,300)
		);
		//dump($size);
		$pid = I('pid',0);
		$type = I('type',-1);
		$where = "1";
		if($pid>0){
			$where .= " AND pid='".$pid."'";
		}
		if($type>-1){
			$this->location = $tt[$type].$size[$type][0].'x'.$size[$type][1];
			$where .= " AND type='".$type."'";
		}else{
			$this->location = '商品附图列表';
		}
		$perpage = 5 ;
		import('ORG.Util.Page');
		$Data = D('picView');	
		$total = $Data->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$this->data = $Data->where($where)->order('product_pic.pos asc')->page($page.','.$Page->listRows)->select();
		$this->page = $Page->show();
		//echo $Data->getLastSql();
		//dump($this->data);
		$this->tt = $tt;
		$this->size = $size;
		$this->pid = $pid;
		$this->type = $type;
		$this->nowpage = $page;
		$this->display();
	}

	function picAdd(){
		$tt = array('顶图','幻灯片','小图');
		$size = array(
			array(1200,600),
			array(1200,600),
			array(300,300)
		);
		$pid = I('pid',0,'intval');
		$type = I('type',-1,'intval');
		if($pid==0 || $type==-1){
			$this->error('请从商品列表里添加所属附图');
		}
		$Temp = M('product');
		$temp = $Temp->field('title')->find($pid);

		$this->pid = $pid;
		$this->type = $type;
		$this->w = $size[$type][0];
		$this->h = $size[$type][1];
		$this->location = '为 “'.$temp['title'].'” 添加 ' .$size[$type][0].'x'.$size[$type][1].' '.$tt[$type];
		$this->tt = $tt[$type];
		$this->display();		
	}

	function picEdit($id=0){
		$id = I('get.id',0,'intval');
		$Data = M('product_pic');
		$data = $Data->find($id);
		$tt = array(0=>'顶图',1=>'幻灯片',2=>'小图');
		$size = array(
			array(1200,600),
			array(1200,600),
			array(300,300)
		);
		$this->data =$data;
		$pid = $data['pid'];
		$type = $data['type'];
		$Temp = M('product');
		$temp = $Temp->field('title')->find($pid);

		$this->pid = $pid;
		$this->type = $tt;
		//dump($tt);
		$this->w = $size[$type][0];
		$this->h = $size[$type][1];
		$this->location = '编辑 “'.$temp['title'].'” ' .$size[$type][0].'x'.$size[$type][1].' '.$tt[$type];
		$this->tt = $tt[$type];
		$this->display();		
	}



	function picUpdate(){
		$pid = I('pid',0,'intval');
		$type = I('type',0,'intval');
		parent::_update('product_pic',U('picList','pid='.$pid.'&type='.$type),0);
	}


	function picPosUpdate(){//更新排序
		$p = I('p');
		$Data = M('product_pic');
		foreach ($_POST as $key => $value) {
			$data['pos'] = $value;
			$Data->where('id='.$key)->save($data);
		}
		$this->success('更新成功',U('picList','p='.$p));
	}


	function add(){
		$location = '添加新商品';
		$Taxonomy = M('cat');
		$tax = $Taxonomy->select();
		$this->taxonomy = infiniteCategory($tax,0,0,'————');
		//dump($this->taxonomy);
		$this->pid = $pid;
		$this->location = $location;
		$this->display();		
	}

	function edit($id=0){
		$p = I('p',1,'intval');
		parent::_edit('product');	
		$C = M('relationship');
		$this->c = $C->field('cid')->where("pid=".$id)->select();
		//dump($this->c);
		$this->taxonomy = parent::_list2('cat',"1",1);
		$this->nowpage = $p;
		$this->location='商品编辑';
		$this->display();
	}

	function update(){
		$p = I('p',1,'intval');
		parent::_update('product',U('index','p='.$p),1);
	}

	function statusUpdate(){
		$p = I('p');
		parent::_statusUpdate('product',U('index','p='.$p));
	}

	function posUpdate(){//更新排序
		$p = I('p');
		$Data = M('product');

		$id = I('id');
		$price3 = I('price3');
		$pos = I('pos');

/*		p($id);
		p($price3);
		p($pos);*/		

		for($i=0;$i<count($id);$i++){
			$data['price3'] = $price3[$i];
			$data['pos'] = $pos[$i];
			$Data->where('id='.$id[$i])->save($data);
		}

		/*foreach ($_POST as $key => $value) {
			$data['pos'] = $value;
			$Data->where('id='.$key)->save($data);
		}*/
		$this->success('更新成功',U('index','p='.$p));
	}


	function upload(){
		$p1 = '100,200,300,400';
		$p2 = '100,200,300,400';
		$prefix = 'thumb_,thumb200_,thumb300_,thumb400_';
		parent::_upload('product/',$p1,$p2,$prefix);
	}

	/*删除产品*/
	function del(){
		$id = I('id',0,'intval');
		$p = I('p',1,'intval');
		$obj = M('product');
		$data = $obj->find($id);
		$img = './Upload/product/'.$data['img'];
		if(file_exists($img))unlink($img);
		$img = './Upload/product/thumb400_'.$data['img'];
		if(file_exists($img))unlink($img);
		$img = './Upload/product/thumb300_'.$data['img'];
		if(file_exists($img))unlink($img);
		$img = './Upload/product/thumb200_'.$data['img'];
		if(file_exists($img))unlink($img);		
		$img = './Upload/product/thumb100_'.$data['img'];
		if(file_exists($img))unlink($img);			
		$obj->where('id='.$id)->delete();//删除主表中数据

		M('relationship')->where('pid='.$id)->delete();//删除分类表中数据

		$temp = M('product_pic')->where('pid='.$id)->select();//找出图片数据
		foreach ($temp as $key => $value) {
			$img = './Upload/'.$table.'/'.$value['img'];
			if(file_exists($img))unlink($img);
			$img = './Upload/'.$table.'/thumb_'.$value['img'];
			if(file_exists($img))unlink($img);
		}
		M('product_pic')->where('pid='.$id)->delete();

		$this->success('操作成功',U('index','p='.$p));
	}

	/*产出产品附件图片*/
	function picDel(){
		$id = I('id',0,'intval');
		$p = I('p',1,'intval');
		$type = I('type',-1,'intval');
		$pid = I('pid',0,'intval');
		$Data = M('product_pic');
		$data = $Data->field('img')->find($id);
		$img = './Upload/product/'.$data['img'];
		if(file_exists($img))unlink($img);
		$img = './Upload/product/thumb_'.$data['img'];
		if(file_exists($img))unlink($img);
		$Data->where('id='.$id)->delete();
		$this->success('操作成功',U('picList','pid='.$id.'type='.$type));
	}

}

?>