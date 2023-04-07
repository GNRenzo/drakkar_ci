
<?php


    $arrayMenu = $this->session->userdata('CURRENT_MENU');
    $currentMenu = $arrayMenu['id'];
    $this->session->unset_userdata('CURRENT_MENU');

	$arrayMenuHijo = $this->session->userdata('CURRENT_MENU_HIJO');
	if ($arrayMenuHijo) {
		$currentMenuHijo = $arrayMenuHijo['id'];
	}else{
		$currentMenuHijo = '';
	}


    $arrayMenuItem = $this->session->userdata('CURRENT_MENU_ITEM');
    if ($arrayMenuItem) {
    	$currentMenuItem = $arrayMenuItem['id'];
    }else{
    	$currentMenuItem = '';
    }

    $this->session->unset_userdata('CURRENT_MENU_ITEM');
?>

<style type="text/css">
  .user-panel img {
    width: 3.5rem !important;
    margin-left: -12px !important;
}
</style>
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>inicio" class="brand-link navbar-dark">
      <img src="<?php echo base_url(); ?>adminlte/img/logos/favicon.png"  class="brand-image elevation-5"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: #fff">DMS AGV</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel  pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>adminlte/img/logos/logo.png"  alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('') ?>inicio" class="d-block"><b>AGROVISIONCORP</b></a>
        </div>
      </div>
      <input type="hidden" name="txtCurrentMenu" id="txtCurrentMenu" value="<?=$currentMenu?>">
	  <input type="hidden" name="txtCurrentMenuHijo" id="txtCurrentMenuHijo" value="<?=$currentMenuHijo?>">
      <input type="hidden" name="txtCurrentMenuItem" id="txtCurrentMenuItem" value="<?=$currentMenuItem?>">
      <nav class="mt-2 ">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Sidebar user panel (optional) -->
      <?php
  $menu_principal = [];
  $submenu_uno = [];
  $submenu_dos = [];
  foreach ($_menupermiso as $item):
    if(strlen($item["jerarquia"])==3)
      $menu_principal[] = array('id' => $item["id"], 'descripcion' => $item["descripcion"], 'link' => $item["link"], 'icono' => $item["icono"], 'jerarquia' => $item["jerarquia"], 'submenu' => $item["submenu"]);

    if(strlen($item["jerarquia"])==6)
      $submenu_uno[] = array('id' => $item["id"], 'descripcion' => $item["descripcion"], 'link' => $item["link"], 'icono' => $item["icono"], 'jerarquia' => $item["jerarquia"], 'submenu' => $item["submenu"]);

    if(strlen($item["jerarquia"])==9)
      $submenu_dos[] = array('id' => $item["id"], 'descripcion' => $item["descripcion"], 'link' => $item["link"], 'icono' => $item["icono"], 'jerarquia' => $item["jerarquia"], 'submenu' => $item["submenu"]);

  endforeach;
  for ($i=0; $i < count($menu_principal); $i++) { ?>
    <li id="li<?=$menu_principal[$i]['id'] ?>" <?php if($menu_principal[$i]["submenu"]>0){ ?> class="nav-item has-treeview" <?php }?> >

          <?php
            if($menu_principal[$i]["submenu"]>0){
          ?>

            <a id="<?=$menu_principal[$i]['id'] ?>" href="" class="nav-link" translate="no">
              <i id="i<?=$menu_principal[$i]['id'] ?>" class="nav-icon <?=$menu_principal[$i]["icono"] ?>"></i>
              <p>
                <?=$menu_principal[$i]['descripcion'] ?>
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>

            <?php }else{ ?>
              </li>
            <li class="nav-item">

            <a id="<?=$menu_principal[$i]['id'] ?>" href="<?=base_url($menu_principal[$i]["link"].''); ?>" class="nav-link">
              <i id="i<?=$menu_principal[$i]['id'] ?>"  class="nav-icon <?=$menu_principal[$i]["icono"] ?>"></i>
              <p>
                <?=$menu_principal[$i]['descripcion'] ?>
                 <span class="badge badge-info right"></span>
              </p>
            </a>

            <?php } ?>

              <?php if($menu_principal[$i]["submenu"]>0){ ?>
              <ul class="nav nav-treeview" translate="no">
                  <?php for ($j=0; $j < count($submenu_uno); $j++) {
                      if($menu_principal[$i]["jerarquia"]==substr($submenu_uno[$j]["jerarquia"], 0,3) and strlen($submenu_uno[$j]["jerarquia"])==6){

                        if($submenu_uno[$j]["submenu"]>0){
                  ?>

                  <li id="li_hijo<?=$submenu_uno[$j]['id'] ?>" class="nav-item has-treeview">
                    <a id="hijo<?=$submenu_uno[$j]['id'] ?>" href="#" class="nav-link">
                      <i id="i_hijo<?=$submenu_uno[$j]['id'] ?>" class="<?=$submenu_uno[$j]["icono"] ?> nav-icon"></i>
                      <p>
                        <?=$submenu_uno[$j]['descripcion'] ?>
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>

                    <?php if($submenu_uno[$j]["submenu"]>0){ ?>
                      <ul class="nav nav-treeview">
                        <?php
                        for ($k=0; $k < count($submenu_dos); $k++) {
                          if($submenu_uno[$j]["jerarquia"]==substr($submenu_dos[$k]["jerarquia"], 0,6) and strlen($submenu_dos[$k]["jerarquia"])==9){
                          ?>
                          <li>
                            <a id="item<?=$submenu_dos[$k]['id'] ?>" href="<?=base_url($submenu_dos[$k]["link"].''); ?>" class="nav-link">
                              <i id="i_item<?=$submenu_dos[$k]['id'] ?>" class="nav-icon <?=$submenu_dos[$k]["icono"] ?>"></i>
                              <p>
                                <?=$submenu_dos[$k]['descripcion'] ?>
                              </p>
                            </a>
                          </li>

                    <?php }
                        } ?>
                      </ul>
              <?php } ?>

                  </li>

                  <?php }else{ ?>
                    <li>
                      <a id="item<?=$submenu_uno[$j]['id'] ?>" href="<?=base_url($submenu_uno[$j]["link"].''); ?>" class="nav-link">
                        <i id="i_item<?=$submenu_uno[$j]['id'] ?>" class="nav-icon <?=$submenu_uno[$j]["icono"] ?>"></i>
                        <p>
                          <?=$submenu_uno[$j]['descripcion'] ?>
                        </p>
                      </a>
                    </li>
                  <?php }
                }
              } ?>

                </ul>
<?php

      } ?>

    </li>

  <?php
  }

  ?>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <script src="<?=base_url(); ?>project/js/sidebar.js"></script>
