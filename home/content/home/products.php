<section class="htc__product__area bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-style-tab">
                    <div class="tab-content another-product-style jump">
                        <div class="tab-pane active" id="home1">
                            <div class="row">
                                <div class="product__list another-product-style">
                                    <?php $get = $myFunc->getProduk(8); ?>
                                    <?php foreach($get as $row) : ?>
                                    <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                        <div class="product foo">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="#">
                                                        <img src="<?= $baseurl ?>/images/produk/<?= $row['gambar'] ?>" alt="product images" height="300">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                        <li><a title="Add To Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                        <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="#"><?= ucwords($row['nama']) ?></a></h2>
                                                <ul class="product__price">
                                                    <li class="new__price">Rp.<?= number_format($row['harga']) ?>,-</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="htc__loadmore__btn">
                                            <a href="<?= $baseurl ?>/home/page/products">produk lainnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>