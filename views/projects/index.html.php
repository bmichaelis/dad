<div class="twelve columns">
	<h3>Projects</h3>

	<ul id="projects">
		<?php foreach ($projects as $project) : ?>
		<li><?= $this->html->link($project->name, ['Projects::show', 'id' => $project->_id]) ?></li>
		<?php endforeach; ?>
	</ul>

	<?= $this->html->link('Add a project', ['Projects::add', 'http:method' => 'GET']) ?>
</div>