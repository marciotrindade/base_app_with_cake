<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
											"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>.:: <?php SITE_NAME ?> ::. Admin</title>

	<?php
		echo $html->charset();
		echo $html->meta("icon");

		echo $html->css(array("admin/default", "plugins/superfish"));
	
		echo $javascript->link(array(
			"jquery",
			"plugins/corner",
			"plugins/metadata",
			"plugins/validate",
			"plugins/masked",
			"plugins/sort",
			"plugins/superfish",
			"admin/default"
		));
		echo $javascript->codeBlock("var webroot = '" . $html->webroot("/admin/") . "';");

		echo $scripts_for_layout;
	?>
</head>
<body>

<?php if($session->check("user")): ?>
	<?php echo $this->element("/admin/layouts/_info"); ?>
<?php endif; ?>

<?php echo $html->image("admin/dbd.gif", array("alt"=>"Dburs Design")); ?>

<?php if($session->check("user")): ?>
	<?php echo $this->element("/admin/layouts/_menu"); ?>
<?php endif; ?>

<div id="content">
	<?php $session->flash(); ?>
	<?php echo $content_for_layout; ?>
</div>

<div id="footer">Created by <?php echo $html->link("DBurns Design", "http://www.dburnsdesign.com", array("target" => "_blank")) ?></div>

</body>
</html>
