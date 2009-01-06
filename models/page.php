<?php
class Page extends AppModel {
	var $name = "Page";

	var $validate = array(
		"name" => array(
			"rule" => VALID_NOT_EMPTY,
			"message" => MSG_REQUIRED
		)
	);
	
	var $belongsTo = array("Parent" => array("className" => "Page", "foreignKey" => "parent_id"));
	var $hasMany = array("Childrens" => array("className" => "Page", "foreignKey" => "parent_id", "order" => "position"));
	
	var $actsAs = array("Permalink", "Containable");
}
?>