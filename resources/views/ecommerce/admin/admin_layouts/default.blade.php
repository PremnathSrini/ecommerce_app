<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-icons.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin_assets/css/toastr.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('admin_assets/css/datatables.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('ecommerce.admin.admin_layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('ecommerce.admin.admin_layouts.sidebar')



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-sec">
                @yield('admin-content')
            </div>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('ecommerce.admin.admin_layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{asset('admin_assets/jquery.validate.min.js')}}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/adminlte.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pages/dashboard.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/datatables.min.js') }}"></script>
    <script src="{{asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.js')}}"></script>

    @if (Session::has('message'))
            <script>
                $(document).ready(function() {
                    toastr.success("{{ Session::get('message') }}");
                });
            </script>
    @endif
    <script>
        $(function() {
            bsCustomFileInput.init();
            });
    </script>
    @stack('custom-scripts')

</body>

</html>
