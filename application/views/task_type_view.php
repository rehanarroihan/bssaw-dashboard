<div id="app">
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          Manage Tipe Pekerjaan
          <span>
          <div class="btn-group">
            <button type="button" v-if="!isAddTaskType" @click="toggleAddNewTaskType" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i> Add New Task Type</button>
          </div>
          </span>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Employee</li>
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
      <div class="col-md-5" v-if="isAddTaskType">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add New Task Type</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" @click="toggleAddNewTaskType"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input 
                type="text"
                v-model.trim="newTaskTypeData.task_type_name"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.newTaskTypeData.task_type_name.required }"
                @keyup.enter="submitNewTaskType"
                placeholder="Masukkan nama tipe pekerjaan baru">
              <div class="invalid-feedback">
                Nama pekerjaan harus di isi
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button
              v-if="!isAddTaskTypeLoading"
              type="button"
              class="btn btn-primary float-right"
              @click="submitNewTaskType">
              Submit
            </button>
            <button v-if="isAddTaskTypeLoading" class="btn btn-primary float-right" type="button" disabled="false">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-5" v-if="isEditTaskType">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Edit Task Type Data</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" @click="toggleEditTaskType"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama Jenis Pekerjaan</label>
              <input 
                type="text"
                v-model.trim="editTaskTypeData.job_type"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.editTaskTypeData.job_type.required }"
                placeholder="Masukkan nama jenis pekerjaan"
                @keyup.enter="submitEditNewTaskType">
              <div class="invalid-feedback">
                Nama jenis pekerjaan harus di isi
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button v-if="!isEditTaskTypeLoading" type="button" class="btn btn-primary float-right" @click="submitEditNewTaskType">Update</button>
            <button v-if="isEditTaskTypeLoading" class="btn btn-primary float-right" type="button" disabled="false">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
            </button>
          </div>
        </div>
      </div>
      <div v-bind:class="{ 'col-md-12': !isAddTaskType && !isEditTaskType, 'col-md-7': isAddTaskType || isEditTaskType }">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Job Type List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Job Type</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, idx) in taskTypeList">
                    <td>{{ item.no }}</td>
                    <td>{{ item.job_type }}</td>
                    <td>
                      <button @click="editTaskType(item)" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</button>
                      <button @click="deleteTaskType(item.id_task_type)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
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
//use vuelidate
Vue.use(window.vuelidate.default);
const { required, minLength } = window.validators;

var app = new Vue({
	el: '#app',
	data: {
    baseURL: '<?php echo base_url() ?>',
    taskTypeList: [],
		isAddTaskType: false,
    isAddTaskTypeLoading: false,
    newTaskTypeData: {
      task_type_name: '',
    },
    editTaskTypeData: {},
    isEditTaskType: false,
    isEditTaskTypeLoading: false,
	},
  validations: {
    newTaskTypeData: {
      task_type_name: {
        required,
      },
    },
    editTaskTypeData: {
      job_type: {
        required,
      },
    }
  },
  computed: {},
	methods: {
    getTaskTypeList() {
      const self = this;
      self.taskTypeList = [];
      axios.post(self.baseURL + 'tasktype/get').then((res) => {
        if (res.data.length === 0) { return; }
        // converting to bettter format
        for (let i = 0; res.data.length; i++) {
          const number = i + 1;
          let newFormat = {
            no: number,
            id_task_type: res.data[i].id_task_type,
            job_type: res.data[i].job_type,
          };
          self.taskTypeList.push(newFormat);
        }
      });
    },

    toggleAddNewTaskType() {
      this.isAddTaskType = !this.isAddTaskType;
      this.isEditTaskType = false;
    },

    toggleEditTaskType() {
      this.isEditTaskType = !this.isEditTaskType;
      this.isAddTaskType = false;
    },

    submitNewTaskType() {
      if (this.$v.newTaskTypeData.$invalid) { return; }
      this.isAddTaskTypeLoading = true;
      const self = this;
      axios.post(self.baseURL + 'tasktype/insert',
        self.newTaskTypeData).then(() => {
        self.isAddTaskTypeLoading = false;
        self.newTaskTypeData = {
          task_type_name: '',
        };
        self.getTaskTypeList();
      });
    },

    editTaskType(item) {
      this.isAddTaskType = false;
      this.isEditTaskType = true;
      this.editTaskTypeData = JSON.parse(JSON.stringify(item));
    },

    submitEditNewTaskType() {
      if (this.$v.editTaskTypeData.$invalid) { return; }
      this.isEditTaskTypeLoading = true;
      const self = this;
      axios.post(self.baseURL + 'tasktype/update',
        self.editTaskTypeData).then(() => {
        self.isEditTaskTypeLoading = false;
        self.getTaskTypeList();
      });
    },

    deleteTaskType(id) {
      const self = this;
      let r = confirm('Menghapus data karyawan akan menghapus data pekerjaan mereka juga dan mengakibatkan karyawan ini tidak bisa login, lanjutkan ?');
      if (r == true) {
        axios.post(self.baseURL + 'tasktype/delete', { id }).then((res) => {
          self.getTaskTypeList();
        });
      }
    }
  },
	mounted() {
    this.getTaskTypeList();
	}
});
</script>