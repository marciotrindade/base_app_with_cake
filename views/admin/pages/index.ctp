<div class="pages index">
	<h2>Pages</h2>

	<table>
		<tr>
			<th>Name</th>
		</tr>
		<?php foreach ($pages as $id => $name): ?>
			<tr>
				<td><?php echo $name; ?></td>
				<td>
					<?php echo $html->link(__("View", true), array("action"=>"view", $id));  ?>
					<?php echo $html->link(__("Edit", true), array("action"=>"edit", $id));  ?>
					<?php echo $html->link(__("Delete", true), array("action"=>"delete", $id), null, __("Are you sure you want to delete", true)." #" . $id); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php echo $html->link("New Page", array("action" => "add")); ?>
