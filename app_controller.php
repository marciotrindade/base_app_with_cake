<?php
class AppController extends Controller
{
	var $helpers = array("Html", "Form", "Javascript", "Session", "Time", "Text", "H");
	var $components = array("RequestHandler", "DebugKit.Toolbar");
	// var $components = array("RequestHandler");
	var $beforFilter = array();
	var $authorized = array("usr");

	function __construct()
	{
		$this->smtpOptions = array(
			"host"     => Configure::read("Smtp.host"),
			"username" => Configure::read("Smtp.username"),
			"password" => Configure::read("Smtp.password"),
			"type"     => Configure::read("Smtp.type"),
			"port"     => Configure::read("Smtp.port")
		);
		parent::__construct();
	}

	function beforeFilter()
	{
		// CHECK IF NEED LOGIN
		$controllers = Configure::read('base.authorization');

		// check if ther this controller name with a key of base.authorization
		if (array_key_exists($this->params['controller'], $controllers))
		{
			// if value of key isn't an array
			if (!is_array($controllers[$this->params['controller']]))
			{
				$controllers[$this->params['controller']] = array($controllers[$this->params['controller']]);
			}

			foreach ($controllers[$this->params['controller']] as $action)
			{
				if (("" == $action || $this->params['action'] == $action) && $action != "permission_denied")
				{
					$this->__login_requeired();
				}
			}
		}

		// loop em todos os nomes de filtros e chama os mesmos.
		foreach($this->beforFilter as $filter){
			$this->$filter();
		}
	}
	
	function __login_requeired()
	{
		//
		if(!$this->Session->check('user'))
		{
			$url = "/{$this->params["url"]["url"]}";
			$this->Session->write('redirect', str_replace("//", "/", $url));
			$this->redirect('/users/login');
		}
		//
		else
		{
			$user = $this->Session->read('user');

			$authorized = false;
			foreach ($this->authorized as $group)
			{
				if (in_array($group, $user['Group']))
				{
					$authorized = true;
				}
			}

			if(!$authorized){
				$this->redirect('/users/permission_denied');
			}
		}
	}
}
?>
