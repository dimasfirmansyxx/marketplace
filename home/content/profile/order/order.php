<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?= $baseurl ?>/home/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Order List</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12 mb-5">
        <button class="btn btn-primary BtnShowStatus" id="BtnShowProgress">On Progress</button>
        <button class="btn btn-success BtnShowStatus" id="BtnShowSuccess">Orderan Selesai</button>
        <button class="btn btn-danger BtnShowStatus" id="BtnShowDecline">Orderan Ditolak</button>
      </div>
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50">#</th>
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="TableData">
              <tr id="LblLoading">
                <td colspan="6">Sedang memuat data ...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>

  </div>
</div>

<div class="modal fade" id="modalOrderList" tabindex="-1" role="dialog" style="z-index : 9999;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center LblLoadingOrderListOnModal">Sedang me-load data...</p>
        <div class="content-orderlist container">
          <div class="row">
            <div class="col-md-4">
              <p>No Transaksi</p>
            </div>
            <div class="col-md-8">
              <p id="LblNoTransaksiModal">123</p>
            </div>
          </div>
          <div class="row">
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
                <tbody id="DataOrderListOnModal">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include 'order_script.php'; ?>