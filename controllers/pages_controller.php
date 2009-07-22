<?php
class PagesController extends AppController
{
	var $name = 'Pages';

	function show($id = null)
	{
		if (!$id) {
			$this->redirect(array('action'=>'home'));
		}
    $page = $this->Page->findByPermalink($id);

    //MetaTags
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
