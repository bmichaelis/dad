<?php

namespace dad\controllers;

use lithium\security\Auth;

class SessionsController extends \dad\extensions\action\BaseController {

	public function add() {
	}

	public function create() {
		if (Auth::check('default', $this->request)) {
			return $this->redirect('/');
		} else {
			//Todo: Set a flash message here
			return $this->redirect('/');
		}
	}

	public function delete() {
		Auth::clear('default');
		return $this->redirect('/');
	}
}

?>