<div class="pages edit">
<?php echo $form->create('Page', array('class'=>'validate', "type" => "file", "action" => "update"));?>
	<fieldset>
 		<legend><?php echo "Edit Page";?></legend>
		<?php echo $this->element("../admin/pages/_form"); ?>
	</fieldset>
<?php echo $form->end("Update");?>
</div>

<br/>
<?php echo $html->link(__('List Pages', true), array('action'=>'index'));?><br/>
<?php echo $html->link(__('Delete Page', true), array('action'=>'delete', $form->value('Page.id')));?>
