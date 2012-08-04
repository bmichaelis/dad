<h3>Add a new person</h3>

<?= $this->form->create($person, array('url' => '/people')) ?>
	<?= $this->form->field('name') ?>
	<?= $this->form->field('email_address') ?>
	<?= $this->form->submit('Submit') ?>
<?= $this->form->end() ?>
