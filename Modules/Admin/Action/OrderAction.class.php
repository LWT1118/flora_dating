<?php

Class OrderAction extends AdminAction{
	function index(){
		$status = I('status',5,'intval');
		if($status==5){
			$where = '1';
		}else{
			$where = 'status='.$status;
		}
		$txt = array('待付款订单','待发货订单','待收货订单','已成功订单','失败订单','全部订单');
		$Data = D('orderView');
		$data = $Data->where($where)->select();
		//echo $Data->getLastSql();
		//dump($data);
		$this->data = $data;
		$this->location = $txt[$status];
		$this->display();		
	}

	function newOrder(){
		//parent::_list('order','status=0',$perpage=20,$order='id desc');
		$Data = D('orderView');
		$data = $Data->select();
		//echo $Data->getLastSql();
		//dump($data);
		$this->data = $data;
		$this->cur3 = " class='cur'";
		$this->location = '未处理订单';
		$this->display();	
	}

	function edit($id=0){
		parent::_edit('user');	
		$this->location='会员信息详情';
		$this->display();
	}

	function update(){
		parent::_update('user',U('index'),1);
	}

	function statusUpdate(){
		$url = $this->_server('HTTP_REFERER');
		parent::_statusUpdate('user',$url);
	}	


	function pwdUpdate(){
		$id = I('id',0,'intval');
		$pwd = I('pwd');
		$Data = M('user');
		$data = array('password'=>md5($pwd));
		$Data->where('id='.$id)->setField($data);
		echo "1";
	}

	function posUpdate(){
		$shop_id = I('shop_id',0,'intval');
		if($shop_id>0){
			$url = 'shop_id='.$shop_id;
		}else{
			$url = NULL;
		}
		$Data = M('user');
		foreach ($_POST['id'] as $key => $value) {
			$data = array('price_old'=>$_POST['price_old'][$key],'price_new'=>$_POST['price_new'][$key],'pos'=>$_POST['pos'][$key]);
			$Data->where('id='.$value)->setField($data);
		}
		$this->success('更新成功',U('index',$url));
	}	

	function upload(){
		parent::_upload('goods/');
	}
	
	function del($id=0){
		$url = $this->_server('HTTP_REFERER');
		$id = I('id',0,'intval');
		$Data = M('user');
		$data = $Data->where('id='.$id)->select();
		dump($data);
		if(strlen($data['img'])>0 && file_exists($data['img'])){
			echo "<img src='".C('__UPLOAD__')."/user/".$data['img']."'>";
		}else{
			echo "<a href='".APP_NAME."/upload/user/".$data['img']."'>ddd</a>";
		}
		die;
		$Data->where('id='.$id)->delete();
		$this->success('操作成功！',$url);
	}
}

?>