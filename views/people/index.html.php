<h3>People</h3>

<ul id="people">
	<?php foreach ($people as $person) : ?>
	<li><?= $person->name ?></li>
	<?php endforeach; ?>
</ul>

<?= $this->html->link('Add a person', ['People::add', 'http:method' => 'GET']) ?>