<?php

namespace dad\models;

class Projects extends \lithium\data\Model {

	protected $_schema = array(
		'_id'          => array('type' => 'id'),
		'name'         => array('type' => 'string'),
		'description'  => array('type' => 'string'),
		'creator'      => array('type' => 'object'),
		'creator.id'   => array('type' => 'string'),
		'creator.name' => array('type' => 'string'),
		'archived'     => array('type' => 'boolean', 'default' => false),
		'created_at'   => array('type' => 'date'),
		'updated_at'   => array('type' => 'date')
	);

	public $validates = array();
}

?>