<h3><?= $person->exists() ? 'Edit ' . $person->name : 'Add a new person' ?></h3>

<?= $this->form->create($person, ['url' => $this->resource->path($person)]) ?>
	<?= $this->form->field('name') ?>
	<?= $this->form->field('email_address') ?>
	<?= $this->form->field('password', ['type' => 'password']) ?>
	<br />
	<?= $this->form->field('gravatar_email') ?>
	<?php $title = $person->exists() ? 'Save your changes' : 'Add me baby!' ?>
	<?= $this->form->submit($title, ['class' => 'button small radius']) ?>
<?= $this->form->end() ?>