<article class="message row">
	<div class="one column creator-avatar">
		<?= $this->html->image('http://placehold.it/80x80') ?>
	</div>
	<div class="eight columns end formatted-content">
		<strong><?= $message->creator->name ?></strong> –
		<?php echo $message->content; ?>
	</div>
</article>