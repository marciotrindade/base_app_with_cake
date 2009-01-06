<?php
/**
 *  Model
 * 
 * [Short Description]
 *
 * @package default
 * @author Marcio Trindade
 **/
class Page extends AppModel {
	var $name = "Page";

	var $validate = array(
		"name" => array(
			"rule" => VALID_NOT_EMPTY,
			"message" => MSG_REQUIRED
		)
	);
	
	var $belongsTo = array("Parent" => array("className" => "Page", "foreignKey" => "parent_id"));
	
	var $actsAs = array("Permalink", "Containable");
}
?>