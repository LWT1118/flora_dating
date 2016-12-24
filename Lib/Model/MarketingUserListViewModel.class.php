<?php
class MarketingUserListViewModel extends ViewModel {
	public $viewFields = array(
		"user"=>array("id","realname","tel","email","gender","birthday","promote","hub","_type"=>"LEFT"),
		
		"orders"=>array(
			"count(orders.id)"=>"orderNum",
			"sum(orders.goods_price)"=>"orderFee", 
			"_on"=>"orders.uid=user.id",
		),
	);
}

?>