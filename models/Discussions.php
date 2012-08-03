<?php

namespace dad\models;

use lithium\util\String;

class Discussions extends \dad\extensions\data\BaseModel {

	protected $_schema = array(
		'_id'          => array('type' => 'id'),
		'project_id'   => array('type' => 'string'),
		'subject'      => array('type' => 'string'),
		'content'      => array('type' => 'string'),
		'creator'      => array('type' => 'object'),
		'creator.id'   => array('type' => 'string'),
		'creator.name' => array('type' => 'string'),
		'messages'     => array('type' => 'object', 'array' => true),
		'created_at'   => array('type' => 'date'),
		'updated_at'   => array('type' => 'date')
	);

	public $validates = array();

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