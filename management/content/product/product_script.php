<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";
		loadContent();
		CKEDITOR.replace('TxtAddFormDeskripsi');
		
		function loadContent(){
			$(".table-responsive").load(baseurl + "/management/content/product/productShow.php");
		}
		function clearFormAdd() {
			$("#TxtAddFormNama").val("");
			$("#TxtAddFormGambar").val("");
			$("#TxtAddFormHarga").val("");
			$("#TxtAddFormKategori").val("0");
			$("#TxtAddFormDeskripsiSingkat").val("");
			$("#TxtAddFormDeskripsi").val("");
		}


		$("#BtnTambahProduk").on("click",function(){
			$("#AddModal").modal("show");
			clearFormAdd();
		});

		$("#FormAdd").on("submit",function(e){
			e.preventDefault();
			var desc = $("#TxtAddFormDeskripsiSingkat").val();
			console.log(1);
			return;
			$.ajax({
				url : baseurl + "/core/request.php",
				type : 'post',
				data : new FormData(this),
				contentType: false,
                cache: false,
                processData:false,
                dataType : 'json',
                success : function(result) {

                }
			});
		});

	});
</script>