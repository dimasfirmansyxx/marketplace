<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var	user = "<?= $_SESSION["userInfo"]['id'] ?>"

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



	});
</script>