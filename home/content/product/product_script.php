<script>
  $(document).ready(function(){

    var baseurl = "<?= $baseurl ?>";
    var user = "<?= $_SESSION['userInfo']['id'] ?>";
    var produk = "<?= $get['id'] ?>";

    function getTotalItemOnCart(){
      $.ajax({
        url : baseurl + "/core/functions.php?cmd=getTotalItemOnCart",
        type : "post",
        data : { id : user },
        dataType : "json",
        success : function(result){
          if ( result == "0" ) {
            $(".total-cart-count").css("display","none");
          } else {
            $(".total-cart-count").css("display","block");
            $(".total-cart-count").html(result);
          }
        }
      });
    }

    $("#BtnAddToWishlist").on("click",function(e){
      e.preventDefault();
      $.ajax({
        url : baseurl + "/core/functions.php?cmd=addToWishlist",
        type : "post",
        data : { user_id : user, produk_id : produk },
        dataType : "json",
        success : function(result) {
          if ( result == "0" ) {
            swal("Sukses!", "Berhasil Menambah Produk ke dalam Wishlist", "success");
          } else if ( result == "1" ) {
            swal("Gagal!", "Produk sudah tersedia di dalam Wishlist anda", "warning");
          } else if ( result == "2" ) {
            swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
          }
        }
      });
    });

    $("#BtnAddToCart").on("click",function(e){
      e.preventDefault();
      var qty = $("#TxtQty").val();
      $.ajax({
        url : baseurl + "/core/functions.php?cmd=addToCart",
        type : "post",
        data : { user_id : user, produk_id : produk, qty : qty },
        dataType : "json",
        success : function(result){
          getTotalItemOnCart();
          if ( result == "0" ) {
            swal("Sukses!", "Berhasil Menambah Produk ke dalam Keranjang Belanja", "success");
          } else if ( result == "3" ) {
            swal("Gagal!", "Stok Produk sudah habis", "warning");
          } else if ( result == "2" ) {
            swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
          }
        }
      });
    });

  });
</script>