<?php

namespace dad\tests\cases\models;

use dad\tests\factories\Messages;

class MessagesTest extends \lithium\test\Unit {

	public function test_has_valid_factory() {
		$message = Messages::create();
		$this->assertTrue($message->validates());
	}

	public function test_invalid_without_content() {
		$message = Messages::create(['content' => null]);
		$expected = ['content' => ['Cowardly refusing to save an empty message.']];
		$this->assertFalse($message->validates());
		$errors = $message->errors();
		$this->assertTrue(!empty($errors));
		$this->assertEqual($expected, $errors);
	}

	public function test_schema_inheritence() {
		$schema = Messages::schema();
		$this->assertNotNull($schema->fields('created_at'));
		$this->assertNotNull($schema->fields('updated_at'));
	}
}

?>