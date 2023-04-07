$(document).ready(function(){
  $('#txtName').addClass('onlyAtoZEsp');
  $('#txtDNI').addClass('onlyAtoZUser');
  $('#txtAccount').addClass('onlyAtoZUser');
  $('#tblListado').dataTable();

  bsCustomFileInput.init();
  listarUsuarios();

});


function nuevo(){

  $('#tituloModal').html("<i class='fad fa-user'></i> Nuevo Usuario");
  $('#add-row').html("Registrar");
  $('#txtName').val("");
  $('#txtCodigo').val("");
  
  $('#myModalAdd').modal('show');
  limpiar();
}


function listarAreasAjax(departamento, area){
    $("#cboArea").empty();  


    var parametro={        
      "departamento": departamento
    };
    
    $.ajax({
      url: base_url+"Usuario/listarAreasAjax",
      type: 'POST',
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){   

          for(data in DataJson.resultado){

            $("#cboArea").append(""+
              "<Option value='"+DataJson.resultado[data].codigo+"' >"+DataJson.resultado[data].nombre+"</option>"
              );
          }
          if (area != 0) {
            $('#cboArea').val(area);
          }
          
        }
      }
    });
  }

$('#cboDepartamento').on('change', function(e) {
   codigo = $(this).val();
   listarAreasAjax(codigo, 0);

})




function listarSeccionAjax(area, seccion){
    $("#cboSeccion").empty();  


    var parametro={        
      "area": area
    };
    
    $.ajax({
      url: base_url+"Usuario/listarSeccionAjax",
      type: 'POST',
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){   
          
          for(data in DataJson.resultado){

            $("#cboSeccion").append(""+
              "<Option value='"+DataJson.resultado[data].codigo+"' >"+DataJson.resultado[data].nombre+"</option>"
              );
          }
          if (seccion != 0) {
            $('#cboSeccion').val(seccion);
          }
          
        }
      }
    });
  }



$('#cboArea').on('change', function(e) {
   codigo = $(this).val();
   listarSeccionAjax(codigo, 0);

})


function registrar(){

  var cadena=[];


  if ($("#cboGrupoUsuario").val()==''){
    cadena.push ("User Group");
    mensaje(cadena,'cboGrupoUsuario');
    return;
  }

  
  Swal.fire({
    title: 'Registering file...',
    text: 'Please wait while the file is registered and necessary transactions are made.',
    footer: "Don't close the window",
    imageUrl: base_url+'/adminlte/img/loading/loading_cross.gif',
    imageWidth: 200,
    imageHeight: 200,
    showCancelButton: false, // There won't be any cancel button
    showConfirmButton: false // There won't be any confirm button
  })


  ruta =  base_url+"/usuario/registrar";

  

  var formData = new FormData(document.getElementById("frmRegistrar"));



  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(DataJson){

        Swal.fire({ 
          title: "Register Done",
          text: "The user was registered",
          type: "success"
        }).then((result) => {

          ruta =  base_url+"/usuario";

          window.location.replace(ruta);
        })
   

      

    }

  });


}




function resetPass(idusuario){


  Swal.fire({
      type: 'info',
      title: 'Information',
      text: 'Please wait, information is being logged...',
      showConfirmButton: false,
      timer: 7500
    });

  ruta =  base_url+"/usuario/resetPass";

  var parametro={

    "idusuario": idusuario
  };

  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: "json",
    data: parametro,
    success: function(DataJson){
      if(DataJson.state){ 

        Swal.fire({ 
          title: "Password Reset",
          text: "The password was reset",
          type: "success"
        }).then((result) => {

          ruta =  base_url+"/usuario";

          window.location.replace(ruta);
        })
      }

    }

  });


}




