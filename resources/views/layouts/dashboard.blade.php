<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>کنترل پنل | @yield('title', __('داشبورد'))</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/persianDatepicker.css') }}" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
          integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css') }}">
  <script src="{{ asset('assets/dashboard/plugins/chart.js/Chart.min.js')}}"></script>

    @yield('styles', '')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte.rtl.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
        var module = { };
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
.card-info:not(.card-outline) > .card-header {
    background-color: #3e82e8;
}
a {
    color: #3e82e8;
}
.content-wrapper {
    background: #f9f4f4;
}
.teachername a {
  padding-right: 13px;
}
.chartshead {
    display: flex;
    align-items: center;
}
.tab {
  overflow: hidden;
  margin-right:auto;
}
.tablinks {
  background-color: #f5f5f5 !important;
  margin: 0px 15px;
  border-radius: 38px;
}
/* Style the buttons that are used to open the tab content */
.tab button {
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    background-color: white;
    padding: 15px 30px;
    transition: 0.3s;
    font-size: 20px;
}
.sidebar a {
    color: #3e82e8;
}
.sidebar-dark-gray .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-gray .nav-sidebar > .nav-item > .nav-link.active {
    background-color: #3e82e8;
    color: #ffffff;
}
/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #3e82e8 !important;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #3e82e8 !important;
}

.bg-gradient-info {
    background: #a3ccd3 linear-gradient(180deg, #8d348f, #b817b500) repeat-x !important;
}
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard.index') }}" class="nav-link">{{ __('داشبورد') }}</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="nav-link">{{ __('خروج') }}</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-gray elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <img src="{{ asset('/img/logo1.png') }}" alt="{{ config('app.name') }}"  class="brand-image" style="opacity: .8">
            <span class="brand-text font-weight-light">رواق</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/dashboard/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @yield('sidebar')
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('hierarchy')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
         ravagh   
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2023 <a href="https://webitofa.ir">shirkhani</a></strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dashboard/js/adminlte.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
</script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/persianDatepicker.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $("#date, #date1").persianDatepicker({
        });   
    });
    
</script>
<script type="text/javascript">
    $(function() {
        $("#date, #date1").persianDatepicker();
        $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
         });
    });

</script>
<script>
  $(function () {
    $("#example2").DataTable({

      "responsive": true,"searching": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example1').DataTable({
    "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Persian.json"
      },
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('درحال پردازش درخواست')
    });
});

 </script>
 <script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard.js"></script>
 <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
 <script type="text/javascript">
    CKEDITOR.replace('description', {
     // Load the Farsi interface.
        language: 'fa'
      });
</script>
@yield('scripts', '')
</body>
</html>
