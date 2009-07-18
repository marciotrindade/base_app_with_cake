<?php
class Page extends AppModel
{
	var $name = "Page";

	var $validate = array(
		"name" => array(
			"rule" => VALID_NOT_EMPTY,
			"message" => MSG_REQUIRED
		)
	);

	var $belongsTo = array("Parent" => array("className" => "Page", "foreignKey" => "parent_id", "counterCache" => true));
	var $hasMany = array("Childrens" => array("className" => "Page", "foreignKey" => "parent_id", "order" => "position"));
	
	var $actsAs = array("Permalink", "Containable");

	function root()
	{
		return $this->find("all", array(
			"conditions" => array("Page.parent_id" => 0),
			"order" => "Page.position",
			"contain" => array()
		));
	}

	function childrens($id)
	{
		return $this->find("all", array(
			"conditions" => array("Page.parent_id" => $id),
			"order" => "Page.position",
			"contain" => array()
		));
	}
	
	function show($id)
	{
		return $this->find('first' , array(
			"conditions" => array("permalink" => $id),
			"contain" => array()
		));
	}
}
?>