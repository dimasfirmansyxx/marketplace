<?php 
	include '../../require.php';
	$get = $myFunc->getOrderList("prepare");
?>

<table class="table table-bordered table-hover" id="tabelproduk">
	<thead>
	  <tr>
	    <th width="100">No. Transaksi</th>
	    <th>Customer</th>
	    <th>Waktu</th>
	    <th width="200">Aksi</th>
	  </tr>
	</thead>
	<tbody id="DataInHere">
		<?php foreach ($get as $row): ?>
			<?php $userInfo = $myFunc->getUserInfo($row['user_id']) ?>
			<tr>
				<td class="text-center"><?= $row['id_transaksi'] ?></td>
				<td><?= $userInfo['nama'] ?></td>
				<td><?= $row['tanggal'] . " " . $row['waktu'] ?></td>
				<td class="text-center">
					<button class="btn btn-info btn-sm" id="BtnShowInfoPengiriman" data-id="<?= $row['id_transaksi'] ?>">
						<i class="fa fa-info"></i> Invoice
					</button>
					<button class="btn btn-success btn-sm" id="BtnToOngoing" data-id="<?= $row['id_transaksi'] ?>">
						<i class="fa fa-paper-plane"></i> Kirim Barang
					</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script>
	$('#tabelproduk').DataTable();
</script>