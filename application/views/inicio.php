<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><i class="nav-icon far fa-home-lg"></i> Inicio</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">Inicio</li>

				</ol>
			</div>
		</div>
	</div>
</section>
<!-- <form class="form-inline" name="frmReporte" id="frmReporte" action="<?=base_url(); ?>jaspergen/genExcelJasperTest" method="post">
	<button type="submit" class="btn btn-success btn-sm left"  style="box-shadow: 1px 1px 7px 0px rgba(0,0,0,0.75);">TEST JAVA BRIDGE</button>
</form> -->
<section class="content">

	

	<div class="row">

		

		<!-- LASTEST PUBLISHED -->
		<div class="col-md-6">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="far fa-parking" style="color: #1976D2"></i>
						<b>Documentos vistos recientes</b>
					</h3>

					<div class="card-tools">
						<a href="processes" style="background-color: #1976D2; color: #fff" type="button" class="btn hvr-icon-rotate" >
							<i class="far fa-external-link-alt hvr-icon"></i> Macroprocesos
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 ">

							<div class="row">
								<div id="divLastMacroprocesses" class="col-12">


								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- END LASTEST PUBLISHED -->


		<!-- RECENT FILES -->
		<div class="col-md-6">
			<div class="card card-danger card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<i class="far fa-file-search" style="color: #C82333"></i>
						<b>Contratos vistos recientemente</b>
					</h3>

					<div class="card-tools">
						<a href="Contract" style="background-color: #17A2B8; color: #fff" type="button" class="btn hvr-icon-rotate" >
							<i class="far fa-external-link-alt hvr-icon"></i> Contratos
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 ">

							<div class="row">
								<div id="divRecentFiles" class="col-12">

									

								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- END RECENT FILES -->
		
	</div>

</section>


<!-- DOCUMENT PREVIEW MODAL -->
<form class="form-horizontal" role="form" autocomplete="off" method="post">
	<div class="modal fade bd-example-modal-xl" id="modalDocumentView" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				
				<div class="modal-body">
					<input type="hidden" name="txtHIRutaFile" id="txtHIRutaFile">
					<input type="hidden" name="txtDofiCodigoHide" id="txtDofiCodigoHide">
					<div class="row">

						<div class="col-md-6">

							<div class="col-md-12">
								<div class="form-group">
									<label>Name:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-file-alt"></i></span>
										</div>
										<input type="text" class="form-control form-control-sm" id="txtNombreView" name="txtNombreView" readonly>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="row">

									<div class="col-md-8">
										<div class="form-group">
											<label class="">Tipo:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-file-code"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtTipoView" name="txtTipoView" readonly>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Estado:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-info-circle"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtEstadoView" name="txtEstadoView" readonly>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="col-md-12">
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label>Creation Date:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-calendar-plus"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtFechaCreacionView" name="txtFechaCreacionView" readonly>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Uploader User:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-user"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtUsuarioCreadorView" name="txtUsuarioCreadorView" readonly>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>



						<div class="col-md-6">

							<div class="col-md-12">
								<div class="form-group">
									<label>Description:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
										</div>
										<input type="text" class="form-control form-control-sm" id="txtDescripcionView" name="txtDescripcionView" readonly>
									</div>
								</div>
							</div>


							<div class="col-md-12">
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label>Approval Date:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-calendar-check"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtFechaAprobacionView" name="txtFechaAprobacionView" readonly>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Approval User:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user-check"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtUsuarioAprobadorView" name="txtUsuarioAprobadorView" readonly>
											</div>
										</div>
									</div>

								</div>
							</div>


							<div class="col-md-12">
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label>Size:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-receipt"></i></span>
												</div>
												<input type="text" class="form-control form-control-sm" id="txtSizeView" name="txtSizeView" readonly>
											</div>
										</div>
									</div>

									<div class="col-sm-3" >
										<div class="form-group">
											<label style="visibility: hidden">Refresh:</label>
											<div class="input-group">

												<button id="btnRefreshView" type="button" class="btn btn-block btn-primary btn-sm hvr-icon-spin" ><i class="fas fa-sync-alt hvr-icon" style="color: #fff"></i>&nbsp; Refresh</button>
											</div>
										</div>
									</div>

									<div class="col-sm-3" >
										<div class="form-group">
											<label style="visibility: hidden">Download:</label>
											<div class="input-group">

												<a id="aRefDownload" type="button" class="btn btn-block btn-danger btn-sm hvr-icon-sink-away" style="color: #fff"><i class="fas fa-download hvr-icon" style="color: #fff"></i>&nbsp; Download</a>

											</div>
										</div>
									</div>

								</div>
							</div>


						</div>

						<div id="googleDociFrame" class="col-md-12 holds-the-iframe">


						</div>




					</div>

				</div>


			</div>

		</div>

	</div>
</form>
<!-- END DOCUMENT PREVIEW MODAL -->
<script>
  var base_url = '<?= base_url() ?>'
</script>
<script src="<?=base_url(); ?>project/js/inicio.js"></script>