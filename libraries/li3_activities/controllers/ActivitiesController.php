<?php

namespace li3_activities\controllers;

use li3_activities\models\Activities;

class ActivitiesController extends \lithium\action\Controller {

	public function index($input = null) {
		$activities = Activities::find('all', array('limit' => 250, 'order' => array('created_at' => -1)));
		return compact('activities');
	}
}

?>