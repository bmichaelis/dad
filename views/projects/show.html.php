<div class="twelve columns project">
	<header>
		<h3><?= $this->title($project->name) ?></h3>
		<p><?= $project->description ?></p>
	</header>

	<div id="discussions-list">
		<h5>
			Discussions
			<?= $this->html->link(
				'Start a discussion',
				['Discussions::add', 'project_id' => $project->_id],
				['class' => 'button tiny radius']
			) ?>
		</h5>
		<ul>
			<?php foreach ($discussions as $discussion) : ?>
			<li class="row">
				<?= $this->element->render('discussion_item', ['discussion' => $discussion], ['controller' => 'discussions']) ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>