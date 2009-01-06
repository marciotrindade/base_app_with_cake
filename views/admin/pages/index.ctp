<div class="<?php echo $this->params["controller"] ?> index">
	<h2><?php echo $controller ?></h2>

	<table>
		<tr>
			<th>Name</th>
		</tr>
		<?php foreach ($collection as $obj): ?>
			<tr>
				<td><?php echo $obj[$model]["name"]; ?></td>
				<td>
					<?php echo $html->link(__("Edit", true), array("action"=>"edit", $obj[$model]["id"]));  ?>
					<?php echo $html->link(__("Delete", true), array("action"=>"delete", $obj[$model]["id"]), null, __("Are you sure you want to delete", true)." #" . $obj[$model]["id"]); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<br/>
<?php echo $html->link("New {$model}", array("action" => "add")); ?>
