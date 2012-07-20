<?php

use lithium\data\Connections;

Connections::add('default', array(
	'test' => array(
		'type' => 'MongoDb',
		'host' => '127.0.0.1',
		'database' => 'dad_test'
	),
	'development' => array(
		'type' => 'MongoDb',
		'host' => '127.0.0.1',
		'database' => 'dad'
	),
	'production' => array(
		'type' => 'MongoDb',
		'host' => '127.0.0.1',
		'database' => 'dad'
	)
));

?>