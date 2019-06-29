<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?= $baseurl ?>/home/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Keranjang Belanja</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-remove" width="50">#</th>
                <th class="product-thumbnail">Gambar</th>
                <th class="product-name">Produk</th>
                <th class="product-price">Harga</th>
                <th class="product-quantity" width="100">Qty</th>
                <th class="product-total">Subtotal</th>
              </tr>
            </thead>
            <tbody id="TableData-Cart">
              <tr>
                <td colspan="6">Sedang memuat data ...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-6">
            <a href="<?= $baseurl ?>/home/page/product/all" class="btn btn-outline-primary btn-sm btn-block">Lanjutkan Belanja</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Subtotal</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Total Belanja</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">Rp.<span id="LblTotalBelanja">0</span>,-</strong>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">PPN</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">10%</strong>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Subtotal</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">Rp.<span id="LblSubtotal">0</span>,-</strong>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <a href="<?= $baseurl ?>/home/page/profile/checkout" class="btn btn-primary btn-lg py-3 btn-block">Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'cart_script.php'; ?>