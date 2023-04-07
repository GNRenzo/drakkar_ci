$(document).ready(function(){
  ocultarLoader();
});


// function ocultarLoader() {
//  var img1 = document.getElementById('img_loader1');
//  img1.style.display = "none";

//  var img2 = document.getElementById('img_loader2');
//  img2.style.display = "none";
// }

// function mostrarLoader() {
//  var img1 = document.getElementById('img_loader1');
//  img1.style.display = 'inherit';

//  var img2 = document.getElementById('img_loader2');
//  img2.style.display = 'inherit';
// }


function ocultarLoader() {

 var img = document.getElementById('img_loader');
 img.style.display = "none";
}

function mostrarLoader() {
 var img = document.getElementById('img_loader');
 img.style.display = 'inherit';
}



function listar(){
  mostrarLoader();
  var idusuario = $('#cboUsuarios').val();
  // alert($('#cboUsuarios').val());

  if (idusuario=="") {
    Swal.fire(
      'Seleccione Usuario',
      'Debe seleccionar un usuario del combo',
      'warning'
      );
    return;
  }



  $("#dviMenuSistema").html("");
  // mostrarLoader();

  
  var parametro={
    "idusuario":idusuario
  };
  var htmlTabla = '<table id="tablaMenusSistema" class="table table-responsive list text-center">'+
  '<thead>'+
  '<tr class="bg-danger">'+

    '<th class="text-center" style="background: #ffa366">  ID      </center></th>'+
    '<th class="text-center" style="background: #ffa366">  Descripción      </center></th>'+
    '<th class="text-center" style="background: #ffa366"> Agregar      </center></th>'+
  '</tr>'+
  '</thead>'+
  '<tbody>';

  // var rutaLeer = base_url+"index.php/huesped/leer";
  $.ajax({
    url: base_url+"index.php/permiso/listarMenusSinPermiso",
    type: 'post',
    dataType: "json",
    data: parametro,
    //jsonpCallback: 'callback',
    success: function(DataJson){ 

      // alert('entra');
      if(DataJson.state){     
 
        for(data in DataJson.resultado){  

          htmlTabla+=  '<tr>'+

          '<td>'+(DataJson.resultado[data].id) +'</td>'+
          '<td>'+(DataJson.resultado[data].descripcion) +'</td>'+
          "<td align='center'>"+                                       
          "<a style='cursor: pointer;' onclick=\"agregarPermiso(\'"+DataJson.resultado[data].id+"\')\"   >"+
          "<i style='color: green' class='fa fa-long-arrow-right' aria-hidden='true'></i></a>"+
          "</td>"+

          "</tr>";

          }
          htmlTabla+='</tbody>'+

          '</table>';
          $("#dviMenuSistema").html(htmlTabla);
          $('#tablaMenusSistema').DataTable({
                                //"pageLength": 20,
                                "aaSorting": [],
                                "language": {
                                  "lengthMenu": "Mostrando _MENU_ registros",
                                  "search": "Buscar:",
                                  "infoEmpty": "No hay entradas para mostrar",
                                  "info": "",
                                  "infoFiltered": "- (filtrado de _MAX_ registros totales)",
                                  "loadingRecords": "Cargando...",
                                  "emptyTable": "No hay datos disponibles en la tabla",
                                  "zeroRecords": "No se encontraron registros coincidentes",
                                  "paginate": {
                                    "previous": "Anterior",
                                    "next":"Siguiente",
                                    "last": "Última",
                                    "first": "Primera"
                                  }
                                }
                              });

        //
         ocultarLoader();
        // $("html").getNiceScroll().resize();

      }
    }
  });



  $("#dviAccesosUsuario").html("");
  // mostrarLoader();

  var htmlTabla2 = '<table id="tablaAccesosUsuario" class="table table-responsive list text-center">'+
  '<thead>'+
  '<tr class="bg-danger">'+
    '<th class="text-center" style="background: #99d6ff"> <center> ID      </center></th>'+
    '<th class="text-center" style="background: #99d6ff"> <center> Descripción      </center></th>'+
    '<th class="text-center" style="background: #99d6ff"> <center> Eliminar      </center></th>'+
  '</tr>'+
  '</thead>'+
  '<tbody>';

  // var rutaLeer = base_url+"index.php/huesped/leer";
  $.ajax({
    url: base_url+"index.php/permiso/getByMenuPermisos",
    type: 'post',
    dataType: "json",
    data: parametro,
    //jsonpCallback: 'callback',
    success: function(DataJson){ 

      // alert('entra');
      if(DataJson.state){     
 
        for(data in DataJson.resultado){  

          htmlTabla2+=  '<tr>'+

          '<td>'+(DataJson.resultado[data].id) +'</td>'+
          '<td>'+(DataJson.resultado[data].descripcion) +'</td>'+
          "<td align='center'>"+                                       
          "<a style='cursor: pointer;' onclick=\"removerPermiso(\'"+DataJson.resultado[data].id+"\')\"   >"+
          "<i style='color: red'  class='fa fa-trash'></i></a>"+
          "</td>"+

          "</tr>";

          }
          htmlTabla2+='</tbody>'+

          '</table>';
          $("#dviAccesosUsuario").html(htmlTabla2);
          $('#tablaAccesosUsuario').DataTable({
                                //"pageLength": 20,
                                "aaSorting": [],
                                "language": {
                                  "lengthMenu": "Mostrando _MENU_ registros",
                                  "search": "Buscar:",
                                  "infoEmpty": "No hay entradas para mostrar",
                                  "info": "",
                                  "infoFiltered": "- (filtrado de _MAX_ registros totales)",
                                  "loadingRecords": "Cargando...",
                                  "emptyTable": "No tiene ningún permiso de acceso",
                                  "zeroRecords": "No se encontraron registros coincidentes",
                                  "paginate": {
                                    "previous": "Anterior",
                                    "next":"Siguiente",
                                    "last": "Última",
                                    "first": "Primera"
                                  }
                                }
                              });


        //
         ocultarLoader();
        // $("html").getNiceScroll().resize();

      }
    }
  });

}


function agregarPermiso(idmenu){

  var idusuario = $('#cboUsuarios').val();
  // alert($('#cboUsuarios').val());

  if (idusuario=="") {
    Swal.fire(
      'Seleccione Usuario',
      'Debe seleccionar un usuario del combo',
      'warning'
      );
    return;
  }


  var parametro={
    "idusuario":idusuario,
    "idmenu":idmenu
  };

  $.ajax({
    url: base_url+"index.php/permiso/agregarPermiso",
    type: 'post',
    dataType: "json",
    data: parametro,
    success: function(DataJson){

      Swal.fire({ 
        title: "Acceso Registrado",
        text: "Se agregó el permiso al usuario",
        type: "success" 
      }).then((result) => {

          listar();
          })

    }
  });


}


function removerPermiso(idmenu){

  var idusuario = $('#cboUsuarios').val();
  // alert($('#cboUsuarios').val());

  if (idusuario=="") {
    Swal.fire(
      'Seleccione Usuario',
      'Debe seleccionar un usuario del combo',
      'warning'
      );
    return;
  }


  var parametro={
    "idusuario":idusuario,
    "idmenu":idmenu
  };

  $.ajax({
    url: base_url+"index.php/permiso/removerPermiso",
    type: 'post',
    dataType: "json",
    data: parametro,
    success: function(DataJson){

      Swal.fire({ 
        title: "Acceso Removido",
        text: "Se removió el permiso al usuario",
        type: "success" 
      }).then((result) => {

          listar();
          })

    }
  });


}