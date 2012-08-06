<?php

namespace dad\tests\factories;

class Projects extends \dad\models\Projects {

	public static function create(array $data = [], array $options = []) {
		$defaults = [
			'name' => 'TDD Best Practices',
			'description' => 'Thought on TDD best practices',
		];
		$data += $defaults;

		return parent::create($data, $options);
	}
}

?>