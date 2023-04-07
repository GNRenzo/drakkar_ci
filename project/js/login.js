
$("#btnSubmitEmailRequest").click(function() {
    sendEmailRequest();
  });




function sendEmailRequest(){

  var cadena=[];

  if ($("#txtName").val()==''){
    cadena.push ("Full Name / Nombres y Apellidos");
    mensaje(cadena,'txtName');
    return;
  }else if ($("#txtCorreo").val()==''){
    cadena.push ("Corporate E-Mail / Correo Corporativo");
    mensaje(cadena,'txtCorreo');
    return;
  }


  correo = $("#txtCorreo").val();
  val = correo.indexOf("@agrovisioncorp.com") > -1;



  if (val == false){
    Swal.fire({ 
      title: "Warning / Advertencia",
      text: "Only corporate emails are allowed. / Solo se permiten correos corporativos.",
      type: "warning",
      onAfterClose: () => {
        setTimeout(function() { $('input[name=txtCorreo]').focus() }, 0);
      }
    })
    return;
  }

  var parametro={
    "correo": correo
  };

  try {
    $.ajax({
      url: base_url+'Login/validarExistenciaCorreo',
      type: 'post',
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if (DataJson.state) {
          var nfilas = DataJson.resultado['nfilasidusuario'];

          if (nfilas == 0){
            Swal.fire({ 
              title: "Advertencia",
              text: "El correo ingresado no se encuentra en el sistema",
              type: "warning",
              onAfterClose: () => {
                setTimeout(function() { $('input[name=txtCorreo]').focus() }, 0);
              }
            })
            return;
          }


          $.ajax({
            url: base_url+'Login/datosUsuario',
            type: 'post',
            dataType: "json",
            data: parametro,
            success: function(DataJson){
              if (DataJson.state) {
                $("#idUsuario").val(DataJson.resultado['idusuario']);
                $("#nameSistema").val(DataJson.resultado['usr_nombres']);
              }

              Swal.fire({
                title: 'Sending / Enviando',
                text: 'Please wait...',
                footer: "Don't close the window",
                imageUrl:'https://www.agvperu.com/admin/admin-fabrex/img/shipping/loading5.gif',
                imageWidth: 200,
                imageHeight: 200,
          showCancelButton: false, // There won't be any cancel button
          showConfirmButton: false // There won't be any confirm button
        })


              var formData = new FormData(document.getElementById("frmEmailRequest"));

              $.ajax({
                type: 'POST',
                url: base_url+"Login/sendEmailRequest",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(DataJson){


                 if (DataJson.state) {
                  Swal.fire({ 
                    title: "Link enviado",
                    text: "Se ha enviado un link de recuperación a su correo corporativo.",
                    type: "success" 
                  }).then((result) => {


                    window.location.replace(base_url);
                  })
                }
              },
              error: function (jqXHR, textStatus, errorThrown) {

                console.log(jqXHR)

              }
            }); 


            }
          });



        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR)
      }
    }); 
  } catch (error) {
    console.error(error);
  }

}