function leer(idusuario){

  $('#tituloModal').html("<i class='fad fa-user'></i> Modificar Usuario");
  $('#add-row').html("Modificar");

  

  $('#txtAccount').attr('readonly', true); 
  ruta = base_url+"Usuario/leer";
  var parametro={

    "idusuario": idusuario
  }; 

  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: "json",
    data: parametro,
    success: function(DataJson){
      if(DataJson.state){    
        for(data in DataJson.resultado){
          var decodePassword = $.base64('decode', (DataJson.resultado[data].password));
          $('#txtCodigo').val(DataJson.resultado[data].idusuario);
          $('#txtAccount').val(DataJson.resultado[data].idusuario);
          $('#txtName').val(DataJson.resultado[data].usr_nombres);
          $('#txtDNI').val(DataJson.resultado[data].idcodigogeneral);
          $('#txtPassword').val(decodePassword);
          $('#txtRepeatPassword').val(decodePassword);
          $('#cboGrupoUsuario').val(DataJson.resultado[data].usu_grus_dms_codigo);

          $('#cboDepartamento').val(DataJson.resultado[data].departamento_codigo);
          listarAreasAjax(DataJson.resultado[data].departamento_codigo, DataJson.resultado[data].area_codigo);
          listarSeccionAjax(DataJson.resultado[data].area_codigo, DataJson.resultado[data].seccion_codigo);

          $('#cboCargo').val(DataJson.resultado[data].cargo_codigo);

          $('#txtCorreoCorp').val(DataJson.resultado[data].usu_corporate_email);
          // $('#cboArea').val(DataJson.resultado[data].area_codigo);
          // $('#cboSeccion').val(DataJson.resultado[data].seccion);

          // $('#cboGrupoUsuario').val(DataJson.resultado[data].usu_grus_codigo);
          // $('#txtRutaFirmaHI').val(DataJson.resultado[data].ruta_firma_legal);

          if (DataJson.resultado[data].representante_legal == '1') {
            $("#checkReprentanteLegal").prop("checked", true );
          }else{
            $("#checkReprentanteLegal").prop("checked", false );
          }
        }
        $('#myModal').modal('show');
      }  
    }
  });
}





function cambiarEstado(codigo, estado){
  if (estado == 0) {
    mensaje = "Enabled";
    nuevoEstado = "1";
    icono = 'success';
  }else{
    mensaje = "Disabled";
    nuevoEstado = "0";
    icono = 'error';
  }
  const swalWithBootstrapButtons = Swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false,
  })

  swalWithBootstrapButtons.fire({
    title: '¿Are you sure?',
    text: "¡The Account will be "+mensaje+"!",
    type: icono,
    showCancelButton: true,
    confirmButtonText: 'Yes, Continue!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      var parametro={
        "estado": nuevoEstado,
        "codigo": codigo
      };
      $.ajax({
        url: base_url+"/usuario/cambiarEstado",
        type: 'post',
        dataType: "json",
        data: parametro,
                    //data: $("#frmgrabar").serialize(),
                    success: function(DataJson){                    
                        //alert(DataJson.state);
                        if(DataJson.state){                 
                          swalWithBootstrapButtons.fire(
                            mensaje+'!',
                            'The Account was '+mensaje,
                            icono
                            ).then((result) => {

                             $("#btncerrar").click();
                             $(location).attr('href',base_url+ "/usuario");
                           })


                          }

                        }
                      });
    } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'No changes were made',
        'info'
        )
    }
  })
}

$('#frmRegistrarNew').submit(function (ev){
	// algo
	ev.preventDefault();
	registrarNew();
});


function registrarNew(){

	var cadena=[];

	if ($("#cboGrupoUsuarioDMS").val()==''){
		cadena.push ("User Group");
		mensaje(cadena,'cboGrupoUsuario');
		return;
	}

	if ($("#txtPasswordNew").val() != $("#txtRepeatPasswordNew").val()) {

		cadena.push ("Please enter the same Password as above");
		mensaje(cadena,'txtRepeatPasswordNew');
		return;
	}
	
	if($("#checkReprentanteLegalNew").is(':checked') ){
		$("#valRepresentateLegalNew").val("1");
	}else {
		$("#valRepresentateLegalNew").val("0");
	}

	Swal.fire({
		title: 'Registering file...',
		text: 'Please wait while the file is registered and necessary transactions are made.',
		footer: "Don't close the window",
		imageUrl: base_url+'adminlte/img/loading/loading_cross.gif',
		imageWidth: 200,
		imageHeight: 200,
		showCancelButton: false, // There won't be any cancel button
		showConfirmButton: false // There won't be any confirm button
	})

	$("#valRepresentateLegal").val("0");
	if($("#checkReprentanteLegalNew").is(':checked')){
		$("#valRepresentateLegal").val("1");
	}
	var ruta = base_url+ "usuario/registrarNew";

	var formData = new FormData(document.getElementById("frmRegistrarNew"));

	$.ajax({
		url: ruta,
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(DataJson){
			Swal.fire({
				title: "Register Done",
				text: "The user was registered",
				type: "success"
			}).then((result) => {
				$('#myModalAdd').modal('hide');
				listarUsuarios();

			})
		}

	}).fail( function(response) {

		//alert( 'Error!!' +  response);
		Swal.fire({
			title: "Error",
			text: "Usuario no registrado",
			type: "error"
		});

	});

}


