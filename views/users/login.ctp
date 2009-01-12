<?php
	echo $form->create('User', array('action'=>'login', 'class'=>'validate'));
	echo $form->input('username', array('class'=>'{required:true, rangeLength:[3,20]}'));
	echo $form->input('password', array('class'=>'{required:true, rangeLength:[6,12]}'));
	echo $form->end('Login');
?>
<br/>
<?php echo $html->link(__('Forgot my password', true), array('action'=>'forget')); ?></li>
