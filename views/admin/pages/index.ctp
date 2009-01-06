<div class="pages index">
	<h2>Pages</h2>

	<table>
		<tr>
			<th>Name</th>
		</tr>
		<?php foreach ($collection as $page): ?>
			<tr>
				<td><?php echo $page["Page"]["name"]; ?></td>
				<td>
					<?php echo $html->link(__("Edit", true), array("action"=>"edit", $page["Page"]["id"]));  ?>
					<?php echo $html->link(__("Delete", true), array("action"=>"delete", $page["Page"]["id"]), null, __("Are you sure you want to delete", true)." #" . $page["Page"]["id"]); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php echo $html->link("New Page", array("action" => "add")); ?>
