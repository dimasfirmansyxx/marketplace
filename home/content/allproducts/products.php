<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?= $baseurl ?>/home">Beranda</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Semua Produk</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-9 order-2">

        <div class="row">
          <div class="col-md-12 mb-5">
            <div class="float-md-left mb-4"><h2 class="text-black h5">Produk</h2></div>
            <div class="d-flex">
              <div class="dropdown mr-1 ml-md-auto">
                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Sorting</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                  <a class="dropdown-item" href="#">Nama, A - Z</a>
                  <a class="dropdown-item" href="#">Nama, Z - A</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Harga, Terendah - Tertinggi</a>
                  <a class="dropdown-item" href="#">Harga, Tertinggi - Terendah</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">

          <?php $get = $myFunc->getProduk() ?>
          <?php foreach($get as $row) : ?>
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
              <div class="block-4 text-center border">
                <figure class="block-4-image">
                  <a href="<?= $baseurl ?>/home/page/product/<?= $row['id'] ?>"><img src="<?= $baseurl ?>/images/produk/<?= $row['gambar'] ?>" alt="<?= ucwords($row['nama']) ?>" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="shop-single.html"><?= ucwords($row['nama']) ?></a></h3>
                  <p class="text-primary font-weight-bold">Rp.<?= number_format($row['harga']) ?>,-</p>
                </div>
              </div>
            </div>
          <?php endforeach ?>

        </div>
        <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 order-1 mb-5 mb-md-0">

        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
          <ul class="list-unstyled mb-0">
            <?php $get = $myFunc->getKategori();?>
            <?php foreach ($get as $row): ?>
              <li class="mb-1"><a href="#" class="d-flex"><span><?= ucwords($row['kategori']) ?></span></a></li>
            <?php endforeach ?>
          </ul>
        </div>

      </div>
    </div>
    
  </div>
</div>