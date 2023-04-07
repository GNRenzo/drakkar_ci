<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SQA | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition"  style="align-items: center; height: 100vh; justify-content: center; display: flex; margin-top: 200px"  background="<?=base_url(); ?>adminlte/img/login/BB2.png">
  <!-- <img class="img-responsive" src="<?=base_url(); ?>adminlte/img/login/BB2.png">  style="align-items: center; height: 100vh; justify-content: center;" -->
<div class="login-box" >
  <!-- <img class="img-responsive" src="<?=base_url(); ?>adminlte/img/login/BB2.png"> -->
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>adminlte/index2.html"><b>Calidad </b>Agrovision</a>
  </div>
  <!-- /.login-logo -->
  <div class="card" >
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesión</p>

       <?php echo $form->open_tag(); ?>
        <div class="input-group mb-3">
          <?php
          $data = array(
            'name'        => 'frm[USER]',
            'id'    => 'frm_USER',
            'class'       => 'form-control',
            'placeholder' => 'User Name *',
            'required' => 'required',
            'autofocus' => 'autofocus'

          );

          echo form_input($data);
          ?>
          <!-- <input type="email" class="form-control" placeholder="Email"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
          $data = array(
            'name'        => 'frm[CLAVE]',
            'id'    => 'frm_CLAVE',
            'type' => 'password',
            'class'       => 'form-control',
            'placeholder' => 'Password *',
            'required' => 'required'

          );

          echo form_input($data);
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordar
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close(); ?>

    
      <!-- /.social-auth-links -->
      <br>
      <p class="mb-1">
        <a href="forgot-password.html">Olvidé mi contraseña</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>
