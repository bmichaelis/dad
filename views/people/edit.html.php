<h3>Edit <?= $person->name ?></h3>

<?= $this->form->create($person, array('url' => '/people/' . $person->_id)) ?>
	<?= $this->form->field('name') ?>
	<?= $this->form->field('email_address') ?>
	<?= $this->form->submit('Submit') ?>
<?= $this->form->end() ?>

