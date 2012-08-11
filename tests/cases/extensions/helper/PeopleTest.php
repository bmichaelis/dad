<?php

namespace dad\tests\cases\extensions\helper;

use dad\extensions\helper\People;
use lithium\tests\mocks\template\helper\MockHtmlRenderer;

class PeopleTest extends \lithium\test\Unit {

	public function setUp() {
		$this->people = new People(array('context' => new MockHtmlRenderer()));
	}

	public function tearDown() {
		unset($this->people);
	}

	public function test_short_name() {
		$pairs = [
			'Mehdi Lahmam B.' => 'Mehdi L.',
			'Kévin Chavanne' => 'Kévin C.',
			'HELENE SOMMET' => 'Helene S.',
			'John E. Gray' => 'John E.'
		];

		foreach ($pairs as $name => $expected) {
			$this->assertEqual($expected, $this->people->short_name($name));
		}
	}
}

?>