<footer class="htc__foooter__area gray-bg">
    <div class="container">
        <div class="row">
            <div class="footer__container clearfix">
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <div class="ft__widget">
                        <div class="ft__logo">
                            <a href="index.html">
                                <h1><?= $siteName ?></h1>
                            </a>
                        </div>
                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="address-icon">
                                        <i class="zmdi zmdi-pin"></i>
                                    </div>
                                    <div class="address-text">
                                        <p><?= $siteIdentity['address'] ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="address-icon">
                                        <i class="zmdi zmdi-email"></i>
                                    </div>
                                    <div class="address-text">
                                        <a href="#"> <?= $contactMail ?></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="address-icon">
                                        <i class="zmdi zmdi-phone-in-talk"></i>
                                    </div>
                                    <div class="address-text">
                                        <p><?= $siteIdentity['telephone'] ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-6 smt-30 xmt-30">
                    <div class="ft__widget">
                        <h2 class="ft__title">Kategori</h2>
                        <ul class="footer-categories">
                            <?php $get = $myFunc->getKategori();?>
                            <?php foreach ($get as $row): ?>
                                <li>
                                    <a href="#">
                                        <?= ucwords($row['kategori']) ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-6 smt-30 xmt-30">
                    <div class="ft__widget">
                        <h2 class="ft__title">Infomation</h2>
                        <ul class="footer-categories">
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li><a href="#">Cara Pembelian</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Payment Method</a></li>
                            <li><a href="#">Return</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Start Copyright Area -->
        <div class="htc__copyright__area">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="copyright__inner text-center">
                        <div class="copyright">
                            <p>&copy; <?= date("Y") ?> ObatSaya.com
                            All Right Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </div>
</footer>