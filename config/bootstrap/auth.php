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
	$controller = $chain->next($self, $params, $chain);
	$action  = $params['params']['action'];
	$request = isset($params['request']) ? $params['request'] : null;

	if (Auth::check('default')) {
		return $controller;
	}

	if ($request->params['controller'] == 'Sessions' && in_array($action, ['add', 'create'])) {
		return $controller;
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