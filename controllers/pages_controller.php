<?php
class PagesController extends AppController
{
	var $name = 'Pages';

	function show($id = null)
	{
		if (!$id) {
			$this->redirect(array('action'=>'home'));
		}
		$this->set('page', $this->Page->show($id));

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