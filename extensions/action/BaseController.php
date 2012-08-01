<?php

namespace dad\extensions\action;

class BaseController extends \lithium\action\Controller {

	protected function _init() {
		$this->_render['negotiate'] = true;
		parent::_init();
	}
}

?>