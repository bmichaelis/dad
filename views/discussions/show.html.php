<?php
use \lithium\net\http\Router;
$new_message_path = Router::match([
	'Messages::create',
	'project_id' => $project->_id, 'discussion_id' => $discussion->_id
	]);
?>

<div class="twelve columns discussion">
<article>
	<header>
		<h3><?= $discussion->subject ?></h3>
		<p>Posted by <?= $discussion->creator->name ?> <time datetime="<?= date('c', $discussion->created_at->sec) ?>" style="">on <?= date('M j', $discussion->created_at->sec) ?></time></p>
	</header>

	<div class="row">
		<div class="one column creator-avatar">
			<?= $this->html->image('http://placehold.it/80x80') ?>
		</div>
		<div class="eight columns end formatted-content">
			<?php echo $discussion->content; ?>
		</div>
		<hr />
	</div>

	<footer>
		<section id="messages">
			<h4>Discuss this message</h4>
			<?php foreach ($discussion->messages as $message) : ?>
			<article class="message row">
				<div class="one column creator-avatar">
					<?= $this->html->image('http://placehold.it/80x80') ?>
				</div>
				<div class="eight columns end formatted-content">
					<strong><?= $message->creator->name ?></strong> –
					<?php echo $message->content; ?>
				</div>
			</article>
			<?php endforeach; ?>
		</section>

		<section class="row message new">
				<div class="one column creator-avatar">
					<?= $this->html->image('http://placehold.it/80x80') ?>
				</div>
				<div class="eight columns end">
					<?= $this->element->render('wysihtml5-toolbar'); ?>
					<?= $this->form->create(null, ['url' => $new_message_path]) ?>
						<?= $this->form->textarea('content', [
							'id' => 'wysihtml5-textarea',
							'rows' => 2,
							'placeholder' => 'Add a massage...'])
						?>
						<?= $this->form->submit('Add this message', ['class' => 'button small radius']) ?>
					<?= $this->form->end() ?>
				</div>
		</section>
	</footer>
</article>
</div>