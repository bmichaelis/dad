<?php

namespace dad\extensions\helper;

class Element extends \lithium\template\Helper {

	public function render($template, array $data = [], array $options = []) {
		$data += $this->_context->data();
		$options += ['controller' => $this->_context->request()->controller];

		return $this->_context->view()->render(['element' => $template], $data, $options);
	}
}

?>