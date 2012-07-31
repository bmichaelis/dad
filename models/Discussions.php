<?php

namespace dad\models;

class Discussions extends \dad\extensions\data\BaseModel {

	protected $_schema = array(
		'_id'          => array('type' => 'id'),
		'subject'      => array('type' => 'string'),
		'content'      => array('type' => 'string'),
		'creator'      => array('type' => 'object'),
		'creator.id'   => array('type' => 'string'),
		'creator.name' => array('type' => 'string'),
		'messages'     => array('type' => 'object', 'array' => true),
		'created_at'   => array('type' => 'date'),
		'updated_at'   => array('type' => 'date')
	);

	public $validates = array();
}

?>