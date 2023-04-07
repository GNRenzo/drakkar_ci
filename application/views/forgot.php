
<?php
                 
$nombreUser =   $this->data ['nombre'];  
$idUser =   $this->data ['idUser'];  
$correo =   $this->data ['correo'];   

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inet AGV | Forgot</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- favicon -->    
  <link rel="shortcut icon" href="<?php echo base_url(); ?>adminlte/img/logos/favicon.png">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/vendor/animate/animate.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/vendor/select2/select2.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/vendor/daterangepicker/daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fabrex/login/css/main.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>fabrex/plugins/owcarousel2/assets/owl.carousel.min.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>fabrex/plugins/owcarousel2/assets/owl.theme.default.min.css">

 <script src="<?=base_url();?>fabrex/js/sa/sweetalert2.all.min.js"></script>
 <script src="<?=base_url();?>fabrex/js/sa/sweetalert2.min.js"></script>
 <link rel="stylesheet" href="<?=base_url(); ?>fabrex/js/sa/sweetalert2.min.css">

</head>
<body>


  <div class="limiter">
    <div class="container-login100" style="background-image: url('<?php echo base_url(); ?>fabrex/login/images/ASP2.jpg');">
      <div class="wrap-login100">

        <?php 
        $attributes = array('class' => 'login100-form validate-form');
        echo $form->open_tag($attributes); //open_tag modificado!!!!
        ?>

        <span class="login100-form-title p-b-35" style="margin-top: -8%;">
          <b style="color: #525861;font-size: 28px;color: #000;font-weight:bolder;font-family: Verdana;">Forgot Password </b>
          <br>
          <p style="color: #525861;text-transform: initial;margin-top: 2%">Se ha solicitado cambiar su clave de ingreso al sistema</p>
        </span>  

        <span class="login100-form-title p-b-30" style="margin-top: 22%;">
          
          <h3><img style="margin-top: -30%;margin-left: -2%; width: 35%;" src="<?php echo base_url(); ?>fabrex/img/forgot/iconforgot.png"></h3>
        </span> 

        <span class="login100-form-title p-b-30" style="margin-top: -10%;">
          <b style="color: #525861;font-size:16px;font-weight:bold;text-transform: capitalize;"><?php echo ucwords(strtolower($nombreUser)); ?></b>
          <br>
          <p style="color: #525861;text-transform: initial;margin-top: 0%"><b>Cuenta Usuario:</b> &nbsp;<?php echo strtolower($idUser); ?></p>
        </span>           

        <input type="hidden" name="txtIdUser" id="txtIdUser" value="<?php echo $idUser  ?>">
        <input type="hidden" name="txtNombreUser" id="txtNombreUser" value="<?php echo $nombreUser; ?>">
        <input type="hidden" name="txtCorreoUser" id="txtCorreoUser" value="<?php echo $correo; ?>">

        <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="New password" style="height:11%">

          <input class="input100" type="password" name="txtNewClave" id="txtNewClave" placeholder="Nueva clave" >
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Confirm Password" style="height:11%">
          <input class="input100" type="password" name="txtConfirmarClave" id="txtConfirmarClave" placeholder="Confirmar Clave">
          <span class="focus-input100"></span>
        </div>

        <div class="icheck-primary" style="margin-top: -5%;margin-bottom: 9%">
          <input type="checkbox" id="mostrarClave" name="mostrar" value="mostrar">
          <label for="agreeTerms" style="color: #198AE2;font-size: 13px;margin-top: -12%">
           Mostrar claves ingresadas
         </label>
       </div>

       <div class="container-login100-form-btn">
        <button type="button" class="login100-form-btn" id="btnSubmitClaveActualizar">
          Actualizar Password
        </button>
      </div>

     <!--  <div class="w-full text-center p-t-27 p-b-239">
        <span class="txt1">
          New password -
        </span>

        <a type="button" style="cursor: pointer; color: #04A45C !important;" class="txt2" onmouseover="this.style.color='#333333'" onMouseOut="this.style.color='#04A45C'">
          Minimo 8 caracteres.
        </a>

      </div> -->

      <?php echo form_close(); ?>

      <div style="width: 50%; position: relative;">
        <div class="row">
          <div class="col-md-12 col-sm-12 hidden-xs" style="padding-right:0;">

            <div id="logincar" class="owl-carousel owl-theme">

              <div class="lcitem first">
                <!-- <img style="display: block; margin-left: auto; margin-right: auto; width: 100%;" src="<?php echo base_url(); ?>fabrex/img/forgot/imgagv.png" > -->
                <img style="filter:brightness(0.4);" src="<?php echo base_url(); ?>fabrex/login/images/BB1.png" >
                <div class="icont">
                  <h3><img style="margin-top: -30%;margin-left: -2%; width: 35%;" src="<?php echo base_url(); ?>fabrex/img/forgot/agrovision_logo.png"></h3>
                </div>
                <div class="icont">
                  <p style="font-size: 18px;font-weight: bold;margin-top:50% ">INTRANET AGROVISION</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div> 



<script src="<?php echo base_url(); ?>fabrex/login/vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="<?php echo base_url(); ?>fabrex/login/vendor/animsition/js/animsition.min.js"></script>

<script src="<?php echo base_url(); ?>fabrex/login/vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo base_url(); ?>fabrex/login/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>fabrex/login/vendor/select2/select2.min.js"></script>
<script>
  $(".selection-2").select2({
   minimumResultsForSearch: 20,
   dropdownParent: $('#dropDownSelect1')
 });
</script>

<script src="<?php echo base_url(); ?>fabrex/login/vendor/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url(); ?>fabrex/login/vendor/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>fabrex/login/vendor/countdowntime/countdowntime.js"></script>

<script src="<?php echo base_url(); ?>fabrex/plugins/owcarousel2/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>fabrex/login/js/main.js"></script>

<script src="<?=base_url(); ?>project/js/forgot.js"></script>

<script type="text/javascript" src="<?=base_url(); ?>project/js/means.js"></script>

</body>
</html>