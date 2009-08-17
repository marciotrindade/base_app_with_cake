<div class="<?php echo $controller ?> edit">
<h1>Editing <?php echo $h->nameize($model); ?></h1>
<?php echo $form->create($model, array("class"=>"validate", "action" => "update", "type" => "file"));?>
	<?php echo $this->element("../admin/{$controller}/_form"); ?>
<?php echo $form->end("Update");?>
</div>
<br/>
<?php echo $html->link(__("List " . $h->nameize($controller), true), array("action"=>"index", isSet($this->parent)?$this->parent:""));?> |
<?php echo $html->link(__("Delete " . $h->nameize($model), true), array("action"=>"delete", $form->value("{$model}.id")));?>
