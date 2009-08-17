<div class="<?php echo $controller ?> add">
<h1>New <?php echo $h->nameize($model); ?></h1>
<?php echo $form->create($model, array("class"=>"validate", "action" => "create", "type" => "file"));?>
	<?php echo $this->element("../admin/{$controller}/_form"); ?>
<?php echo $form->end("Create");?>
</div>

<br/>
<?php echo $html->link(__("List " . $h->nameize($controller), true), array("action"=>"index", isSet($this->passedArgs[0])?$this->passedArgs[0]:""));?>
