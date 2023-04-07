<?php
$Usuario = $this->session->userdata('USUARIO');
$usuarioActual = $Usuario->username;
// $sucursal = $Usuario["sucursal"];
// $nameSucursal = $Usuario["name_sucursal"];
$nameSucursal = 'PERU';
?>
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><span><i class="fas fa-bars"> &nbsp; <?=$nameSucursal?></i>  <i class="fas fa-flag"></i></i></span></a>
    </li>

  </ul>


  <ul class="navbar-nav ml-auto">
    <!-- Right navbar links -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle"></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
          <?=$usuarioActual?>
        </a>

        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <a href="<?= base_url('') ?>inet" target="_blank" class="dropdown-item">
            <i class="far fa-browser mr-2"></i> Retornar a Intranet
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('') ?>inet/inicio/profile" target="_blank" class="dropdown-item">
            <i class="far fa-id-card mr-2"></i> Perfil
          </a>
       <!--    <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-exchange-alt mr-2"></i> Change Password
          </a> -->
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('auth/logout'); ?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
          </a>
        </div>

      </li>

    
  </ul>
</nav>