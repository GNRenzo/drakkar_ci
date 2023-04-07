$(document).ready(function(){

  countDocumentByTye();
  listarRecentContract();
  listarRecentMacroprocesses();
  // listarPendingApproval();
  
});


function countDocumentByTye(){


  $.ajax({
        url: base_url+"inicio/countDocumentByTye",
        type: 'POST',
        dataType: "json",
        success: function(DataJson){
            if(DataJson.state){          
                
                for(data in DataJson.resultado){
                  if (DataJson.resultado[data].doty_codigo == '1') {
                    file = '';
                    if (DataJson.resultado[data].count==1) {
                      file = ' File';
                    }else{
                      file = ' Files';
                    }
                    $('#countDocuments').html(DataJson.resultado[data].count+file);
                  }else if (DataJson.resultado[data].doty_codigo == '2') {
                    file = '';
                    if (DataJson.resultado[data].count==1) {
                      file = ' File';
                    }else{
                      file = ' Files';
                    }
                    $('#countProcesses').html(DataJson.resultado[data].count+file);
                  }else if (DataJson.resultado[data].doty_codigo == '3') {
                    file = '';
                    if (DataJson.resultado[data].count==1) {
                      file = ' File';
                    }else{
                      file = ' Files';
                    }
                    $('#countPolicies').html(DataJson.resultado[data].count+file);
                  }else if (DataJson.resultado[data].doty_codigo == '4') {
                    file = '';
                    if (DataJson.resultado[data].count==1) {
                      file = ' File';
                    }else{
                      file = ' Files';
                    }
                    $('#countFormats').html(DataJson.resultado[data].count+file);
                  }
                }
            }
        }
    });

  
}






function listarRecentContract(){


  $("#divRecentFiles").html(
    "<div id='loading-wrapper'>"+
    "<img id='img_loader' class='img-responsive' src='"+base_url+"adminlte/img/loading/loading_cross.gif' alt='Chania' style='width: 150px; height: 150px; margin:0px auto;display:block'>"+
    "<div id='loading-content'></div>"+
    "</div>");

  $.ajax({
        url: base_url+"Inicio/listarRecentContract",
        type: 'POST',
        dataType: "json",
        success: function(DataJson){
            $("#divRecentFiles").empty();
            if(DataJson.state){          
                
                for(data in DataJson.resultado){
                  $("#divRecentFiles").append(

                    "<div class='post'>"+
                    "<div class='user-block'>"+             
                    "<img class='img-circle img-bordered-sm' src='"+base_url+"adminlte/img/extensions/"+DataJson.resultado[data].fiex_icono+"' >"+  
                    "<span class='username'>"+
                    "<a onclick=\"viewDocument(\'"+DataJson.resultado[data].dofi_codigo+"\')\" style='cursor:pointer; color:#666; background-color: transparent; font-weight: 700;' onmouseover="+"this.style.color='#0056b3'"+" onMouseOut="+"this.style.color='#666'"+">"+DataJson.resultado[data].dofi_nombre+'.'+DataJson.resultado[data].fiex_extension+"</a>"+
                    "</span>"+
                    "<span class='description'>Visto: "+DataJson.resultado[data].movdo_fecha+' '+DataJson.resultado[data].movdo_hora+"</span>"+
                    "</div>"+
                    "<p>"+
                    "<a href='documents/downloadWithWaterMark/"+DataJson.resultado[data].dofi_codigo+"'  class='link-black text-sm hvr-icon-down'><i class='fad fa-cloud-download-alt hvr-icon mr-1 '  style='color: #007acc'></i> "+DataJson.resultado[data].fiex_descripcion+' | '+DataJson.resultado[data].dofi_size+"</a>"+
                    "</p>"+
                    "</div>"

                  );
                
                }
            }
        }
    });
}



