<?php 
  include '../../require.php';
?>
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>150</h3>

          <p>Order on Progress</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>53</h3>

          <p>Order this month</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>65</h3>

          <p>Order This Day</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>44</h3>

          <p>Buyer Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>
  
  <div class="row">

    <div class="col-lg-12">
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Grafik Bulanan</h3>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="bar-chart" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

<script>
  var bar = new Morris.Bar({
    element: 'bar-chart',
    resize: true,
    data: [
      {y: 'Jan', a: 100, b: 90},
      {y: 'Feb', a: 75, b: 65},
      {y: 'Mar', a: 50, b: 40},
      {y: 'Apr', a: 75, b: 65},
      {y: 'May', a: 50, b: 40},
      {y: 'Jun', a: 75, b: 65},
      {y: 'Jul', a: 100, b: 90},
    ],
    barColors: ['#00a65a', '#f56954'],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Penjualan', 'Pengeluaran'],
    hideHover: 'auto'
  });
</script>