<?php

namespace dad\extensions\data;

class BaseModel extends \lithium\data\Model {

	protected $_schema = [
		'created_at'   => ['type' => 'date'],
		'updated_at'   => ['type' => 'date']
	];

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

	public static function cast($entity) {
		return $entity->to('array', [
			'indexed' => null,
			'handlers' => [
				'MongoId' => function($value) { return $value; },
				'MongoDate' => function($value) { return $value; }
			]
		]);
	}

	public function push($entity, $path, $subentity, array $options = array()) {
		$options += array(
			'validate' => true,
			'events' => $subentity->exists() ? 'update' : 'create'
		);
		if ($rules = $options['validate']) {
			$events = $options['events'];
			$validateOpts = is_array($rules) ? compact('rules','events') : compact('events');
			$validateOpts['parent'] = $entity;
			if (!$subentity->validates($validateOpts)) {
				return false;
			}
		}
		if (!$subentity->exists()) {
			$subentity->_id = $subentity->_id ?: new \MongoId();
			return static::update(
				['$push' => [$path => static::cast($subentity)]],
				['_id' => $entity->_id]
			);
		}
		return static::update(
			['$set' => ["{$path}.$" => static::cast($subentity)]],
			['_id' => $entity->_id, "{$path}._id" => $subentity->_id]
		);
	}

	public function pull($entity, $path, $subentity) {
		if (!$subentity->_id) {
			return false;
		}
		return static::update(
			['$pull' => [$path => ['_id' => $subentity->_id]]],
			['_id' => $entity->_id, "{$path}._id" => $subentity->_id]
		);
	}
}

?>