function listarRecentMacroprocesses(){
 

  $("#divLastMacroprocesses").html(
    "<div id='loading-wrapper'>"+
    "<img id='img_loader' class='img-responsive' src='"+base_url+"adminlte/img/loading/loading_cross.gif' alt='Chania' style='width: 150px; height: 150px; margin:0px auto;display:block'>"+
    "<div id='loading-content'></div>"+
    "</div>");

  $.ajax({
        url: base_url+"Inicio/listarRecentMacroprocesses",
        type: 'POST',
        dataType: "json",
        success: function(DataJson){
            $("#divLastMacroprocesses").empty();
            if(DataJson.state){          
                
                for(data in DataJson.resultado){
                  $("#divLastMacroprocesses").append(

                    "<div class='post'>"+
                    "<div class='user-block'>"+             
                    "<img class='img-circle img-bordered-sm' src='"+base_url+"adminlte/img/extensions/"+DataJson.resultado[data].fiex_icono+"' >"+
                    "<span class='username'>"+
                    "<a onclick=\"viewProcess(\'"+DataJson.resultado[data].prfi_codigo+"\')\" style='cursor:pointer; color:#666; background-color: transparent; font-weight: 700;' onmouseover="+"this.style.color='#0056b3'"+" onMouseOut="+"this.style.color='#666'"+">"+DataJson.resultado[data].prfi_nombre+'.'+DataJson.resultado[data].fiex_extension+"</a>"+
                    "</span>"+
                    "<span class='description'>Visto: "+DataJson.resultado[data].movdopr_fecha+' '+DataJson.resultado[data].movdopr_hora+"</span>"+
                    "</div>"+
                    "<p>"+
                    "<a href='"+base_url+"/documents/downloadWithWaterMark/"+DataJson.resultado[data].prfi_codigo+"'  class='link-black text-sm hvr-icon-down'><i class='fad fa-cloud-download-alt hvr-icon mr-1 '  style='color: #007acc'></i> "+DataJson.resultado[data].fiex_descripcion+' | '+DataJson.resultado[data].prfi_size+"</a>"+
                    "</p>"+
                    "</div>"

                  );
                
                }
            }
        }
    });
}




// function listarLastPublished(){
 
//   var url_actual = window.location.href;
//   var URL_BASE = 'https://'+url_actual.split('/')[2]+'/'+url_actual.split('/')[3];

//   $("#divLastPublished").html(
//     "<div id='loading-wrapper'>"+
//     "<img id='img_loader' class='img-responsive' src="+URL_BASE+"/adminlte/img/loading/loading_cross.gif alt='Chania' style='width: 150px; height: 150px; margin:0px auto;display:block'>"+
//     "<div id='loading-content'></div>"+
//     "</div>");

//   $.ajax({
//         url: URL_BASE+"/inicio/listarLastPublished",
//         type: 'POST',
//         dataType: "json",
//         success: function(DataJson){
//             $("#divLastPublished").empty();
//             if(DataJson.state){          
                
//                 for(data in DataJson.resultado){
//                   $("#divLastPublished").append(

//                     "<div class='post'>"+
//                     "<div class='user-block'>"+             
//                     "<img class='img-circle img-bordered-sm' src='"+URL_BASE+"/adminlte/img/extensions/"+DataJson.resultado[data].fiex_icono+"' >"+  
//                     "<span class='username'>"+
//                     "<a onclick=\"viewDocument(\'"+DataJson.resultado[data].dofi_codigo+"\')\" style='cursor:pointer; color:#666; background-color: transparent; font-weight: 700;' onmouseover="+"this.style.color='#0056b3'"+" onMouseOut="+"this.style.color='#666'"+">"+DataJson.resultado[data].dofi_nombre+'.'+DataJson.resultado[data].fiex_extension+"</a>"+
//                     "</span>"+
//                     "<span class='description'>Elevated date: "+DataJson.resultado[data].movdo_fecha+' '+DataJson.resultado[data].movdo_hora+"</span>"+
//                     "</div>"+
//                     "<p>"+
//                     "<a href='"+URL_BASE+"/documents/downloadWithWaterMark/"+DataJson.resultado[data].dofi_codigo+"'  class='link-black text-sm hvr-icon-down'><i class='fad fa-cloud-download-alt hvr-icon mr-1 '  style='color: #007acc'></i> "+DataJson.resultado[data].fiex_descripcion+' | '+DataJson.resultado[data].dofi_size+"</a>"+
//                     "</p>"+
//                     "</div>"

