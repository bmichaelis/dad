<div class="two column creator">
	<p>
		<span class="creator-avatar">
			<?= $this->gravatar->image($discussion->creator()->gravatar_email, [
				'default' => '/img/john_doe_avatar.png',
				'size' => 140
			]) ?>
		</span>
		<?= $this->person->short_name($discussion->creator()->name) ?>
	</p>
</div>
<div class="eight columns">
	<p><?= $this->html->link($discussion->subject, ['Discussions::show', 'id' => $discussion->_id, 'project_id' => $project->_id]) ?></p>
</div>
<div class="one column">
<p><span class="round label updated_at"><time datetime="<?= date('c', $discussion->updated_at->sec) ?>"><?= date('M d', $discussion->updated_at->sec) ?></time></span></p>
</div>
<div class="one columns">
	<p><span class="round secondary label"><?= $discussion->messages->count() ?></span></p>
</div>