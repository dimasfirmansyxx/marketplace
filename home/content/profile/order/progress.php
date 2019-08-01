<?php 
  include '../../../../core/functions.php';
  $get = $myFunc->getUserOrder("progress",$_SESSION["userInfo"]['id']);
?>
<?php if ( $get == "3" ): ?>
  <tr>
    <td colspan="6">Tidak ada orderan.</td>
  </tr>
<?php else: ?>
    <?php $i = 1; ?>
    <?php foreach ($get as $row): ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['id_transaksi'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['waktu'] ?></td>
            <td><?= strtoupper($row['status']) ?></td>
            <td>
              <button data-id="<?= $row['id_transaksi'] ?>" class="btn btn-primary btn-sm" id="BtnShowOrderList">Lihat Orderan</button>
              <?php if ( $row['status'] == "pending" ) : ?>
                <button data-id="<?= $row['id_transaksi'] ?>" class="btn btn-success btn-sm" id="BtnDoPayment">Lakukan Pembayaran</button>
              <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
<?php endif ?>