<?php
class UsersController extends AppController
{
	var $name = 'Users';
	var $components = array('Email');
	
	function login()
	{
		$this->layout = "../admin/layouts/default";

		if($this->Session->check('user')){
			$this->redirect(array('controller'=>'users', 'action'=>'index', 'admin'=>true));
		}
		if(!empty($this->data)){
			$user = $this->User->findByUsername($this->data["User"]["username"]);

			if(empty($user)){
				$this->Session->setFlash('Invalid username. Please try again.');
				return false;
			}
			
			if($this->data['User']['password'] != $user['User']['password']){
				$this->Session->setFlash('Invalid password. Please try again.');
				return false;
			}

			$user['Group'] = Set::Extract($user['Group'], '{n}.slug');

			unset($user['User']['password']);
			$update['User']['id'] = $user['User']['id'];
			$update['User']['logged'] = date('Y-m-d H:i:s');
			$this->User->save($update);

			$this->Session->write('user', $user);
			if($this->Session->check('redirect')){
				$url = $this->Session->read('redirect');
				$this->Session->del('redirect');
				$this->redirect('/'.$url);
			}else{
				$this->redirect(array('controller'=>'pages', 'action'=>'home', 'admin'=>false));
			}
		}
	}

	function logout()
	{
		$this->Session->destroy();
		$this->redirect('/');
	}

	function reset_password() 
	{
		$this->data['User']['id'] = 1;
		$this->data['User']['password'] = 'admin';
		$this->User->save($this->data);
		e('Password for default user was reset!');
		exit;
	}

	function forget()
	{
		$this->layout = "../admin/layouts/default";

		if(!empty($this->data)){
			$this->User->recursive = -1;
			$user = $this->User->findByEmail($this->data['User']['email']);

			if(! empty($user)){
				$this->Email->from = Configure::read('Project.name') . ' <'.Configure::read('Project.mail').'>';
				$this->Email->to = $user['User']['firstname'] . "<{$user['User']['email']}>";
				$this->Email->sendAs = 'html';
				$this->Email->subject = '['.Configure::read('Project.name').'] Your Password';
				$this->Email->delivery = 'smtp';
				$this->Email->smtpOptions = $this->smtpOptions;
				$this->set('user', $user);
				if ($this->Email->send(null, 'forget')) {
					$this->Session->setFlash(__('The Email has been sent.', true));
					$this->redirect(array('action'=>'login'));
				} else {
					$this->Session->setFlash(__('The Email could not be sent. Please, try again.', true));
				}
			}
			else
			{
				$this->Session->setFlash(__('This Email has not found.', true));
			}
		}
	}

	function permission_denied() {}

}
?>
