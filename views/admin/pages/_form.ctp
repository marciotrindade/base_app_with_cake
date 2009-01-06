<?php
	echo $form->input("id");
	echo $form->input("name", array("class" => "{required:true}"));
	echo $form->input("body");
	echo $form->input("parent_id", array("empty" => array(0 => "")));
?>