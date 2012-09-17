<?php

namespace dad\controllers;

use dad\models\People;

class PeopleController extends \dad\extensions\action\BaseController{

	/**
	 * List people
	 *
	 * - `GET /people` will return the all people.
	 *
	 */
	public function index() {
		$people = People::all();
		return compact('people');
	}

	/**
	 * - GET `/people/add`
	 */
	public function add() {
		$person = People::create();
		return compact('person');
	}

	/**
	 * Create a new person
	 *
	 * - `POST /people` will create a new person from the parameters passed.
	 *
	 * Returns `201 Created` on success,
	 * with the `Location` header set to the URL of the newly-created person.
	 */
	public function create() {
		$person = People::create($this->person_data());

		if ($person->save()) {
			return $this->redirect(['People::index', 'http:method' => 'GET']);
		} else {
			$this->_render['template'] = 'add';
		}

		return compact('person');
	}

	/**
	 * - `GET /people/1/edit`
	 */
	public function edit() {
		$person = People::find($this->request->id);

		if (!$person) {
			return $this->redirect(['People::index', 'http:method' => 'GET']);
		}

		return compact('person');
	}

	/**
	 * Update a person
	 *
	 * - `PUT /people/1` will update the person from the parameters passed.
	 *
	 * Return a `200 OK` on success.
	 * If the user does not have access to update the person, you'll see `403 Forbidden`.
	 */
	public function update() {
		$person = People::find($this->request->id);

		if ($person->save($this->person_data())) {
			return $this->redirect(['People::index', 'http:method' => 'GET']);
		} else {
			$this->_render['template'] = 'edit';
		}

		return compact('person');
	}

	/**
	 * Delete a person
	 *
	 * - `DELETE /people/1` will delete the person.
	 *
	 * Return a `204 No Content` on success.
	 */
	public function delete() {
		$person = People::find($this->request->id);

		if ($person->delete()) {
			return $this->render(['head' => true, 'status' => 204]);
		}

		return $this->render(['head' => true, 'status' => 400]);
	}

	/**
	 * Encapsulate the permissible attributes of a person
	 */
	private function person_data() {
		return array_intersect_key(
			$this->request->data,
			array_flip(['name', 'email_address', 'password', 'gravatar_email']));
	}
}

?>