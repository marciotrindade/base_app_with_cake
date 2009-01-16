<?php

class AppController extends Controller
{
	var $helpers = array("Html", "Form", "Javascript", "Session");
	//var $components = array("RequestHandler", "DebugKit.Toolbar");
	var $components = array("RequestHandler");
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

	function beforeFilter() {
		/*
		 * verifica se esta dentro do admim
		 * se estiver adiciona o metodo _adminFilter a lista de filtros
		 */
		if(isSet($this->params["admin"])){
//			$this->beforFilter = array_merge_recursive($this->beforFilter, array("_adminFilter"));
		}
		/*
		 * loop em todos os nomes de filtros e chama os mesmos.
		 */
		foreach($this->beforFilter as $filter){
			$this->$filter();
		}
	}

	/*
	 * filtro quando está dentro do Routing.admin
	 */
	function _adminFilter() {
		// altera o layout
		$this->layoutPath = "admin";
		$this->viewPath .= "/admin";
		$this->params["prefix"] = "";

		/*
		 * se o usuário não estiver logado
		 * salva a url solicitada em uma seção e
		 * redireciona o usuário para a tela de login
		 */
		if(!$this->Session->check("user"))
		{
			if(!empty($this->params["url"])){
				$url = $this->params["url"]["url"];
			}else{
				$url = "/";
			}
			$this->Session->write("redirect", $url);
			$this->redirect(array("controller" => "users", "action"=>"login", "admin"=>false));
		}
		/*
		 * se está logado verifica se tem permissão de administrador
		 * não tendo redireciona para o paginas de permisão.
		 * tendo manda os dados do usuário para o view
		 */
		else
		{
			$user = $this->Session->read("user");

			if(!in_array("adm", $user["Group"])){
				$this->redirect(array("controller"=>"users", "action"=>"permission_denied", "admin" => false));
			}
		}
	}

	function beforeRender() {
		if(isSet($this->params[Configure::read("Routing.admin")])){
			$this->action = str_replace("admin_", "", $this->action);
		}
	}

	function _filter(){
		$this->passedArgs = am(array(
			"sort" => "name",
			"direction" => "asc",
			"limit" => 20,
			"page" => 1,
			"key" => ""
			), $this->passedArgs);
			$this->set("limits", array(10 => 10, 20 => 20, 30 => 30, 50 => 50, 100 => 100));
	}

}
?>
