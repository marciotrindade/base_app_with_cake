<p id="info">
	Welcome, <?php echo $session->read('user.User.username'); ?><br/>
	[ <?php echo $html->link('frontend', array('controller'=>'home', 'action'=>'index', 'admin'=>false)); ?> ]
	[ <?php echo $html->link('logout', array('controller'=>'users', 'action'=>'logout', 'admin'=>false)); ?> ]
</p>