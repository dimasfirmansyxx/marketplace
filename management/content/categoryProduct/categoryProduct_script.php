<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";

		function loadContent(){
			$(".table-responsive").load(baseurl + "/management/content/categoryProduct/categoryProductShow.php");
		}
		function clearFormAdd(){
			$("#TxtNamaAddForm").val("");
			$("#TxtIconAddForm").val("");
		}
		function clearFormEdit(){
			$("#TxtNamaEditForm").val("");
			$("#TxtNamaEditForm").attr("disabled","disabled");
		}
		function clearFormEditGambar(){
			$("#PictEditIconForm").attr("src",baseurl + "/images/loader.gif");
			$("#TxtGambarEditIconForm").val("");
		}

		loadContent();

		$("#BtnTambahKategori").on("click",function(){
			clearFormAdd();
			$("#TambahModal").modal("show");
		});

		$("#FormTambahKategori").on("submit",function(e){
			e.preventDefault();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=addKategori",
				type : 'post',
				data : new FormData(this),
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
                success : function(result) {
                	if ( result == "0" ) {
                		swal("Sukses!", "Berhasil Memasukkan Kategori Produk", "success");
                		clearFormAdd();
                		loadContent();
                	} else if ( result == "1" ) {
                		swal("Gagal!", "Kategori Sudah Ada", "warning");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
                }
			});
		});

		$(".table-responsive").on("click","#BtnHapusKategori",function(e){
			e.preventDefault();
			var id = $(this).attr("href");

			swal({
				title : "Yakin ingin menghapus kategori ini?",
				text : "Dengan menghapusnya, produk dengan kategori ini juga ikut terhapus",
				icon : "warning",
				buttons : ["Tidak", "Ya, Lanjutkan"],
				dangerMode : true
			}).then(function(isConfirm){
				if ( isConfirm ) {
					$.ajax({
						url : baseurl + "/core/functions.php?cmd=deleteKategori",
						data : { id : id },
						type : "post",
						dataType : "json",
						success : function(result) {
							if ( result == "0" ) {
		                		swal("Sukses!", "Berhasil Menghapus Kategori", "success");
		                		loadContent();
		                	} else if ( result == "3" ) {
		                		swal("Gagal!", "Kategori Tidak Tersedia", "warning");
		                	} else if ( result == "2" ) {
		                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
		                	}
						}
					});
				}
			});
		});


		var idSelected;

		$(".table-responsive").on("click","#BtnEditKategori",function(e){
			e.preventDefault();
			idSelected = $(this).attr("href");
			clearFormEdit();
			$("#EditModal").modal("show");
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getKategoriProduk",
				data : { id : idSelected },
				type : "post",
				dataType : "json",
				success : function(result) {
					$("#TxtNamaEditForm").val(result.kategori);
					$("#TxtNamaEditForm").removeAttr("disabled");
				}
			});
		});

		$("#FormEditKategori").on("submit",function(e){
			e.preventDefault();
			var kategori = $("#TxtNamaEditForm").val();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=editKategori",
				data : { id : idSelected, kategori : kategori },
				type : "post",
				dataType : "json",
				success : function(result) {
					if ( result == "0" ) {
                		swal("Sukses!", "Berhasil Mengubah Kategori", "success");
                		$("#EditModal").modal("hide");
                		loadContent();
                	} else if ( result == "1" ) {
                		swal("Gagal!", "Kategori Sudah Ada", "warning");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
				}
			});
		});

		$(".table-responsive").on("click","#BtnEditIconKategori",function(e){
			e.preventDefault();
			idSelected = $(this).attr("href");
			$("#EditGambarModal").modal("show");
			clearFormEditGambar();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=getKategoriProduk",
				data : { id : idSelected },
				type : "post",
				dataType : "json",
				success : function(result) {
					$("#PictEditIconForm").attr("src", baseurl + "/images/cat_icon/" + result.icon);
				}
			});
		});

		$("#FormEditGambar").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id",idSelected);
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=changeIconKategori",
				type : 'post',
				data : formdata,
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
                success : function(result) {
                	if ( result == "0" ) {
	            		swal("Sukses!", "Berhasil Mengganti Icon", "success");
	            		loadContent();
	            		$("#EditGambarModal").modal("hide");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
                }
			});
		});


	});
</script>