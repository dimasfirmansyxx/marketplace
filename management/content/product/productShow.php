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
			<th>Stok</th>
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
				$stok = $myFunc->getStokProduk($row['id']);
			?>
			<tr>
				<td align="center"><?= $i++ ?></td>
				<td><?= ucwords($row['nama']) ?></td>
				<td><?= ucwords($kategori) ?></td>
				<td>Rp.<?= number_format($row['harga']) ?>,-</td>
				<td><?= $stok ?></td>
				<td align="center">
					<a href="<?= $row['id'] ?>" class="btn btn-warning btn-sm" id="BtnEditGambarProduk" title="Ganti Gambar"><i class="fa fa-picture-o"></i></a>
					<a href="<?= $row['id'] ?>" class="btn btn-primary btn-sm" id="BtnStokProduk" title="Stok"><i class="fa fa-dropbox"></i></a>
					<a href="<?= $row['id'] ?>" class="btn bg-navy btn-sm" id="BtnTambahStokProduk" title="Tambah Stok"><i class="fa fa-plus"></i></a>
					<a href="<?= $row['id'] ?>" class="btn btn-success btn-sm" id="BtnEditProduk" title="Edit"><i class="fa fa-pencil"></i></a>
					<a href="<?= $row['id'] ?>" class="btn btn-danger btn-sm" id="BtnHapusProduk" title="Hapus"><i class="fa fa-trash"></i></a>
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