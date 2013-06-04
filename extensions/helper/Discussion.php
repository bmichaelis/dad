<?php

namespace dad\extensions\helper;

use lithium\util\Inflector;
use \lithium\net\http\Router;

class Discussion extends \lithium\template\Helper {

	public function path($discussion, $project) {
		if ($discussion->exists()) {
			$path = Router::match(['Discussions::update', 'project_id' => $project->_id, 'id' => $discussion->_id, 'http:method' => 'PUT']);
		} else {
			$path = Router::match(['Discussions::create', 'project_id' => $project->_id, 'http:method' => 'POST']);
		}

		return $path;
	}

	public function add_path($discussion, $project) {
		return $this->path($discussion, $project) . '/add';
	}

	public function edit_path($discussion, $project) {
		return $this->path($discussion, $project) . '/edit';
	}
}

?>
