<li>
	<?php echo $html->link($page["Page"]["name"], array("controller" => "pages", "action"=>"show", $page["Page"]["permalink"])); ?>
	<?php if ($page["Page"]["page_count"] > 0): ?>
		<ul>
			<?php foreach ($this->requestAction("/pages/menu/{$page["Page"]["id"]}") as $sub): ?>
				<?php echo $this->element("../layouts/_submenu", array("page" => $sub)); ?>
			<?php endforeach ?>
		</ul>
	<?php endif; ?>
</li>
