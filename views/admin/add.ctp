<div class="<?php echo $controllerLow ?> add">
<h1>New <?php echo $model; ?></h1>
<?php echo $form->create($model, array("class"=>"validate", "action" => "create"));?>
	<?php echo $this->element("../admin/{$controllerLow}/_form"); ?>
<?php echo $form->end("Create");?>
</div>

<br/>
<?php echo $html->link(__("List {$controller}", true), array("action"=>"index"));?>
