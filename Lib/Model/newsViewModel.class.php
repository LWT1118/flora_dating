<?php
class newsViewModel extends ViewModel {
	public $viewFields = array(
		
		"news"=>array(
			true,
			'_type'=>'LEFT',
		),
		
		"news_cat"=>array(
			"cat"=>"cat_name", 
			"_on"=>"news_cat.id = news.cat",			
		),		
	);
}

?>