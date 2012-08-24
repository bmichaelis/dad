<?php

namespace dad\tests\cases\extensions\helper;

use dad\extensions\helper\Message;
use lithium\tests\mocks\template\helper\MockHtmlRenderer;
use dad\tests\factories\Messages;

class MessageTest extends \lithium\test\Unit {

	public $message = null;

	public function setUp() {
		$this->message = new Message(array('context' => new MockHtmlRenderer()));
	}

	public function testUpdatedAt() {
		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('-22 hours')),
			'updated_at' => new \MongoDate(strtotime('-21 hours -45 minutes'))
		]);
		$result = $this->message->updated_at($message);
		$this->assertEqual('Posted 22 hours ago, updated 15 minutes later', $result);

		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('-22 hours')),
			'updated_at' => new \MongoDate(strtotime('-22 hours'))
		]);
		$result = $this->message->updated_at($message);
		$this->assertEqual('Posted 22 hours ago', $result);

		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('-3 days -1 hour')),
			'updated_at' => new \MongoDate(strtotime('-3 days -45 minutes'))
		]);
		$result = $this->message->updated_at($message);
		$expected  = 'Posted 3 days ago, updated 15 minutes later';
		$this->assertEqual($expected, $result);

		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('-3 days')),
			'updated_at' => new \MongoDate(strtotime('-3 days -1 hour -30 minutes -2 seconds'))
		]);
		$result = $this->message->updated_at($message);
		$expected  = 'Posted on ' . date('M d', strtotime('-3 day'));
		$expected .= ', updated 15 minutes later';
		$this->assertEqual($expected, $result);
	}
}

?>