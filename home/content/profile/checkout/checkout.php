<?php 
  $get = $myFunc->getCartItem($_SESSION["userInfo"]['id']);
  if ( $get == "0" ) {
    $myGlobal->redirect("$baseurl/home/page/profile/cart");
  }
?>
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?= $baseurl ?>/home/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Gambar</th>
                <th class="product-name">Produk</th>
                <th class="product-price">Harga</th>
                <th class="product-quantity" width="100">Qty</th>
                <th class="product-total">Subtotal</th>
              </tr>
            </thead>
            <tbody id="TableData-Cart">
              <?php foreach ($get as $row): ?>
                <?php $produkInfo = $myFunc->getProdukInfo($row['produk_id']); ?>
                <tr>
                  <td class="product-thumbnail">
                    <img src="<?= $baseurl ?>/images/produk/<?= $produkInfo['gambar'] ?>" alt="<?= ucwords($produkInfo['nama']) ?>" class="img-fluid">
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black"><?= ucwords($produkInfo['nama']) ?></h2>
                  </td>
                  <td>Rp.<?= number_format($produkInfo['harga']) ?>,-</td>
                  <td><?= $row['qty'] ?></td>
                  <td>Rp.<?= number_format($produkInfo['harga'] * $row['qty']) ?>,-</td>
                </tr>
              <?php endforeach ?> 
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="row mb-5">
        </div>
      </div>
      <div class="col-md-7">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">TOTAL</h3>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-7">
                <span class="text-black">Total Belanja + PPN (10%)</span>
              </div>
              <div class="col-md-5 text-right">
                <?php 
                  $total = $myFunc->getTotalPriceOnCart($_SESSION["userInfo"]['id']); 
                  $total = ( $total * 10 / 100 ) + $total;
                ?>
                <strong class="text-black">Rp.<span id="LblTotalBelanja"><?= number_format($total) ?></span>,-</strong>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <span class="text-black">Berat Barang (gram)</span>
              </div>
              <div class="col-md-5 text-right">
                <?php 
                  $berat = $myFunc->getItemWeight($_SESSION["userInfo"]['id']);
                ?>
                <strong class="text-black" id="LblBeratBarang"><?= $berat ?></strong>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <select class="form-control" id="CmbEkspedisi">
                  <option value="0">-- PILIH EKSPEDISI --</option>
                  <option value="jne reg">JNE REG</option>
                  <option value="jne oke">JNE OKE</option>
                  <option value="tiki">TIKI</option>
                  <option value="pos">POS INDONESIA</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <span class="text-black">Tujuan Pengiriman <a href="#">change</a></span>
              </div>
              <div class="col-md-5 text-right">
                <?php 
                  $idkota = $_SESSION["userDetail"]['kota'];
                  $getkota = $myFunc->getRegionInfo("kota",$idkota)['city']
                ?>
                <strong class="text-black" id="LblTujuanPengiriman" data-id="<?= $idkota ?>"><?= $getkota ?></strong>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <span class="text-black">Ongkos Kirim</span>
              </div>
              <div class="col-md-5 text-right">
                <strong class="text-black">Rp.<span id="LblOngkosKirim">0</span>,-</strong>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <span class="text-black">GRAND TOTAL</span>
              </div>
              <div class="col-md-5 text-right">
                <strong class="text-black">Rp.<span id="LblGrandTotal">0</span>,-</strong>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <a href="<?= $baseurl ?>/home/page/profile/checkout" class="btn btn-primary btn-lg py-3 btn-block" id="BtnCheckout">
                  Checkout
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<p class="col-md-12" id="MLMLMLM"></p>

<?php include 'checkout_script.php'; ?>