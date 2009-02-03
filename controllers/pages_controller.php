<?php
/**
 * PagesController
 * 
 * @package default
 * @author Marcio Trindade
 **/

class PagesController extends AppController {
	var $name = 'Pages';

	function show($id = null) {
		if (!$id) {
			$this->redirect(array('action'=>'home'));
		}
		$this->set('page', $this->Page->findByPermalink($id));

		$template = Inflector::underscore($id);
		if (file_exists(VIEWS . $this->viewPath . DS . $template . $this->ext)) {
			$this->render($template);
		} else {
			$this->render("show");
		}
	}


}
?>