<?php

namespace dad\extensions\command;

use Faker\Factory;
use li3_faker\extensions\adapter\ORM\Lithium\Populator;

use lithium\core\Libraries;
use lithium\security\Password;
use lithium\util\String;

class Db extends \lithium\console\Command {

	/**
	 * Populate the database with fake random data
	 */
	public function populate() {
		$generator = Factory::create('fr_FR');

		//people
		$populator = new Populator($generator);
		$populator->addEntity('People', 12, array(
			'name' => function() use ($generator) { return $generator->name(); },
			'email_address' => function() use ($generator) { return $generator->email(); },
			'avatar_url' => function() use($generator) { return 'http://placehold.it/80x80'; },
			'password' => function() use($generator) { return Password::hash($generator->word()); },
		));

		$people_ids = $populator->execute();

		//projects
		$populator = new Populator($generator);
		$populator->addEntity('Projects', 80, array(
			'name' => function() use ($generator) { return $generator->sentence(3); },
			'description' => function() use ($generator) { return $generator->sentence(10); },
			'archived' => function() use ($generator) { return $generator->boolean(10); },
			'creator.id' => function() use ($people_ids) { return (string) $people_ids['People'][array_rand($people_ids['People'])]; },
			'creator.name' => function() use ($generator) { return $generator->name(); },
		));

		$projects_ids = $populator->execute();

		//discussions and messages
		$populator = new Populator($generator);
		$populator->addEntity('Discussions', 840, array(
			'project_id' => function() use ($projects_ids) {
				return (string) $projects_ids['Projects'][array_rand($projects_ids['Projects'])];
			},
			'subject' => function() use ($generator) { return $generator->sentence(10); },
			'content' => function() use ($generator) { return join('<br />', $generator->paragraphs(rand(1, 4))); },
			'creator.id' => function() use ($people_ids) { return (string) $people_ids['People'][array_rand($people_ids['People'])]; },
			'creator.name' => function() use ($generator) { return $generator->name(); },
			'messages' => function() use($generator, $people_ids) {
				$messages = [];

				$loops = $generator->randomNumber(2);
				for ($i = 0; $i < $loops; $i++) {
					$messages[$i] = [
						'id' => String::uuid(),
						'content' => join('<br />', $generator->sentences(rand(1, 3))),
						'creator' => [
							'id' => (string) $people_ids['People'][array_rand($people_ids['People'])],
							'name' => $generator->name()
						],
						'created_at' => new \MongoDate(),
						'updated_at' => new \MongoDate()
					];
				}

				return $messages;
			}
		));

		$discussions_ids = $populator->execute();
	}

	/**
	 * Reset the database by removing all models documents.
	 */
	public function reset() {
		$models = Libraries::locate('models');
		foreach ($models as $model) {
			$model::remove();
		}
	}
}

?>