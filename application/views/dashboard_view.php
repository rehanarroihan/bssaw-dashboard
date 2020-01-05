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
            <h3><?php echo $dashboard_data['employees'] ?></h3>
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
            <h3><?php echo $dashboard_data['running_tasks'] ?></h3>
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
<section class="content" v-cloak>
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
            <input type="text" class="form-control float-right" id="report-range">
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
                <span class="info-box-number">{{ reportData.summary.maintenance }}</span>
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
                <span class="info-box-number">{{ reportData.summary.installation }}</span>
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
                <span class="info-box-number">{{ reportData.summary.preventive }}</span>
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
                <span class="info-box-number">{{ reportData.summary.visit }}</span>
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
                <span class="info-box-number">{{ reportData.summary.bts }}</span>
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
            <tr v-for="(item, index) in reportData.data" :key="index">
              <td>{{ item.no }}</td>
              <td>{{ item.full_name }}</td>
              <td>{{ convertTitleCase(item.type) }}</td>
              <td>{{ convertDateFormat(item.start_time) }}</td>
              <td>{{ convertDateFormat(item.end_time) }}</td>
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
  //$('#reportTable').DataTable();
  $('#report-range').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'dddd, DD MMMM YYYY HH:mm'
    }
  });
  $('#report-range').on('apply.daterangepicker', function(ev, picker) {
    // callback on apply date range
  });
}, false);

var app = new Vue({
	el: '#app',
	data: {
    baseURL: '<?php echo base_url() ?>',
    reportData: {
      summary: {},
      data: []
    },
	},
	methods: {
    getReportData(timeStart, timeEnd) {
      const self = this;
      self.employeeList = [];
      axios.post(self.baseURL + 'dashboard/getReport/', {
        timeStart, timeEnd
      }).then((res) => {
        self.reportData.summary = res.data.summary;
        if (res.data.data.length === 0) { return; }
        // convert into better format
        for (let i = 0; res.data.data.length; i++) {
          const number = i + 1;
          let newFormat = {
            no: number,
            id_task: res.data.data[i].id_task,
            type: res.data.data[i].type,
            start_time: res.data.data[i].start_time,
            start_time: res.data.data[i].start_time,
            id_user: res.data.data[i].id_user,
            full_name: res.data.data[i].full_name,
          };
          self.reportData.data.push(newFormat);
        }
      });
    },

    convertDateFormat(oldFormat) {
      return moment(oldFormat).lang('id').format('dddd, DD MMMM YYYY - HH:mm');
    },

    convertTitleCase(string) {
      str = string.toLowerCase().split(' ');
      for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
      }
      return str.join(' ');
    },
  },
	mounted() {
    this.getReportData(
      "<?php echo $dashboard_data['first_task_date'] ?>",
      "<?php echo $dashboard_data['last_task_date'] ?>"
    );
	}
});
</script>