<?php
class AppController extends Controller
{
	var $helpers = array("Html", "Form", "Javascript", "Session", "Time", "Text");
	var $components = array("RequestHandler", "DebugKit.Toolbar");
	// var $components = array("RequestHandler");
	var $beforFilter = array();

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
		// loop em todos os nomes de filtros e chama os mesmos.
		foreach($this->beforFilter as $filter){
			$this->$filter();
		}
	}
}
?>