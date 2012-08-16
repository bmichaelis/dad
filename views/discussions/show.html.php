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
			<?php
				foreach ($discussion->messages as $message) {
					echo $this->element->render('message_item', compact('message'));
				}
			?>
		</section>

		<?php echo $this->element->render('add_message', compact('new_message_path')); ?>

	</footer>
</article>
</div>