function limpiar(){
	$("#txtNameNew").val("");
	$("#txtDNINew").val("");
	$("#txtCorreoCorpNew").val("");
	document.getElementById("checkReprentanteLegalNew").checked = false;
	$("#txtAccountNew").val("");
	$("#txtPasswordNew").val("");
	$("#txtRepeatPassword").val("");
	$("#cboGrupoUsuarioDMS").val("9");
	$("#cboGrupoUsuarioIntranet").val("3");
}

function listarUsuarios (){

	$("#divContentLists").html(
		"<div id='loading-wrapper'>"+
		"<img id='img_loader' class='img-responsive' src='"+base_url+"adminlte/img/loading/loading_cross.gif' alt='Chania' style='width: 150px; height: 150px; margin:0px auto;display:block'>"+
		"<div id='loading-content'></div>"+
		"</div>");
	
	var idLogin = $("#txtIdlogoin").val();

	var htmlTabla =
		'<table id="tblUser" class="table table-bordered table-striped">'+

		'<thead>'+

		'<tr>'+
		'<th style="background-color: #004a99; color: #ffff; vertical-align: middle; text-align: center;">Opciones</th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Estado</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Usuario</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Departamento</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Área</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Sección</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Cargo</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;" ><center>Grupo Usuario</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle; text-align: center;"><center>Nro.Doc.</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle;text-align: center;"><center>Correo</center></th>'+
		'<th style="background-color:#006fe6; color:#fff; font-size: 15px; vertical-align: middle;text-align: center;"><center>Representante Legal</center></th>'+
		'</tr>'+

		'</thead>'+

		'<tbody>';

		$.ajax({
			url: base_url+"usuario/getUsuarioList",
			type: 'POST',
			dataType: "json",
			//data: parametro,
			success: function(DataJson){
				if(DataJson.state){
					console.log( DataJson.resultado);
					for(data in DataJson.resultado){
						if (true) {

							var estado = 'ACTIVO';
							var icon = 'fas fa-ban tooltips';
							var iconColor = '#ff4d4d';
							var classs = 'success';
							var classInvert = 'danger';
							var action = 'Inactivar';

							if(DataJson.resultado[data].estado != '1'){
								estado = 'INACTIVO';
								icon= 'far fa-check-circle tooltips';
								iconColor = '#00cc66';
								classs = 'danger';
								classInvert = 'success';
								action = 'Activar';
							}
							var eliminar = "";
							if(idLogin == "1"){
								eliminar ='&nbsp;'+
									"<a style=\"cursor: pointer;\" onclick=\"eliminar(\'" + DataJson.resultado[data].idusuario + "\')\">"+
									'<i style="color: #333333" class="far fa-trash-alt tooltips" tooltip="Delete User"'+
									' tooltip-position="top" tooltip-type="secondary"></i>'+
									'</a>';
							}
							
							var representante = "NO";
							if(DataJson.resultado[data].estado == '1'){
								representante = "SI";
							}

							htmlTabla +=

								'<tr>' +

								'<td style="vertical-align: middle; text-align: center;">'+
									"<a style=\"cursor: pointer;\" onclick=\"leer(\'" + DataJson.resultado[data].idusuario + "\')\">"+
										'<i style="color: #00ace6" class="fa fa-edit tooltips" tooltip="Edit User"'+
										   'tooltip-position="right" tooltip-type="primary"></i>'+
									'</a>'+
									'&nbsp;'+
									"<a style=\"cursor: pointer;\" onclick=\"resetPass(\'" + DataJson.resultado[data].idusuario + "\')\">"+
										'<i style="color: #ffa64d" class="fas fa-lock-open-alt tooltips"'+
										   'tooltip="Reset Password" tooltip-position="right" tooltip-type="warning"></i>'+
									'</a>'+
									'&nbsp;'+
									"<a style=\"cursor: pointer;\" onclick=\"cambiarEstado(\'" + DataJson.resultado[data].idusuario + "\',\'" + DataJson.resultado[data].estado + "\')\">"+
										"<i style=\"color: "+iconColor+"\" class=\""+icon+"\""+
										" tooltip=\""+action+"\" tooltip-position=\"right\" tooltip-type=\""+classInvert+"\"></i>"+
									'</a>'+
								eliminar+
								'</td>'+
								'<td style=" cursor: pointer; vertical-align: middle; " class="project-state"><span class="badge badge-'+classs+'">'+estado+'</span></td>'+
								'<td style=" cursor: pointer; vertical-align: middle; "><a>'+validarNull(DataJson.resultado[data].usr_nombres)+'</a></br><small>'+validarNull(DataJson.resultado[data].idusuario)+'</small></td>'+
								'<td style=" cursor: pointer; vertical-align: middle; ">'+validarNull(DataJson.resultado[data].departamento)+'</td>'+
								'<td style=" cursor: pointer; vertical-align: middle; ">'+validarNull(DataJson.resultado[data].area)+'</td>'+
								'<td style=" cursor: pointer; vertical-align: middle; ">'+validarNull(DataJson.resultado[data].seccion)+'</td>'+
								'<td style=" cursor: pointer;vertical-align: middle; ">'+validarNull(DataJson.resultado[data].cargo)+'</td>'+
								'<td style=" cursor: pointer;vertical-align: middle; "><a>'+validarNull(DataJson.resultado[data].grus_nombre)+'</a></br><small>#Menús: '+validarNull(DataJson.resultado[data].nromenusadd)+'</small></td>'+
								'<td style=" cursor: pointer; vertical-align: middle; ">'+validarNull(DataJson.resultado[data].idcodigogeneral)+'</td>'+
								'<td style=" cursor: pointer; vertical-align: middle; ">'+validarNull(DataJson.resultado[data].usu_corporate_email)+'</td>'+
								'<td style=" cursor: pointer; vertical-align: middle; text-align: center; ">'+representante+'</td>'+
								'</tr>';

								'</tr>';


					}
					//fin

				}
			}

			htmlTabla+='</tbody>'+
				'<tfoot>'+

				/*
				'<tr>'+
				'<th style="background-color: #004a99; color: #ffff; vertical-align: middle; text-align: center;">Opciones</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Usuario</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Departamento</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Área</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Sección</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Cargo</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Grupo Usuario</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Nro.Doc.</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Correo Corp</th>'+
				'<th style="background-color: #006fe6; color: #ffff; vertical-align: middle;">Estado</th>'+
				'</tr>'+
*/
				'</tfoot>'+

				'</table>';

			$("#divContentLists").html(htmlTabla);

			$('#tblUser').DataTable({
				"aaSorting": [],
				"pageLength": 10,
				"bLengthChange": true,
				"searching": true
			});
			
			$('.tooltips').append("<span></span>");
				$('.tooltips:not([tooltip-position])').attr('tooltip-position','bottom');


				$(".tooltips").mouseenter(function(){
					$(this).find('span').empty().append($(this).attr('tooltip'));
				});
				
		}
	});

	function validarNull(valor){

		if((valor==null)) {
			valor = '';
		}
		return valor;
	}


}

function eliminar(idusuario){

	const swalWithBootstrapButtons = Swal.mixin({
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass: 'btn btn-danger',
		buttonsStyling: false,
	})

	swalWithBootstrapButtons.fire({
		title: '¿Está seguro?',
		text: "¡El registro será eliminado!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {



			var parametro={
				"idusuario": idusuario
			};


			$.ajax({
				url: base_url+"usuario/eliminar",
				type: 'post',
				dataType: "json",
				data: parametro,
				success: function(DataJson){
					if(DataJson.state){
						swalWithBootstrapButtons.fire(
							'¡Eliminado!',
							'The registro fue eliminado.',
							'success'
						).then((result) => {
							//$(location).attr('href',"usuario");
							listarUsuarios();
						})
					}
				}
			});


		}else if (result.dismiss === Swal.DismissReason.cancel){

			swalWithBootstrapButtons.fire(
				'Cancelado',
				'No se realizó ninguna acción ;)',
				'error'
			)
		}

	})
}