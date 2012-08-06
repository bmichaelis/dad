<?php

namespace dad\extensions\action;

use lithium\security\Auth;
use dad\models\People;

class BaseController extends \lithium\action\Controller {

	protected function _init() {
		$this->_render['negotiate'] = true;
		parent::_init();
	}

	protected function current_user() {
		if (!($user = Auth::check('user'))) {
			return null;
		}

		return People::find($user['_id']);
	}
}

?>