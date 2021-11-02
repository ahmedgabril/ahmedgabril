<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
 <!-- <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">-->

  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
 
  <link rel="stylesheet" href=" {{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  @stack('styles')

 <!-- <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
  <style>
    html,body{
        font-family: 'Cairo', sans-serif!important;
    }
       @media print {

           button,a,select,input{
           display: none!important;

           }

           
       }
       /*.loader{
           position: fixed;
           top :0;
           left:0;
           background-color: #191c24;
           display:flex;
           justify-content: center;
           align-items: center;
           height: 100%;
           width:100%;
           z-index: 1000000;

       }
       .disaper{
           animation: pre 1s forwards;


       }
       @keyframes pre {
           100%{
               opacity: 0;
               visibility: hidden;
           }
       }*/
       </style>
    
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="direction:rtl ;text-align:right">
<div class="wrapper">
 
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center bg-dark">
      <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!--<div class="loader disaper">
      <div class="text-light" style="margin-right:-97px">انتظر ثوانى...</div>
      <img  src="/dist/img/preloder.gif" alt="ahmedgabril" height="170" width="170">

    </div>-->
    <!-- BEGIN: Header-->
    @include("baespage/navbar")

      @include("baespage/sidebar")
        <!-- Content Wrapper. Contains page content -->

   
 
    <!-- /.content-header -->
    <div class="content-wrapper" style="min-height: 1170.12px; padding-top:60px">
      <!-- Content Header (Page header) -->
     
      <!-- /.content-header -->
      @yield('content')
      {{$slot}}
      <!-- Main content -->

      <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
 <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="#">ahmed-gabril.</a>**phone:+201092586526</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="left: 0px;
  right: auto; display:none">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@livewireScripts
 

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--
<script>
  $(function() {
    
    $(".loader").on("load",function(){
    $(this).addClass("disaper");

 });
});
</script>-->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="/plugins/toastr/toastr.min.js"></script>

<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>-->
<!--<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>

@stack('scripts')

</body>
</html>
