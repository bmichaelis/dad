<section class="project-settings">
	<div class="row project-settings-link">
		<div class="twelve columns">
			<i class="icon-settings"></i> <?= $this->html->link('Project settings', '#', ['escape' => false]) ?>
		</div>
	</div>
	<div id="project-settings" class="row" style="display:none;">
		<div class="ten columns">
			<h5>Project settings</h5>
			<?= $this->form->create($project, ['url' => $this->resource->path($project)]) ?>
			<label>
				<?= $this->form->radio('archived', ['value' => 0]) ?>
				<b>Active</b> — Fully functional project
			</label>
			<label>
				<?= $this->form->radio('archived') ?>
				<b>Archived</b> — This project is locked and can't be changed
			</label>
			<?= $this->form->submit('Save changes') ?> or <a href="#" data-behavior="cancel">Cancel</a>
			<?= $this->form->end() ?>
		</div>
		<div class="two columns">
			<?= $this->html->link(
					'Delete this project',
					$this->resource->path($project),
					['data-method' => 'delete', 'data-confirm' => 'Are you sure you want to completely delete this entire project?']
				)
			?>
		</div>
	</div>
</section>

<?php ob_start(); ?>
<script>
$('.project-settings')
	.on('click', '.project-settings-link', function(){
		$('#project-settings').show();
		$(this).hide();
		return false;
	})
	.on('click', '[data-behavior=cancel]', function(){
		$('#project-settings').hide();
		$('.project-settings-link').show();
		return false;
	});
</script>
<?php $this->scripts(ob_get_clean()); ?>
