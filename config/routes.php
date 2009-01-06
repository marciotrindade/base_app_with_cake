<?php
	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	
	Router::parseExtensions();
?>