//                   );
                
//                 }
//             }
//         }
//     });
// }



// function listarPendingApproval(){
 
//   var url_actual = window.location.href;
//   var URL_BASE = 'https://'+url_actual.split('/')[2]+'/'+url_actual.split('/')[3];

//   $("#divPendingApproval").html(
//     "<div id='loading-wrapper'>"+
//     "<img id='img_loader' class='img-responsive' src="+URL_BASE+"/adminlte/img/loading/loading_cross.gif alt='Chania' style='width: 150px; height: 150px; margin:0px auto;display:block'>"+
//     "<div id='loading-content'></div>"+
//     "</div>");

//   $.ajax({
//         url: URL_BASE+"/inicio/listarPendingApproval",
//         type: 'POST',
//         dataType: "json",
//         success: function(DataJson){
//             $("#divPendingApproval").empty();
//             if(DataJson.state){          
                
//                 for(data in DataJson.resultado){
//                   $("#divPendingApproval").append(

//                     "<div class='post'>"+
//                     "<div class='user-block'>"+             
//                     "<img class='img-circle img-bordered-sm' src='"+URL_BASE+"/adminlte/img/extensions/"+DataJson.resultado[data].fiex_icono+"' >"+  
//                     "<span class='username'>"+
//                     "<a onclick=\"viewDocument(\'"+DataJson.resultado[data].dofi_codigo+"\')\" style='cursor:pointer; color:#666; background-color: transparent; font-weight: 700;' onmouseover="+"this.style.color='#0056b3'"+" onMouseOut="+"this.style.color='#666'"+">"+DataJson.resultado[data].dofi_nombre+'.'+DataJson.resultado[data].fiex_extension+"</a>"+
//                     "</span>"+
//                     "<span class='description'>Published date: "+DataJson.resultado[data].movdo_fecha+' '+DataJson.resultado[data].movdo_hora+"</span>"+
//                     "</div>"+
//                     "<p>"+
//                     "<a href='"+URL_BASE+"/documents/downloadWithWaterMark/"+DataJson.resultado[data].dofi_codigo+"'  class='link-black text-sm hvr-icon-down'><i class='fad fa-cloud-download-alt hvr-icon mr-1 '  style='color: #007acc'></i> "+DataJson.resultado[data].fiex_descripcion+' | '+DataJson.resultado[data].dofi_size+"</a>"+
//                     "</p>"+
//                     "</div>"

//                   );
                
//                 }
//             }
//         }
//     });
// }


