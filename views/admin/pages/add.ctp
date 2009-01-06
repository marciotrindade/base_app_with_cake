<div class="pages add">
<?php echo $form->create("Page", array("class"=>"validate", "action" => "create"));?>
	<fieldset>
 		<legend><?php echo "New Page";?></legend>
		<?php echo $this->element("../admin/pages/_form"); ?>
	</fieldset>
<?php echo $form->end("Create");?>
</div>

<br/>
<?php echo $html->link(__("List Pages", true), array("action"=>"index"));?>
