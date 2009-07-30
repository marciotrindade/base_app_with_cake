<?php
class PagesController extends AppController
{
	var $name = 'Pages';

	function show($id = null)
	{
		if (!$id) {
			$this->redirect("/");
		}
		$page = $this->Page->show($id);

		$this->set("meta", $page["Page"]);
		$this->set('page', $page);

		$template = Inflector::underscore($id);
		if (file_exists(VIEWS . $this->viewPath . DS . $template . $this->ext)) {
			$template = $template;
		} else {
			$template = "show";
		}

		$this->render($template);
	}

}
?>
