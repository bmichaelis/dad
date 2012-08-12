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
			<?= $this->html->image('http://placehold.it/140x140') ?>
			<h6><?= $person->name ?></h6>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
