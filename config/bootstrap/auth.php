<?php

use lithium\security\Auth;
use lithium\security\Password;
use lithium\action\Dispatcher;
use lithium\action\Response;
use lithium\util\collection\Filters;

Auth::config(array(
	'default' => array(
		'adapter' => 'Form',
		'model' => 'People',
		'fields' => array('email_address', 'password')
	)
));


Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
	$chain = $chain->next($self, $params, $chain);

	$request = isset($params['request']) ? $params['request'] : null;
	$controller  = $params['params']['controller'];
	$action  = $params['params']['action'];

	if (Auth::check('default')) {
		return $chain;
	}

	$public = in_array($controller, ['People', 'Sessions']) && in_array($action, ['add', 'create']);
	if ($public) {
		return $chain;
	}

	return function() use($request) {
		return new Response(compact('request') + ['location' => 'Sessions::add']);
	};
});


Filters::apply('dad\models\People', 'save', function($self, $params, $chain){
	$entity = $params['entity'];

	if (!empty($params['data'])) {
		$entity->set($params['data']);
	}

	if (!$entity->exists()) {
		$entity->password = Password::hash($entity->password);
	}

	$params['entity'] = $entity;

	return $chain->next($self, $params, $chain);
});

?>