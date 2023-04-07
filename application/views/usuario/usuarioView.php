
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fad fa-user"></i> Usuarios</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Seguridad</li>
          <li class="breadcrumb-item active">Usuarios</li>
        </ol>
      </div>


    </div>
  </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-info card-outline">
                <div class="card-header">
                  <h3 class="card-title"><b>Lista de Usuarios Actuales:</b></h3>
				  <button type="button" class="btn btn-danger btn-sm float-sm-right" onclick="nuevo()">Nuevo Usuario</button>
                </div>

                <div class="card-body">
					<div class="row">
						<div class="table-responsive">
							<div class="col-md-12" id="divContentLists">
							</div>
						</div>
					</div>
					<input type="hidden" id="txtIdlogoin" name="txtIdlogoin" value="<?php $Usuario = $this->session->userdata('USUARIO'); echo $Usuario['usu_grus_codigo']; ?>">

				<!--
                    <div class="table-responsive">
                        <table id="tableSpanish25" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color: #004a99; color: #ffff; vertical-align: middle; text-align: center;">Opciones</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Usuario</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Departamento</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Área</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Sección</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Cargo</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Grupo Usuario</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Nro.Doc.</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Correo Corp</th>
                                    <th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody> -->
                                <?php 
								/*
                                $i=0;
                                foreach ($lista as $item):
                                    $i++;
                                    if ($item["estado"] == '1') {
                                        $estado = 'ACTIVO';
                                          $icon = 'fas fa-ban';
                                          $iconColor = '#ff4d4d';
                                          $class = 'success';
                                          $classInvert = 'danger';
                                          $action = 'Inactivar';
                                      }else{
                                        $estado = 'INACTIVO';
                                          $icon= 'far fa-check-circle';
                                          $iconColor = '#00cc66';
                                          $class = 'danger';
                                          $classInvert = 'success';
                                          $action = 'Activar';
                                      }*/
                                    ?>
									<!--
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center;">
                                            <a  style="cursor: pointer;" onclick="leer('<?=$item['idusuario']?>')">
                                                <i style="color: #00ace6" class="fa fa-edit tooltips" tooltip="Edit User" tooltip-position="right" tooltip-type="primary"></i>
                                            </a>
                                            &nbsp;
                                            <a style="cursor: pointer;" onclick="resetPass('<?=$item['idusuario']?>')">
                                                <i style="color: #ffa64d" class="fas fa-lock-open-alt tooltips" tooltip="Reset Password" tooltip-position="right" tooltip-type="warning"></i> 
                                            </a>
                                            &nbsp;
                                            <a style="cursor: pointer;" onclick="cambiarEstado('<?=$item["idusuario"]?>' , '<?=$item["estado"]; ?>')">
                                                <i style="color: <?=$iconColor?>" class="<?=$icon?> tooltips" tooltip="<?=$action?>" tooltip-position="right" tooltip-type="<?=$classInvert?>"></i> 
                                            </a>
                                        </td>
                                        <td><a><?=$item["usr_nombres"] ?></a></br><small><?=$item["idusuario"] ?></small></td>
                                        <td style="vertical-align: middle; "><?=$item["departamento"] ?></td>
                                        <td style="vertical-align: middle; "><?=$item["area"] ?></td>
                                        <td style="vertical-align: middle; "><?=$item["seccion"] ?></td>
                                        <td style="vertical-align: middle; "><?=$item["cargo"] ?></td>
                                        <td><a><?=$item["grus_nombre"] ?></a></br><small>#Menús: <?=$item["nromenusadd"] ?></small></td>
                                        <td style="vertical-align: middle; "><?=$item["idcodigogeneral"] ?></td>
                                        <td style="vertical-align: middle; "><?=$item["usu_corporate_email"] ?></td>
                                        <td style="vertical-align: middle; " class="project-state"><span class="badge badge-<?=$class?>"><?=$estado?></span></td>
                                        
                                    </tr> -->

                                <?php //endforeach; ?>
                        <!--    </tbody>
                        </table>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
