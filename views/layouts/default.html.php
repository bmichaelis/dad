<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>DAD &gt; <?php echo $this->title(); ?></title>
	<meta name="viewport" content="width=device-width">

	<?php
		echo $this->html->style([
			'debug.css',
			'app.css'
		]);

		echo $this->html->script([
			'modernizr-2.6.1.min.js'
		]);
	?>

	<script type="text/javascript" src="//use.typekit.net/bhz8fbs.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body class="app">
	<div class="row">
		<div class="twelve columns">
		<h3><?= $this->html->link('DAD', '/') ?></h3>
			<hr />
		</div>
	</div>

	<div class="row">
		<?= $this->flashMessage->output(); ?>
	</div>

	<div class="row">
		<?php echo $this->content(); ?>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.8.0.min.js"><\/script>')</script>

	<?php
		echo $this->html->script([
			'jquery.foundation.alerts.js',
			'jquery.foundation.buttons.js',
			'jquery.foundation.navigation.js',
			'jquery.foundation.forms.js',
			'jquery.foundation.tabs.js',
			'jquery.foundation.tooltips.js',
			'wysihtml5-parser-rules.js',
			'wysihtml5-0.3.0.min.js',
			'application-ujs.js',
			'app.js'
		]);
	?>

	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

</body>
</html>