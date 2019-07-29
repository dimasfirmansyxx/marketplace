<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var	user = "<?= $_SESSION["userInfo"]['id'] ?>"

		function loadProgress(){
			$("#LblLoading").css("visibility","show");
			setTimeout(function(){
				$(".BtnShowStatus").removeAttr("disabled");
				$("#BtnShowProgress").attr("disabled","disabled");
				$("#TableData").load(baseurl + "/home/content/profile/order/progress.php");
				$("#LblLoading").css("visibility","hidden");
			},1000);
		}

	    loadProgress();

		$("#TableData").on("click","#BtnShowOrderList",function(e){
			e.preventDefault();
			$(".LblLoadingOrderListOnModal").css("display","block");
			$(".content-orderlist").css("display","none");
			var transaction = $(this).attr("data-id");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getInvoiceDetail",
				data : { transaction : transaction },
				type : "post",
				dataType : "json",
				success : function(result){
					var table = $("#DataOrderListOnModal");
					$.each(result, function(){
						var tr = $("<tr/>");
						var produk = $("<td>" + this.produk + "</td>");
						var harga = $("<td>" + this.harga + "</td>");
						var qty = $("<td>" + this.qty + "</td>");
						var subtotal = $("<td>" + this.subtotal + "</td>");

						tr.append(produk);
						tr.append(harga);
						tr.append(qty);
						tr.append(subtotal);

						table.append(tr);
					});
					$("#LblNoTransaksiModal").html(transaction);
					$(".LblLoadingOrderListOnModal").css("display","none");
					$(".content-orderlist").css("display","block");
					$("#modalOrderList").modal("show");
				}
			});
		});

	});
</script>