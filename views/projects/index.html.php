<div class="two columns projects-nav">
	<?= $this->html->link(
		'+ New Project',
		['Projects::add', 'http:method' => 'GET'],
		['class' => 'button small']
	) ?>
</div>

<div class="ten columns">
	<ul id="projects-list">
		<?php foreach ($projects as $project) : ?>
		<li>
			<article class="project">
				<header class="project-header">
					<h4 class="project-title">
						<?= $this->html->link($project->name, ['Projects::show', 'id' => $project->_id]) ?>
					</h4>
					<p><?= $project->description ?></p>
					<p>8 discussions</p>
				</header>
			</article>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
