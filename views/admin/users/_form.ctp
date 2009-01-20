<?php
	echo $form->input("id");
	echo $form->input("username", array("class" => "required login"));
	if ($this->action == "add")
	{
		echo $form->input("password", array("class" => "required"));
	}
	echo $form->input("name", array("class" => "required"));
	echo $form->input("email", array("class" => "required email"));

	echo $form->input("Group", array("multiple" => "checkbox"));
?>