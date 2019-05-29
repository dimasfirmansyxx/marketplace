<div class="site-section block-3 site-blocks-2 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Produk</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="nonloop-block-3 owl-carousel">
          <?php $get = $myFunc->getProduk(8); ?>
          <?php foreach($get as $row) : ?>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="<?= $baseurl ?>/images/produk/<?= $row['gambar'] ?>" alt="<?= ucwords($row['nama']) ?>" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#"><?= ucwords($row['nama']) ?></a></h3>
                  <p class="text-primary font-weight-bold">Rp.<?= number_format($row['harga']) ?>,-</p>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
        <div class="text-center">
          <a href="<?= $baseurl ?>/home/page/product/all" class="btn btn-primary">SEMUA PRODUK</a>
        </div>
      </div>
    </div>
  </div>
</div>