<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var	user = "<?= $_SESSION["userInfo"]['id'] ?>"

		function loadContent(){
			$("#TableData-Cart").load(baseurl + "/home/content/profile/cart/cartShow.php");
		}
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
	    function getTotalShopping(){
	    	$.ajax({
	    		url : baseurl + "/core/functions.php?cmd=getTotalPriceOnCart",
	    		type : "post",
	    		data : { user : user },
	    		dataType : "json",
	    		success : function(result){
	    			$("#LblTotalBelanja").html(result);
	    			var ppn = result * 10 / 100;
	    			$("#LblSubtotal").html(result + ppn);
	    		}
	    	});
	    }

	    getTotalShopping();
		loadContent();

		$("#TableData-Cart").on("change",".TxtQty",function(){
			var newqty = $(this).val();
			var id = $(this).attr("data-id");
			var produk = $(this).attr("data-produk");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=setNewQty",
				type : "post",
				data : { id : id, qty : newqty, produk : produk },
				dataType : "json",
				success : function(result){
					if ( result == "3" ) {
						swal("Gagal!", "Stok Produk sudah habis", "warning");
					} else if ( result == "2" ) {
						swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
					}
					loadContent();
					getTotalShopping();
				}
			});
		});

		$("#TableData-Cart").on("click",".BtnDelete",function(e){
			e.preventDefault();
			var id = $(this).attr("href");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=deleteCart",
				type : "post",
				data : { id : id, user : user },
				dataType : "json",
				success : function(result) {
					if ( result == "2" ) {
						swal("Gagal!","Terjadi kesalahan pada Server","error");
					}
					loadContent();
					getTotalItemOnCart();
					getTotalShopping();
				}
			});
		});


	});
</script>