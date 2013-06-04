<?php

namespace dad\models;

class People extends \dad\extensions\data\BaseModel {

	protected $_schema = [
		'_id'            => ['type' => 'id'],
		'name'           => ['type' => 'string'],
		'email_address'  => ['type' => 'string'],
		'password'       => ['type' => 'string'],
		'gravatar_email' => ['type' => 'string']
	];

	public $validates = [
		'name' => 'Must not be blank.',
		'email_address' => [
			['notEmpty', 'message' => 'Must not be blank.'],
			['email', 'message' => "That doesn't look like a valid email address."],
			['unique', 'message' => 'An existing account with this email address already exists.']
		],
		'password' => 'Must not be blank.'
	];
}

?>