function viewDocument(codigoDocumento){ 
 
  // alert(codigoDocumento);
  $('#googleDociFrame').empty();


    $('#modalDocumentView').modal('show');

    $("#btnRefreshView").prop("onclick", null).off("click");
    $("#btnRefreshView").click(function() {
      refreshDocument();
    });

   
    var parametro={        
      "codigo": codigoDocumento
    };
    var folder = '';
    $.ajax({
          url: base_url+"documents/leerDocumento",
          type: 'POST',
          dataType: "json",
          data: parametro,
          success: function(DataJson){
              if(DataJson.state){          
                  var estadoAprobacion = '';
                  var fechaAprobacionStamp = '';
                  var waterMark = '';
                  var codigo = '';
                  var extension = '';
                  for(data in DataJson.resultado){
                    $('#txtDofiCodigoHide').val(DataJson.resultado[data].dofi_codigo);  
                    if (DataJson.resultado[data].dofi_estado_aprobacion == '0') {
                      estadoAprobacion = 'PENDING';
                    }else if (DataJson.resultado[data].dofi_estado_aprobacion == '1') {
                      estadoAprobacion = 'APPROVED';
                    }else if (DataJson.resultado[data].dofi_estado_aprobacion == '2') {
                      estadoAprobacion = 'REJECTED';
                    }

                    if (DataJson.resultado[data].dofi_fecha_aprobacion != null) {
                      fechaAprobacionStamp = DataJson.resultado[data].dofi_fecha_aprobacion+' '+DataJson.resultado[data].dofi_hora_aprobacion;
                    }

                       $('#txtNombreView').val(DataJson.resultado[data].dofi_nombre);
                       $('#txtDescripcionView').val(DataJson.resultado[data].dofi_descripcion);
                       $('#txtFechaCreacionView').val(DataJson.resultado[data].dofi_fecha_creacion+' '+DataJson.resultado[data].dofi_hora_creacion);
                       $('#txtUsuarioCreadorView').val(DataJson.resultado[data].usuario_creador);
                       $('#txtTipoView').val(DataJson.resultado[data].fiex_descripcion+' (.'+DataJson.resultado[data].fiex_extension+')');
                       $('#txtEstadoView').val(estadoAprobacion);
                       $('#txtFechaAprobacionView').val(fechaAprobacionStamp);
                       $('#txtUsuarioAprobadorView').val(DataJson.resultado[data].usuario_aprobador);
                       $('#txtSizeView').val(DataJson.resultado[data].dofi_size);
                       $('#txtHIRutaFile').val(DataJson.resultado[data].dofi_ruta);
                      
                      folder = DataJson.resultado[data].dofi_ruta;

                      $('#aRefDownload').attr("href", base_url+"documents/downloadWithWaterMark/"+DataJson.resultado[data].dofi_codigo);

                  }                
              }
                      // var link = 'https://docs.google.com/gview?url='+URL_BASE+'/'+folder+'&embedded=true';

                      if (DataJson.resultado[data].dofi_fiex_codigo == 11 ) {

                        var link = folder;

                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');

                      }else if ( DataJson.resultado[data].dofi_fiex_codigo == 12) {

                          $('#aRefDownload').hide();
                          
                          var link = folder;

                          var iframe =  $('<iframe class="embed-responsive-item" id="ifrVistaPrevia" src="'+link+'?e=hQOzSl&action=embedview&wdHideHeaders=True&wdAllowInteractivity=true&wdDownloadButton=True" width="100%" height="580px"></iframe>').on('load', () => {
                            $('#googleDociFrame').waitMe('hide')
                          }) 

                        }else if ( DataJson.resultado[data].dofi_fiex_codigo == 6) {// PDF

                          if (DataJson.resultado[data].dofi_copia_autorizada == '1') {
                            var link = base_url+'documents/previewMarkwater'+'/'+DataJson.resultado[data].dofi_codigo;

                          }else{
                            var link = base_url+'/'+folder;
                          }


                          var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                        }else if ( DataJson.resultado[data].dofi_fiex_codigo == 4 || DataJson.resultado[data].dofi_fiex_codigo == 5) {// WORD Y EXCEL

                          

                          var link = 'https://view.officeapps.live.com/op/view.aspx?src='+base_url+'/'+folder;

                          var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                        }

              


                      $('#googleDociFrame').html(iframe)

                      
          }
      });
    
  


}


