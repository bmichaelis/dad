<?php

namespace dad\models;

use dad\models\Messages;
use dad\models\Projects;
use dad\models\People;

use lithium\util\String;
use lithium\util\Set;
use lithium\data\Entity;

class Discussions extends \dad\extensions\data\BaseModel {

	protected $_schema = [
		'_id'          => ['type' => 'id'],
		'project_id'   => ['type' => 'id'],
		'subject'      => ['type' => 'string'],
		'content'      => ['type' => 'string'],
		'creator'      => ['type' => 'object'],
		'creator.id'   => ['type' => 'id'],
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
		$self = static::_object();

		$defaults = [
			'id' => String::uuid(),
			'created_at' => new \MongoDate(),
			'updated_at' => new \MongoDate()
		];
		$message_data = $message->data() + $defaults;
		$params = compact('discussion', 'message_data');

		$filter = function($self, $params) {
			$discussion = $params['discussion'];
			$message_data = $params['message_data'];

			$query = ['$push' => ['messages' => $message_data]];
			$conditions = ['_id' => $discussion->_id];

			if (!Discussions::update($query, $conditions)) {
				return false;
			}
			return true;
		};

		return static::_filter(__FUNCTION__, $params, $filter);
	}

	public function pull_message($discussion, $message) {
		$query = ['$pull' => ['messages' => ['id' => $message->id]]];
		$conditions = ['_id' => $discussion->_id];

		if (!Discussions::update($query, $conditions)) {
			return false;
		}

		return true;
	}

	public function project($discussion) {
		return Projects::first((string) $discussion->project_id);
	}

	public function creator($discussion) {
		return People::first((string) $discussion->creator->id);
	}
}

Discussions::applyFilter(['save', 'delete'], function ($self, $params, $chain) {
	$chain = $chain->next($self, $params, $chain);

	$project = $params['entity']->project();
	$project->updated_at = new \MongoDate();
	$project->save();

	return $chain;
});

Discussions::applyFilter('update', function ($self, $params, $chain) {
	$chain = $chain->next($self, $params, $chain);

	$discussion = Discussions::first((string) $params['conditions']['_id']);

	$project = $discussion->project();
	$project->updated_at = new \MongoDate();
	$project->save();

	return $chain;
});

?>