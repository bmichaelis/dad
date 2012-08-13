<?php

namespace dad\extensions\helper;

class Person extends \lithium\template\Helper {

	public function short_name($name) {
		$name = ucwords(strtolower($name));
		list($fname, $lname) = explode(' ', $name, 2);

		return $fname . ' ' . substr($lname , 0, 1) . '.';
	}
}

?>