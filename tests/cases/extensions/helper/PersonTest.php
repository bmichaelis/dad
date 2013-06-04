<?php

namespace dad\tests\cases\extensions\helper;

use dad\extensions\helper\Person;
use lithium\tests\mocks\template\MockRenderer;

class PersonTest extends \lithium\test\Unit {

	public function setUp() {
		$this->person = new Person(array('context' => new MockRenderer()));
	}

	public function tearDown() {
		unset($this->person);
	}

	public function test_short_name() {
		$pairs = [
			'Mehdi Lahmam B.' => 'Mehdi L.',
			'Kévin Chavanne' => 'Kévin C.',
			'HELENE SOMMET' => 'Helene S.',
			'John E. Gray' => 'John E.',
			'Repellendus Victor' => 'Repellendus V.',
			'Repëllendus Victor' => 'Repëllendus V.'
		];

		foreach ($pairs as $name => $expected) {
			$this->assertEqual($expected, $this->person->short_name($name));
		}
	}
}

?>