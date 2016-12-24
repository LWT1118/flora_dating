<?php
class orderViewModel extends ViewModel {
	public $viewFields = array(
		"orders"=>array("id","goods_price","ship_fee","pay_price","add_time","pay_time","send_time","receive_time","realname","tel","address","remark","uid","status"),
		
		"user"=>array(
			"username"=>"user_name", 
			"tel"=>"user_tel", 
			"realname"=>"user_realname", 
			"_on"=>"orders.uid=user.id",
		),
	);
}

?>