<h3>Add a new discussion</h3>

<?php
use \lithium\net\http\Router;
$new_discussion_path = Router::match(['Discussions::create', 'project_id' => $project->_id]);
?>

<?= $this->form->create($discussion, array('url' => $new_discussion_path)) ?>
	<?= $this->form->field('subject') ?>
	<?= $this->form->field('content', ['type' => 'textarea', 'rows' => 15]) ?>
	<?= $this->form->submit('Submit') ?>
<?= $this->form->end() ?>