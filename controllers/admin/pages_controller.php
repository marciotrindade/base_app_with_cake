<?php
class PagesController extends AdminController {
	var $name = 'Pages';

	function index($parent_id=false)
	{
		if ($parent_id)
		{
			$collection = $this->Page->find("all", array("conditions" => array("Page.parent_id" => $parent_id), "order" => "Page.position"));
		}else{
			$collection = $this->Page->root("all", array("order" => "Page.position"));
		}

		$this->set(compact("collection"));

		// render template
		$this->render_action();
	}

}
?>