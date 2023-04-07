<!DOCTYPE html>
<html lang="en">
<head>
	<title>DMS | Login</title>
	<meta charset="UTF-8">
<!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/sa/sweetalert2.min.css">

  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 

  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <!-- Daterange picker -->
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


 <!-- Tool Tips -->
 <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/tooltips/tooltips.css"/>

 <link href="<?php echo base_url(); ?>adminlte/plugins/hover/css/hover.css" rel="stylesheet">

 <link href="<?php echo base_url(); ?>adminlte/plugins/means.css" rel="stylesheet">


<!--===============================================================================================-->
</head>
<body>
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Página de Error con marca de agua</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Documentos</a></li>
              <li class="breadcrumb-item active">Descargar</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">PDF</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Archivo encriptado o con contraseña.</h3>

          <p>
            El PDF que intentó descargar se encuentra encriptado o protegido con contraseña, por lo que no se puede colocar la marca de agua.
            Puede<a href="../documents"> regresar a documentos</a> e informar al usuario que colgó el archivo.
          </p>

          <form class="search-form">
            <div class="input-group">

                <a href="../documents" type="submit" name="submit" class="btn btn-danger" ><i class="fas fa-arrow-alt-left"></i> Regresar
                </a>
            </div>
          </form>
        </div>
      </div>
    </section>
  
	
	
<script src="<?=base_url();?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Sparkline -->
<script src="<?=base_url();?>adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url();?>adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url();?>adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url();?>adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url();?>adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<!-- AdminLTE App -->
<script src="<?=base_url();?>adminlte/dist/js/adminlte.js"></script>



<script src="<?=base_url();?>adminlte/plugins/jsgrid/jsgrid.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?=base_url();?>adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?=base_url();?>adminlte/dist/js/demo.js"></script>


<!-- Sweet Alert -->
<script src="<?=base_url();?>adminlte/plugins/sa/sweetalert2.all.min.js"></script>
<script src="<?=base_url();?>adminlte/plugins/sa/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/sa/sweetalert2.min.css">


<!-- tool tips -->
<script src="<?php echo base_url(); ?>adminlte/plugins/tooltips/tooltips.js"></script>
<script src="<?php echo base_url(); ?>project/js/means.js"></script>
<script src="<?php echo base_url(); ?>adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>



	

</body>
</html>