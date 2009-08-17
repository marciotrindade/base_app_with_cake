<div class="<?php echo $controller ?> index">
	<h2>Reorder <?php echo $h->nameize($controller); ?></h2>

	<?php echo $html->link("order", array("action" => "order"), array("id" => "url_order")); ?>
	
	<ul id="order">
		<?php foreach ($collection as $obj): ?>
			<li id="item_<?php echo $obj[$model]["id"] ?>"><?php echo $obj[$model][$field] ?></li>
		<?php endforeach ?>
	</ul>
</div>

<br/>
<?php echo $html->link("List " . $h->nameize($controller), array("action" => "index", isSet($this->passedArgs[0])?$this->passedArgs[0]:"")); ?>

<?php echo $this->addScript($javascript->link("admin/reorder")); ?>