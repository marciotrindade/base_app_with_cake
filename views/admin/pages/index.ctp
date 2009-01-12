<div class="<?php echo $this->params["controller"] ?> index">
	<h2><?php echo $controller ?></h2>

	<ul class="act_as_tree">
		<?php echo $this->element("../admin/{$controllerLow}/_list"); ?>
	</ul>

</div>

<br/>
<?php echo $html->link("New {$model}", array("action" => "add")); ?> |
<?php echo $html->link("Reorder {$controller}", array("action" => "reorder", 0)); ?>