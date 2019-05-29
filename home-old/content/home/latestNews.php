<section class="htc__blog__area bg__white pb--130">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title section__title--2 text-center">
                    <h2 class="title__line">Berita</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog__wrap clearfix mt--60 xmt-30">

                <?php for ($i = 0; $i < 3; $i++) : ?>
                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                    <div class="blog foo">
                        <div class="blog__inner">
                            <div class="blog__thumb">
                                <a href="blog-details.html">
                                    <img src="images/blog/blog-img/1.jpg" alt="blog images">
                                </a>
                                <div class="blog__post__time">
                                    <div class="post__time--inner">
                                        <span class="date">14</span>
                                        <span class="month">sep</span>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__hover__info">
                                <div class="blog__hover__action">
                                    <p class="blog__des"><a href="blog-details.html">Lorem ipsum dolor sit consectetu.</a></p>
                                    <ul class="bl__meta">
                                        <li>By :<a href="#">Admin</a></li>
                                        <li>Product</li>
                                    </ul>
                                    <div class="blog__btn">
                                        <a class="read__more__btn" href="blog-details.html">read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor ?>

            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="htc__loadmore__btn">
                        <a href="#">berita lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>