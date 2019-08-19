<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";

		$("#BtnTambahAdmin").on("click",function(){
			$("#ModalTambahAdmin").modal("show");
		});

		$("#FormTambahAdmin").on("submit",function(e){
			e.preventDefault();
			var data = $(this).serializeArray();
			$.ajax({
				url : baseurl + "/core/functions.php?cmd=addAdmin",
				data : data,
				type : "post",
				dataType : "json",
				success : function(result) {
					if ( result == "0" ) {
                		swal("Sukses!", "Berhasil Menambahkan admin", "success");
                	} else if ( result == "1" ) {
                		swal("Gagal!", "Username Sudah Ada", "warning");
                	} else if ( result == "2" ) {
                		swal("Gagal!", "Terjadi Kesalahan pada Server", "error");
                	}
				}
			});
		});

	});
</script>