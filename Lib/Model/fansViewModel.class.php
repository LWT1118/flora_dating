<?php
class fansViewModel extends ViewModel {
	public $viewFields = array(
		
		"bookmark"=>array(
			true,
			'_type'=>'LEFT',
		),
		
		"user"=>array(
			true,
			"_on"=>"bookmark.uid = user.id",
			'_type'=>'LEFT',
		),
		
	);
}

?>