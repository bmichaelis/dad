<li class="project-item">
	<article class="panel">
		<header class="project-header">
			<h5 class="project-title ellipsis">
				<?= $this->html->link($project->name, ['Projects::show', 'id' => $project->_id]) ?>
				<?php if ($project->archived): ?>
					<span class="label">ARCHIVED</span>
				<?php endif; ?>
			</h5>
			<p><?= $project->description ?></p>
			<p><?= $this->text->pluralize($project->count_discussions(), 'discussion') ?></p>
		</header>
	</article>
</li>
