<?php
class recordViewModel extends ViewModel {
	public $viewFields = array(
		
		"record"=>array(
			true,
			'_type'=>'LEFT',
		),
		
		"news"=>array(
			true,
			"_on"=>"news.id = record.news_id",			
		),		
	);
}

?>