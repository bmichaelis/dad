<?php

namespace dad\controllers;

use dad\models\Messages;
use dad\models\Discussions;
use lithium\action\DispatchException;

class MessagesController extends \dad\extensions\action\BaseController {

	private $discussion = null;

	protected function _init() {
		parent::_init();
		$this->applyFilter('__invoke', function($self, $params, $chain){
			$discussion = Discussions::find($self->request->discussion_id);
			if (!$discussion) {
				throw new DispatchException();
			}

			$self->discussion = $discussion;

			return $chain->next($self, $params, $chain);
		});
	}

	/**
	 * Create a new message
	 *
	 * - `POST /projects/1/discussions/1/messages` will create a new message from the parameters passed.
	 *
	 * Returns `201 Created` on success,
	 * with the `Location` header set to the URL of the newly-created message.
	 */
	public function create() {
		$user = $this->current_user();
		$message = $this->discussion->create_message($this->message_data() + ['creator' => ['id' => $user->_id, 'name' => $user->name]]);

		if ($this->discussion->push_message($message)) {
			return $this->redirect(['Discussions::show', 'id' => $this->discussion->_id, 'project_id' => $this->discussion->project_id]);
		}

		return compact('message');
	}

	/**
	 * - `GET /projects/1/discussions/1/messages/1/edit`
	 */
	public function edit() {
		return $this->render(array('head' => true, 'status' => 501));
	}

	/**
	 * Update a message
	 *
	 * - `PUT /projects/1/discussions/1/messages/1` will update the message from the parameters passed.
	 */
	public function update() {
		return $this->render(array('head' => true, 'status' => 501));
	}

	/**
	 * Delete a message
	 *
	 * - `DELETE /projects/1/discussions/1/messages/1` will delete the message specified.
	 *
	 * Return a `204 No Content` on success.
	 */
	public function delete() {
		$message = $this->discussion->message(['id' => $this->request->id]);

		if ($this->discussion->pull_message($message)) {
			return $this->render(['head' => true, 'status' => 204]);
		}

		return $this->render(['head' => true, 'status' => 400]);
	}

	/**
	 * Encapsulate the permissible attributes of a message
	 */
	private function message_data() {
		return array_intersect_key($this->request->data, array_flip(['content']));
	}
}

?>