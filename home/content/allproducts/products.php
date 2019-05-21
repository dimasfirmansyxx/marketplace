<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Semua Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="product__list another-product-style">
        <!-- Start Single Product -->
        <?php $get = $myFunc->getProduk() ?>
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
                                <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__details">
                        <h2><a href="product-details.html"><?= ucwords($row['nama']) ?></a></h2>
                        <ul class="product__price">
                            <li class="new__price">Rp.<?= number_format($row['harga']) ?>,-</li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</div>