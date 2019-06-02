<?php 
  $get = $myFunc->getProdukInfo($_GET['param']);
?>
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?= $baseurl ?>/home/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $get['nama'] ?></strong></div>
    </div>
  </div>
</div>  

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <img src="<?= $baseurl ?>/images/produk/<?= $get['gambar'] ?>" alt="<?= $get['nama'] ?>" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h2 class="text-black"><?= ucwords($get['nama']) ?></h2>
        <p><?= $get['deskripsi_singkat'] ?></p>
        <p><strong class="text-primary h4">Rp.<?= number_format($get['harga']) ?>,-</strong></p>
        
        <div class="mb-5">
          <div class="input-group mb-3" style="max-width: 120px;">
          <div class="input-group-prepend">
            <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
          </div>
          <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Qty" aria-describedby="button-addon1" id="TxtQty">
          <div class="input-group-append">
            <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
          </div>
        </div>

        </div>
        <p>
          <a href="#" class="buy-now btn btn-sm btn-primary" id="BtnAddToCart">Add To Cart</a>
          <a href="#" class="buy-now btn btn-sm btn-danger" id="BtnAddToWishlist">Add To Wishlist</a>
        </p>

      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h3 class="text-black">Deskripsi</h3>
        <p><?= $get['deskripsi'] ?></p>
      </div>
    </div>

  </div>
</div>

<?php include 'product_script.php'; ?>