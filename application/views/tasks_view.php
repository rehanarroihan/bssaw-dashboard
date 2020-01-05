<div id="app">
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          Manage Tasks
          <span>
          <div class="btn-group">
            <button type="button" v-if="!isAddTask" @click="toggleAddNewTask" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i> Add New Task</button>
          </div>
          </span>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a>Pekerjaan</a></li>
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
    <div class="col-md-5" v-if="isAddTask">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add New Task</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" @click="toggleAddNewTask"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Nama Anggota</label>
            <input 
              type="text"
              v-model="newTaskData.full_name"
              disabled
              class="form-control">
          </div>
          <div class="form-group">
            <label>Jenis Pekerjaan</label>
            <select class="form-control" @change="taskTypeOnChange">
              <option>-- Pilih Jenis Pekerjaan --</option>
              <option
                v-for="(item, index) in taskTypeList"
                :key="item.id"
                :value="item.id">{{ item.name }}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Waktu Mulai</label>
            <div class="input-group" data-target-input="nearest">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <date-picker v-model="newTaskData.start_time" @dp-change="onStartDateChange" :config="datePickerOption"></date-picker>
            </div>
          </div>
          <div class="form-group">
            <label>Waktu Selesai</label>
            <div class="input-group" data-target-input="nearest">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <date-picker v-model="newTaskData.end_time" @dp-change="onEndDateChange" :config="datePickerOption"></date-picker>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button v-if="!isAddTaskLoading" type="button" class="btn btn-primary float-right" @click="submitNewTask">Submit</button>
          <button v-if="isAddTaskLoading" class="btn btn-primary float-right" type="button" disabled="false">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
          </button>
        </div>
      </div>
    </div>
    <div v-bind:class="{ 'col-md-12': !isAddTask, 'col-md-7': isAddTask }">
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Daftar Pekerjaan Saya</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Tugas</th>
                  <th>Waktu Mulai</th>
                  <th>Waktu Selesai</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, idx) in taskList">
                  <td>{{ item.no }}</td>
                  <td>{{ convertTitleCase(item.type) }}</td>
                  <td>{{ convertDateFormat(item.start_time) }}</td>
                  <td>{{ convertDateFormat(item.end_time) }}</td>
                  <td>
                    <button @click="editEmployee(item)" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</button>
                    <button @click="deleteEmployee(item.id_user)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
        </div>
        <!-- /.card-footer -->
      </div>
    </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
Vue.component('date-picker', VueBootstrapDatetimePicker);

var app = new Vue({
	el: '#app',
	data: {
    baseURL: '<?php echo base_url() ?>',
    taskList: [],
    isAddTask: false,
    taskTypeList: [
      {
        id: 'MAINTENANCE',
        name: 'Maintenance'
      },
      {
        id: 'INSTALLATION',
        name: 'Installation'
      },
      {
        id: 'PREVENTIVE',
        name: 'Preventive'
      },
      {
        id: 'VISIT',
        name: 'Visit'
      },
      {
        id: 'BTS',
        name: 'BTS'
      }
    ],
    newTaskData: {
      type: '',
      full_name: '<?php echo $this->session->userdata('full_name') ?>',
      id_user: '<?php echo $this->session->userdata('user_id') ?>',
      start_time: new Date(),
      end_time: '',
    },
    isAddTaskLoading: false,
    datePickerOption: {
      format: 'dddd, DD MMMM YYYY - HH:mm',
      useCurrent: false,
      locale: 'id'
    }  
	},
	methods: {
    onStartDateChange(e) {
      this.start_time = moment(e.date._i, 'dddd, DD MMMM YYYY - HH:mm').format('YYYY-MM-DD hh:mm:ss');
    },

    onEndDateChange(e) {
      this.start_time = moment(e.date._i, 'dddd, DD MMMM YYYY - HH:mm').format('YYYY-MM-DD hh:mm:ss');
    },

    toggleAddNewTask() {
      this.isAddTask = !this.isAddTask;
    },
    
    taskTypeOnChange(event) {
      this.newTaskData.type = event.target.value;
    },

    getMyTaskList() {
      const self = this;
      self.taskList = [];
      axios.post(self.baseURL + 'tasks/get/' + '<?php echo $this->session->userdata('user_id') ?>').then((res) => {
        if (res.data.length === 0) { return; }
        // converting to bettter format
        for (let i = 0; res.data.length; i++) {
          const number = i + 1;
          let newFormat = {
            no: number,
            id_task: res.data[i].id,
            type: res.data[i].type,
            start_time: res.data[i].start_time,
            start_time: res.data[i].start_time,
          };
          self.taskList.push(newFormat);
        }
      });
    },

    convertTitleCase(string) {
      str = string.toLowerCase().split(' ');
      for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
      }
      return str.join(' ');
    },

    convertDateFormat(oldFormat) {
      return moment(oldFormat).lang('id').format('dddd, DD MMMM YYYY - HH:mm');
    },

    submitNewTask() {
      //if (this.$v.$invalid) { return; }
      this.isAddTaskLoading = true;

      const self = this;
      axios.post(self.baseURL + 'tasks/insert', self.newTaskData).then(() => {
        self.isAddTaskLoading = false;
        self.newTaskData = {
          type: '',
          full_name: '<?php echo $this->session->userdata('full_name') ?>',
          id_user: '<?php echo $this->session->userdata('user_id') ?>',
          start_time: new Date(),
          end_time: '',
        },
        self.isAddTaskLoading = false;
        self.getMyTaskList();
      });
    },
  },
	mounted() {
    this.getMyTaskList();
	}
});
</script>