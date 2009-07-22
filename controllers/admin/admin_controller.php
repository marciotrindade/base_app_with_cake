<?php

class AdminController extends AppController
{
	var $helpers = array("Fck", "Application");
	var $field = "name";
	var $components = array('Upload');
	var $except = array();
	var $authorized = array("adm");
	
	function __construct()
	{
		$this->viewPath = "admin" . DS . Inflector::underscore($this->name);
		parent::__construct();
	}

	function beforeFilter()
	{
		// altera o layout
		$this->layoutPath = "admin";

		// authorize with group admin
		$this->__login_requeired();

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
			$this->order = $this->{$this->modelClass}->alias.".position ASC, ".$this->{$this->modelClass}->alias.".id DESC";
		}

		$collection = $this->{$this->modelClass}->find("all", array("order" => $this->order));
		$this->set(compact("collection"));
		
		$associations = $this->__associations();
	
		$this->set("associations", $associations);
		$this->set("except", am(array("id", "created", "modified", "password", "position", "permalink"), $this->except));
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
				if (isSet($this->files))
				{
					$this->data[$this->modelClass]["id"] = $this->{$this->modelClass}->getInsertID();
					$this->Upload->process();
				}
				$this->Session->setFlash(sprintf(__("The %s has been created", true), Inflector::humanize($this->modelClass)), "default", array("class" => "success"));
				if (isSet($this->data[$this->modelClass]["redirect_to"]))
				{
					$this->redirect(array("action"=>"index", $this->data[$this->modelClass]["redirect_to"]));
				}else{
					$this->redirect(array("action"=>"index"));
				}
			}
			else
			{
				$this->Session->setFlash(sprintf(__("The %s could not be created.", true), Inflector::humanize($this->modelClass)), "default", array("class" => "error"));
				$this->setAction("add");
			}
		}
		else
		{
			$this->redirect(array("action" => "add"));
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
				if (isSet($this->files))
				{
					$this->Upload->process();
				}
				$this->Session->setFlash(sprintf(__("The %s has been updated", true), Inflector::humanize($this->modelClass)), "default", array("class" => "success"));
				if (isSet($this->data[$this->modelClass]["redirect_to"]))
				{
					$this->redirect(array("action"=>"index", $this->data[$this->modelClass]["redirect_to"]));
				}else{
					$this->redirect(array("action"=>"index"));
				}
			}
			else
			{
				$this->Session->setFlash(sprintf(__("The %s could not be updated.", true), Inflector::humanize($this->modelClass)), "default", array("class" => "error"));
				$this->setAction("edit");
			}
		}
		else
		{
			$this->redirect(array("action" => "index"));
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

		$this->set("field", $this->field);
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

	function destroy($id, $parent=null)
	{
		$this->{$this->modelClass}->delete($id);
		$this->Session->setFlash(sprintf(__("The %s has been destroyed", true), Inflector::humanize($this->modelClass)), "default", array("class" => "success"));
		$this->redirect(array("action"=>"index", $parent));
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

	function __associations()
	{
		$keys = array('belongsTo', 'hasOne', 'hasMany', 'hasAndBelongsToMany');
		$associations = array();

		foreach ($keys as $key => $type) {
			foreach ($this->{$this->modelClass}->{$type} as $assocKey => $assocData) {
				$associations[$type][$assocKey]['primaryKey'] = $this->{$this->modelClass}->{$assocKey}->primaryKey;
				$associations[$type][$assocKey]['displayField'] = $this->{$this->modelClass}->{$assocKey}->displayField;
				$associations[$type][$assocKey]['foreignKey'] = $assocData['foreignKey'];
				$associations[$type][$assocKey]['controller'] = Inflector::pluralize(Inflector::underscore($assocData['className']));
			}
		}
		return $associations;
	}

}
?>
