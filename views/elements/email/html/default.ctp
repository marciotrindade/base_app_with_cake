<?php if (isSet($h1)): ?>
	<h1><?php echo $h1; ?></h1>
<?php endif; ?>
<?php foreach($data as $field => $content): ?>
	<p>
		<strong><?php echo Inflector::humanize($field); ?>:</strong><br />
		<?php echo nl2br(h($content)); ?>
	</p>
<?php endforeach; ?>
