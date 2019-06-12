<?php 
  include '../../../../core/functions.php';
  $get = $myFunc->getCartItem($_SESSION["userInfo"]['id']);
?>
<?php if ( $get == "0" ): ?>
  <tr>
    <td colspan="6">Tidak ada item. Silahkan pilih produk yang tersedia</td>
  </tr>
<?php else: ?>
  <?php foreach ($get as $row): ?>
    <?php $produkInfo = $myFunc->getProdukInfo($row['produk_id']); ?>
    <tr>
      <td><a href="<?= $row['id'] ?>" class="btn btn-primary btn-sm BtnDelete">X</a></td>
      <td class="product-thumbnail">
        <img src="<?= $baseurl ?>/images/produk/<?= $produkInfo['gambar'] ?>" alt="<?= ucwords($produkInfo['nama']) ?>" class="img-fluid">
      </td>
      <td class="product-name">
        <h2 class="h5 text-black"><?= ucwords($produkInfo['nama']) ?></h2>
      </td>
      <td>Rp.<?= number_format($produkInfo['harga']) ?>,-</td>
      <td>
        <div class="input-group mb-3">
          <input type="number" class="form-control text-center TxtQty" value="<?= $row['qty'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" data-id="<?= $row['id'] ?>" data-produk="<?= $row['produk_id'] ?>">
        </div>
      </td>
      <td>Rp.<?= number_format($produkInfo['harga'] * $row['qty']) ?>,-</td>
    </tr>
  <?php endforeach ?> 
  <?php $total = $myFunc->getTotalPriceOnCart($_SESSION["userInfo"]['id']); ?>
  <tr>
    <td colspan="5"><h2 class="h5 text-right">Grand Total</h2></td>
    <td><h2 class="h5">Rp.<?= number_format($total) ?>,-</h2></td>
  </tr>
<?php endif ?>