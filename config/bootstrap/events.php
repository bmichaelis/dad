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
Activity::events([
	'saved' => '{:actor.name} {:verb} a {:object.type}: {:object.name}.'
]);

/**
 * Here we filter our-self into the whole application to
 * track Activity on whatever interests us.
 *
 * @see lithium\core\StaticObject::applyFilter()
 * @see li3_activities\core\Activity
 */

use lithium\util\collection\Filters;

/**
 * Tracks Discussions events
 */
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
			'type' => 'discussion',
			'name' => $discussion->subject
		],
		'target' => [
			'type' => 'project',
			'name' => $discussion->project()->name,
			'id'   => (string) $discussion->project()->_id
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
 * Tracks Projects creation event
 */
Filters::apply('dad\models\Projects', 'save', function($self, $params, $chain) {
	$project = &$params['entity'];

	if (!$project->exists()) {
		$data = [
			'actor'   => [
				'type' => 'person',
				'name' => $project->creator->name,
				'id'   => $project->creator->id
			],
			'verb'    => 'created',
			'object'  => [
				'type' => 'project',
				'name' => $project->name
			]
		];
		if (!$result = $chain->next($self, $params, $chain)) {
			return false;
		}
		$data['object']['id'] = (string) $project->{$project->key()};
		Activity::track('saved', $data);
		return $result;
	}

	return $chain->next($self, $params, $chain);
});

?>