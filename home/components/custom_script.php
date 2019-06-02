<script>
	$(document).ready(function(){

		var user = "<?= $_SESSION['userInfo']['id'] ?>";
		var baseurl = "<?= $baseurl ?>";

		getTotalItemOnCart();

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

	});
</script>