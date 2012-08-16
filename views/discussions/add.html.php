<div class="eight columns">
	<h3>Add a new discussion</h3>

	<?php
	use \lithium\net\http\Router;
	$new_discussion_path = Router::match(['Discussions::create', 'project_id' => $project->_id]);
	?>

	<?= $this->form->create($discussion, array('url' => $new_discussion_path)) ?>
		<?= $this->form->field('subject') ?>

		<?= $this->element->render('wysihtml5-toolbar'); ?>
		<?= $this->form->field('content', [
			'id' => 'wysihtml5-textarea',
			'type' => 'textarea',
			'rows' => 15])
		?>

		<?= $this->form->submit('Add this discussion', ['class' => 'button small radius']) ?>
	<?= $this->form->end() ?>
</div>