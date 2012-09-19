<?php

use li3_activities\core\Activity;

/**
 * Events should be configured, in order to parse a message
 * for a given type. It can contain placeholders and given
 * data will be used to replace those. Make sure, you
 * always put in the data you need in order to generate
 * the messages, you may want (even later on).
 * Also, have a look at String::insert() to see, how
 * placeholders work.
 *
 * @see li3_activities\core\Activity::events()
 * @see li3_activities\core\Activity
 * @see lithium\util\String::insert()
 */
Activity::events(array(
	'saved' => '{:actor.name} {:verb} a {:object.type}.',
	// 'action' => '{:controller}::{:action} called',
));

/**
 * Here we filter our-self into the whole application to
 * track Activity on whatever interests us.
 *
 * @see lithium\core\StaticObject::applyFilter()
 * @see li3_activities\core\Activity
 */

/**
 * Write an Activity for any Model::save().
 */
use lithium\util\collection\Filters;

Filters::apply('dad\models\Discussions', 'save', function($self, $params, $chain) {
	$discussion = &$params['entity'];
	$data = [
		'actor'   => [
			'type' => 'person',
			'name' => $discussion->creator->name,
			'id'   => $discussion->creator->id
		],
		'verb'    => ($discussion->exists()) ? 'updated' : 'posted',
		'object'  => [
			'type' => 'discussion'
		]
	];
	if (!$result = $chain->next($self, $params, $chain)) {
		return false;
	}
	$data['object']['id'] = (string) $discussion->{$discussion->key()};
	Activity::track('saved', $data);
	return $result;
});

/**
 * Track all calls to Dispatcher and log Activity about called Controller::action.
 */
// lithium\action\Dispatcher::applyFilter('run', function($self, $params, $chain) {
// 	$result = $chain->next($self, $params, $chain);
// 	Activity::action($params['request']->params);
// 	return $result;
// });

?>