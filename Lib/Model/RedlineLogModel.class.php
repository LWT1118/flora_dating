<?php
class RedlineLogModel extends RelationModel{
	protected $_link = array(
		'user'=>array('mapping_type'=>BELONGS_TO, 'class_name'=>'user', 'foreign_key'=>'pid'),
		'complainter'=>array('mapping_type'=>BELONGS_TO, 'class_name'=>'user', 'foreign_key'=>'uid')
		);
}
?>