function refreshDocument(){
 
  // alert(codigoDocumento);
  $('#googleDociFrame').empty();


    $('#modalDocumentView').modal('show');

    codigoDocumento = $('#txtDofiCodigoHide').val();

   
    var parametro={        
      "codigo": codigoDocumento
    };
    var folder = '';
    $.ajax({
          url: base_url+"documents/leerDocumento",
          type: 'POST',
          dataType: "json",
          data: parametro,
          success: function(DataJson){
              if(DataJson.state){          
                  var estadoAprobacion = '';
                  var fechaAprobacionStamp = '';
                  var waterMark = '';
                  var codigo = '';
                  var extension = '';
                  for(data in DataJson.resultado){
                    $('#txtDofiCodigoHide').val(DataJson.resultado[data].dofi_codigo);  
                    if (DataJson.resultado[data].dofi_estado_aprobacion == '0') {
                      estadoAprobacion = 'PENDING';
                    }else if (DataJson.resultado[data].dofi_estado_aprobacion == '1') {
                      estadoAprobacion = 'APPROVED';
                    }else if (DataJson.resultado[data].dofi_estado_aprobacion == '2') {
                      estadoAprobacion = 'REJECTED';
                    }

                    if (DataJson.resultado[data].dofi_fecha_aprobacion != null) {
                      fechaAprobacionStamp = DataJson.resultado[data].dofi_fecha_aprobacion+' '+DataJson.resultado[data].dofi_hora_aprobacion;
                    }

                       $('#txtNombreView').val(DataJson.resultado[data].dofi_nombre);
                       $('#txtDescripcionView').val(DataJson.resultado[data].dofi_descripcion);
                       $('#txtFechaCreacionView').val(DataJson.resultado[data].dofi_fecha_creacion+' '+DataJson.resultado[data].dofi_hora_creacion);
                       $('#txtUsuarioCreadorView').val(DataJson.resultado[data].usuario_creador);
                       $('#txtTipoView').val(DataJson.resultado[data].fiex_descripcion+' (.'+DataJson.resultado[data].fiex_extension+')');
                       $('#txtEstadoView').val(estadoAprobacion);
                       $('#txtFechaAprobacionView').val(fechaAprobacionStamp);
                       $('#txtUsuarioAprobadorView').val(DataJson.resultado[data].usuario_aprobador);
                       $('#txtSizeView').val(DataJson.resultado[data].dofi_size);
                       $('#txtHIRutaFile').val(DataJson.resultado[data].dofi_ruta);
                      
                      folder = DataJson.resultado[data].dofi_ruta;

                      $('#aRefDownload').attr("href", base_url+"documents/downloadWithWaterMark/"+DataJson.resultado[data].dofi_codigo);

                  }                
              }



                      if (DataJson.resultado[data].dofi_fiex_codigo == 11 ) {

                        var link = folder;

                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');

                      }else if ( DataJson.resultado[data].dofi_fiex_codigo == 12) {

                          $('#aRefDownload').hide();
                          
                          var link = folder;

                          var iframe =  $('<iframe class="embed-responsive-item" id="ifrVistaPrevia" src="'+link+'?e=hQOzSl&action=embedview&wdHideHeaders=True&wdAllowInteractivity=true&wdDownloadButton=True" width="100%" height="580px"></iframe>').on('load', () => {
                            $('#googleDociFrame').waitMe('hide')
                          }) 

                        }else if ( DataJson.resultado[data].dofi_fiex_codigo == 6) {// PDF

                          if (DataJson.resultado[data].dofi_copia_autorizada == '1') {
                            var link = base_url+'documents/previewMarkwater'+'/'+DataJson.resultado[data].dofi_codigo;

                          }else{
                            var link = base_url+'/'+folder;
                          }


                          var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                        }else if ( DataJson.resultado[data].dofi_fiex_codigo == 4 || DataJson.resultado[data].dofi_fiex_codigo == 5) {// WORD Y EXCEL

                          

                          var link = 'https://view.officeapps.live.com/op/view.aspx?src='+base_url+'/'+folder;

                          var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                        }





                      $('#googleDociFrame').html(iframe);


                 



                      
          }
      });
    

}




