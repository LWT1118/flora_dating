<?php
class mycart{

 
	public function __construct(){

		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
			$this->g = $_SESSION['cart'];
			$this->g['item'] = 0 ;
			$this->g['total'] = 0 ;
			$this->g['sum_all'] = 0.00 ;
		}else{
			$this->g = $_SESSION['cart'];
			if(!isset($this->g['item']))$this->g['item'] = 0 ;
			if(!isset($this->g['total']))$this->g['total'] = 0 ;
			if(!isset($this->g['sum_all']))$this->g['sum_all'] = 0.00 ;
		}
	}
	
	
	public function add($good){
		if(is_array($good) && isset($good['id']) && isset($good['title']) && isset($good['price']) && isset($good['qty'])){
			$good['price'] = $this->money($good['price']);
			$row_id = md5('xxx'.$good['id'].$good['title'].$good['price'].'xxx');
			
			//$this->pre($good);
			
			if(isset($this->g[$row_id])){
				$this->g[$row_id]['qty']+=$good['qty'];
				$this->g[$row_id]['sum'] += $good['price']*$good['qty'];
				$this->g[$row_id]['sum'] = $this->money($this->g[$row_id]['sum']);
				$this->g['total'] += $good['qty'];
				$this->g['sum_all'] += $good['price']*$good['qty'];
				$this->g['sum_all'] = $this->money($this->g['sum_all']);
			}else{
				$this->g[$row_id]['id'] = $good['id'];
				$this->g[$row_id]['title'] = $good['title'];
				$this->g[$row_id]['qty'] = $good['qty'];
				$this->g[$row_id]['price'] = $good['price'];
				$this->g[$row_id]['printer'] = 'printer';
				$this->g[$row_id]['img'] = $good['img'];

				$this->g[$row_id]['sum'] = $good['price']*$good['qty'];
				$this->g[$row_id]['sum'] = $this->money($this->g[$row_id]['sum']);
				$this->g['item'] += 1 ;
				$this->g['total'] += $good['qty'];
				$this->g['sum_all'] += $this->money($this->g[$row_id]['sum']);
			}
			
			$this->save();		
			
		}
	}


	public function remove($good){
		if(is_array($good) && isset($good['id']) && isset($good['title']) && isset($good['price']) && isset($good['qty'])){
			$good['price'] = $this->money($good['price']);
			$row_id = md5('xxx'.$good['id'].$good['title'].$good['price'].'xxx');

			
			if(isset($this->g[$row_id])){
				//echo $this->g[$row_id];
				if($this->g[$row_id]['qty']>$good['qty']){
					
					$this->g[$row_id]['qty'] -= $good['qty'];
					$this->g[$row_id]['sum'] -= $good['price']*$good['qty'];
					$this->g[$row_id]['sum'] = $this->money($this->g[$row_id]['sum']);					
					$this->g['total'] -= $good['qty'] ;
					$this->g['sum_all'] -= $good['price']*$good['qty'];
					$this->g['sum_all'] = $this->money($this->g['sum_all']);
					
				}elseif($this->g[$row_id]['qty']==$good['qty']){
					
					$this->g['item'] -= 1 ;
					$this->g['total'] -= $good['qty'] ;
					$this->g['sum_all'] -= $good['price']*$good['qty'];
					$this->g['sum_all'] = $this->money($this->g['sum_all']);
					unset($this->g[$row_id]);
					
				}

			}
			
			$this->save();
			
		}
	}
	
	public function id2info($pos){
		$temp = $this->g;
		if(isset($temp[$pos]) && is_array($temp[$pos])){
			return $temp[$pos];
		}else{
			return false;
		}
	}
	
	public function get_cart(){
	
		$temp =  $this->g;
		unset ($temp['item'],$temp['total'],$temp['sum_all']);
		
		sort($temp);
		return $temp;
	}
	
	public function sum_all(){
		return $this->g['sum_all'];	
	}
	
	public function item(){
		return $this->g['item'];	
	}	

	public function total(){
		return $this->g['total'];	
	}

	public function show(){
	
		$this->pre($this->g);
	
	}

	public function save(){ 	
		$_SESSION['cart'] = $this->g;
	}

	public function drop(){
		$this->g = array();
		$this->g['item'] = 0 ;
		$this->g['total'] = 0 ;
		$this->g['sum_all'] = 0.00 ;
		unset($_SESSION['cart']);
		//$this->pre($this->g);
	}

	private function money($v){
		$v = trim(preg_replace('/([^0-9\.])/i', '', $v));
		if(is_numeric($v)){
			return number_format($v,2,'.','');
		}else{
			return 0.00;
		}
	}
	
	
}
?>