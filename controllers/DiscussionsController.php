<?php

namespace dad\controllers;

use dad\models\Discussions;
use dad\models\Projects;

class DiscussionsController extends \dad\extensions\action\BaseController {

	protected function _init() {
		parent::_init();
		$this->applyFilter('__invoke', function($self, $params, $chain){
			$project = Projects::find($self->request->project_id);

			if (!$project) {
				$self->redirect('Projects::index');
			}

			$self->set(compact('project'));

			return $chain->next($self, $params, $chain);
		});
	}

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
			return $this->redirect(['Discussions::index', 'project_id' => $this->request->project_id]);
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
		$discussion = Discussions::create($this->discussion_data());

		if ($discussion->save()) {
			return $this->redirect(['Discussions::show', 'id' => $discussion->_id, 'project_id' => $this->request->project_id]);
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
			return $this->redirect(['Discussions::index', 'project_id' => $this->request->project_id]);
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
			return $this->redirect(['Discussions::show', 'id' => $discussion->_id, 'project_id' => $this->request->project_id]);
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