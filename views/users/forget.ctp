<p>Please enter your email below.</p>

<?php
	echo $form->create('User', array('action'=>'forget', 'class'=>'validate'));
	echo $form->input('email', array('class'=>'{required:true, email:true}'));
	echo $form->end('Send');
?>

<br/>
<?php echo $html->link(__('Login', true), array('action'=>'login')); ?>
