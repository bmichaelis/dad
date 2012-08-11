<div class="twelve columns project">
	<header>
		<h3><?= $this->title($project->name) ?></h3>
		<p><?= $project->description ?></p>
	</header>

	<div id="discussions-list">
		<h5>
			Discussions
			<?= $this->html->link(
				'Start a discussion',
				['Discussions::add', 'project_id' => $project->_id],
				['class' => 'button tiny radius']
			) ?>
		</h5>
		<ul>
			<?php foreach ($discussions as $discussion) : ?>
			<li class="row">
				<div class="two column creator">
					<p>
						<span class="creator-avatar">
							<?= $this->html->image('https://secure.gravatar.com/avatar/fea5bc8aeb5d806a817a27a000e91053?s=140&d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png') ?>
						</span>
						<?= $this->people->short_name($discussion->creator->name) ?>
					</p>
				</div>
				<div class="nine columns">
					<p><?= $this->html->link($discussion->subject, ['Discussions::show', 'id' => $discussion->_id, 'project_id' => $project->_id]) ?></p>
				</div>
				<div class="one columns">
					<p><span class="round secondary label"><?= $discussion->messages->count() ?></span></p>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>