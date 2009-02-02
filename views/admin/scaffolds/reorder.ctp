<div class="<?php echo $this->params["controller"] ?> index">
	<h2><?php echo $controller ?></h2>

	<?php echo $html->link("order", array("action" => "order"), array("id" => "url_order")); ?>
	
	<ul id="order">
		<?php foreach ($collection as $obj): ?>
			<li id="item_<?php echo $obj[$model]["id"] ?>"><?php echo $obj[$model][$field] ?></li>
		<?php endforeach ?>
	</ul>
</div>

<br/>
<?php echo $html->link("List {$controller}", array("action" => "index")); ?>

<?php echo $this->addScript($javascript->link("admin/reorder")); ?>