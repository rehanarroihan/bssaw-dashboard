<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BSS Access Wireless</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" integrity="sha256-VVbO1uqtov1mU6f9qu/q+MfDmrqTfoba0rAE07szS20=" crossorigin="anonymous" />
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Date-picker dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.3"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.22"></script>
  <!-- Date-picker itself -->
  <script src="https://cdn.jsdelivr.net/npm/pc-bootstrap4-datetimepicker@4.17/build/js/bootstrap-datetimepicker.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/pc-bootstrap4-datetimepicker@4.17/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <!-- Lastly add this package -->
  <script src="https://cdn.jsdelivr.net/npm/vue-bootstrap-datetimepicker@5"></script>

  <!-- Modern JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
  <script src="https://unpkg.com/vuelidate/dist/validators.min.js"></script>
  <script src="https://unpkg.com/vuelidate/dist/vuelidate.min.js"></script>
  <style>
    [v-cloak] {
      display: none!important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">BSS Wireless</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://southernautomotivegroup.com.au/wp-content/uploads/2015/04/generic-placeholder-person.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('full_name') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if($this->session->userdata('role') == 'ADMIN'): ?>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dashboard" class="nav-link">
              <i class="nav-icon fa fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dashboard/employees" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Employees</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dashboard/task_type" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Tipe Pekerjaan</p>
            </a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dashboard/tasks" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>Pekerjaan</p>
            </a>
          </li>
          <li class="nav-header">Other</li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dashboard/logout" class="nav-link">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>Log Out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->load->view($content_view) ?>
  </div>

</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/id.js" integrity="sha256-5aLk1fogTLyWd3GNewO2j33+AtT02NYcGkkskO+3EQQ=" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha256-zI6VVO07NPmVW11q3RQE42YbRmJIkkunrcQ9LEYxJsQ=" crossorigin="anonymous"></script>

<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php //echo base_url() ?>assets/dist/js/pages/dashboard.js"></script> -->
<script>
window.addEventListener("load", function () {
  jQuery.extend(true, jQuery.fn.datetimepicker.defaults, {
    icons: {
      time: 'far fa-clock',
      date: 'far fa-calendar',
      up: 'fas fa-arrow-up',
      down: 'fas fa-arrow-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right',
      today: 'fas fa-calendar-check',
      clear: 'far fa-trash-alt',
      close: 'far fa-times-circle'
    }
  });
});
</script>
</body>
</html>
