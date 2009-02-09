<?php
	Router::connect('/', array('controller' => 'pages', 'action' => "show", 'home'));

	Router::connect('/pages/menu/*', array('controller' => 'pages', 'action' => 'menu'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'show'));

	Router::connect('/admin', array('controller' => 'pages', 'action' => 'index', 'admin' => true));
	
	Router::parseExtensions();
?>