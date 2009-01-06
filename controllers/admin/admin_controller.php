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

		$model_low = Inflector::variable($this->modelClass);
		$controller_low = Inflector::variable($this->name);
		$model = Inflector::humanize($this->modelClass);
		$controller = Inflector::humanize($this->name);

		$this->set(compact("model_low", "controller_low", "model", "controller"));

	}

	function index()
	{
		$collection = $this->{$this->modelClass}->find("all");
		$this->set(compact("collection"));
	}

	function add()
	{
		$this->load_vars();
		$this->render("/admin/add");
	}

	function create()
	{
		if (!empty($this->data))
		{
			$this->{$this->modelClass}->create();
			if ($this->{$this->modelClass}->save($this->data))
			{
				$this->Session->setFlash(sprintf(__("The %1 has been created", true), Inflector::humanize($this->modelClass)));
				$this->redirect(array("action"=>"index"));
			}
			else
			{
				$this->Session->setFlash(sprintf(__("The %1 could not be saved. Please, try again.", true), Inflector::humanize($this->modelClass)));
				$this->setAction("add");
			}
		}
	}

	function edit()
	{
		$this->data = $this->{$this->modelClass}->read();
		$this->load_vars();
		$this->render("/admin/edit");
	}

	function update()
	{
		if (!empty($this->data))
		{
			if ($this->{$this->modelClass}->save($this->data))
			{
				$this->Session->setFlash(sprintf(__("The %1 has been updated", true), Inflector::humanize($this->modelClass)));
				$this->redirect(array("action"=>"index"));
			}
			else
			{
				$this->Session->setFlash(sprintf(__("The %1 could not be updated. Please, try again.", true), Inflector::humanize($this->modelClass)));
				$this->setAction("edit");
			}
		}
	}

	function load_vars()
	{
		foreach ($this->{$this->modelClass}->belongsTo as $name => $data)
		{
			$conditions = array();
			if ($data["className"] == $this->{$this->modelClass}->alias && $this->{$this->modelClass}->id)
			{
				$conditions = array("{$name}.id <>" => $this->{$this->modelClass}->id);
			}
			$var_name = Inflector::variable(Inflector::pluralize(preg_replace("/(?:_id)$/", "", $data["foreignKey"])));
			$this->set($var_name, $this->{$this->modelClass}->{$name}->find("list", array("conditions" => $conditions)));
		}

		foreach ($this->{$this->modelClass}->hasAndBelongsToMany as $name => $data)
		{
			$conditions = array();
			if ($data["className"] == $this->{$this->modelClass}->alias && $this->{$this->modelClass}->id)
			{
				$conditions = array("{$name}.id <>" => $this->{$this->modelClass}->id);
			}
			$var_name = Inflector::variable(Inflector::pluralize($name));
			$this->set($var_name, $this->{$this->modelClass}->{$name}->find('list'));
		}
	}

}
?>
