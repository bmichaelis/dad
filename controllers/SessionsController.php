<?php

namespace dad\controllers;

use lithium\security\Auth;

class SessionsController extends \dad\extensions\action\BaseController {

	public function add() {
	}

	public function create() {
		if (Auth::check('user', $this->request)) {
			return $this->redirect('/');
		} else {
			return $this->redirect('/signin', ['error' => "We didn't recognize the username or password you entered. Please try again."]);
		}
	}

	public function delete() {
		Auth::clear('user');
		return $this->redirect('/');
	}
}

?>