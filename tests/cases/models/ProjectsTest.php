<?php

namespace dad\tests\cases\models;

use dad\tests\factories\Projects;

class ProjectsTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {}

	public function test_validates() {
		$project = Projects::create();
		$this->assertTrue($project->validates());

		$project = Projects::create(['description' => null]);
		$this->assertTrue($project->validates());

		$project = Projects::create(['name' => null]);
		$expected = ['name' => ['Must not be blank.']];
		$this->assertFalse($project->validates());
		$errors = $project->errors();
		$this->assertTrue(!empty($errors));
		$this->assertEqual($expected, $errors);
	}
}

?>