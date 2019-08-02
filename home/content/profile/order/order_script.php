<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var	user = "<?= $_SESSION["userInfo"]['id'] ?>";
		var lastpage = "progress";

		function loadProgress(){
			$("#LblLoading").css("visibility","show");
			setTimeout(function(){
				$(".BtnShowStatus").removeAttr("disabled");
				$("#BtnShowProgress").attr("disabled","disabled");
				$("#TableData").load(baseurl + "/home/content/profile/order/progress.php");
				$("#LblLoading").css("visibility","hidden");
			},1000);
			lastpage = "progress";
		}

	    function loadContent(){
			if ( lastpage == "progress" ) {
				loadProgress();
			}
		}

		loadContent();

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

		var transactionId = "0";

		$("#TableData").on("click","#BtnDoPayment",function(e){
			e.preventDefault();
			transactionId = $(this).attr("data-id");
			$("#modalDoPayment").modal("show");
		});

		$("#FormUploadBukti").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("user",user);
			formdata.append("transaction",transactionId);
			$("#BtnKirimOnUploadBukti").html("Sedang Mengirim");
			$("#BtnKirimOnUploadBukti").attr("disabled","disabled");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=uploadProofOfPayment",
				type : 'post',
				data : formdata,
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
				success : function(result) {
					if ( result == "0" ) {
                		swal("Sukses!", "Berhasil mengirim request pembayaran", "success");
                		loadContent();
                	} else if ( result == "1" ) {
                		swal("Gagal!", "Sudah pernah melakukan pengiriman request pembayaran", "warning");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	} else if ( result == "5" ) {
						swal("Gagal!", "Ekstensi file tidak diperbolehkan","error");
					} else {
						swal("Gagal!", "Terdapat kesalahan","error");
					}
					$("#BtnKirimOnUploadBukti").html("Kirim");
					$("#BtnKirimOnUploadBukti").removeAttr("disabled");
				}
			});
		});

	});
</script>