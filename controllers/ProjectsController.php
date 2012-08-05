<?php

namespace dad\controllers;

use dad\models\Projects;

class ProjectsController extends \dad\extensions\action\BaseController {

	/**
	 * List projects
	 *
	 * - `GET /projects/1` will return all the projects for the project.
	 *
	 */
	public function index() {
		$projects = Projects::all();
		return compact('projects');
	}

	/**
	 * Get a single project
	 *
	 * - `GET /projects/1` will return the specified project.
	 *
	 */
	public function show() {
		$project = Projects::find($this->request->id);

		if (!$project) {
			return $this->redirect(['Projects::index', 'http:method' => 'GET']);
		}

		$discussions = $project->discussions();

		return compact('project', 'discussions');
	}

	/**
	 * - GET `/projects/add`
	 */
	public function add() {
		$project = Projects::create();
		return compact('project');
	}

	/**
	 * Create a new project
	 *
	 * - `POST /projects` will create a new project from the parameters passed.
	 *
	 * Returns `201 Created` on success,
	 * with the `Location` header set to the URL of the newly-created project.
	 */
	public function create() {
		$user = $this->current_user();
		$project = Projects::create($this->project_data() + ['creator' => ['id' => (string) $user->_id, 'name' => $user->name]]);

		if ($project->save()) {
			return $this->redirect(['Projects::show' , 'id' => $project->_id]);
		} else {
			$this->_render['template'] = 'add';
		}

		return compact('project');
	}

	/**
	 * - `GET /projects/1/edit`
	 */
	public function edit() {
		$project = Projects::find($this->request->id);

		if (!$project) {
			return $this->redirect(['Projects::index', 'http:method' => 'GET']);
		}

		return compact('project');
	}

	/**
	 * Update a project
	 *
	 * - `PUT /projects/1` will update the project from the parameters passed.
	 *
	 * Return a `200 OK` on success.
	 * If the user does not have access to update the project, you'll see `403 Forbidden`.
	 */
	public function update() {
		$project = Projects::find($this->request->id);

		if ($project->save($this->project_data())) {
			return $this->redirect(['Projects::show' , 'id' => $project->_id]);
		} else {
			$this->_render['template'] = 'edit';
		}

		return compact('project');
	}

	/**
	 * Delete a project
	 *
	 * - `DELETE /projects/1` will delete the project specified.
	 *
	 * Return a `204 No Content` on success.
	 */
	public function delete() {
		$project = Projects::find($this->request->id);

		if ($project->delete()) {
			return $this->render(['head' => true, 'status' => 204]);
		}

		return $this->render(['head' => true, 'status' => 400]);
	}


	/**
	 * Encapsulate the permissible attributes of a project
	 */
	private function project_data() {
		return array_intersect_key($this->request->data, array_flip(['name', 'description']));
	}
}

?>