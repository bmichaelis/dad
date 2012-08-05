<?php

use lithium\storage\Session;

Session::config(array(
	// 'cookie' => array('adapter' => 'Cookie', 'name' => $name),
	'default' => array('adapter' => 'Php', 'session.name' => 'dad')
));

?>