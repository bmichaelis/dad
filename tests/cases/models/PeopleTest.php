<?php

namespace dad\tests\cases\models;

use dad\tests\factories\People;

class PeopleTest extends \lithium\test\Unit {

	public function test_has_valid_factory() {
		$person = People::create();
		$this->assertTrue($person->validates());
	}

	public function test_invalid() {
		$person = People::create([
			'name' => null,
			'email_address' => null,
			'password' => null
		]);
		$expected = [
			'name' => ['Must not be blank.'],
			'email_address' => ['Must not be blank.', 'That doesn\'t look like a valid email address.'],
			'password' => ['Must not be blank.']
		];
		$this->assertFalse($person->validates());
		$errors = $person->errors();
		$this->assertTrue(!empty($errors));
		$this->assertEqual($expected, $errors);
	}

	public function test_invalid_email() {
		$person = People::create([
			'email_address' => 'invalid@emailadress',
		]);
		$expected = [
			'email_address' => ['That doesn\'t look like a valid email address.']
		];
		$this->assertFalse($person->validates());
		$errors = $person->errors();
		$this->assertEqual($expected, $errors);
	}

	public function test_schema_inheritence() {
		$schema = People::schema();
		$this->assertNotNull($schema->fields('created_at'));
		$this->assertNotNull($schema->fields('updated_at'));
	}
}

?>