<h3><?= $discussion->exists() ? 'Edit this discussion' : 'Start a new discussion' ?></h3>

<?= $this->form->create($discussion, array('url' => $this->discussion->path($discussion, $project))) ?>
	<?= $this->form->field('subject') ?>
	<?= $this->element->render('wysihtml5-toolbar'); ?>
	<?= $this->form->field('content', [
		'id' => 'wysihtml5-textarea',
		'type' => 'textarea',
		'rows' => 15])
	?>
	<?php $title = $discussion->exists() ? 'Update this message' : 'Add this message' ?>
	<?= $this->form->submit($title, ['class' => 'button small radius']) ?>
<?= $this->form->end() ?>