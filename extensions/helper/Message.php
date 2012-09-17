<?php

namespace dad\extensions\helper;

use li3_time_helper\extensions\helper\Time;
use lithium\util\String;

class Message extends \lithium\template\Helper {

	protected $_strings = [
		'created_at' => 'Posted {:created_at}',
		'updated_at' => 'Posted {:created_at}, updated {:updated_at} later'
	];

	public function updated_at($message, array $options = []) {
		$time = $this->_context->time;

		$created_at = $time->to('words', $message->created_at->sec, ['end' => '+2 days', 'format' => 'M d']);
		$updated_at = $time->to('words', date('Y-m-d H:i', $message->updated_at->sec), ['now' => date('Y-m-d H:i', $message->created_at->sec)]);

		if (!$updated_at) {
			return String::insert($this->_strings['created_at'], compact('created_at'));
		}

		return String::insert($this->_strings['updated_at'], compact('created_at', 'updated_at'));

	}
}

?>