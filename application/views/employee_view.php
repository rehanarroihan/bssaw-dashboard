<div id="app">
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          Manage Employees
          <span>
          <div class="btn-group">
            <button type="button" v-if="!isAddEmployee" @click="toggleAddNewEmployee" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i> Add New Employee</button>
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
      <div class="col-md-5" v-if="isAddEmployee">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add New Employee</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" @click="toggleAddNewEmployee"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input 
                type="text"
                v-model.trim="newEmployeeData.full_name"
                @keyup="generateUsernameSuggestion"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.newEmployeeData.full_name.required }"
                placeholder="Masukkan nama lengkap karyawan">
              <div class="invalid-feedback">
                Nama karyawan harus di isi
              </div>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input
                type="text"
                v-model.trim="newEmployeeData.username"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.newEmployeeData.username.required || !$v.newEmployeeData.username.minLength }"
                placeholder="Masukkan username untuk login karyawan">
                <div class="invalid-feedback" v-if="!$v.newEmployeeData.username.required || !$v.newEmployeeData.username.minLength">
                  {{ errUsername }}
                </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input
                type="password"
                v-model.trim="newEmployeeData.password"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.newEmployeeData.password.required || !$v.newEmployeeData.password.minLength }"
                placeholder="Masukkan password untuk login karyawan">
                <div class="invalid-feedback" v-if="!$v.newEmployeeData.password.required || !$v.newEmployeeData.password.minLength">
                  {{ errPassword }}
                </div>
            </div>
          </div>
          <div class="card-footer">
            <button v-if="!isAddEmployeeLoading" type="button" class="btn btn-primary float-right" @click="submitNewEmployee">Submit</button>
            <button v-if="isAddEmployeeLoading" class="btn btn-primary float-right" type="button" disabled="false">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-5" v-if="isEditEmployee">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Edit Employee Data</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" @click="toggleEditEmployee"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input 
                type="text"
                v-model.trim="editEmployeeData.full_name"
                @keyup="generateUsernameSuggestion"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.editEmployeeData.full_name.required }"
                placeholder="Masukkan nama lengkap karyawan">
              <div class="invalid-feedback">
                Nama karyawan harus di isi
              </div>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input
                type="text"
                v-model.trim="editEmployeeData.username"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.editEmployeeData.username.required || !$v.editEmployeeData.username.minLength }"
                placeholder="Masukkan username untuk login karyawan">
                <div class="invalid-feedback" v-if="!$v.editEmployeeData.username.required || !$v.editEmployeeData.username.minLength">
                  {{ errUsername }}
                </div>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" v-model="editEmployeeData.isChangePassword" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Ganti Password
              </label>
            </div>
            <div class="form-group mt-2" v-if="editEmployeeData.isChangePassword">
              <label>Password</label>
              <input
                type="password"
                v-model.trim="editEmployeeData.password"
                class="form-control"
                v-bind:class="{ 'is-invalid': !$v.editEmployeeData.password.required || !$v.editEmployeeData.password.minLength }"
                placeholder="Masukkan password untuk login karyawan">
                <div class="invalid-feedback" v-if="!$v.editEmployeeData.password.required || !$v.editEmployeeData.password.minLength">
                  {{ errPassword }}
                </div>
            </div>
          </div>
          <div class="card-footer">
            <button v-if="!isAddEmployeeLoading" type="button" class="btn btn-primary float-right" @click="submitEditEmployee">Simpan</button>
            <button v-if="isAddEmployeeLoading" class="btn btn-primary float-right" type="button" disabled="false">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
            </button>
          </div>
        </div>
      </div>
      <div v-bind:class="{ 'col-md-12': !isAddEmployee && !isEditEmployee, 'col-md-7': isAddEmployee || isEditEmployee }">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Employee List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, idx) in employeeList">
                    <td>{{ item.no }}</td>
                    <td>{{ item.full_name }}</td>
                    <td>{{ item.username }}</td>
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
//use vuelidate
Vue.use(window.vuelidate.default);
const { required, minLength } = window.validators;