$URL = explode("/",uri_string());
echo form_open($URL[0].'/registrar',  'class="form-horizontal" enctype="multipart/form-data" role="form" autocomplete="off" id="frmRegistrar"');  
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloModal" id="myModalLabel"><i class="fad fa-user"></i> Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <input type="hidden" id="txtCodigo" name="txtCodigo">
            <div class="modal-body">

                <div class="row">

                    <div class="col-sm-6">

                        <input type="text" style="display:none">
                        <input type="password" style="display:none">

                        <div class="form-group">
                            <label for="txtNumeroDocumento"><b>Grupo de Usuario DMS:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="fa fa-users"></i></div>
                                </div>
                                <?php 
                                echo form_dropdown("cboGrupoUsuario", $listaGrupos, '', 'id="cboGrupoUsuario" class="form-control" style="width: 200; " '); 
                                ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtName"><b>Nombre Completo:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                </div>
                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="User Name" required="" maxlength="80" autocomplete="off" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtAccount"><b>Cuenta de Usuario:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="fa fa-address-book"></i></div>
                                </div>
                                <input type="text" name="txtAccount" id="txtAccount" class="form-control" placeholder="User Account" required="" maxlength="20" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtDNI"><b>Documento de Identidad:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="far fa-id-card"></i></div>
                                </div>
                                <input type="input" name="txtDNI" id="txtDNI" class="form-control" maxlength="20" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtCorreoCorp"><b>Correo Corporativo:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="far fa-id-card"></i></div>
                                </div>
                                <input type="input" name="txtCorreoCorp" id="txtCorreoCorp" class="form-control" maxlength="90" >
                            </div>
                        </div>

                    </div>



                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="cboDepartamento"><b>Departamento:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="far fa-layer-group"></i></div>
                                </div>
                                <?php 
                                    echo form_dropdown("cboDepartamento", $listaDepartamentos, '', 'id="cboDepartamento" class="form-control" style="width: 200; " '); 
                                ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cboArea"><b>Área:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="fas fa-building"></i></div>
                                </div>
                                <?php 
                                    echo form_dropdown("cboArea", $listaAreas, '', 'id="cboArea" class="form-control" style="width: 200; " '); 
                                ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cboSeccion"><b>Sección:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="fal fa-layer-group"></i></div>
                                </div>
                                <?php 
                                    echo form_dropdown("cboSeccion", $listaSecciones, '', 'id="cboSeccion" class="form-control" style="width: 200; " '); 
                                ?>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="cboCargo"><b>Cargo:</b></label>
                            <div class="input-group">
                                <div  class="input-group-prepend">
                                    <div style="color: #0073b7" class="input-group-text"><i class="far fa-suitcase"></i></div>
                                </div>
                                <?php 
                                    echo form_dropdown("cboCargo", $listaCargos, '', 'id="cboCargo" class="form-control" style="width: 200; " '); 
                                ?>

                            </div>
                        </div>

                        <div id="divCheck" class="form-group">
                            <div class="icheck-primary d-inline">
                                <input  type="checkbox" id="checkReprentanteLegal" name="checkReprentanteLegal" value="1">
                                <label for="checkReprentanteLegal">Representante Legal</label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="registrar()" id="add-row" class="btn btn-success">Registrar</button>
            </div>
        </div>
    </div>
</div>
<?=form_close(); ?>

<form class="form-horizontal" enctype="multipart/form-data" role="form" autocomplete="off" id="frmRegistrarNew">
	<div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal" id="myModalLabel"><i class="fad fa-user"></i> Nuevo Usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<input type="hidden" id="txtCodigoNew" name="txtCodigoNew">
				<div class="modal-body">

					<div class="row">

						<div class="col-sm-6">


							<div class="form-group">
								<label for="txtNumeroDocumento"><b>Grupo de Usuario DMS:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="fa fa-users"></i></div>
									</div>
									<?php
									echo form_dropdown("cboGrupoUsuarioDMS", $listaGrupos, '', 'id="cboGrupoUsuarioDMS" class="form-control" style="width: 200; " required="" ');
									?>

								</div>
							</div>

							<div class="form-group">
								<label for="txtNameNew"><b>Nombre Completo:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="fas fa-user-circle"></i></div>
									</div>
									<input type="text" name="txtNameNew" id="txtNameNew" class="form-control" placeholder="User Name" required="" maxlength="80" autocomplete="off" >
								</div>
							</div>

							<div class="form-group">
								<label for="txtDNINew"><b>Documento de Identidad:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="far fa-id-card"></i></div>
									</div>
									<input type="input" name="txtDNINew" id="txtDNINew" class="form-control" maxlength="20" required="">
								</div>
							</div>

							<div class="form-group">
								<label for="txtCorreoCorpNew"><b>Correo Corporativo:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="far fa-id-card"></i></div>
									</div>
									<input type="input" name="txtCorreoCorpNew" id="txtCorreoCorpNew" class="form-control" maxlength="90" >
								</div>
							</div>

							<div id="divCheckNew" class="form-group">
								<div class="icheck-primary d-inline">
									<input  type="checkbox" id="checkReprentanteLegalNew" name="checkReprentanteLegalNew" value="1">
									<label for="checkReprentanteLegalNew">Representante Legal</label>
									<input type="hidden" id="valRepresentateLegalNew" name="valRepresentateLegalNew">
								</div>
							</div>
						</div>



						<div class="col-sm-6">

							<div class="form-group">
								<label for="cboGrupoUsuarioIntranet"><b>Grupo de Usuario Intranet:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="fa fa-users"></i></div>
									</div>
									<?php
									echo form_dropdown("cboGrupoUsuarioIntranet", $listaGruposIntranet, '', 'id="cboGrupoUsuarioIntranet" class="form-control" style="width: 200; " required="" ');
									?>

								</div>
							</div>

							<div class="form-group">
								<label for="txtAccountNew"><b>Cuenta de Usuario:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="fa fa-address-book"></i></div>
									</div>
									<input type="text" name="txtAccountNew" id="txtAccountNew" class="form-control" placeholder="User Account" required="" maxlength="20" autocomplete="off">
								</div>
							</div>



							<div class="form-group">
								<label for="txtCorreoCorp"><b>Contraseña:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="fa fa-lock"></i></div>
									</div>
									<input type="password" name="txtPasswordNew" id="txtPasswordNew" class="form-control" maxlength="90" required="">
								</div>
							</div>

							<div class="form-group">
								<label for="txtCorreoCorp"><b>Repetir Contraseña:</b></label>
								<div class="input-group">
									<div  class="input-group-prepend">
										<div style="color: #0073b7" class="input-group-text"><i class="fa fa-lock"></i></div>
									</div>
									<input type="password" name="txtRepeatPasswordNew" id="txtRepeatPasswordNew" class="form-control" maxlength="90" required="">
								</div>
							</div>


						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit"   id="add-row-new" class="btn btn-success">Registrar</button>
				</div>
			</div>
		</div>
	</div>

</form>



<script>
  var base_url = '<?= base_url() ?>'
</script>
<script src="<?=base_url(); ?>project/js/usuario.js"></script>