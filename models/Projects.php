<?php

namespace dad\models;

use dad\models\Discussions;

class Projects extends \dad\extensions\data\BaseModel {

	protected $_schema = [
		'_id'          => ['type' => 'id'],
		'name'         => ['type' => 'string'],
		'description'  => ['type' => 'string'],
		'creator'      => ['type' => 'object'],
		'creator.id'   => ['type' => 'string'],
		'creator.name' => ['type' => 'string'],
		'archived'     => ['type' => 'boolean', 'default' => false],
		'created_at'   => ['type' => 'date'],
		'updated_at'   => ['type' => 'date']
	];

	public $validates = [];

	public function discussions($project, array $options = []) {
		$defaults =  ['project_id' => (string) $project->_id];
		$conditions = $options += $defaults;

		return Discussions::all(compact('conditions'));
	}
}

?>