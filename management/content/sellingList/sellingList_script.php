<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		var active = "request";

		function loadActive(){
			if ( active == "pending" ) { 
				loadPending();
			} else if ( active == "request" ) {
				loadRequest();
			} else if ( active == "confirm" ) {
				loadConfirmed();
			} else if ( active == "prepare" ) {
				loadPrepare();
			} else if ( active == "ongoing" ) {
				loadOngoing();
			}
		}

		function loadRequest(){
			$(".BtnShowStatus").removeAttr("disabled");
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
			$(".DataInHere").empty();

			$(".LblLoading").css("display","block");
			$(".box-title").html("List Payment Pending");
			$(".DataInHere").load(baseurl + "/management/content/sellingList/pending.php");
			setTimeout(function(){
				$(".LblLoading").css("display","none");
			},1000);

			active = "pending";
		}
		function loadConfirmed(){
			$(".BtnShowStatus").removeAttr("disabled");
			$(".DataInHere").empty();

			$(".LblLoading").css("display","block");
			$(".box-title").html("List Payment Confirmed");
			$(".DataInHere").load(baseurl + "/management/content/sellingList/confirm.php");
			setTimeout(function(){
				$(".LblLoading").css("display","none");
			},1000);

			active = "confirm";
		}
		function loadPrepare(){
			$(".BtnShowStatus").removeAttr("disabled");
			$(".DataInHere").empty();

			$(".LblLoading").css("display","block");
			$(".box-title").html("List Item in Preparation");
			$(".DataInHere").load(baseurl + "/management/content/sellingList/prepare.php");
			setTimeout(function(){
				$(".LblLoading").css("display","none");
			},1000);

			active = "prepare";
		}
		function loadOngoing(){
			$(".BtnShowStatus").removeAttr("disabled");
			$(".DataInHere").empty();

			$(".LblLoading").css("display","block");
			$(".box-title").html("List Item Ongoing");
			$(".DataInHere").load(baseurl + "/management/content/sellingList/ongoing.php");
			setTimeout(function(){
				$(".LblLoading").css("display","none");
			},1000);

			active = "ongoing";
		}

		loadOngoing();

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
				case "BtnShowConfirm":
					loadConfirmed();
					break;
				case "BtnShowPrepare":
					loadPrepare();
					break;
				case "BtnShowOngoing":
					loadOngoing();
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
					table.empty();
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

		$(".DataInHere").on("click","#BtnAcceptPayment",function(e){
			e.preventDefault();
			var transaction = $(this).attr("data-id");
			swal({
				title : "Terima Pembayaran ?",
				text : "Yakin ingin menerima pembayaran orderan "+ transaction +" ?",
				icon : "warning",
				buttons : ["Tidak", "Ya, Lanjutkan"],
				dangerMode : false
			}).then(function(isConfirm){
				if ( isConfirm ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=acceptOrder",
						data : { transaction : transaction },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
		                		swal("Sukses!", "Berhasil Menerima Orderan", "success");
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

		$(".DataInHere").on("click","#BtnDeclinePayment",function(e){
			e.preventDefault();
			var transaction = $(this).attr("data-id");
			var reason;
			swal({
				text: 'Alasan penolakan?',
				content: "input",
				buttons : ["Tidak", "Ya, Lanjutkan"],
				dangerMode : false
			}).then(input => {
				if ( !(input == "" || input == " " || input == null) ) {
					reason = "ORDERAN " + transaction + " DITOLAK. " + input;
				} else if ( !(input == null) ) {
					reason = "PEMBAYARAN PADA ORDERAN "+ transaction +" DITOLAK.";
				} else {
					reason = null;
				}

				if ( !(reason == null) ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=declineOrder",
						data : { transaction : transaction, reason : reason },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
								swal("Sukses!", "Berhasil Menolak Orderan", "success");
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

		$(".DataInHere").on("click","#BtnToPrepMode",function(e){
			e.preventDefault();
			var transaction = $(this).attr("data-id");
			swal({
				title : "Siapkan produk ?",
				text : "Ubah status orderan "+ transaction +" ke 'Barang disiapkan' ?",
				icon : "warning",
				buttons : ["Tidak", "Ya, Lanjutkan"],
				dangerMode : false
			}).then(function(isConfirm){
				if ( isConfirm ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=prepStatusOrder",
						data : { transaction : transaction },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
		                		swal("Sukses!", "Berhasil Merubah status Orderan", "success");
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

		$(".DataInHere").on("click","#BtnShowInfoPengiriman",function(e){
			e.preventDefault();
			var transaction = $(this).attr("data-id");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getInvoice",
				data : { transaction : transaction },
				type : "post",
				dataType : "json",
				success : function(result) {
					$("#InfoModalNomor").html(transaction);
					$("#InfoModalNama").html(result.nama);
					$("#InfoModalAlamat").html(result.alamat);
					$("#InfoModalHP").html(result.nohp);
					$("#InfoModalEkspedisi").html(result.ekspedisi);

					$.ajax({
						url : baseurl + "/core/functions.php?cmd=getInvoiceDetail",
						data : { transaction : transaction },
						type : "post",
						dataType : "json",
						success : function(result) {
							var subtotal = 0;

							var table = $("#TblInfoModalOrderList");
							table.empty();
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

							$("#TblInfoModalOrderListTotal").html(total);
							$("#infopengirmanmodal").modal("show");
						}
					});
				}
			});
		});

		$("#BtnPrintInvoice").on("click",function(e){
			e.preventDefault();
			$.print("#PrintThisInvoice");
		});

		$(".DataInHere").on("click","#BtnToOngoing",function(e){
			e.preventDefault();
			var transaction = $(this).attr("data-id");
			var input;
			swal({
				text: 'Masukkan nomor resi',
				content: "input",
				buttons : ["Batal", "Submit"],
				dangerMode : false
			}).then(input => {
				if ( input == "" || input == " " || input == null ) {
					input = null;
				}

				if ( !(input == null) ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=sendItem",
						data : { transaction : transaction, resi : input },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
								swal("Sukses!", "Berhasil Memasukkan resi Orderan", "success");
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


	});
</script>