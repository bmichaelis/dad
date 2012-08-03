<header>
	<h3><?= $this->title($project->name) ?></h3>
	<p><?= $project->description ?></p>
</header>

<?= $this->html->link('Start a discussion', ['Discussions::add', 'project_id' => $project->_id]) ?>

<h4>Discussions</h4>
<ul id="discussions">
	<?php foreach ($discussions as $discussion) : ?>
	<li>
		<p><?= $this->html->link($discussion->subject, ['Discussions::show', 'id' => $discussion->_id, 'project_id' => $project->_id]) ?></p>
	</li>
	<?php endforeach; ?>
</ul>