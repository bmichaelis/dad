<?php

use lithium\util\Validator;

Validator::add('unique', function($value, $format, $options) {
	$model = $options['model'];
	$fields = (array) $options['field'];
	$conditions = array();

	foreach ($fields as $key => $field) {
		if (!array_key_exists($field, $options['values'])) {
			return false;
		}
		if (is_numeric($key)) {
			$conditions[$field] = $options['values'][$field];
			continue;
		}
		$conditions[$key] = $options['values'][$field];
	}
	if ($key = $model::key($options['values'])) {
		$conditions[key($key)] = array('!=' => new \MongoId(current($key)));
	}
	return $model::find('count', compact('conditions')) < 1;
});

?>