var app = new Vue({
	el: '#app',
	data: {
    baseURL: '<?php echo base_url() ?>',
    employeeList: [],
		isAddEmployee: false,
    isAddEmployeeLoading: false,
    newEmployeeData: {
      full_name: '',
      username: '',
      password: '',
    },
    editEmployeeData: {},
    isEditEmployee: false,
    isEditEmployeeLoading: false,
	},
  validations: {
    newEmployeeData: {
      full_name: {
        required,
      },
      username: {
        required,
        minLength: minLength(6)
      },
      password: {
        required,
        minLength: minLength(6)
      },
    },
    editEmployeeData: {
      full_name: {
        required,
      },
      username: {
        required,
        minLength: minLength(6)
      },
      password: {
        required,
        minLength: minLength(6)
      },
    }
  },
  computed: {
    errUsername() {
      if (!this.$v.newEmployeeData.username.required) {
        return 'Username harus di isi';
      }
      if (!this.$v.newEmployeeData.username.minLength) {
        return 'Username minimal 6 karakter';
      }
    },
    errPassword() {
      if (!this.$v.newEmployeeData.password.required) {
        return 'Password harus di isi';
      }
      if (!this.$v.newEmployeeData.password.minLength) {
        return 'Password minimal 6 karakter';
      }
    },
  },
	methods: {
    getEmployeeList() {
      const self = this;
      self.employeeList = [];
      axios.post(self.baseURL + 'employees/get').then((res) => {
        if (res.data.length === 0) { return; }
        // converting to bettter format
        for (let i = 0; res.data.length; i++) {
          const number = i + 1;
          let newFormat = {
            no: number,
            id_user: res.data[i].id_user,
            full_name: res.data[i].full_name,
            username: res.data[i].username,
          };
          self.employeeList.push(newFormat);
        }
      });
    },

    toggleAddNewEmployee() {
      this.isAddEmployee = !this.isAddEmployee;
      this.isEditEmployee = false;
    },

    toggleEditEmployee() {
      this.isEditEmployee = !this.isEditEmployee;
      this.isAddEmployee = false;
    },
    
    generateUsernameSuggestion() {
      let full_name = this.newEmployeeData.full_name;
      const firstWord = full_name.replace(/ .*/, '');
      this.newEmployeeData.username = firstWord.toLowerCase();
    },
    
    submitNewEmployee() {
      if (this.$v.newEmployeeData.$invalid) { return; }
      this.isAddEmployeeLoading = true;
      const self = this;
      axios.post(self.baseURL + 'employees/insert',
        self.newEmployeeData).then(() => {
        self.isAddEmployeeLoading = false;
        self.newEmployeeData = {
          full_name: '',
          username: '',
          password: '',
        };
        //self.isAddEmployee = false;
        self.getEmployeeList();
      });
    },
    
    submitEditEmployee() {
      // ensure validation
      const dataValidation = this.$v.editEmployeeData;
      if (this.editEmployeeData.isChangePassword) {
        if (this.$v.editEmployeeData.password.$invalid) { return; }
      } else {
        this.editEmployeeData.isChangePassword = false;
        if (dataValidation.full_name.$invalid || dataValidation.username.$invalid) { return; }
      }

      this.isEditEmployeeLoading = true;

      const self = this;
      axios.post(self.baseURL + 'employees/update',
        self.editEmployeeData).then(() => {
        self.isEditEmployeeLoading = false;
        self.isEditEmployee = false;
        self.getEmployeeList();
      });
    },
    
    editEmployee(item) {
      this.isAddEmployee = false;
      this.isEditEmployee = true;
      this.editEmployeeData = JSON.parse(JSON.stringify(item));
    },
    
    deleteEmployee(id) {
      const self = this;
      let r = confirm('Menghapus data karyawan akan menghapus data pekerjaan mereka juga dan mengakibatkan karyawan ini tidak bisa login, lanjutkan ?');
      if (r == true) {
        axios.post(self.baseURL + 'employees/delete', { id }).then((res) => {
          self.getEmployeeList();
        });
      }
    }
  },
	mounted() {
    this.getEmployeeList();
	}
});
</script>