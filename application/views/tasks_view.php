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
            <select class="form-control" v-bind:class="{ 'is-invalid': !$v.newTaskData.type.required }" @change="taskTypeOnChange">
              <option value="">-- Pilih Jenis Pekerjaan --</option>
              <option
                v-for="(item, index) in taskTypeList"
                :key="item.id"
                :value="item.id">{{ item.name }}</option>
            </select>
            <div class="invalid-feedback">
              Pilih jenis pekerjaan
            </div>
          </div>
          <div class="form-group">
            <label>Waktu Mulai</label>
            <div class="input-group" data-target-input="nearest">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <date-picker
                v-model="startTimeInput"
                @dp-change="onStartDateChange"
                placeholder="Waktu Pekerjaan Mulai"
                v-bind:class="{ 'is-invalid': !$v.startTimeInput.required }"
                :config="startDatePickerOption">
              </date-picker>
              <div class="invalid-feedback">
                Waktu mulai harus di isi
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Waktu Selesai</label>
            <div class="input-group" data-target-input="nearest">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <date-picker
                v-model="endTimeInput"
                @dp-change="onEndDateChange"
                placeholder="Waktu Pekerjaan Selesai"
                v-bind:class="{ 'is-invalid': !$v.endTimeInput.required }"
                :config="endDatePickerOption">
              </date-picker>
              <div class="invalid-feedback">
                Waktu selesai harus di isi
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <textarea
              type="text"
              v-model="newTaskData.note"
              placeholder="Catatan Tambahan"
              class="form-control">
            </textarea>
          </div>
          <div class="form-group">
            <label>Dokumen</label>
            <!-- show when file not choosen -->
            <div class="input-group" v-if="!file">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-file"></i></span>
              </div>
              <div class="custom-file">
                <input type="file" @change="onFileChange()" ref="file" id="file" class="custom-file-input" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
              <div class="input-group-append">
              </div>
            </div>
            <!-- show when file choosen -->
            <div class="input-group" v-if="file">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-file"></i></span>
              </div>
              <input type="text" class="form-control" :value="file.name">
              <span class="input-group-append">
                <button type="button" @click="removeFile" class="btn btn-danger btn-flat">
                  <i class="fa fa-times"></i>
                </button>
              </span>
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
    <!-- Edit task section -->
    <div class="col-md-5" v-if="isEditTask">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Edit Task</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" @click="toggleEditTask"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Nama Anggota</label>
            <input 
              type="text"
              v-model="editTaskData.full_name"
              disabled
              class="form-control">
          </div>
          <div class="form-group">
            <label>Jenis Pekerjaan</label>
            <select class="form-control" v-model="editTaskData.type" v-bind:class="{ 'is-invalid': !$v.editTaskData.type.required }">
              <option value="">-- Pilih Jenis Pekerjaan --</option>
              <option
                v-for="(item, index) in taskTypeList"
                :key="item.id"
                :value="item.id">{{ item.name }}</option>
            </select>
            <div class="invalid-feedback">
              Pilih jenis pekerjaan
            </div>
          </div>
          <div class="form-group">
            <label>Waktu Mulai</label>
            <div class="input-group" data-target-input="nearest">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <date-picker
                v-model="startTimeEditInput"
                @dp-change="onStartDateEditChange"
                v-bind:class="{ 'is-invalid': !$v.startTimeEditInput.required }"
                :config="startDatePickerOption">
              </date-picker>
              <div class="invalid-feedback">
                Waktu mulai harus di isi
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Waktu Selesai</label>
            <div class="input-group" data-target-input="nearest">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <date-picker
                v-model="endTimeEditInput"
                @dp-change="onEndDateEditChange"
                v-bind:class="{ 'is-invalid': !$v.endTimeEditInput.required }"
                :config="endDatePickerOption">
              </date-picker>
              <div class="invalid-feedback">
                Waktu selesai harus di isi
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <textarea
              type="text"
              v-model="editTaskData.note"
              class="form-control">
            </textarea>
          </div>
          <div class="form-group">
            <label>Dokumen</label>
            <!-- show when NOT isEditFile -->
            <div class="input-group" v-if="!isEditFile">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-file"></i></span>
              </div>
              <input type="text" class="form-control" readonly :value="!editTaskData.attachment ? 'No Attachment' : editTaskData.attachment">
              <span class="input-group-append">
                <button type="button" @click="removeEditFile" class="btn btn-warning">
                  Upload File Lain
                </button>
              </span>
            </div>
            <!-- show when isEditFile -->
            <div class="input-group" v-if="isEditFile">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-file"></i></span>
              </div>
              <input type="file" @change="onEditFileChange()" ref="fileEdit" class="form-control">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button v-if="!isEditTaskLoading" type="button" class="btn btn-primary float-right" @click="submitEditedTask">Submit Change</button>
          <button v-if="isEditTaskLoading" class="btn btn-primary float-right" type="button" disabled="false">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
          </button>
        </div>
      </div>
    </div>
    <div v-bind:class="{ 'col-md-12': !isAddTask && !isEditTask, 'col-md-7': isAddTask || isEditTask }">
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
                  <th>Catatan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, idx) in taskList">
                  <td>{{ item.no }}</td>
                  <td>{{ item.type }}</td>
                  <td>{{ convertDateFormat(item.start_time) }}</td>
                  <td>{{ convertDateFormat(item.end_time) }}</td>
                  <td>{{ item.note }}</td>
                  <td>
                    <button @click="editTask(item)" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</button>
                    <button @click="deleteTask(item.id_task)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    <a v-if="item.attachment" target="_blank" :href="getAttachmentLink(item.attachment)" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Attachment</a>
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

