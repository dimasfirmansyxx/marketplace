<?php 
    include '../core/functions.php';
    $myFunc = new AllFunction();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $siteTitle ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= $baseurl ?>/images/logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="<?= $baseurl ?>/home/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/aos.css">
    <link rel="stylesheet" href="<?= $baseurl ?>/home/css/style.css">
    
    <script src="<?= $baseurl ?>/home/js/jquery-3.3.1.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/jquery-ui.js"></script>
    <script src="<?= $baseurl ?>/home/js/popper.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/bootstrap.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/owl.carousel.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= $baseurl ?>/home/js/aos.js"></script>
  </head>
  <body>
  
  <div class="site-wrap">

    <?php include 'components/header.php'; ?>

    <?php 
        if ( isset($_GET['page']) ) {
            if ( $_GET['page'] == "product" ) {
                if ( $_GET['param'] == "all" ) {
                    include 'content/allproducts/products.php';
                } else {
                    include 'content/product/product.php';
                }
            } elseif ( $_GET['page'] == "session" ) {
                if ( $_GET['param'] == "login" ) {
                    include 'content/session/login.php';
                } elseif ( $_GET['param'] == "register" ) {
                    include 'content/session/registrasi.php';
                }
            }
        } else {
            include 'content/home/home.php';  
        }
    ?>

    <?php include 'components/footer.php'; ?>

  </div>

    
    <script src="<?= $baseurl ?>/home/js/main.js"></script>
  </body>
</html>