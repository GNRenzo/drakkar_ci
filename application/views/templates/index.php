<!DOCTYPE html>
<html lang="en">
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="x-ua-compatible" content="ie=edge">

 <!-- title  -->
 <title>DMS | Agrovision</title>
 <!-- Tell the browser to be responsive to screen width -->
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- jQuery -->
 <script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
 <!-- favicon -->
 <link rel="shortcut icon" href="<?php echo base_url(); ?>adminlte/img/logos/favicon.png">

<!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

 <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="<?=base_url();?>adminlte/plugins/select2/js/select2.full.min.js"></script>

  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/sa/sweetalert2.min.css">

  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/jqvmap/jqvmap.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap-colorpicker plugin -->
    <link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

 <!-- PLUGINS AÑADIDOS -->
 <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
 <!-- Tool Tips -->
 <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/tooltips/tooltips.css"/>

	<!-- AUTOCOMPLETE -->
	<link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/autocomplete/styles-autocomplete.css">
	<script src="<?php echo base_url(); ?>adminlte/plugins/autocomplete/jquery.autocomplete.js"></script>

 <link href="<?php echo base_url(); ?>adminlte/plugins/hover/css/hover.css" rel="stylesheet">

 <link href="<?php echo base_url(); ?>adminlte/plugins/waitMe/waitMe.css" rel="stylesheet">

 <link href="<?php echo base_url(); ?>adminlte/plugins/means.css" rel="stylesheet">

 <!-- BOOTZARD BOOTSTRAP WIZARD -->
 <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
 <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/bootzard_wizard/bootstrap/css/bootstrap.min.css"> -->

 <!-- BOOTZARD BOOTSTRAP WIZARD -->


  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">



    <div class="wrapper">

      <header>

        <?php if ($nav) echo $nav; ?>
      </header>

      <aside class="main-sidebar elevation-4 sidebar-light-info" style="background-color: #e6e6e6">
        <?php if ($sidebar) echo $sidebar; ?>
      </aside>

      <div class="content-wrapper">
        <?php if ($middle) echo $middle; ?>
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <?php if ($footer) echo $footer; ?>
      </footer>
    </div>



    <!-- REQUIRED SCRIPTS -->
<!-- <script src="<?php echo base_url(); ?>adminlte/plugins/tree/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/tree/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/tree/js/bootstrap.min.js"></script> -->

<!-- jQuery -->
<!-- <script src="<?=base_url();?>adminlte/plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url();?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- ChartJS -->
<script src="<?=base_url();?>adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url();?>adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url();?>adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url();?>adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url();?>adminlte/plugins/moment/moment.min.js"></script>
<script src="<?=base_url();?>adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url();?>adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url();?>adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url();?>adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url();?>adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>adminlte/dist/js/adminlte.js"></script>

<!-- colorpicker -->
    <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script src="<?=base_url();?>adminlte/plugins/jsgrid/jsgrid.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?=base_url();?>adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?=base_url();?>adminlte/dist/js/demo.js"></script>

<script src="<?php echo base_url(); ?>adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>


<!-- Sweet Alert -->
<script src="<?=base_url();?>adminlte/plugins/sa/sweetalert2.all.min.js"></script>
<script src="<?=base_url();?>adminlte/plugins/sa/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/sa/sweetalert2.min.css">

<!-- DataTables -->
<script src="<?php echo base_url(); ?>adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    // $("#example1").DataTable();
    $('#example1').DataTable({
      "language": {
        "lengthMenu": "Showing _MENU_ rows per page",
        "search": "Search:",
        "zeroRecords": "No data found",
        "info": "Showing _START_ a _END_ de _TOTAL_ rows",
        "infoEmpty": "No pages to display",
        "infoFiltered": "- (filtrado de _MAX_ registros totales)",
        "paginate": {
          "previous": "Previous",
          "next":"Next",
          "last": "Last page",
          "first": "First page"
        }
      }
    });




    $('#tableSpanish25').DataTable({
      "pageLength": 25,
      "language": {
        "lengthMenu": "Mostrando _MENU_ filas por página",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron datos",
        "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
        "infoEmpty": "No hay páginas a mostrar",
        "infoFiltered": "- (filtrado de _MAX_ registros totales)",
        "paginate": {
          "previous": "Anterior",
          "next":"Siguiente",
          "last": "Última",
          "first": "Primera"
        }
      }
    });


    $('#tableSpanish10').DataTable({
      "pageLength": 10,
      "language": {
        "lengthMenu": "Mostrando _MENU_ filas por página",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron datos",
        "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
        "infoEmpty": "No hay páginas a mostrar",
        "infoFiltered": "- (filtrado de _MAX_ registros totales)",
        "paginate": {
          "previous": "Anterior",
          "next":"Siguiente",
          "last": "Última",
          "first": "Primera"
        }
      }
    });



  });


  //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
</script>


<!-- Toastr -->
<script src="<?php echo base_url(); ?>adminlte/plugins/toastr/toastr.min.js"></script>
<!-- tool tips -->
<script src="<?php echo base_url(); ?>adminlte/plugins/tooltips/tooltips.js"></script>
<script src="<?php echo base_url(); ?>project/js/means.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url(); ?>project/js/validarcaracteres.js"></script>

<script src="<?php echo base_url(); ?>adminlte/plugins/waitMe/waitMe.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/base64/jquery.base64.js"></script>




<!-- <script src="<?php echo base_url(); ?>adminlte/plugins/bootzard_wizard/js/jquery-1.11.1.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>adminlte/plugins/bootzard_wizard/bootstrap/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootzard_wizard/js/jquery.backstretch.min.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/bootzard_wizard/js/retina-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/bootzard_wizard/js/scripts.js"></script>


</body>
</html>

