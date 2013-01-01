<div class="two columns projects-nav">
	<?= $this->html->link(
		'<i class="icon-plus"></i> New Project',
		['Projects::add', 'http:method' => 'GET'],
		['class' => 'button small radius', 'escape' => false]
	) ?>
</div>

<section class="ten columns">
	<ul class="block-grid three-up">
		<?php
		foreach ($projects as $project) {
			echo $this->element->render('project_item', ['project' => $project]);
		}
		?>
	</ul>
</section>