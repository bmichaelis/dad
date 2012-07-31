<?php

namespace dad\extensions\data;

class BaseModel extends \lithium\data\Model {

	public function save($entity, $data = null, array $options = array()) {
		if ($data) {
			$entity->set($data);
		}

		if (!$entity->exists()) {
			$entity->created_at = new \MongoDate();
		}

		$entity->updated_at = new \MongoDate();

		return parent::save($entity, null, $options);
	}

}

?>