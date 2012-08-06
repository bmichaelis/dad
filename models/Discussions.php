<?php

namespace dad\models;

use dad\models\Messages;

use lithium\util\String;
use lithium\util\Set;
use lithium\data\Entity;

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

	public function messages($discussion, array $options = []) {
		return $discussion->messages;
	}

	public function message($discussion, array $options = []) {
		$message_id = $options['id'];
		$message_data = Set::extract($discussion->data(), "/messages[id={$message_id}]/.");

		if (empty($message_data)) {
			return null;
		}

		$message = new Entity([
			'data' => $message_data[0],
			'model' => __CLASS__
		]);

		// Sync the Entity to be flagged as existing
		$message->sync($message->id);

		return $message;
	}

	public function create_message($discussion, array $data = [], array $options = []) {
		return Messages::create($data, $options);
	}

	public function push_message($discussion, $message) {
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

	public function pull_message($discussion, $message) {
		$query = ['$pull' => ['messages' => ['id' => $message->id]]];
		$conditions = ['_id' => $discussion->_id];

		if (!Discussions::update($query, $conditions)) {
			return false;
		}

		return true;
	}
}

?>