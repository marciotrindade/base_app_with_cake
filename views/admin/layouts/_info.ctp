<p id="info">
	Welcome, <?php echo $session->read('user.User.username'); ?><br/>
	[ <?php echo $html->link('frontend', array('controller'=>'pages', 'action'=>'home', 'admin'=>false)); ?> ]
	[ <?php echo $html->link('logout', array('controller'=>'users', 'action'=>'logout', 'admin'=>false)); ?> ]
</p>