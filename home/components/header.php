<header class="site-navbar" role="banner">
  <div class="site-navbar-top">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
          <form action="" class="site-block-top-search">
            <span class="icon icon-search2"></span>
            <input type="text" class="form-control border-0" placeholder="Search">
          </form>
        </div>

        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
          <div class="site-logo">
            <a href="<?= $baseurl ?>/home" class="js-logo-clone"><?= $siteName ?></a>
          </div>
        </div>

        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
          <div class="site-top-icons">
            <ul>
              <?php if ( $myFunc->checkSession("userSess") ): ?>
                <li>
                  <a href="<?= $baseurl ?>/home/page/profile/my" title="Profile">
                    <span class="icon icon-person"></span>
                  </a>
                </li>
                <li>
                  <a href="<?= $baseurl ?>/home/page/profile/notification" class="site-cart" title="Notification">
                    <span class="icon icon-bell"></span>
                    <span class="count total-notif-count">0</span>
                  </a>
                </li>
                <li>
                  <a href="<?= $baseurl ?>/home/page/profile/wishlist" title="Wishlist">
                    <span class="icon icon-heart-o"></span>
                  </a>
                </li>
                <li>
                  <a href="<?= $baseurl ?>/home/page/profile/order" class="site-cart" title="Order">
                    <span class="icon icon-menu"></span>
                  </a>
                </li>
                <li>
                  <a href="<?= $baseurl ?>/home/page/profile/cart" class="site-cart" title="Keranjang Belanja">
                    <span class="icon icon-shopping_cart"></span>
                    <span class="count total-cart-count">0</span>
                  </a>
                </li> 
                <li>
                  <a href="<?= $baseurl ?>/home/page/profile/logout" title="Logout">
                    <span class="icon icon-exit_to_app"></span>
                  </a>
                </li>
                <?php include 'custom_script.php'; ?>
              <?php else : ?>
                <li><a href="<?= $baseurl ?>/home/page/session/login"><span class="icon icon-person"></span></a></li>
              <?php endif ?>
              <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
            </ul>
          </div> 
        </div>

      </div>
    </div>
  </div> 
  <nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
      <ul class="site-menu js-clone-nav d-none d-md-block">
        <li class="has-children">
          <a href="index.html">Kategori</a>
          <ul class="dropdown">
            <?php $get = $myFunc->getKategori();?>
            <?php foreach ($get as $row): ?>
              <li>
                <a href="#">
                  <img src="<?= $baseurl ?>/images/cat_icon/<?= $row['icon'] ?>" height="15">
                  &nbsp;&nbsp; <?= ucwords($row['kategori']) ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </li>
        <li><a href="<?= $baseurl ?>/home/">Beranda</a></li>
        <li><a href="<?= $baseurl ?>/home/page/product/all">Produk</a></li>
        <li><a href="#">Tentang</a></li>
        <li><a href="#">Berita</a></li>
        <li><a href="#">Kontak</a></li>
        <li><a href="#">Cara Pembelian</a></li>
      </ul>
    </div>
  </nav>
</header>