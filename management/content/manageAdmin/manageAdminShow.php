<?php 
	include '../../require.php';
	$datas = $myFunc->getAdmin();
?>
<table class="table table-bordered table-hover" id="tabelproduk">
	
	<thead>
		<tr>
			<th>#</th>
			<th>Nama</th>
			<th>Username</th>
			<th>Email</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($datas as $data): ?>
			<tr>
				<td><?= $i++  ?></td>
				<td><?= $data['nama'] ?></td>
				<td><?= $data['username'] ?></td>
				<td><?= $data['email'] ?></td>
				<td>
					<a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Hapus</a>
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