<?php

namespace dad\models;

use dad\models\Discussions;

class Projects extends \dad\extensions\data\BaseModel {

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

	public function discussions($entity, array $options = array()) {
		$defaults =  ['project_id' => (string) $entity->_id];
		$conditions = $options += $defaults;

		return Discussions::all(compact('conditions'));
	}
}

?>