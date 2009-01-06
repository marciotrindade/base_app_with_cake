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
			'limit' => array(
				'rule' => array('between', 3, 20),
				'message' => "Please enter a value between 3 and 20 characters long."
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
			'limit' => array(
				'rule' => array('maxLength', 120),
				'message' => "Please enter no more than 120 characters."
			),
			'unique'=>array(
				'rule'=>array('unique', 'email'),
				'message'=>'This email is already in use.  Please select another.'
			)
		),
		'firstname' => array(
			'format' => array(
				'rule' => VALID_NOT_EMPTY,
				'message' => MSG_REQUIRED
			),
			'limit' => array(
				'rule' => array('maxLength', 80),
				'message' => "Please enter no more than 80 characters."
			)
		),
		'lastname' => array(
			'format' => array(
				'rule' => VALID_NOT_EMPTY,
				'message' => MSG_REQUIRED
			),
			'limit' => array(
				'rule' => array('maxLength', 80),
				'message' => "Please enter no more than 80 characters."
			)
		)
	);

	var $hasAndBelongsToMany = array('Group' => array('with' => 'GroupUser'));
	var $actsAs = array('Containable', 'Password');

	/*
	 * callbak executado depois de uma consulta no banco 
	 * recebe um array associativo
	 * trata o mesmo
	 * retorno o array tratado
	 */
	function afterFind($result){
		foreach($result as &$rs){
			/*
			 * verifica se tem o campo birth na matriz User
			 * tendo altera o formato da data para o padrão americano
			 */
			if(isSet($rs['User']['birth'])){
				$rs['User']['birth'] = date('m/d/Y', strtotime($rs['User']['birth']));
			}
			/*
			 * verifica se tem o campo loged na matriz User
			 * tendo altera o formato da data para o padrão americano
			 */
			if(isSet($rs[$this->name]['loged'])){
				$rs[$this->name]['logged'] = date('m/d/Y', strtotime($rs[$this->name]['logged']));
			}
		}

		$result = parent::afterFind($result);
		
		return $result;
	}
	/*
	 * metodo executado antes de salvar
	 * trata o a variavael data
	 * retorno true para continuar a ação de salvar
	 */
	function beforeSave(){
		// verifica se tem o campo birth tendo altera o formato da data para o padrão MySql
		if(isSet($this->data[$this->name]['birth'])){
			$this->data[$this->name]['birth'] = date('Y-m-d', strtotime($this->data[$this->name]['birth']));
		}
		return true;
	}
	
}

?>
