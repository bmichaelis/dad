<div class="two column creator">
	<p>
		<span class="creator-avatar">
			<?= $this->html->image('http://placehold.it/80x80') ?>
		</span>
		<?= $this->people->short_name($discussion->creator->name) ?>
	</p>
</div>
<div class="nine columns">
	<p><?= $this->html->link($discussion->subject, ['Discussions::show', 'id' => $discussion->_id, 'project_id' => $project->_id]) ?></p>
</div>
<div class="one columns">
	<p><span class="round secondary label"><?= $discussion->messages->count() ?></span></p>
</div>