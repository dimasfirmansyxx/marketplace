<?php 
  include '../core/functions.php';
  if ( !isset($_SESSION["last_page"]) ) {
    $lastpage = "home";
  } else {
    $lastpage = $_SESSION["last_page"];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'components/head.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

  <div class="loading-area">
    <div class="container text-center">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <div class="wrapper">

    <?php include 'components/header.php'; ?>
    <?php include 'components/navbar.php'; ?>

    <div class="content-wrapper">
      
    </div>
    
    <?php include 'components/footer.php'; ?>
    <?php include 'components/control.php'; ?>


  </div>

  <?php include 'components/script.php'; ?>

  <script>
    $(document).ready(function(){

      var baseurl = "<?= $baseurl ?>";
      var lastpage = "<?= $lastpage ?>";

      $(".content-wrapper").load(baseurl + "/management/content/"+ lastpage +"/"+ lastpage +".php");
      $("#" + lastpage + "Menu").addClass("active");

      $(".navmenu").on("click",function(e){
        e.preventDefault();
        var href = $(this).attr("data-href");
        $(".loading-area").addClass("execute-loading");

        $.ajax({
          url : baseurl + "/core/functions.php?cmd=setSession",
          data : { name : "last_page", value : href },
          type : "post",
          success : function(){
            $(".navmenu").removeClass("active");
            $("#" + href + "Menu").addClass("active");
            $(".content-wrapper").load(baseurl + "/management/content/"+ href +"/"+ href +".php");
            $(".loading-area").removeClass("execute-loading");
          }
        });

      });



    });
  </script>


</body>
</html>
