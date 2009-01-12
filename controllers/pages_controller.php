<?php
/**
 * PagesController
 * 
 * @package default
 * @author Marcio Trindade
 **/

class PagesController extends AppController {
	var $name = 'Pages';

	function home()
	{
	}

	function show($id = null) {
		if (!$id) {
			$this->redirect(array('action'=>'home'));
		}
		$this->set('page', $this->Page->findByPermalink($id));
	}


}
?>