<?php

namespace dad\tests\cases\models;

use dad\tests\factories\Projects;

class ProjectsTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {
		Projects::remove();
	}

	public function test_has_valid_factory() {
		$project = Projects::create();
		$this->assertTrue($project->validates());
	}

	public function test_valid_without_description() {
		$project = Projects::create(['description' => null]);
		$this->assertTrue($project->validates());
	}

	public function test_invalid_without_name() {
		$project = Projects::create(['name' => null]);
		$this->assertFalse($project->validates());
		$errors = $project->errors();
		$this->assertTrue(!empty($errors));
		$this->assertEqual(['name' => ['Must not be blank.']], $errors);
	}

	public function test_creator_id_object() {
		$project = Projects::create(['creator' => ['id' => '4fdfb4327a959c4f76000006', 'name' => 'Bart']]);
		$project->save();
		$result = Projects::first(['conditions' => ['_id' => $project->_id]]);
		$this->assertTrue($result->creator->id instanceof \MongoId);

		$project2 = Projects::create(['creator' => ['id' => new \MongoId(), 'name' => 'Bart']]);
		$project2->save();
		$result2 = Projects::first(['conditions' => ['_id' => $project2->_id]]);
		$this->assertTrue($result2->creator->id instanceof \MongoId);
	}

	public function test_schema_inheritence() {
		$schema = Projects::schema();
		$this->assertNotNull($schema->fields('created_at'));
		$this->assertNotNull($schema->fields('updated_at'));
	}
}

?>