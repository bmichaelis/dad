<?php

namespace dad\tests\cases\models;

use dad\tests\factories\People;

class PeopleTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {}

	public function test_validates() {
		$person = People::create();
		$this->assertTrue($person->validates());

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
}

?>