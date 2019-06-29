<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		loadContent();
		CKEDITOR.replace('TxtAddFormDeskripsi');
		CKEDITOR.replace('TxtEditFormDeskripsi');
		
		function loadContent(){
			$(".table-responsive").load(baseurl + "/management/content/product/productShow.php");
		}
		function clearFormAdd() {
			$("#TxtAddFormNama").val("");
			$("#TxtAddFormGambar").val("");
			$("#TxtAddFormHarga").val("");
			$("#TxtAddFormBerat").val("");
			$("#TxtAddFormKategori").val("0");
			$("#TxtAddFormDeskripsiSingkat").val("");
			CKEDITOR.instances.TxtAddFormDeskripsi.setData("");
		}
		function clearFormEdit() {
			$("#TxtEditFormNama").val("wait ...");
			$("#TxtEditFormHarga").val("0");
			$("#TxtEditFormBerat").val("0");
			$("#TxtEditFormKategori").val("0");
			$("#TxtEditFormDeskripsiSingkat").val("wait ...");
			CKEDITOR.instances.TxtEditFormDeskripsi.setData("wait ...");

			$("#TxtEditFormNama").attr("disabled","disabled");
			$("#TxtEditFormGambar").attr("disabled","disabled");
			$("#TxtEditFormHarga").attr("disabled","disabled");
			$("#TxtEditFormBerat").attr("disabled","disabled");
			$("#TxtEditFormKategori").attr("disabled","disabled");
			$("#TxtEditFormDeskripsiSingkat").attr("disabled","disabled");
			CKEDITOR.instances.TxtEditFormDeskripsi.setReadOnly(true);
		}
		function clearReadOnlyFormEdit(){
			$("#TxtEditFormNama").removeAttr("disabled");
			$("#TxtEditFormGambar").removeAttr("disabled");
			$("#TxtEditFormHarga").removeAttr("disabled");
			$("#TxtEditFormBerat").removeAttr("disabled");
			$("#TxtEditFormKategori").removeAttr("disabled");
			$("#TxtEditFormDeskripsiSingkat").removeAttr("disabled");
			CKEDITOR.instances.TxtEditFormDeskripsi.setReadOnly(false);
		}
		function clearFormEditGambar(){
			$("#PictEditGambarForm").attr("src",baseurl + "/images/loader.gif");
			$("#TxtEditGambarFormGambar").val("");
		}
		function clearFormStok(){
			$("#TxtEditStokFormStok").val("0");
			$("#TxtEditStokFormStok").attr("disabled",'disabled');
		}


		$("#BtnTambahProduk").on("click",function(){
			$("#AddModal").modal("show");
			clearFormAdd();
		});

		$("#FormAdd").on("submit",function(e){
			e.preventDefault();
			var desc = CKEDITOR.instances.TxtAddFormDeskripsi.getData();
			var formdata = new FormData(this);
			formdata.append("deskripsi",desc);
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=addProduk",
				type : 'post',
				data : formdata,
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
                success : function(result) {
                	if ( result == "0" ) {
                		swal("Sukses!", "Berhasil Memasukkan Produk", "success");
                		clearFormAdd();
                		loadContent();
                	} else if ( result == "1" ) {
                		swal("Gagal!", "Produk Sudah Ada", "warning");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
                }
			});
		});

		$(".table-responsive").on("click","#BtnHapusProduk",function(e){
			e.preventDefault();

			var id = $(this).attr("href");

			swal({
				title : "Yakin ?",
				text : "Yakin ingin menghapus produk ini ?",
				icon : "warning",
				buttons : ["Tidak","Ya, Lanjutkan"],
				dangerMode : true
			}).then(function(isConfirm){
				if ( isConfirm ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=deleteProduk",
						data : { id : id },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
		                		swal("Sukses!", "Berhasil Menghapus Produk", "success");
		                		loadContent();
		                	} else if ( result == "3" ) {
		                		swal("Gagal!", "Produk Tidak Tersedia", "warning");
		                	} else if ( result == "2" ) {
		                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
		                	}
						}
					});
				}
			});
		});

		var idSelected;
		$(".table-responsive").on("click","#BtnEditProduk",function(e){
			e.preventDefault();
			idSelected = $(this).attr("href");
			$("#EditModal").modal("show");
			clearFormEdit();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getProdukInfo",
				data : { id : idSelected },
				type : "post",
				dataType : "json",
				success : function(result) {
					$("#TxtEditFormNama").val(result.nama);
					$("#TxtEditFormHarga").val(result.harga);
					$("#TxtEditFormBerat").val(result.berat);
					$("#TxtEditFormKategori").val(result.kategori_id);
					$("#TxtEditFormDeskripsiSingkat").val(result.deskripsi_singkat);
					CKEDITOR.instances.TxtEditFormDeskripsi.setData(result.deskripsi);
					clearReadOnlyFormEdit();
				}
			});
		});

		$("#FormEdit").on("submit",function(e){
			e.preventDefault();
			var desc = CKEDITOR.instances.TxtEditFormDeskripsi.getData();
			var formdata = new FormData(this);
			formdata.append("deskripsi",desc);
			formdata.append("id",idSelected);
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=editProduk",
				type : 'post',
				data : formdata,
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
                success : function(result) {
                	if ( result == "0" ) {
                		swal("Sukses!", "Berhasil Mengubah Produk", "success");
                		$("#EditModal").modal("hide");
                		clearFormEdit();
                		loadContent();
                	} else if ( result == "1" ) {
                		swal("Gagal!", "Produk Sudah Ada", "warning");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
                }
			});
		});

		$(".table-responsive").on("click","#BtnEditGambarProduk",function(e){
			e.preventDefault();
			idSelected = $(this).attr("href");
			clearFormEditGambar();
			$("#EditGambarModal").modal("show");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getProdukInfo",
				type : "post",
				data : { id : idSelected },
				dataType : "json",
				success : function(result){
					$("#PictEditGambarForm").attr("src",baseurl + "/images/produk/" + result.gambar);
				}
			});
		});

		$("#FormEditGambar").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id",idSelected);
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=changeGambarProduk",
				type : 'post',
				data : formdata,
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
                success : function(result) {
                	if ( result == "0" ) {
	            		swal("Sukses!", "Berhasil Mengganti Gambar Produk", "success");
	            		$("#EditGambarModal").modal("hide");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
                }
			});
		});

		$(".table-responsive").on("click","#BtnStokProduk",function(e){
			e.preventDefault();
			idSelected = $(this).attr("href");
			clearFormStok();
			$("#EditStokModal").modal("show");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getStokProduk",
				type : 'post',
				data : { id : idSelected },
				dataType : 'json',
				success : function(result) {
					$("#TxtEditStokFormStok").val(result);
					$("#TxtEditStokFormStok").removeAttr("disabled");
				}
			});
		});

		$("#FormEditStok").on("submit",function(e){
			e.preventDefault();
			var stok = $("#TxtEditStokFormStok").val();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=setStokProduk",
				type : 'post',
				data : { id : idSelected, stok : stok },
				dataType : 'json',
				success : function(result) {
					if ( result == "0" ) {
	            		swal("Sukses!", "Berhasil Mengganti Stok Produk", "success");
	            		$("#EditStokModal").modal("hide");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
				}
			});
		});

		$(".table-responsive").on("click","#BtnTambahStokProduk",function(e){
			e.preventDefault();
			idSelected = $(this).attr("href");
			$("#TambahStokModal").modal("show");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getStokProduk",
				type : 'post',
				data : { id : idSelected },
				dataType : 'json',
				success : function(result) {
					$("#LblJumlahStokFormStok").html("Jumlah Stok Saat Ini : " + result);
				}
			});
		});

		$("#FormTambahStok").on("submit",function(e){
			e.preventDefault();
			var stok = $("#TxtTambahStokFormStok").val();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=addStokProduk",
				type : 'post',
				data : { id : idSelected, stok : stok },
				dataType : 'json',
				success : function(result) {
					if ( result == "0" ) {
	            		swal("Sukses!", "Berhasil Menambah Stok Produk", "success");
	            		$("#LblJumlahStokFormStok").html("");
	            		$("#TambahStokModal").modal("hide");
	            		$("#TxtTambahStokFormStok").val("");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
				}
			});
		});

	});
</script>