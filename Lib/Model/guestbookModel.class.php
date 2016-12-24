<?php
class guestbookModel extends Model {

	protected $_validate = array(
	    array('firstname','require','名字不能为空！'),
	    array('lastname','require','姓氏不能为空！'), 
	    array('email','email','请输入正确的邮箱地址！',2),
	    array('tel','number','请输入正确的手机号！',2,'/1[3,5,8][0-9]{9}/'),
	);

	protected $_auto = array ( 
   		array('addtime','time',3,'function'),
   	);
}

?>