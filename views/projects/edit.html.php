<h3>Edit <?= $project->name ?></h3>

<?= $this->form->create($project, array('url' => '/projects/' . $project->_id)) ?>
	<?= $this->form->field('name') ?>
	<?= $this->form->field('description') ?>
	<?= $this->form->submit('Submit') ?>
<?= $this->form->end() ?>
