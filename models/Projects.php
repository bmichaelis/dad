<?php

namespace dad\models;

use dad\models\Discussions;

class Projects extends \dad\extensions\data\BaseModel {

	protected $_schema = [
		'_id'          => ['type' => 'id'],
		'name'         => ['type' => 'string'],
		'description'  => ['type' => 'string'],
		'creator'      => ['type' => 'object'],
		'creator.id'   => ['type' => 'id'],
		'creator.name' => ['type' => 'string'],
		'archived'     => ['type' => 'boolean', 'default' => false]
	];

	public $validates = [
		'name' => 'Must not be blank.'
	];

	public function discussions($project, array $options = []) {
		$conditions = $options += ['project_id' => $project->_id];
		return Discussions::all(compact('conditions'));
	}

	public function count_discussions($project, array $options = []) {
		$conditions = $options += ['project_id' => $project->_id];
		return Discussions::count(compact('conditions'));
	}

	public function discussion($project, array $options = []) {
		$conditions = $options += ['project_id' => $project->_id];
		return Discussions::first(compact('conditions'));
	}

	public function create_discussion($project, array $data = [], $options = []) {
		$data += ['project_id' => $project->_id];
		return Discussions::create($data, $options);
	}

	/**
	 * TODO: Update events log for the deleted project
	 */
	public function delete($project, array $options = []) {
		Discussions::remove(['project_id' => $project->_id]);
		return parent::delete($project, $options);
	}
}

?>