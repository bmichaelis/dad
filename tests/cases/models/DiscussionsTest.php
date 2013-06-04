<?php

namespace dad\tests\cases\models;

use dad\models\Discussions;
use dad\tests\factories\Projects;
use dad\tests\factories\People;

class DiscussionsTest extends \lithium\test\Unit {

	public function tearDown() {
		Discussions::remove();
		Projects::remove();
		People::remove();
	}

	public function test_schema_inheritence() {
		$schema = Discussions::schema();
		$this->assertNotNull($schema->fields('created_at'));
		$this->assertNotNull($schema->fields('updated_at'));
	}

	public function test_project_marked_updated_after_discussion_save_or_delete() {
		$creator = People::create();
		$creator->save();
		$project = Projects::create(['creator' => ['id' => $creator->_id, 'name' => $creator->name]]);
		$project->save();

		$discussion = $project->create_discussion(['creator' => ['id' => $creator->_id, 'name' => $creator->name]]);
		$discussion->save();
		$updated_project_after_save = Projects::first(['conditions' => ['_id' => $project->_id]]);

		$this->assertTrue($project->updated_at < $updated_project_after_save->updated_at);

		$discussion->delete();
		$updated_project_after_delete = Projects::first(['conditions' => ['_id' => $project->_id]]);

		$this->assertTrue($updated_project_after_save->updated_at < $updated_project_after_delete->updated_at);
	}
}

?>