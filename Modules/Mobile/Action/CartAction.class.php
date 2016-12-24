<?php
class CartAction extends HomeAction{
	public function index(){
		$cart = parent::bonycart();	
		//$cart->show();
		$this->data = $cart->get_cart();
		$this->total = $cart->total();
		$this->sum_all = $cart->sum_all();
		$this->item = $cart->item();


		if(session('?'.C('USER_AUTH_KEY'))){
			$this->m = M('user')->find(session(C('USER_AUTH_KEY')));
		}else{
			$this->m = array(
				'id'=>'',
				'username'=>'',
				'tel'=>'',
				'realname'=>'',
				'address'=>''
			);
		}


		$this->page_title = '购物车';
		$this->display();


	}
	public function add(){
		$cart = parent::bonycart();
		$id = I('id',0,'intval');
		$qty = I('qty',1,'intval');
		$ginfo = M('product')->field('id,title,price3 as price,img')->where('status=1')->find($id);		
		$ginfo['qty']=$qty;
		$cart->add($ginfo);
		$data['info'] = '商品成功加入购物车';
		$data['status'] = 1;
		$this->ajaxReturn($data,'JSON');
	}
	public function drop(){
		$cart = parent::bonycart();
		$cart->drop();
		//$cart->show();
	}

	public function remove(){
		$qty = I('qty',1,'intval');
		$cart = parent::bonycart();
		$id = I('id',0,'intval');
		$ginfo = M('product')->field('id,title,price3 as price,img')->where('status=1')->find($id);	
		$ginfo['qty'] = $qty;
		$cart->remove($ginfo);
	}
}
?>