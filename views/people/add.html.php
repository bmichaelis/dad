<h3>Add a new person</h3>

<?= $this->form->create($person, ['url' => '/people']) ?>
	<?= $this->form->field('name') ?>
	<?= $this->form->field('email_address') ?>
	<?= $this->form->field('password', ['type' => 'password']) ?>
	<?= $this->form->submit('Submit') ?>
<?= $this->form->end() ?>