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
			'application.css'
		]);

		echo $this->html->script([
			'modernizr-2.6.1.min.js'
		]);
	?>

	<script type="text/javascript" src="//use.typekit.net/bhz8fbs.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<script type="text/javascript" src="http://anywhere.embed.ly/scripts/17fc899bb78d4b6092c6daa3bac13c67.js?t=1349889153"></script>
</head>
<body class="app">

	<div class="contain-to-grid">
		<nav class="top-bar">
			<ul>
				<li class="name"><h1><a href="/">DAD</a></h1></li>
				<li class="tagline">// day after day</li>
			</ul>
			<section>
				<ul class="right">
					<?php if ($current_user): ?>
					<li class="divider"></li>
					<li class="has-dropdown">
					<a href="#">
						<?= $this->gravatar->image($current_user->gravatar_email, [
							'default' => '/img/john_doe_avatar.png',
							'size' => 30,
							'class' => 'avatar'
						]) ?>
					</a>
					<ul class="dropdown">
					<li><?= $this->html->link('Profile', ['People::edit', 'id' => $current_user->_id]) ?></li>
						<li class="divider"></li>
						<li><a href="/signout">Sign out</a></li>
					</ul>
					</li>
					<?php endif; ?>
				</ul>
			</section>
		</nav>
	</div>

	<?= $this->flashMessage->show(); ?>

	<div id="container" class="row">
		<?php echo $this->content(); ?>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.8.0.min.js"><\/script>')</script>

	<?php
		echo $this->html->script([
			'jquery.foundation.alerts.js',
			'jquery.foundation.buttons.js',
			'jquery.foundation.navigation.js',
			'jquery.foundation.topbar.js',
			'jquery.foundation.forms.js',
			'jquery.foundation.tooltips.js',
			'wysihtml5-parser-rules.js',
			'wysihtml5-0.3.0.min.js',
			'application-ujs.js',
			'app.js'
		]);

		echo $this->scripts();
	?>

	<script>
	var editor = new wysihtml5.Editor("wysihtml5-textarea", {
	  toolbar:      "wysihtml5-toolbar",
	  parserRules:  wysihtml5ParserRules
	});
	</script>

</body>
</html>