<footer class="site-footer border-top">
  <div class="container">
    <div class="row">

      <div class="col-md-7 col-lg-3 mb-4 mb-lg-0">
        <h1 class=" mb-4"><?= $siteName ?></h1>
      </div>

      <div class="col-lg-5 mb-5 mb-lg-0">
        <div class="row">
          <div class="col-md-12">
            <h3 class="footer-heading mb-4">Informasi</h3>
          </div>
          <div class="col-md-6 col-lg-4">
            <ul class="list-unstyled">
              <li><a href="#">Tentang Kami</a></li>
              <li><a href="#">Kontak</a></li>
              <li><a href="#">Cara Pembelian</a></li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-4">
            <ul class="list-unstyled">
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Payment Method</a></li>
              <li><a href="#">Return</a></li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3">
        <div class="block-5 mb-5">
          <h3 class="footer-heading mb-4">Kontak</h3>
          <ul class="list-unstyled">
            <li class="address"><?= $siteIdentity['address'] ?></li>
            <li class="phone"><?= $siteIdentity['telephone'] ?></li>
            <li class="email"><?= $contactMail ?></li>
          </ul>
        </div>
      </div>

    </div>
    <div class="row pt-5 mt-5 text-center">
      <div class="col-md-12">
        <p>
            &copy; <?= date("Y") ?> <?= $siteName ?> | Template by Colorlib
        </p>
      </div>
      
    </div>
  </div>
</footer>