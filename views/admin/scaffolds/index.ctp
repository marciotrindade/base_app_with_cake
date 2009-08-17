<div class="<?php echo $controller ?> index">
	<h2><?php echo $h->nameize($controller); ?></h2>

		<table cellspacing="0" class="display" id="table">
			<thead>
		<tr>
			<?php foreach ($schema as $field => $options):?>
				<?php if (in_array($field, $except)){continue;} ?>
				<th><?php echo __(Inflector::humanize(preg_replace('/_id$/', '', $field)));?></th>
			<?php endforeach;?>
		</tr>
			</thead>
		<?php foreach ($collection as $obj): ?>
			<tr>
				<?php
					foreach ($schema as $field => $options){
						if(in_array($field, $except)){ continue; }
						
						$isKey = false;
						
						if (!empty($associations['belongsTo'])) {
							foreach ($associations['belongsTo'] as $_alias => $_details) {
								if ($field === $_details['foreignKey']) {
									$isKey = true;
									echo "\t\t\t\t<td>" . $obj[$_alias][$_details['displayField']] . "</td>\n";
									break;
								}
							}
						}
						if ($isKey != true)
						{
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
					}
				?>
				<td><?php echo $html->link(__("Edit", true), array("action"=>"edit", $obj[$model]["id"]));	?></td>
				<td><?php echo $html->link(__("Destroy", true), array("action"=>"destroy", $obj[$model]["id"]), null, __("Are you sure?", true)); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<br/>
<?php echo $html->link("New " . $h->nameize($model), array("action" => "add", isSet($this->passedArgs[0])?$this->passedArgs[0]:"")); ?>
<?php if (array_key_exists("position", $schema) && count($collection) > 1): ?>
 | <?php echo $html->link("Reorder " . $h->nameize($controller), array("action" => "reorder", isSet($this->passedArgs[0])?$this->passedArgs[0]:"")); ?> 
<?php endif; ?>
