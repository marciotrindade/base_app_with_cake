<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
											"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo Configure::read('Project.name') ?> - Admin</title>

	<?php
		echo $html->charset();
		echo $html->meta("icon");

		echo $html->css(array(
		    "admin/default", "plugins/superfish",
		    "admin/default", "plugins/data_tables",
		    "admin/default", "plugins/crossbrowser"
		));
	
		echo $javascript->link(array(
			"jquery",
			"plugins/jquery-ui",
			"plugins/metadata",
			"plugins/validate",
			"plugins/superfish",
			"plugins/data_tables",
			"plugins/crossbrowser",
			"application",
			"admin/default"
		));
		echo $javascript->codeBlock("var webroot = '" . $html->webroot("/admin/") . "';");

		echo $scripts_for_layout;
	?>
    <script type="text/javascript">
        $(function(){
	        $("#table").dataTable( {
		        "aaSorting": [[ 0, "asc" ]],
		        "sPaginationType": "full_numbers",
		        "bStateSave": true,
		        "bInfo": false
	        }).css("width", "auto");
        });
    </script>
</head>
<body>

<?php if($session->check("user")): ?>
	<?php echo $this->element("../admin/layouts/_info"); ?>
<?php endif; ?>

<h1 id="name_of_cms">Marcio Trindade <sup>CMS</sup></h1>

<?php if($session->check("user")): ?>
	<?php echo $this->element("../admin/layouts/_menu"); ?>
<?php endif; ?>

<div id="content">
	<?php $session->flash(); ?>
	<?php echo $content_for_layout; ?>
</div>

<div id="footer">Created by <?php echo $html->link("Marcio Trindade", "http://www.marciotrindade.net", array("target" => "_blank")) ?></div>

</body>
</html>
