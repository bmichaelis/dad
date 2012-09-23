<div class="twelve columns">
	<header>
		<h3>Recent activity across all the projects</h3>
	</header>

	<?php
		if (!count($activities)) {
			echo 'Blankslate placeholder';
		}
	?>

	<div id="activities-list">
		<ul class="no-bullet">
			<?php foreach ($activities as $activity) : ?>
			<li>
				<b><?= $this->time->to('short', $activity->created_at->sec) ?></b>, <?= $activity->message ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>