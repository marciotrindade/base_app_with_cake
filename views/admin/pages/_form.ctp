<?php
	$parent = 0;
	if (isSet($this->data["Page"]["parent_id"]))
	{
		$parent = $this->data["Page"]["parent_id"];
	}elseif (isSet($this->passedArgs[0]))
	{
		$parent = $this->passedArgs[0];
	}
	
	echo $form->input("id");
	echo $form->input("name", array("class" => "required"));
	echo $fck->input("body");
	echo $form->input("parent_id", array("type" => "hidden", "value" => $parent));
	
  echo $this->element("../admin/scaffolds/_metatags");
?>
