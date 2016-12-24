<?php
class picViewModel extends ViewModel {
	public $viewFields = array(
		"product_pic"=>array("id","img","pid","alt","type","url","pos"),
		
		"product"=>array(
			"title"=>"title", 
			"_on"=>"product_pic.pid=product.id",
		),
	);
}

?>