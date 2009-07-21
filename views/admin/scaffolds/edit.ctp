<div class="<?php echo $controllerLow ?> edit">
<h1>Editing <?php echo $model; ?></h1>
<?php echo $form->create($model, array("class"=>"validate", "action" => "update", "type" => "file"));?>
	<?php echo $this->element("../admin/{$controllerLow}/_form"); ?>
<?php echo $form->end("Update");?>
</div>
<br/>
<?php echo $html->link(__("List {$controller}", true), array("action"=>"index", isSet($this->parent)?$this->parent:""));?> |
<?php echo $html->link(__("Delete {$model}", true), array("action"=>"delete", $form->value("{$model}.id")));?>
