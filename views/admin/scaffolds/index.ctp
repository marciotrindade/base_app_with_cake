<div class="<?php echo $controllerLow ?> index">
	<h2><?php echo $controller ?></h2>

	<table>
		<tr>
			<?php foreach ($schema as $field => $options):?>
				<?php if (in_array($field, $except)): ?>
					<?php continue; ?>
				<?php endif; ?>
				<th><?php echo $field;?></th>
			<?php endforeach;?>
		</tr>
		<?php foreach ($collection as $obj): ?>
			<tr>
				<?php
					foreach ($schema as $field => $options){
						if(in_array($field, $except)){ continue; }
					
						switch ($options["type"]) {
							case 'date':
								echo "\t\t\t\t<td>{$time->format(Configure::read('format.date'), $obj[$model][$field])}</td>\n";
								break;
							case 'datetime':
								echo "\t\t\t\t<td>{$time->format(Configure::read('format.datetime'), $obj[$model][$field])}</td>\n";
								break;
							case 'text':
								echo "\t\t\t\t<td>{$text->truncate(strip_tags($obj[$model][$field]))}</td>\n";
								break;
							default:
								echo "\t\t\t\t<td>{$obj[$model][$field]}</td>\n";
								break;
						}
					}
				?>
				<td><?php echo $html->link(__("Edit", true), array("action"=>"edit", $obj[$model]["id"]));  ?></td>
				<td><?php echo $html->link(__("Delete", true), array("action"=>"delete", $obj[$model]["id"]), null, __("Are you sure you want to delete", true)." #" . $obj[$model]["id"]); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<br/>
<?php echo $html->link("New {$model}", array("action" => "add")); ?>
