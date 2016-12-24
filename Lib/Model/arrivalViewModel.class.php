<?php
class arrivalViewModel extends ViewModel {
	public $viewFields = array(
		"record"=>array("news_id","user_id","reg_time","arrival_time"),
		
		"news"=>array(
			"title"=>"title",
			"img"=>"img",
			"reg"=>"reg",
			"arrival"=>"arrival",
			"_on"=>"record.news_id=news.id",
		),
	);
}

?>