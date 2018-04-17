<table class="table">
	<thead>
		<th>No.</th>
		<th>Nama Device</th>
		<th>Option</th>
	</thead>
	<tbody>
	<?php
		$no = 0;
		foreach ($device as $data) {
			$no++
		 ?>
		<tr data-id="<?php echo $data['id_device']; ?>" data-type="<?php echo $data['type_device']; ?>">
			<td><?php echo $no; ?></td>
			<td><?php echo $data['nama_device']; ?></td>
			<td>
				<button id="editDevice" class="btn btn-warning" onclick="edit_device('<?php echo $data['id_device']; ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
				<button class="btn btn-danger" onclick="delete_device('<?php echo $data['id_device'];?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>		
			</td>
		</tr>
		<?php }
	?>
	</tbody>
</table>

