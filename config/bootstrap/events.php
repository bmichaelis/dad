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
	'saved_discussion' => '{:actor.name} {:verb} a {:object.type}: {:object.name}.',
	'saved_message' => '{:actor.name} {:verb} a message on: {:target.name}',
	'saved_project' => '{:actor.name} {:verb} a {:object.type}: {:object.name}.'
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

	Activity::track('saved_discussion', $data);
	return $result;
});

/**
 * Tracks posted Messages on Disucssions
 */
Filters::apply('dad\models\Discussions', 'push_message', function($self, $params, $chain) {
	$data = [
		'actor'   => [
			'type' => 'person',
			'name' => $params['message_data']['creator']['name'],
			'id'   => $params['message_data']['creator']['id']
		],
		'verb'    => 'posted',
		'object'  => [
			'type' => 'message'
		],
		'target' => [
			'type' => 'discussion',
			'name' => $params['discussion']->subject,
			'id'   => (string) $params['discussion']->_id
		]
	];

	if (!$result = $chain->next($self, $params, $chain)) {
		return false;
	}
	$data['object']['id'] = $params['message_data']['id'];

	Activity::track('saved_message', $data);
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

		Activity::track('saved_project', $data);
		return $result;
	}

	return $chain->next($self, $params, $chain);
});

?>