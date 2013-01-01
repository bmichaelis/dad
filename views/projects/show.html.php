<section id="project-show" class="twelve columns">
	<header>
		<h3><?= $this->title($project->name) ?></h3>
		<p><?= $project->description ?></p>
	</header>

	<section id="discussions-list">
		<h5>
			Discussions
			<?= $this->html->link(
				'Start a discussion',
				['Discussions::add', 'project_id' => $project->_id],
				['class' => 'button tiny radius']
			) ?>
		</h5>
		<ul class="no-bullet">
			<?php
			foreach ($discussions as $discussion) {
				echo $this->element->render('discussion_item', ['discussion' => $discussion], ['controller' => 'discussions']);
			}
			?>
		</ul>
	</section>

	<hr />
	<?= $this->element->render('project_settings') ?>
</section>