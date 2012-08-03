<h3> <?= $project->name ?> discussions</h3>

<?php
	if (!count($discussions)) {
		echo 'Blankslate placeholder';
	}
?>

<ul id="discussions">
	<?php foreach ($discussions as $discussion) : ?>
	<li><?= $this->html->link($discussion->subject, ['Discussions::show', 'project_id' => $project->_id, 'id' => $discussion->_id]) ?></li>
	<?php endforeach; ?>
</ul>