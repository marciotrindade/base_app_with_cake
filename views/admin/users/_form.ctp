<?php
	echo $form->input("id");
	echo $form->input("username");
	if ($this->action == "add")
	{
		echo $form->input("password");
	}
	echo $form->input("name", array("class" => "{required:true}"));
	echo $form->input("email");

	echo $form->input("Group", array("multiple" => "checkbox"));
?>