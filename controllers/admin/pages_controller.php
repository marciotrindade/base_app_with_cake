<?php
class PagesController extends AdminController
{
	var $name = 'Pages';

	function index($id=false)
	{
		if ($id)
		{
			$collection = $this->Page->childrens($id);
		}else{
			$collection = $this->Page->root("all");
		}

		$this->set(compact("collection"));

		// render template
		$this->render_action();
	}

}
?>