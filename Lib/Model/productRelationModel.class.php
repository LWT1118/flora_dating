<?php
class productRelationModel extends RelationModel{
	protected $tableName = 'product';
    protected $_link = array(
		'cat' => array(
			'mapping_type'=>MANY_TO_MANY,
			'foreign_key'=>'pid',
			'relation_key'=>'cid',
			'relation_table'=>'wjw_relationship',
		)
    );
}

?>