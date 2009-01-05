<?php
/**
 * PagesController
 * 
 *
 * @package Admin
 * @author Marcio Trindade
 **/

class PagesController extends AdminController {
	var $name = 'Pages';

	function index() {
		$pages = $this->Page->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;');
		$this->set(compact("pages"));
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