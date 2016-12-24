<?php
class productViewModel extends ViewModel {
	public $viewFields = array(
		"product"=>array("id","title","brand","short_word","long_word","vintage","addtime","pos"),
		
		"product_pic"=>array(
			"count(id)"=>"banner_count", 
			"_on"=>"product.id=product_pic.pid and product_pic.type=0",
		),
		
	);
}

?>