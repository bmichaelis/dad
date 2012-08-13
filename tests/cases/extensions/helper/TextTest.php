<?php

namespace dad\tests\cases\extensions\helper;

use dad\extensions\helper\Text;
use lithium\tests\mocks\template\helper\MockHtmlRenderer;

class TextTest extends \lithium\test\Unit {

	public function setUp() {
		$this->text = new Text(array('context' => new MockHtmlRenderer()));
	}

	public function tearDown() {
		unset($this->text);
	}

	public function test_pluralize() {
		$this->assertEqual('0 discussions', $this->text->pluralize(0, 'discussion'));
		$this->assertEqual('1 discussion', $this->text->pluralize(1, 'discussion'));
		$this->assertEqual('2 discussions', $this->text->pluralize(2, 'discussion'));
		$this->assertEqual('0 people', $this->text->pluralize(0, 'person'));
		$this->assertEqual('0 bar', $this->text->pluralize(0, 'foo', 'bar'));
		$this->assertEqual('1 foo', $this->text->pluralize(1, 'foo', 'bar'));
	}
}

?>
