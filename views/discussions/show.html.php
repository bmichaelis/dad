<div class="twelve columns discussion">
<article>
	<header>
		<h3><?= $discussion->subject ?></h3>
		<div>
			Posted by <?= $discussion->creator->name ?> <time datetime="<?= date('c', $discussion->created_at->sec) ?>">on <?= date('M j', $discussion->created_at->sec) ?></time>
			<?php if ($discussion->creator->id == $current_user->_id) : ?>
			<nav>
				<?= $this->html->link('Edit', $this->discussion->edit_path($discussion, $project)) ?> |
				<?= $this->html->link(
						'Delete',
						$this->discussion->path($discussion, $project),
						['data-method' => 'delete', 'data-confirm' => 'Delete this message ?']
					)
				?>
			</nav>
			<?php endif; ?>
		</div>
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

		<?php
		use \lithium\net\http\Router;
		$new_message_path = Router::match([
			'Messages::create',
			'project_id' => $project->_id, 'discussion_id' => $discussion->_id
			]);

		echo $this->element->render('add_message', compact('new_message_path'));
		?>

	</footer>
</article>
</div>