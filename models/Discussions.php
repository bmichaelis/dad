<?php

namespace dad\models;

use lithium\util\String;

class Discussions extends \dad\extensions\data\BaseModel {

	protected $_schema = [
		'_id'          => ['type' => 'id'],
		'project_id'   => ['type' => 'string'],
		'subject'      => ['type' => 'string'],
		'content'      => ['type' => 'string'],
		'creator'      => ['type' => 'object'],
		'creator.id'   => ['type' => 'string'],
		'creator.name' => ['type' => 'string'],
		'messages'     => ['type' => 'object', 'array' => true],
		'created_at'   => ['type' => 'date'],
		'updated_at'   => ['type' => 'date']
	];

	public function pushMessage($discussion, $message) {
		$defaults = [
			'id' => String::uuid(),
			'created_at' => new \MongoDate(),
			'updated_at' => new \MongoDate()
		];
		$message_data = $message->data() + $defaults;

		$query = ['$push' => ['messages' => $message_data]];
		$conditions = ['_id' => $discussion->_id];

		if (!Discussions::update($query, $conditions)) {
			return false;
		}

		return true;
	}

	public function pullMessage($discussion, $message) {
		$query = ['$pull' => ['messages' => ['id' => $message->id]]];
		$conditions = ['_id' => $discussion->_id];

		if (!Discussions::update($query, $conditions)) {
			return false;
		}

		return true;
	}
}

?>