<?php
use \lithium\net\http\Router;
$new_message_path = Router::match([
	'Messages::create',
	'project_id' => $project->_id, 'discussion_id' => $discussion->_id
	]);
?>

<article>
	<header>
		<h3><?= $discussion->subject ?></h3>
		<p>Posted by Mehdi <time data-time-ago="" datetime="2012-06-16T22:31:51Z" style="">on Jun 17</time></p>
	</header>

	<div>
		<?= $discussion->content ?>
	</div>

	<footer>
		<section id="messages">
			<h4>Discuss this message</h4>
			<?php foreach ($discussion->messages as $message) : ?>
			<article class="message">
				<div><?= $message->content ?></div>
			</article>
			<?php endforeach; ?>
		</section>

		<section>
			<?= $this->form->create(null, array('url' => $new_message_path)) ?>
				<?= $this->form->field('content', ['type' => 'textarea', 'rows' => 2]) ?>
				<?= $this->form->submit('Add this comment') ?>
			<?= $this->form->end() ?>
		</section>
	</footer>
</article>