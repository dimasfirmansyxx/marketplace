<?php 
    include '../core/functions.php';
    $myFunc = new AllFunction();
?>
<!DOCTYPE HTML>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $siteTitle ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $baseurl ?>/images/logo.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/core.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/style.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/responsive.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/custom.css">
    <script src="<?= $baseurl ?>/home/js/jquery.3.3.1.min.js"></script>
    <script src="<?= $baseurl ?>/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

    <div class="wrapper">
        
        <?php include 'components/header.php'; ?>
        

        <?php if ( isset($_GET['page']) ) : ?>
            <?php
            
                if ( $_GET['page'] == "product" ) {
                    if ( $_GET['param'] == "all" ) {
                        include 'content/allproducts/products.php';
                    }
                } elseif ( $_GET['page'] == "session" ) {
                    if ( $_GET['param'] == "login" ) {
                        include 'content/session/login.php';
                    }
                }
            
            ?>
        <?php else : ?>

            <section class="categories-slider-area bg__white">
                <div class="container">
                    <div class="row">
                        
                        <?php include 'content/home/slider.php' ?>

                        <?php include 'content/home/categories.php' ?>

                    </div>
                </div>
            </section>

            <br><br>

            <?php include 'content/home/products.php' ?>
            
            <br><br><br>

            <?php include 'content/home/latestNews.php'; ?>

        <?php endif ?>

        <?php include 'components/footer.php'; ?>

    </div>


    <script src="<?= $baseurl ?>/home/js/vendor/jquery-1.12.0.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/bootstrap.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/plugins.js"></script>
    <script src="<?= $baseurl ?>/home/js/slick.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/owl.carousel.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/waypoints.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/main.js"></script>
</body>

</html>