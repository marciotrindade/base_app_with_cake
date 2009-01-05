<?php

class AdminController extends AppController
{

	function __construct()
	{
		$this->viewPath = "admin" . DS . Inflector::underscore($this->name);
		parent::__construct();
	}

	function beforeFilter() {
		// altera o layout
		$this->layoutPath = "admin";
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
		/*
		 * loop em todos os nomes de filtros e chama os mesmos.
		 */
		foreach($this->beforFilter as $filter){
			$this->$filter();
		}
	}

}
?>
