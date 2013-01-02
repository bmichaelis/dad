<article class="message row">
	<div class="one column creator-avatar">
			<?= $this->gravatar->image($message->creator()->gravatar_email, [
				'default' => '/img/john_doe_avatar.png',
				'size' => 80
			]) ?>
	</div>
	<div class="eight columns end formatted-content data-embeddable">
		<strong><?= $message->creator->name ?></strong> –
		<?php echo $message->content; ?>
		<footer>
			<p class="updated_at"><?= $this->message->updated_at($message) ?></p>
		<footer>
	</div>
</article>