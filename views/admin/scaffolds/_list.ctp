<?php foreach ($collection as $obj): ?>
	<li id="page_<?php echo $obj[$model]["id"] ?>">
		<?php if ($obj[$model][strtolower($model)."_count"] > 0): ?>
			<?php echo $html->link($html->image('act_as_tree/open.gif', array("alt"=>"", "size" => "20x16")), array("action" => "index", "ext" => "js", $obj[$model]["id"]), array("class" => "first")); ?>
		<?php else: ?>
			<?php echo $html->image('act_as_tree/simple.gif', array("alt"=>"", "size" => "20x16")); ?>
		<?php endif ?>
		<span><?php echo $obj[$model]["name"]; ?></span>
		<div>
			<?php if ($obj[$model]["{$modelLow}_count"] > 0): ?>
				<?php echo $html->link("Reorder children", array("action" => "reorder", $obj[$model]["id"])); ?>
			<?php endif ?>
			<?php echo $html->link("New children", array("action" => "add", $obj[$model]["id"])); ?>
			<?php echo $html->link("Edit", array("action" => "edit", $obj[$model]["id"])); ?>
			<?php if (!$obj[$model]["protected"]): ?>
				<?php echo $html->link("Destroy", array("action" => "destroy", $obj[$model]["id"]), null, "Are you sure?"); ?>
			<?php endif; ?>
		</div>
	</li>
<?php endforeach ?>