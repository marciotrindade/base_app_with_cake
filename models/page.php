<?php
class Page extends AppModel {
	var $name = "Page";

	var $validate = array(
		"name" => array(
			"rule" => VALID_NOT_EMPTY,
			"message" => MSG_REQUIRED
		)
	);
	
	var $belongsTo = array("Parent" => array("className" => "Page", "foreignKey" => "parent_id", "counterCache" => true));
	var $hasMany = array("Childrens" => array("className" => "Page", "foreignKey" => "parent_id", "order" => "position"));
	
	var $actsAs = array(
		"Permalink",
		"Containable",
			"NamedScope" => array(
				"root" => array(
					"conditions" => array("Page.parent_id" => 0),
					"order" => "Page.position ASC"
				)
			)
	);
}
?>