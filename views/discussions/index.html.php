<section class="twelve columns project">
	<header>
		<h3><?= $this->title($project->name . ' discussions') ?></h3>
		<p><?= $project->description ?></p>
	</header>

	<?php
		if (!count($discussions)) {
			echo 'Blankslate placeholder';
		}
	?>

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
				echo $this->element->render('discussion_item', ['discussion' => $discussion]);
			}
			?>
		</ul>
	</section>
</section>