<ul id="menu">
	<li><?php echo $html->link("Home", "/"); ?></li>
	<?php foreach ($this->requestAction("/pages/menu") as $page): ?>
		<?php echo $this->element("../layouts/_submenu", array("page" => $page)); ?>
	<?php endforeach ?>
</ul>