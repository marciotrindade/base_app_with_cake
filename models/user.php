<?php

class User extends AppModel
{
	var $name = 'User';
	var $validate = array(
		'username' => array(
			'format' => array(
				'rule' => 'alphaNumeric',
				'message' => MSG_ALPHANUMERIC
			),
			'unique'=>array(
				'rule'=>array('unique', 'name'),
				'message'=>'This username is already in use.  Please select another.'
			)
		),
		'password' => array(
			'limit' => array(
				'rule' => array('between', 6, 12),
				'message' => "Please enter a value between 6 and 12 characters long."
			)
		),
		'email' => array(
			'format' => array(
				'rule' => array('email'),
				'message' => MSG_EMAIL
			),
			'unique'=>array(
				'rule'=>array('unique', 'email'),
				'message'=>'This email is already in use.  Please select another.'
			)
		),
		'name' => array(
			'rule' => VALID_NOT_EMPTY,
			'message' => MSG_REQUIRED
		)
	);

	var $hasAndBelongsToMany = array('Group' => array('with' => 'GroupUser'));
	var $actsAs = array('Containable', 'Password');

}

?>
