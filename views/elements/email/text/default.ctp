<?php if (isSet($h1)): ?>
.:: <?php echo $h1; ?> ::.
<?php endif; ?>

<?php foreach($data as $field => $content): ?>
<?php echo Inflector::humanize($field); ?>:
<?php echo $content; ?>


<?php endforeach; ?>
