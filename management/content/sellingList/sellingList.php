<?php 
  include '../../require.php';
?>
<section class="content-header">
  <h1>
    Order
  </h1>
  <br>
  <button class="btn btn-primary btn-sm btn-flat BtnShowStatus" id="BtnShowRequest">
    <i class="fa fa-exclamation-circle"></i> Payment Request
  </button>
  <button class="btn btn-success btn-sm btn-flat BtnShowStatus" id="BtnShowConfirm">
    <i class="fa fa-check-circle"></i> Payment Confirmed
  </button>
  <button class="btn btn-warning btn-sm btn-flat BtnShowStatus" id="BtnShowPrepare">
    <i class="fa fa-dropbox"></i> Item in Preparation
  </button>
  <button class="btn btn-secondary btn-sm btn-flat BtnShowStatus" id="BtnShowOngoing">
    <i class="fa fa-opencart"></i> Item Ongoing to Customer
  </button>
  <button class="btn btn-danger btn-sm btn-flat BtnShowStatus" id="BtnShowPending">
    <i class="fa fa-times"></i> Payment Pending
  </button>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Order List</li>
  </ol>
</section>

<section class="content">
  
  <div class="row">

    <div class="col-lg-12">
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <div class="box-body">
            <p class="LblLoading text-center">Sedang me-load data...</p>
            <div class="table-responsive DataInHere">
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

<div class="modal fade" id="orderlistmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order List</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="TblShowOrderList">
              
            </tbody>
            <tfoot>
              <tr>
                <th class="text-right" colspan="3">Subtotal + PPN (10%)</th>
                <th class="text-center" id="TblShowTotalOrderList"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="buktimodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bukti Pembayaran</h4>
      </div>
      <div class="modal-body text-center">
        <a href="#" target="_blank" id="LinkBuktiPembayaran">
          <img src="" width="300" id="ImgBuktiPembayaran">
        </a>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infopengirmanmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order List</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive mt-3">
          <table class="table">
            <tr>
              <td>Nomor Transaksi</td>
              <th>: <span id="InfoModalNomor"></span></th>
            </tr>
            <tr>
              <td>Nama</td>
              <th>: <span id="InfoModalNama"></span></th>
            </tr>
            <tr>
              <td>Alamat</td>
              <th>: <span id="InfoModalAlamat"></span></th>
            </tr>
            <tr>
              <td>Nomor Handphone</td>
              <th>: <span id="InfoModalHP"></span></th>
            </tr>
            <tr>
              <td>Paket Ekspedisi</td>
              <th>: <span id="InfoModalEkspedisi"></span></th>
            </tr>
          </table>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="TblInfoModalOrderList">
              
            </tbody>
            <tfoot>
              <tr>
                <th class="text-right" colspan="3">Subtotal + PPN (10%)</th>
                <th class="text-center" id="TblInfoModalOrderListTotal"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <a href="#" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
      </div>
    </div>
  </div>
</div>

<?php include 'sellingList_script.php' ?>