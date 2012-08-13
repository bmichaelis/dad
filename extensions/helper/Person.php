<?php

namespace dad\extensions\helper;

class Person extends \lithium\template\Helper {

	public function short_name($name) {
		$name = ucwords(strtolower($name));

		list($fname, $lname) = explode(' ', $name, 2);
		$short_name = $fname . ' ' . substr($lname , 0, 1) . '.';

		return (mb_strlen($short_name, 'utf-8') > 9) ? mb_substr($short_name, 0, 9, 'utf-8') . '...' : $short_name;
	}
}

?>