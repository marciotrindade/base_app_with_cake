<ul id="menu">
	<li>
		<?php echo $html->link("Users", array("controller" => "users", "action"=>"index")); ?>
		<ul>
			<li><?php echo $html->link("Admins", array("controller" => "users", "action"=>"index", "adm")); ?></li>
			<li><?php echo $html->link("Users", array("controller" => "users", "action"=>"index")); ?></li>
		</ul>
	</li>
	<li>
		<?php echo $html->link("Ecommerce", array("controller" => "categories", "action"=>"index")); ?>
		<ul>
			<li><?php echo $html->link("Categories", array("controller" => "categories", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Products", array("controller" => "products", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Notification", array("controller" => "notifications", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Tax", array("controller" => "taxes", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Shipping", array("controller" => "shippings", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Payment", array("controller" => "payments", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Orders", array("controller" => "orders", "action"=>"index")); ?></li>
			<li><?php echo $html->link("Promotions", array("controller" => "promotions", "action"=>"index")); ?></li>
		</ul>
	</li>
	<li><?php echo $html->link("Info Pages", array("controller" => "pages", "action"=>"index")); ?></li>
</ul>
