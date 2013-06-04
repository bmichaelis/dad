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
		'messages'     => ['type' => 'object', 'array' => true]
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
			'model' => 'dad\models\Messages'
		]);
		// Sync the Entity to be flagged as existing
		$message->sync($message->id);

		return $message;
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