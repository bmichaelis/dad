<?php

namespace dad\tests\cases\models;

use dad\models\Discussions;
use dad\tests\factories\Projects;

class DiscussionsTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {
		Projects::remove();
		Discussions::remove();
	}

	public function test_project_marked_updated_after_discussion_save_or_delete() {
		$project = Projects::create();
		$project->save();

		$discussion = Discussions::create(['project_id' => (string) $project->_id]);
		$discussion->save();
		$updated_project_after_save = Projects::first(['conditions' => ['_id' => $project->_id]]);

		$this->assertTrue($project->updated_at < $updated_project_after_save->updated_at);

		$discussion->delete();
		$updated_project_after_delete = Projects::first(['conditions' => ['_id' => $project->_id]]);

		$this->assertTrue($updated_project_after_save->updated_at < $updated_project_after_delete->updated_at);
	}
}

?>