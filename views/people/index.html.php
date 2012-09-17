<div class="two columns people-nav">
	<?= $this->html->link(
		'Add a person',
		['People::add', 'http:method' => 'GET'],
		['class' => 'button small radius']
	) ?>
</div>

<div class="ten columns">
	<ul id="people-list" class="block-grid four-up">
		<?php foreach ($people as $person) : ?>
		<li>
			<?= $this->gravatar->image($person->gravatar_email, [
				'default' => '/img/john_doe_avatar.png',
				'size' => 140
			]) ?>
			<h6><?= $person->name ?></h6>
		</li>
		<?php endforeach; ?>
	</ul>
</div>