<?php

namespace dad\controllers;

use dad\models\Discussions;
use dad\models\Projects;

class DiscussionsController extends \dad\extensions\action\BaseController {

	/**
	 * List discussions
	 *
	 * - `GET /projects/1/discussions` will return the all the discussions for the project.
	 *
	 */
	public function index() {
		$conditions = ['project_id' => $this->request->project_id];
		$discussions = Discussions::all(compact('conditions'));
		return compact('discussions');
	}

	/**
	 * Get a single discussion
	 *
	 * - `GET /projects/1/discussions/1` will return the specified discussion.
	 *
	 */
	public function show() {
		$conditions = [
			'_id' => $this->request->id,
			'project_id' => $this->request->project_id
		];
		$discussion = Discussions::first(compact('conditions'));

		if (!$discussion) {
			return $this->redirect('/discussions');
		}

		return compact('discussion');
	}

	/**
	 * - GET `/projects/1/discussions/add`
	 */
	public function add() {
		$discussion = Discussions::create();
		return compact('discussion');
	}

	/**
	 * Create a new discussion
	 *
	 * - `POST /projects/1/discussions` will create a new discussion from the parameters passed.
	 *
	 * Returns `201 Created` on success,
	 * with the `Location` header set to the URL of the newly-created discussion.
	 */
	public function create() {
		$project = Projects::find($this->request->project_id);

		if (!$project) {
			return $this->redirect('/projects');
		}

		$discussion = Discussions::create($this->discussion_data());

		if ($discussion->save()) {
			return $this->redirect('/projects/' . $this->request->project_id . '/discussions/' . $discussion->_id, ['status' => 201]);
		} else {
			$this->_render['template'] = 'add';
		}

		return compact('discussion');
	}

	/**
	 * - `GET /projects/1/discussions/1/edit`
	 */
	public function edit() {
		$conditions = [
			'_id' => $this->request->id,
			'project_id' => $this->request->project_id
		];
		$discussion = Discussions::first(compact('conditions'));

		if (!$discussion) {
			return $this->redirect('/projects/' . $this->request->project_id . '/discussions');
		}

		return compact('discussion');
	}

	/**
	 * Update a discussion
	 *
	 * - `PUT /projects/1/discussions/1` will update the discussion from the parameters passed.
	 *
	 * Return a `200 OK` on success.
	 * If the user does not have access to update the project, you'll see `403 Forbidden`.
	 */
	public function update() {
		$conditions = [
			'_id' => $this->request->id,
			'project_id' => $this->request->project_id
		];
		$discussion = Discussions::first(compact('conditions'));

		if ($discussion->save($this->discussion_data())) {
			return $this->redirect('/projects/' . $this->request->project_id . '/discussions/' . $discussion->_id);
		} else {
			$this->_render['template'] = 'edit';
		}

		return compact('discussion');
	}

	/**
	 * Delete a discussion
	 *
	 * - `DELETE /projects/1/discussions/1` will delete the discussion specified.
	 *
	 * Return a `204 No Content` on success.
	 */
	public function delete() {
		$conditions = [
			'_id' => $this->request->id,
			'project_id' => $this->request->project_id
		];

		$discussion = Discussions::first(compact('conditions'));

		if ($discussion->delete()) {
			return $this->render(['head' => true, 'status' => 204]);
		}

		return $this->render(['head' => true, 'status' => 400]);
	}

	/**
	 * Encapsulate the permissible attributes of a discussion
	 */
	private function discussion_data() {
		$data = array_intersect_key($this->request->data, array_flip(['subject', 'content']));
		return $data + ['project_id' => $this->request->project_id];
	}
}

?>