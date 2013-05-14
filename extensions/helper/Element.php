<?php

namespace dad\extensions\helper;

use lithium\util\Inflector;

class Element extends \lithium\template\Helper {

	public function render($template, array $data = [], array $options = []) {
		$data += $this->_context->data();
		$options += ['controller' => Inflector::underscore($this->_context->request()->controller)];

		return $this->_context->view()->render(['element' => $template], $data, $options);
	}
}

?>