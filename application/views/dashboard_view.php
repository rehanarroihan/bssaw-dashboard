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
            <h3>9999</h3>

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
            <h3>9999</h3>

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
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Report Pekerjaan Petugas</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label>Filter Range Waktu</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-clock"></i></span>
            </div>
            <input type="text" class="form-control float-right" id="reservationtime">
          </div>
        </div>
        <!-- result info -->
        <h6 class="mb-2"><b>Summary</b></h6>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-tools"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Maintenance</span>
                <span class="info-box-number">9999</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-tv"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Installation</span>
                <span class="info-box-number">9999</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-hand-paper"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Preventive</span>
                <span class="info-box-number">9999</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa fa-walking"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Visit</span>
                <span class="info-box-number">9999</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-broadcast-tower"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">BTS</span>
                <span class="info-box-number">9999</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        <table id="reportTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Petugas</th>
              <th>Jenis Pekerjaan</th>
              <th>Waktu Mulai</th>
              <th>Waktu Berakhir</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Ahmad Shobirin</td>
              <td>Maintenance</td>
              <td>Kamis, 20 Januari 2020 14.00</td>
              <td>Kamis, 20 Januari 2020 19.00</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ahmad Munirus</td>
              <td>BTS</td>
              <td>Kamis, 20 Januari 2020 12.00</td>
              <td>Kamis, 20 Januari 2020 16.00</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Hidayat Kurnio</td>
              <td>Visit</td>
              <td>Kamis, 20 Januari 2020 08.00</td>
              <td>Kamis, 20 Januari 2020 10.00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){ 
  $('#reportTable').DataTable();
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })
}, false);

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