<?php 
  include '../../require.php';
?>
<section class="content-header">
  <h1>
    Manajemen Admin
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Manajemen Admin</li>
  </ol>
</section>

<section class="content">
  
  <div class="row">

    <div class="col-lg-12">
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Admin</h3>
          </div>
          <div class="box-body">
            <button class="btn btn-primary btn-sm" id="BtnTambahAdmin">Tambah Admin</button>
            <br><br>
            <div class="table-responsive DataInHere">

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

<div class="modal fade" id="ModalTambahAdmin">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Admin</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="FormTambahAdmin">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required autocomplete="off">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" maxlength="16" class="form-control" required autocomplete="off">
            <small>Maks. 16 Karakter</small>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" maxlength="16" class="form-control" required autocomplete="off">
            <small>Maks. 16 Karakter</small>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autocomplete="off">
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

<?php include 'manageAdmin_script.php' ?>