<?php

namespace dad\controllers;

use li3_activities\models\Activities;

class ActivitiesController extends \dad\extensions\action\BaseController {

	public function index() {
		$activities = Activities::find('all', ['limit' => 250, 'order' => ['created_at' => '-1']]);
		return compact('activities');
	}
}

?>