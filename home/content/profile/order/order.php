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