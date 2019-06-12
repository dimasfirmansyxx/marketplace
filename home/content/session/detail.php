<?php 
	$getProvince = $myFunc->getRegion("province");
?>
<div class="site-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Detail Profil</h1>
				<form class="text-left" id="FormDetailUser">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="date" name="tgllahir" class="form-control" required id="TxtTglLahir">
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jk" class="form-control" required id="CmbJenisKelamin">
									<option value="0">--- Pilih Satu ---</option>
									<option value="l">Laki-Laki</option>
									<option value="p">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Nomor Handphone</label>
								<input type="text" name="nohp" class="form-control" maxlength="12" id="TxtNoHp" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Provinsi</label>
								<select name="provinsi" class="form-control" id="CmbProvinsi">
									<option value="0">--- Pilih Satu ---</option>
									<?php foreach ($getProvince as $row): ?>
										<option value="<?= $row['id'] ?>"><?= $row['province'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label>Kota</label>
								<select name="kota" class="form-control" id="CmbKota">
									<option value="0">-- Pilih Provinsi Terlebih Dahulu --</option>
								</select>
							</div>
							<div class="form-group">
								<label>Kode Pos</label>
								<input type="number" name="kodepos" class="form-control" id="TxtKodePos" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" name="alamat" id="TxtAlamat" required rows="5"></textarea>
							</div>
						</div>
					</div>
					<button class="btn btn-primary btn-block" type="submit" id="BtnSubmit">Submit</button>
				</form>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";

		$("#CmbProvinsi").on("change",function(){
			var value = $(this).val();
			if ( value == 0 ) {
				$("#CmbKota").find("option").remove();
				$("#CmbKota").append("<option value='0'>-- Pilih Provinsi Terlebih Dahulu --</option>");
			} else {
				$("#CmbKota").find("option").remove();
				$("#CmbKota").append("<option value='0'>Please Wait ...</option>");
				$("#CmbKota").attr("disabled","disabled");
				$.ajax({
					url : baseurl + "/core/functions.php?cmd=getRegion",
					type : "post",
					data : { type : "city", value : value },
					dataType : "json",
					success : function(result) {
						$("#CmbKota").removeAttr("disabled");
						$("#CmbKota").find("option").remove();
						$("#CmbKota").append("<option value='0'>-- Pilih Satu --</option>");
						var select = $("#CmbKota");
						$.each(result, function(i,j){
							var option = $("<option/>");
							option.html(j.city);
							option.val(j.id);

							select.append(option);
						});
					}
				});
			}
		});

		$("#FormDetailUser").on("submit",function(e){
			e.preventDefault();
			var id = "<?= $_SESSION["userInfo"]['id'] ?>"
			var tgllahir = $("#TxtTglLahir").val();
			var jk = $("#CmbJenisKelamin").val();
			var nohp = $("#TxtNoHp").val();
			var provinsi = $("#CmbProvinsi").val();
			var kota = $("#CmbKota").val();
			var kodepos = $("#TxtKodePos").val();
			var alamat = $("#TxtAlamat").val();

			if ( jk == 0 ) {
				swal("Gagal","Pilih Jenis Kelamin","warning");
			} else if ( provinsi == 0 ) {
				swal("Gagal","Pilih Provinsi","warning");
			} else if ( kota == 0 ) {
				swal("Gagal","Pilih Kota","warning");
			} else {
				$.ajax({
					url : baseurl + "/core/functions.php?cmd=setUserDetail",
					type : "post",
					data : { id : id, tgllahir : tgllahir, jk : jk, nohp : nohp, provinsi : provinsi,
							 kota : kota, kodepos : kodepos, alamat : alamat },
					dataType : "json",
					success : function(result) {
						if ( result == "0" ) {
							swal("Sukses","Sukses Menambahkan detail Profil","success");
						} else if ( result == "1" ) {
							swal("Gagal","Anda telah melengkapi detail profil","warning");
						} else if ( result == "2" ) {
							swal("Gagal","Kesalahan pada server","error");
						}
					}
				});
			}
		});

	});
</script>