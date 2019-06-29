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
        <form action="" method="post" id="FormAdd">
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
                <input type="number" name="harga" required class="form-control" id="TxtAddFormHarga">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control" id="TxtAddFormKategori">
                  <option value="0">--- Pilih Kategori ---</option>
                  <?php foreach ($getCategory as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= ucwords($row['kategori']) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Berat (gram)</label>
                <input type="number" name="berat" class="form-control" id="TxtAddFormBerat" required>
              </div>
            </div> 
          </div>
          <div class="form-group">
            <label>Deskripsi Singkat</label>
            <textarea name="descsingkat" class="form-control" required rows="5" id="TxtAddFormDeskripsiSingkat"></textarea>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required id="TxtAddFormDeskripsi"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Produk</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormEdit">
          <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required autocomplete="off" id="TxtEditFormNama">
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required class="form-control" id="TxtEditFormHarga">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control" id="TxtEditFormKategori">
                  <option value="0">--- Pilih Kategori ---</option>
                  <?php foreach ($getCategory as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= ucwords($row['kategori']) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Berat (gram)</label>
                <input type="number" name="berat" class="form-control" id="TxtEditFormBerat" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Deskripsi Singkat</label>
            <textarea name="descsingkat" class="form-control" required rows="5" id="TxtEditFormDeskripsiSingkat"></textarea>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required id="TxtEditFormDeskripsi"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditGambarModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Gambar Produk</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormEditGambar">
          <div class="form-group text-center">
            <img src="<?= $baseurl ?>/images/loader.gif" height="200" id="PictEditGambarForm">
          </div>
          <div class="form-group">
            <input type="file" name="gambar" required id="TxtEditGambarFormGambar">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditStokModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Stok Produk</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormEditStok">
          <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required class="form-control" id="TxtEditStokFormStok">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="TambahStokModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Stok Produk</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormTambahStok">
          <p class="text-center" id="LblJumlahStokFormStok"></p>
          <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required class="form-control" id="TxtTambahStokFormStok">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include 'product_script.php'; ?>