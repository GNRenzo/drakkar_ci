<!DOCTYPE html>
<html lang="en">
<head>
	<title>DMS | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- favicon -->    
  <link rel="shortcut icon" href="<?php echo base_url(); ?>adminlte/img/logos/favicon.png">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/vendor/daterangepicker/daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminlte/login/css/main.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/owcarousel2/assets/owl.carousel.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/owcarousel2/assets/owl.theme.default.min.css">

<script src="<?=base_url();?>adminlte/plugins/sa/sweetalert2.all.min.js"></script>
    <script src="<?=base_url();?>adminlte/plugins/sa/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?=base_url(); ?>adminlte/plugins/sa/sweetalert2.min.css">
<!--===============================================================================================-->
</head>
<body>



  <div class="modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Restablecer credenciales</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="frmEmailRequest" name="frmEmailRequest" >

            <div class="form-group">
              <label for="txtName">Nombres y Apellidos:</label>
              <input style="border: 1px solid rgba(0,0,0,.15) !important;" type="text" id="txtName" name="txtName" class="form-control" placeholder="Nombres y Apellidos" required>
            </div>

            <div class="form-group">
              <label for="txtCorreo">Correo Corporativo:</label>
              <input style="border: 1px solid rgba(0,0,0,.15) !important;" type="text" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Correo Corporativo" required>
            </div>

            <input type="hidden" name="idUsuario" id="idUsuario">
            <input type="hidden" name="nameSistema" id="nameSistema">
            

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnSubmitEmailRequest" name="btnSubmitEmailRequest" class="btn btn-danger">Enviar</button>
        </div>
      </div>
    </div>
  </div>













	<div class="limiter">
    <div class="container-login100" style="background-image: url('<?php echo base_url(); ?>adminlte/img/login/BB2.png');">
      <div class="wrap-login100">


        
        <!-- <div class="login100-form validate-form"> -->

          <?php 
          $attributes = array('class' => 'login100-form validate-form');
          echo $form->open_tag($attributes); 
          ?>
       
          <img style="display: block; margin-left: auto; margin-right: auto; width: 57%;" src="<?php echo base_url(); ?>adminlte/img/logos/logo.png">
          <img style="display: block; margin-left: auto; margin-right: auto; width: 43%;" src="<?php echo base_url(); ?>adminlte/img/logos/favicon.png">
          <span class="login100-form-title p-b-34">
            <br>
            DOCUMENT MANAGEMENT SOFTWARE
          </span>
          
		  <div class="wrap-input100 rs3-wrap-input100 validate-input m-b-20" data-validate="Type user name" style="display: block;">

				  <?php
				  echo form_dropdown("frm[SUCURSAL]", $listaSucursales, '1', 'id="frm_SUCURSAL" class="form-control input100" style="height: 55px;"');
				  ?>

				  <span class="focus-input100"></span>
			  </div>
			  
          <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">

            <?php
              $data = array(
                'name'        => 'frm[USER]',
                'id'    => 'frm_USER',
                'class'       => 'input100',
                'placeholder' => 'Usuario',
                'required' => 'required',
                'autofocus' => 'autofocus'

              );

              echo form_input($data);
            ?>


            <!-- <input id="first-name" class="input100" type="text" name="username" placeholder="User name"> -->
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
             <?php
              $data = array(
                'name'        => 'frm[CLAVE]',
                'id'    => 'frm_CLAVE',
                'type' => 'password',
                'class'       => 'input100',
                'placeholder' => 'Contraseña',
                'required' => 'required'

              );
            echo form_input($data);
            ?>
            <!-- <input class="input100" type="password" name="pass" placeholder="Password"> -->
            <span class="focus-input100"></span>
          </div>
          
          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              Iniciar Sesión
            </button>
          </div>
          <?php if($this->session->userdata('ERROR_LOGIN')){ ?>
            <div class="w-full text-center">
              <span class="">Error, ingrese los datos correctos.</span>
            </div>
          <?php } ?>

          <div class="w-full text-center p-t-27 p-b-239">
            <span class="txt1">
              Olvidé
            </span>

            <a type="button" style="cursor: pointer; color: #04A45C !important;" class="txt2" onmouseover="this.style.color='#333333'" onMouseOut="this.style.color='#04A45C'" data-toggle="modal" data-target="#modalForgot">
              Mi cuenta de Usuario / contraseña?
            </a>
          </div>
          <?php echo form_close(); ?>
        
        <!-- </div> -->
        


        <div style="width: 50%; position: relative;">
          <div class="row">
            <div class="col-md-12 col-sm-12 hidden-xs" style="padding-right:0;">

              <div id="logincar" class="owl-carousel owl-theme">

                <div class="lcitem first">
                  <img style="filter:brightness(0.4);" src="<?php echo base_url(); ?>adminlte/img/login/confianza.jpg" >
                  <div class="icont">
                    <h3>Cadena de Valor</h3>
                    <p>Visualiza y descarga documentacíón de macroprocesos, procesos y subprocesos de las áreas core y de soporte de nuestra empresa.</p>
                  </div>
                </div>
                <div class="lcitem second">
                  <img style="filter:brightness(0.4);" src="<?php echo base_url(); ?>adminlte/img/login/campo.jpg">
                  <div class="icont">
                    <h3>Gestión de Contratos</h3>
                    <p>Accede de manera ágil a todos los contratos de la empresa firmados con proveedores.</p>
                  </div>
                </div>
                <div class="lcitem third">
                  <img style="filter:brightness(0.4);" src="<?php echo base_url(); ?>adminlte/img/login/campo2.jpg">
                  <div class="icont">
                    <h3>Firma de Contratos</h3>
                    <p>Otorga vistos buenos y/o firma nuevos contratos con proveedores online.</p>
                  </div>
                </div>
                <div class="lcitem fourth">
                  <img style="filter:brightness(0.4);" src="<?php echo base_url(); ?>adminlte/img/login/bb3.jpg">
                  <div class="icont">
                    <h3>Manuales y Políticas</h3>
                    <p>Accede a los manuales y políticas corporativas de la organización.</p>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>



      </div>
    </div>
  </div>
  
	
	

	<script src="<?php echo base_url(); ?>adminlte/login/vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?php echo base_url(); ?>adminlte/login/vendor/animsition/js/animsition.min.js"></script>

	<script src="<?php echo base_url(); ?>adminlte/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>adminlte/login/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>adminlte/login/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>

	<script src="<?php echo base_url(); ?>adminlte/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>adminlte/login/vendor/daterangepicker/daterangepicker.js"></script>

	<script src="<?php echo base_url(); ?>adminlte/login/vendor/countdowntime/countdowntime.js"></script>

	<script src="<?php echo base_url(); ?>adminlte/plugins/owcarousel2/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>adminlte/login/js/main.js"></script>

	<script src="<?=base_url(); ?>project/js/login.js"></script>
  <script type="text/javascript" src="<?=base_url(); ?>project/js/means.js"></script>
</body>
</html>