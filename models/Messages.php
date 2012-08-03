<?php

namespace dad\models;

use dad\models\Discussions;
use lithium\util\Set;
use lithium\data\Entity;

class Messages extends \dad\extensions\data\BaseModel {

	protected $_meta = array(
		'connection' => false,
		'source' => false,
		'locked' => true,
		'key' => 'id'
	);

	protected $_schema = array(
		'id'           => array('type' => 'string'),
		'content'      => array('type' => 'string'),
		'creator'      => array('type' => 'object'),
		'creator.id'   => array('type' => 'string'),
		'creator.name' => array('type' => 'string'),
		'created_at'   => array('type' => 'date'),
		'updated_at'   => array('type' => 'date')
	);

	public $validates = array();

	public static function find($type, array $options = array()) {
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