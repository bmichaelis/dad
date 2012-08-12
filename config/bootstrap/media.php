<?php

use lithium\util\Collection;
Collection::formats('lithium\net\http\Media');

use lithium\net\http\Media;
Media::type('default', null, array(
	'view' => 'lithium\template\View',
	'paths' => array(
		'layout' => '{:library}/views/layouts/{:layout}.{:type}.php',
		'template' => '{:library}/views/{:controller}/{:template}.{:type}.php',
		'element'  => array(
			'{:library}/views/{:controller}/_{:template}.{:type}.php',
			'{:library}/views/elements/{:template}.{:type}.php'
		)
	)
));

?>