//use vuelidate
Vue.use(window.vuelidate.default);
const { required, minLength } = window.validators;

var app = new Vue({
	el: '#app',
	data: {
    baseURL: '<?php echo base_url() ?>',
    taskList: [],
    isAddTask: false,
    taskTypeList: [],
    newTaskData: {
      type: '',
      full_name: '<?php echo $this->session->userdata('full_name') ?>',
      id_user: '<?php echo $this->session->userdata('user_id') ?>',
      start_time: '',
      end_time: '',
      note: '',
      attachment: '',
    },
    file: '',
    startTimeInput: '',
    endTimeInput: '',
    isAddTaskLoading: false,
    startDatePickerOption: {
      format: 'dddd, DD MMMM YYYY - HH:mm',
      locale: 'id'
    },
    endDatePickerOption: {
      format: 'dddd, DD MMMM YYYY - HH:mm',
      useCurrent: false,
      locale: 'id'
    },
    // data for edit task
    editTaskData: {},
    startTimeEditInput: '',
    endTimeEditInput: '',
    isEditTaskLoading: false,
    fileEdit: '',
    isEditTask: false,
    isEditFile: false,
	},
  validations: {
    newTaskData: {
      type: { required },
      start_time: { required},
      end_time: { required },
      note: { required }
    },
    editTaskData: {
      type: { required },
      start_time: { required},
      end_time: { required },
      note: { required }
    },
    startTimeInput: { required },
    endTimeInput: { required },
    startTimeEditInput: { required },
    endTimeEditInput: { required },
  },
	methods: {
    onStartDateChange(e) {
      this.newTaskData.start_time = moment(this.startTimeInput, 'dddd, DD MMMM YYYY - HH:mm:ss').format('YYYY-MM-DD HH:mm');
      this.endDatePickerOption.minDate = e.date;
    },

    onEndDateChange(e) {
      this.newTaskData.end_time = moment(this.endTimeInput, 'dddd, DD MMMM YYYY - HH:mm:ss').format('YYYY-MM-DD HH:mm');
      this.startDatePickerOption.maxDate = e.date;
    },

    onStartDateEditChange(e) {
      this.editTaskData.start_time = moment(this.startTimeEditInput, 'dddd, DD MMMM YYYY - HH:mm:ss').format('YYYY-MM-DD HH:mm');
      this.endDatePickerOption.minDate = e.date;
    },

    onEndDateEditChange(e) {
      this.editTaskData.end_time = moment(this.endTimeEditInput, 'dddd, DD MMMM YYYY - HH:mm:ss').format('YYYY-MM-DD HH:mm');
      this.startDatePickerOption.maxDate = e.date;
    },

    toggleAddNewTask() {
      this.isAddTask = !this.isAddTask;
      this.isEditTask = false;
    },

    toggleEditTask() {
      this.isEditTask = !this.isEditTask;
      this.isAddTask = false;
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
        let willBePush = [];
        for (let i = 0; res.data.length; i++) {
          const number = i + 1;
          let newFormat = {
            no: number,
            id_task: res.data[i].id,
            type: res.data[i].type,
            start_time: res.data[i].start_time,
            end_time: res.data[i].end_time,
            note: res.data[i].note,
            attachment: res.data[i].attachment
          };
          self.taskList.push(newFormat);
        }
      });
    },

    getTaskTypeList() {
      const self = this;
      self.taskTypeList = [];
      axios.post(self.baseURL + 'TaskType/get').then((res) => {
        if (res.data.length === 0) { return; }
        // converting to bettter format
        for (let i = 0; res.data.length; i++) {
          const number = i + 1;
          let newFormat = {
            id: res.data[i].id_task_type,
            name: res.data[i].job_type,
          };
          self.taskTypeList.push(newFormat);
        }
      });
    },

    getAttachmentLink(fileName) {
      return this.baseURL + 'assets/upload/' + fileName;
    },

    convertDateFormat(oldFormat) {
      return moment(oldFormat).lang('id').format('dddd, DD MMMM YYYY - HH:mm');
    },

    onFileChange() {
      this.file = this.$refs.file.files[0];
    },

    onEditFileChange() {
      this.fileEdit = this.$refs.fileEdit.files[0];
    },
    
    removeFile() {
      this.file = '';
    },

    removeEditFile() {
      this.fileEdit = '';
      this.editTaskData.isEditFile = true;
      this.isEditFile = true;
    },

    async submitNewTask() {
      if (this.$v.newTaskData.$invalid) { return; }
      this.isAddTaskLoading = true;

      const self = this;
      if (this.file) {
        const uploadedFileName = await this.uploadSingleFile();
        this.newTaskData.attachment = uploadedFileName;
      }
      axios.post(self.baseURL + 'tasks/insert', self.newTaskData).then(() => {
        self.isAddTaskLoading = false;
        self.newTaskData = {
          type: '',
          full_name: '<?php echo $this->session->userdata('full_name') ?>',
          id_user: '<?php echo $this->session->userdata('user_id') ?>',
          start_time: '',
          end_time: '',
          note: '',
          attachment: '',
        };
        self.startTimeInput = '';
        self.endTimeInput = '';
        self.file = '';
        self.getMyTaskList();
      });
    },

    async submitEditedTask() {
      if (this.$v.editTaskData.$invalid) { return; }
      this.isEditTaskLoading = true;
      const self = this;
      if (this.editTaskData.isEditFile) {
        if (this.fileEdit) {
          const uploadedFileName = await this.uploadSingleFile();
          this.editTaskData.attachment = uploadedFileName;
        } else {
          this.editTaskData.attachment = '';
        }
      }
      axios.post(self.baseURL + 'tasks/update', self.editTaskData).then(() => {
        self.isEditTaskLoading = false;
        self.startTimeInput = '';
        self.endTimeInput = '';
        self.file = '';
        self.isEditTask = false;
        self.isAddTask = false;
        self.getMyTaskList();
      });
    },

    uploadSingleFile(){
			const self = this;
			return new Promise((resolve, reject) => {
				let formData = new FormData();

        if (self.isAddTask) {
          formData.append('file', self.file);
        }
        if (self.isEditTask) {
          formData.append('file', self.fileEdit);
        }

				axios.post(self.baseURL + 'tasks/uploadSingleFile', formData, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}).then(res => {
					resolve(res.data);
				});
			});
		},

    editTask(item) {
      this.isAddTask = false;
      this.isEditTask = true;
      this.editTaskData = JSON.parse(JSON.stringify(item));
      this.editTaskData.full_name = '<?php echo $this->session->userdata('full_name') ?>';
      this.editTaskData.isEditFile = false;
      this.isEditFile = false;
      this.startTimeEditInput = this.convertDateFormat(this.editTaskData.start_time);
      this.endTimeEditInput = this.convertDateFormat(this.editTaskData.end_time);
    },

    deleteTask(id_task) {
      const self = this;
      let r = confirm('Are you sure want to delete this data ?');
      if (r == true) {
        axios.post(self.baseURL + 'tasks/delete', { id: id_task }).then((res) => {
          self.isAddTask = false;
          self.isEditTask = false;
          self.getMyTaskList();
        });
      }
    }
  },
	mounted() {
    this.getTaskTypeList();
    this.getMyTaskList();
	}
});
</script>