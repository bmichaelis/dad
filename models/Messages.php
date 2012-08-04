<?php

namespace dad\models;

use dad\models\Discussions;
use lithium\util\Set;
use lithium\data\Entity;

class Messages extends \dad\extensions\data\BaseModel {

	protected $_meta = [
		'connection' => false,
		'source' => false,
		'locked' => true,
		'key' => 'id'
	];

	protected $_schema = [
		'id'           => ['type' => 'string'],
		'content'      => ['type' => 'string'],
		'creator'      => ['type' => 'object'],
		'creator.id'   => ['type' => 'string'],
		'creator.name' => ['type' => 'string'],
		'created_at'   => ['type' => 'date'],
		'updated_at'   => ['type' => 'date']
	];

	public $validates = [];

	public static function find($type, array $options = []) {
		$discussion_id = $options['conditions']['discussion_id'];
		$message_id = $options['conditions']['id'];

		$discussion = Discussions::find($discussion_id);
		if (!$discussion) {
			return null;
		}

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
}

?>