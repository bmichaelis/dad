<h3>Create a new project</h3>

<?= $this->form->create($project, array('url' => '/projects')) ?>
	<?= $this->form->field('name') ?>
	<?= $this->form->field('description') ?>
	<?= $this->form->submit('Submit') ?>
<?= $this->form->end() ?>