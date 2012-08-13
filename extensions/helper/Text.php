<?php

namespace dad\extensions\helper;

class Text extends \lithium\template\Helper {

	protected $_classes = array(
		'inflector' => 'lithium\util\Inflector'
	);

	public function pluralize($count = 0, $singular, $plural = null) {
		$count = (int) $count;
		$inflector = $this->_classes['inflector'];

		return $count . ' ' . (($count > 1 || $count == 0) ? ($plural ?: $inflector::pluralize($singular)) : $singular);
	}
}

?>