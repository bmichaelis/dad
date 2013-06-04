<?php

namespace dad\tests\cases\extensions\helper;

use dad\extensions\helper\Message;
use lithium\tests\mocks\template\MockRenderer;
use dad\tests\factories\Messages;

class MessageTest extends \lithium\test\Unit {

	public $message = null;

	public function setUp() {
		$this->message = new Message(array('context' => new MockRenderer()));
	}

	public function testUpdatedAt() {
		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('-22 hours')),
			'updated_at' => new \MongoDate(strtotime('-21 hours -45 minutes'))
		]);
		$result = $this->message->updated_at($message);
		$this->assertEqual('Posted 22 hours ago, updated 15 minutes later', $result);

		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('2012-09-02 17:52')),
			'updated_at' => new \MongoDate(strtotime('2012-09-02 17:58'))
		]);
		$result = $this->message->updated_at($message);
		$expected = 'Posted on Sep 02, updated 6 minutes later';
		$this->assertEqual($expected, $result);

		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('-22 hours')),
			'updated_at' => new \MongoDate(strtotime('-22 hours'))
		]);
		$result = $this->message->updated_at($message);
		$this->assertEqual('Posted 22 hours ago', $result);

		$message = Messages::create([
			'created_at' => new \MongoDate(strtotime('2012-09-02 17:52:00')),
			'updated_at' => new \MongoDate(strtotime('2012-09-02 17:58:33'))
		]);
		$result = $this->message->updated_at($message);
		$expected  = 'Posted on ' . date('M d', strtotime('2012-09-02'));
		$expected .= ', updated 6 minutes later';
		$this->assertEqual($expected, $result);
	}
}

?>