<?php

namespace dad\tests\cases\models;

use dad\tests\factories\Messages;

class MessagesTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {
		Messages::remove();
	}

	public function test_create() {
		$message = Messages::create();
		$this->assertTrue(!empty($message->content));
		$this->assertTrue($message->creator->id instanceof \MongoId);
	}

	public function test_validates() {
		$message = Messages::create();
		$this->assertTrue($message->validates());

		$message = Messages::create(['content' => null]);
		$expected = ['content' => ['Cowardly refusing to save an empty message.']];
		$this->assertFalse($message->validates());
		$errors = $message->errors();
		$this->assertTrue(!empty($errors));
		$this->assertEqual($expected, $errors);
	}
}

?>