<?php

namespace dad\tests\factories;

class People extends \dad\models\People {

	public static function create(array $data = [], array $options = []) {
		$defaults = [
			'name' => 'Mehdi Lahmam B.',
			'email_address' => 'mehdi@lahmam.com',
			'password' => 'passhash'
		];
		$data += $defaults;

		return parent::create($data, $options);
	}
}

?>