<?php 
	include '../../require.php';
?>
<table class="table table-bordered table-hover" id="tabelproduk">
	
	<thead>
		<tr>
			<th width="25">#</th>
			<th width="100">Icon</th>
			<th>Kategori</th>
			<th width="300">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
			$get = $myFunc->getKategori();
		?>
		<?php foreach ($get as $row): ?>
			<tr>
				<td class="text-center"><?= $i++ ?></td>
				<td class="text-center">
					<img src="<?= $baseurl ?>/images/cat_icon/<?= $row['icon'] ?>" height="50">
				</td>
				<td><?= ucwords($row['kategori']) ?></td>
				<td class="text-center">
					<a href="<?= $row['id'] ?>" class="btn btn-warning btn-sm" id="BtnEditIconKategori">
						<i class="fa fa-picture-o"></i> Ganti Icon
					</a>
					<a href="<?= $row['id'] ?>" class="btn btn-success btn-sm" id="BtnEditKategori">
						<i class="fa fa-pencil"></i> Edit
					</a>
					<a href="<?= $row['id'] ?>" class="btn btn-danger btn-sm" id="BtnHapusKategori">
						<i class="fa fa-trash"></i> Hapus
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>	

</table>
<script>
	$(document).ready(function() {
		$('#tabelproduk').DataTable();
	});
</script>