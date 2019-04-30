<?php 
	include '../../require.php';
?>
<table class="table table-bordered table-hover" id="tabelproduk">
	
	<thead>
		<tr>
			<th width="25">#</th>
			<th>Produk</th>
			<th>Kategori</th>
			<th>Harga</th>
			<th width="200">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
			$get = $myFunc->getProduk(); 
		?>
		<?php foreach ($get as $row): ?>
			<?php 
				$kategori = $myFunc->getKategoriProduk($row['kategori_id'])['kategori'];
			?>
			<tr>
				<td align="center"><?= $i++ ?></td>
				<td><?= ucwords($row['nama']) ?></td>
				<td><?= ucwords($kategori) ?></td>
				<td>Rp.<?= number_format($row['harga']) ?>,-</td>
				<td align="center">
					<a href="#" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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