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
			$this->Session->setFlash(__('Invalid Page.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('data', $this->Page->read(null, $id));
	}


}
?>