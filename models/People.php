<?php

namespace dad\models;

class People extends \dad\extensions\data\BaseModel {

	protected $_schema = [
		'_id'            => ['type' => 'id'],
		'name'          => ['type' => 'string'],
		'email_address' => ['type' => 'string'],
		'password'      => ['type' => 'string'],
		'avatar_url'    => ['type' => 'string'],
		'created_at'    => ['type' => 'date'],
		'updated_at'    => ['type' => 'date']
	];

	public $validates = [];
}

?>