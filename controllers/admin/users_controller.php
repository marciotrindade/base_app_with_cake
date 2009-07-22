<?php
class UsersController extends AdminController
{
	var $name = 'Users';
	var $order = "username";
	
	function edit()
	{
		$this->data = $this->{$this->modelClass}->read();
		$this->data["User"]["password"] = "";
		$this->load_vars();

		// render template
		$this->render_action();
	}

	function update()
	{
		if (!empty($this->data))
		{
			if ($this->data["User"]["password"] == "")
			{
				unset($this->data["User"]["password"]);
			}
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(sprintf(__("The %s has been updated", true), Inflector::humanize($this->modelClass)), "default", array("class" => "success"));
				$this->redirect(array("action"=>"index"));
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
	
}
?>