<?php
class userUpdateModel extends Model {

	protected $_validate = array(
	    array('username','unique','用户名必须唯一！',2),
	    array('email','email','请输入合法的邮箱！',2,'unique'),   
	);

/*	protected $_auto = array ( 
   		array('addtime','time',3,'function'),
   	);*/
}

?>