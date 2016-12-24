<?php
class bookmarkViewModel extends ViewModel {
	public $viewFields = array(
		"bookmark"=>array("pid","uid"),
		
		"product"=>array(
			"title"=>"title", 
			"price3"=>"price3", 
			"img"=>"img", 
			"_on"=>"bookmark.pid=product.id"
		),
		
	);
}

?>