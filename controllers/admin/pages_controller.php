<?php
class PagesController extends AdminController {
	var $name = 'Pages';

	function index($parent_id=0)
	{
		if (!isset($this->order))
		{
			$this->order = $this->{$this->modelClass}->alias.".position";
		}

		$conditions = array($this->{$this->modelClass}->alias . ".parent_id" => $parent_id);

		$collection = $this->{$this->modelClass}->find("all", array("conditions" => $conditions, "order" => $this->order));
		$this->set(compact("collection"));

		// render template
		$this->render_action();
	}

}
?>