<section class="row message new">
		<div class="one column creator-avatar">
			<?= $this->html->image('http://placehold.it/80x80') ?>
		</div>
		<div class="eight columns end">
			<?= $this->element->render('wysihtml5-toolbar'); ?>
			<?= $this->form->create(null, ['url' => $new_message_path]) ?>
				<?= $this->form->textarea('content', [
					'id' => 'wysihtml5-textarea',
					'rows' => 2,
					'placeholder' => 'Add a massage...'])
				?>
				<?= $this->form->submit('Add this message', ['class' => 'button small radius']) ?>
			<?= $this->form->end() ?>
		</div>
</section>