function viewProcess(codigoDocumento){
 
  // alert(codigoDocumento);
  $('#googleDociFrame').empty();


    $('#modalDocumentView').modal('show');

    
    $("#btnRefreshView").prop("onclick", null).off("click");
    $("#btnRefreshView").click(function() {
      refreshProcess();
    });
   
    var parametro={        
      "codigo": codigoDocumento
    };
    var folder = '';
    $.ajax({
          url: base_url+"Processes/leerDocumento",
          type: 'POST',
          dataType: "json",
          data: parametro,
          success: function(DataJson){
              if(DataJson.state){          
                  var estadoAprobacion = '';
                  var fechaAprobacionStamp = '';
                  var waterMark = '';
                  var codigo = '';
                  var extension = '';
                  for(data in DataJson.resultado){
                    $('#txtDofiCodigoHide').val(DataJson.resultado[data].prfi_codigo);  
                    if (DataJson.resultado[data].prfi_estado_aprobacion == '0') {
                      estadoAprobacion = 'PENDIENTE';
                    }else if (DataJson.resultado[data].prfi_estado_aprobacion == '1') {
                      estadoAprobacion = 'APROBADO';
                    }else if (DataJson.resultado[data].prfi_estado_aprobacion == '2') {
                      estadoAprobacion = 'RECHAZADO';
                    }

                    if (DataJson.resultado[data].prfi_fecha_aprobacion != null) {
                      fechaAprobacionStamp = DataJson.resultado[data].prfi_fecha_aprobacion+' '+DataJson.resultado[data].prfi_hora_aprobacion;
                    }

                        $('#txtNombreView').val(DataJson.resultado[data].prfi_nombre);
                        $('#txtDescripcionView').val(DataJson.resultado[data].prfi_descripcion);
                        $('#txtFechaCreacionView').val(DataJson.resultado[data].prfi_fecha_creacion+' '+DataJson.resultado[data].prfi_hora_creacion);
                        $('#txtUsuarioCreadorView').val(DataJson.resultado[data].usuario_creador);
                        $('#txtTipoView').val(DataJson.resultado[data].fiex_descripcion+' (.'+DataJson.resultado[data].fiex_extension+')');
                        $('#txtEstadoView').val(estadoAprobacion);
                        $('#txtFechaAprobacionView').val(fechaAprobacionStamp);
                        $('#txtUsuarioAprobadorView').val(DataJson.resultado[data].usuario_aprobador);
                        $('#txtSizeView').val(DataJson.resultado[data].prfi_size);
                        $('#txtHIRutaFile').val(DataJson.resultado[data].prfi_ruta);
                      
                      folder = DataJson.resultado[data].prfi_ruta;

                      $('#aRefDownload').attr("href", base_url+"Processes/downloadWithWaterMark/"+DataJson.resultado[data].prfi_codigo);

                  }                
              }
                      // var link = 'https://docs.google.com/gview?url='+URL_BASE+'/'+folder+'&embedded=true';

                      if (DataJson.resultado[data].prfi_fiex_codigo == 11 ) { //Google Drive

                        $('#aRefDownload').hide();

                        var link = folder;

                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');

                      }else if ( DataJson.resultado[data].prfi_fiex_codigo == 12) { //One Drive

                        $('#aRefDownload').hide();

                        var link = folder;

                        var iframe =  $('<iframe class="embed-responsive-item" id="ifrVistaPrevia" src="'+link+'?e=hQOzSl&action=embedview&wdHideHeaders=True&wdAllowInteractivity=true&wdDownloadButton=True" width="100%" height="580px"></iframe>').on('load', () => {
                          $('#googleDociFrame').waitMe('hide')
                        }) 

                      }else if ( DataJson.resultado[data].prfi_fiex_codigo == 6) {// PDF

                        if (DataJson.resultado[data].prfi_copia_autorizada == '1') {
                          var link = base_url+'Processes/previewMarkwater'+'/'+DataJson.resultado[data].prfi_codigo;

                        }else{
                          var link = base_url+'/'+folder;
                        }


                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                      }else if ( DataJson.resultado[data].prfi_fiex_codigo == 4 || DataJson.resultado[data].prfi_fiex_codigo == 5) {// WORD Y EXCEL

                        

                        var link = 'https://view.officeapps.live.com/op/view.aspx?src='+base_url+'/'+folder;

                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                      }

                   


                      $('#googleDociFrame').html(iframe)

                      
          }
      });
    
  


}


