<h3><?= $project->exists() ? 'Edit ' . $project->name : 'Start a new project' ?></h3>

<?= $this->form->create($project, array('url' => $this->resource->path($project))) ?>
	<?= $this->form->field('name', ['label' => 'Name the project']) ?>
	<?= $this->form->field('description', ['label' => 'Add a description or extra details (optional)']) ?>
	<?php $title = $project->exists() ? 'Save your changes' : 'Add me baby!' ?>
	<?= $this->form->submit($title, ['class' => 'button small radius']) ?>
<?= $this->form->end() ?>