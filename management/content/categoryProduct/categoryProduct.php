<?php 
  include '../../require.php';
?>
<section class="content-header">
  <h1>
    Kategori Produk
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Produk</a></li>
    <li class="active">Kategori</li>
  </ol>
</section>

<section class="content">
  
  <div class="row">

    <div class="col-lg-12">
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">List Kategori</h3>
          </div>
          <div class="box-body">
            <button class="btn btn-primary btn-sm" id="BtnTambahKategori">Tambah Kategori</button>
            <br><br>
            <div class="table-responsive">

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

<div class="modal fade" id="TambahModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Kategori Produk</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormTambahKategori">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="kategori" class="form-control" required autocomplete="off" id="TxtNamaAddForm">
          </div>
          <div class="form-group">
            <label>Icon</label>
            <input type="file" name="icon" required id="TxtIconAddForm">
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
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Kategori Produk</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormEditKategori">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="kategori" class="form-control" required autocomplete="off" id="TxtNamaEditForm">
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
        <h4 class="modal-title">Edit Icon</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormEditGambar">
          <div class="form-group text-center">
            <img src="<?= $baseurl ?>/images/loader.gif" height="200" id="PictEditIconForm">
          </div>
          <div class="form-group">
            <input type="file" name="gambar" required id="TxtGambarEditIconForm">
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

<?php include 'categoryProduct_script.php' ?>