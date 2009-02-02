<?php

class AdminController extends AppController
{
	var $helpers = array("Fck");
	var $default = "name";
	
	function __construct()
	{
		$this->viewPath = "admin" . DS . Inflector::underscore($this->name);
		parent::__construct();
	}

	function beforeFilter()
	{
		// altera o layout
		$this->layoutPath = "admin";

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
		else
		{
			$user = $this->Session->read("user");

			if(!in_array("adm", $user["Group"])){
				$this->redirect(array("controller"=>"users", "action"=>"permission_denied", "admin" => false));
			}
		}

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
		if (!isset($this->order))
		{
			$this->order = $this->{$this->modelClass}->alias.".position";
		}

		$collection = $this->{$this->modelClass}->find("all", array("order" => $this->order));
		$this->set(compact("collection"));
		
		$this->set("except", array("id", "created", "modified", "password"));
		$this->set("schema", $this->{$this->modelClass}->_schema);

		// render template
		$this->render_action();
	}

	function add()
	{
		$this->load_vars();

		// render template
		$this->render_action();
	}

	function create()
	{
		if (!empty($this->data))
		{
			$this->{$this->modelClass}->create();
			if ($this->{$this->modelClass}->save($this->data))
			{
				$this->Session->setFlash(sprintf(__("The %1 has been created", true), Inflector::humanize($this->modelClass)), "default", array("class" => "success"));
				$this->redirect(array("action"=>"index"));
			}
			else
			{
				$this->Session->setFlash(sprintf(__("The %1 could not be created.", true), Inflector::humanize($this->modelClass)), "default", array("class" => "error"));
				$this->setAction("add");
			}
		}
	}

	function edit()
	{
		$this->data = $this->{$this->modelClass}->read();
		$this->load_vars();

		// render template
		$this->render_action();
	}

	function update()
	{
		if (!empty($this->data))
		{
			if ($this->{$this->modelClass}->save($this->data))
			{
				$this->Session->setFlash(sprintf(__("The %1 has been updated", true), Inflector::humanize($this->modelClass)), "default", array("class" => "success"));
				$this->redirect(array("action"=>"index"));
			}
			else
			{
				$this->Session->setFlash(sprintf(__("The %1 could not be updated.", true), Inflector::humanize($this->modelClass)), "default", array("class" => "error"));
				$this->setAction("edit");
			}
		}
	}

	function reorder($parent_id=null)
	{
		$conditions = array();
		
		if (isSet($parent_id)) {
			$conditions = array($this->{$this->modelClass}->alias . ".parent_id" => $parent_id);
		}
	
		$collection = $this->{$this->modelClass}->find("all", array("conditions" => $conditions, "order" => "position", "contain" => false));
		$this->set(compact("collection"));
		
		$this->set("default", $default);

		// render template
		$this->render_action();
	}

	function order()
	{
		if(!empty($_POST)){
			foreach($_POST['order'] as $k => $id){
				$data[$this->modelClass]['id'] = $id;
				$data[$this->modelClass]['position'] = $k;
				$this->{$this->modelClass}->save($data);
			}
			Configure::write('debug', 0);
			echo "true";
			exit;
		}
	}

	function destroy($id)
	{
		$this->{$this->modelClass}->delete($id);
		$this->redirect(array("action"=>"index"));
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

	function render_action()
	{
		if (file_exists(VIEWS . $this->viewPath . DS . $this->action . $this->ext)) {
			$this->render($this->action);
		} else {
			$this->render("/admin/scaffolds/{$this->action}");
		}
	}

}
?>
