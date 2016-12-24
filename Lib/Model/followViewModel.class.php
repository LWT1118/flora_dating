<?php
class followViewModel extends ViewModel {
	public $viewFields = array(
		
		"bookmark"=>array(
			true,
			'_type'=>'LEFT',
		),
		
		"user"=>array(
			true,
			"_on"=>"bookmark.pid = user.id",
			'_type'=>'LEFT',
		),
		
	);
}

?>