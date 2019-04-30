<?php 
  include '../../require.php';
  $getCategory = $myFunc->getKategori();
?>
<section class="content-header">
  <h1>
    Produk
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Produk</li>
    <li class="active">Manajemen</li>
  </ol>
</section>

<section class="content">
  
  <div class="row">

    <div class="col-lg-12">
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">List Produk</h3>
          </div>
          <div class="box-body">
            <button class="btn btn-primary btn-sm" id="BtnTambahProduk">Tambah Produk</button>
            <br><br>
            <div class="table-responsive">

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

<div class="modal fade" id="AddModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Produk</h4>
      </div>
      <div class="modal-body">
        <form id="FormAdd" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required autocomplete="off" id="TxtAddFormNama">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Gambar Produk</label>
                <input type="file" name="gambar" required id="TxtAddFormGambar">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required id="TxtAddFormHarga">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control" id="TxtAddFormKategori">
              <option value="0">--- Pilih Kategori ---</option>
              <?php foreach ($getCategory as $row): ?>
                <option value="<?= $row['id'] ?>"><?= ucwords($row['kategori']) ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Deskripsi Singkat</label>
            <textarea name="descsingkat" class="form-control" rows="5" id="TxtAddFormDeskripsiSingkat"></textarea>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="TxtAddFormDeskripsi"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include 'product_script.php'; ?>