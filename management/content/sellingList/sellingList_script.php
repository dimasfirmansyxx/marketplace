<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var active = "pending";

		function loadActive(){
			if ( active == "pending" ) { 
				loadPending();
			} else if ( active == "request" ) {
				loadRequest();
			} else if ( active == "confirm" ) {
				// loadConfirmed();
			} else if ( active == "prepare" ) {
				// loadPrepare();
			} else if ( active == "ongoing" ) {
				// loadOngoing();
			}
		}

		function loadRequest(){
			$(".BtnShowStatus").removeAttr("disabled");
			$("#BtnShowRequest").attr("disabled","disabled");
			$(".DataInHere").empty();

			$(".LblLoading").css("display","block");
			$(".box-title").html("List Payment Request");
			$(".DataInHere").load(baseurl + "/management/content/sellingList/request.php");
			setTimeout(function(){
				$(".LblLoading").css("display","none");
			},1000);

			active = "request";
		}
		function loadPending(){
			$(".BtnShowStatus").removeAttr("disabled");
			$("#BtnShowPending").attr("disabled","disabled");
			$(".DataInHere").empty();

			$(".LblLoading").css("display","block");
			$(".box-title").html("List Payment Pending");
			$(".DataInHere").load(baseurl + "/management/content/sellingList/pending.php");
			setTimeout(function(){
				$(".LblLoading").css("display","none");
			},1000);

			active = "pending";
		}

		loadRequest();

		$(".BtnShowStatus").on("click",function(e){
			e.preventDefault();
			var param = $(this).attr("id");
			switch (param) {
				case "BtnShowRequest":
					loadRequest();
					break;
				case "BtnShowPending":
					loadPending();
					break;
			}
		});


		$(".DataInHere").on("click","#BtnShowOrderList",function(){
			var transaction = $(this).attr("data-id");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getInvoiceDetail",
				data : { transaction : transaction },
				type : "post",
				dataType : "json",
				success : function(result) {
					var subtotal = 0;

					var table = $("#TblShowOrderList");
					$.each(result, function(){
						var tr = $("<tr/>");
						var td1 = $("<td>" + this.produk + "</td>");
						var td2 = $("<td>" + this.harga + "</td>");
						var td3 = $("<td>" + this.qty + "</td>");
						var td4 = $("<td>" + this.subtotal + "</td>");
						
						subtotal = subtotal + parseInt(this.subtotal); 

						tr.append(td1);
						tr.append(td2);
						tr.append(td3);
						tr.append(td4);

						table.append(tr);
					});

					var ppn = subtotal * 10 / 100;
					var total = ppn + subtotal;

					$("#TblShowTotalOrderList").html(total);
					$("#orderlistmodal").modal("show");
				}
			});
		});

		$(".DataInHere").on("click","#BtnDeletePaymentPending",function(){
			var transaction = $(this).attr("data-id");
			swal({
				title : "Hapus Orderan ?",
				text : "Yakin ingin menghapus orderan "+ transaction +" ?",
				icon : "warning",
				buttons : ["Tidak", "Ya, Lanjutkan"],
				dangerMode : true
			}).then(function(isConfirm){
				if ( isConfirm ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=deleteOrder",
						data : { transaction : transaction },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
		                		swal("Sukses!", "Berhasil Menghapus Orderan", "success");
		                		loadActive();
		                	} else if ( result == "3" ) {
		                		swal("Gagal!", "Orderan tidak tersedia", "warning");
		                	} else if ( result == "2" ) {
		                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
		                	}
						}
					});
				}
			});
		});

		$(".DataInHere").on("click","#BtnShowBukti",function(e){
			e.preventDefault();
			var transaction = $(this).attr("data-id");
			$("#ImgBuktiPembayaran").attr("src",baseurl + "/images/loader.gif");
			$("#LinkBuktiPembayaran").attr("href","#");
			$("#buktimodal").modal("show");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getProofOfPayment",
				data : { transaction : transaction },
				type : "post",
				dataType : "json",
				success : function(result) {
					$("#ImgBuktiPembayaran").attr("src",baseurl + "/images/bukti_pembayaran/" + result.bukti);	
					$("#LinkBuktiPembayaran").attr("href",baseurl + "/images/bukti_pembayaran/" + result.bukti);
				}
			});
		});

	});
</script>