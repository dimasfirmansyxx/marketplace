<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var	user = "<?= $_SESSION["userInfo"]['id'] ?>"

	    $("#CmbEkspedisi").on("change",function(){
	    	var expedition = $(this).val();
	    	var destination = "<?= $idkota ?>";
	    	var weight = "<?= $berat ?>";
	    	var package = "0";

	    	if ( expedition == "jne reg" || expedition == "jne oke" ) {
	    		package = expedition;
	    		expedition = "jne";
	    	}

	    	if ( expedition == 0 ) {
	    		swal("Pilih Ekspedisi","Harus memilih salah satu ekspedisi yang tersedia","warning");
	    	} else {
	    		$.ajax({
	    			url : baseurl + "/core/functions.php?cmd=getOngkir",
	    			data : { destination : destination , expedition : expedition , weight : weight, package : package },
	    			type : "post",
	    			dataType : "json",
	    			success : function(result) {
	    				$("#LblOngkosKirim").html(result);
	    				var grandtotal = parseInt(result) + parseInt(<?= $total ?>);
	    				$("#LblGrandTotal").html(grandtotal);
	    			}
	    		});
	    	}
	    });

	    $("#BtnCheckout").on("click",function(e){
	    	e.preventDefault();
	    	var expedition = $("#CmbEkspedisi").val();
	    	var package = "0";

	    	if ( expedition == "jne reg" || expedition == "jne oke" ) {
	    		package = expedition;
	    		expedition = "jne";
	    	}

	    	if ( expedition == 0 ) {
	    		swal("Pilih Ekspedisi","Harus memilih salah satu ekspedisi yang tersedia","warning");
	    	} else {
	    		$("#BtnCheckout").html("PROCESSING ...");
	    		$("#BtnCheckout").attr("disabled","disabled");
	    		$.ajax({
	    			url : baseurl + "/core/functions.php?cmd=makeOrder",
	    			data : { expedition : expedition, user : user, package : package },
	    			type : "post",
	    			dataType : "json",
	    			success : function(result){
	    				$("#BtnCheckout").html("Checkout");
			    		$("#BtnCheckout").removeAttr("disabled");
	    				swal("Sukses","Silahkan melanjutkan pembayaran","success");
	    				window.location = baseurl + "/home/";
	    			}
	    		})
	    	}
	    });


	});
</script>