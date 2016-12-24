<?php
class MobileIndexCatViewModel extends ViewModel {
	public $viewFields = array(
		"cat"=>array("id","title"),
		
		"relationship"=>array(
			"pid"=>"pid",  
			"_on"=>"relationship.cid=cat.id"
		),
		"product"=>array(
			"img"=>"img",  
			"_on"=>"relationship.pid=product.id"
		),
		
	);
}

?>