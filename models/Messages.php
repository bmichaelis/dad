<?php

namespace dad\models;

use dad\models\People;

class Messages extends \dad\extensions\data\BaseModel {

	protected $_meta = [
		'connection' => 'default',
		'source' => false,
		'locked' => true,
		'key' => 'id'
	];

	protected $_schema = [
		'id'           => ['type' => 'string'],
		'content'      => ['type' => 'string'],
		'creator'      => ['type' => 'object'],
		'creator.id'   => ['type' => 'id'],
		'creator.name' => ['type' => 'string']
	];

	public $validates = [
		'content' => 'Cowardly refusing to save an empty message.'
	];

	public function creator($message) {
		return People::first((string) $message->creator->id);
	}
}

?>