function refreshProcess(){
 
  // alert(codigoDocumento);
  $('#googleDociFrame').empty();


    $('#modalDocumentView').modal('show');

    codigoDocumento = $('#txtDofiCodigoHide').val();

   
    var parametro={        
      "codigo": codigoDocumento
    };
    var folder = '';
    $.ajax({
          url: base_url+"Processes/leerDocumento",
          type: 'POST',
          dataType: "json",
          data: parametro,
          success: function(DataJson){
              if(DataJson.state){          
                  var estadoAprobacion = '';
                  var fechaAprobacionStamp = '';
                  var waterMark = '';
                  var codigo = '';
                  var extension = '';
                  for(data in DataJson.resultado){
                    $('#txtDofiCodigoHide').val(DataJson.resultado[data].prfi_codigo);  
                    if (DataJson.resultado[data].prfi_estado_aprobacion == '0') {
                      estadoAprobacion = 'PENDIENTE';
                    }else if (DataJson.resultado[data].prfi_estado_aprobacion == '1') {
                      estadoAprobacion = 'APROBADO';
                    }else if (DataJson.resultado[data].prfi_estado_aprobacion == '2') {
                      estadoAprobacion = 'RECHAZADO';
                    }

                    if (DataJson.resultado[data].prfi_fecha_aprobacion != null) {
                      fechaAprobacionStamp = DataJson.resultado[data].prfi_fecha_aprobacion+' '+DataJson.resultado[data].prfi_hora_aprobacion;
                    }

                        $('#txtNombreView').val(DataJson.resultado[data].prfi_nombre);
                        $('#txtDescripcionView').val(DataJson.resultado[data].prfi_descripcion);
                        $('#txtFechaCreacionView').val(DataJson.resultado[data].prfi_fecha_creacion+' '+DataJson.resultado[data].prfi_hora_creacion);
                        $('#txtUsuarioCreadorView').val(DataJson.resultado[data].usuario_creador);
                        $('#txtTipoView').val(DataJson.resultado[data].fiex_descripcion+' (.'+DataJson.resultado[data].fiex_extension+')');
                        $('#txtEstadoView').val(estadoAprobacion);
                        $('#txtFechaAprobacionView').val(fechaAprobacionStamp);
                        $('#txtUsuarioAprobadorView').val(DataJson.resultado[data].usuario_aprobador);
                        $('#txtSizeView').val(DataJson.resultado[data].prfi_size);
                        $('#txtHIRutaFile').val(DataJson.resultado[data].prfi_ruta);
                      
                      folder = DataJson.resultado[data].prfi_ruta;

                      $('#aRefDownload').attr("href", base_url+"Processes/downloadWithWaterMark/"+DataJson.resultado[data].prfi_codigo);

                  }                
              }



                      if (DataJson.resultado[data].prfi_fiex_codigo == 11 ) { //Google Drive

                        $('#aRefDownload').hide();

                        var link = folder;

                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');

                      }else if ( DataJson.resultado[data].prfi_fiex_codigo == 12) { //One Drive

                        $('#aRefDownload').hide();

                        var link = folder;

                        var iframe =  $('<iframe class="embed-responsive-item" id="ifrVistaPrevia" src="'+link+'?e=hQOzSl&action=embedview&wdHideHeaders=True&wdAllowInteractivity=true&wdDownloadButton=True" width="100%" height="580px"></iframe>').on('load', () => {
                          $('#googleDociFrame').waitMe('hide')
                        }) 

                      }else if ( DataJson.resultado[data].prfi_fiex_codigo == 6) {// PDF

                        if (DataJson.resultado[data].prfi_copia_autorizada == '1') {
                          var link = base_url+'Processes/previewMarkwater'+'/'+DataJson.resultado[data].prfi_codigo;

                        }else{
                          var link = base_url+'/'+folder;
                        }


                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                      }else if ( DataJson.resultado[data].prfi_fiex_codigo == 4 || DataJson.resultado[data].prfi_fiex_codigo == 5) {// WORD Y EXCEL

                        

                        var link = 'https://view.officeapps.live.com/op/view.aspx?src='+base_url+'/'+folder;

                        var iframe =  $('<iframe id="ifrVistaPrevia" src="'+link+'" width="100%" height="580px"></iframe>');


                      }




                      $('#googleDociFrame').html('<iframe style="width: 100%; height: 580px;" id="ifrVistaPrevia" src="'+link+'" ></iframe>');


                 



                      
          }
      });
    

}




