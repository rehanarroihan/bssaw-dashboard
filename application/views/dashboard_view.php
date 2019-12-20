<div id="app">
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          Dashboard
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>

            <p>Pegawai</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>4</h3>

            <p>Pekerjaan Berjalan Saat Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          Report
        </h1>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->
</div>
<script>

var app = new Vue({
	el: '#app',
	data: {
    baseURL: '<?php echo base_url() ?>',
	},
	methods: {

  },
	mounted: function() {
    
	}
});
</script>