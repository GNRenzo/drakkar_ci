function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function mensaje(cadena, campo){

  Swal.fire({ 
    title: "Advertencia",
    text: "Debe completar el siguiente campo: | " +cadena.toString()+ " |",
    type: "warning",
    onAfterClose: () => {
      setTimeout(function() { $('input[name='+campo+']').focus() }, 0);
    }
  })

}


function firstMayusLetter(str){

    str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
  });

}



function validarNaN(valor){

  if(isNaN(valor)) {
   valor = 0;
 }
 return valor;
}

function validarNaN2(valor){

  if(isNaN(valor)) {
   valor = '-';
 }
 return valor;
}

function validarNull(valor){

  if((valor==null)) {
   valor = '';
 }
 return valor;
}

function validarNullGuion(valor){

  if((valor==null)) {
   valor = '-';
 }
 return valor;
}

function validarNullND(valor){

  if((valor==null)) {
   valor = 'ND';
 }
 return valor;
}


function numDO_2(valor){

  if ( valor != null) {

    valor = numberWithCommas(parseFloat(valor).toFixed(2));

  }else{

    valor = '-';

  }

  return valor;

}



function getMsjError (jqXHR, pjqXHRStatus, ptextStatus){

  if (pjqXHRStatus === 0) {

      mensajeError = 'Sin Internet: Verificar conexiones de red.';

    } else if (pjqXHRStatus == 404) {

      mensajeError = 'Página solicitada no encontrada [404]';

    } else if (pjqXHRStatus == 500) {

      mensajeError = 'Error interno del servidor [500].';

    } else if (ptextStatus === 'parsererror') {

      mensajeError = 'Requested JSON parse failed.';

    } else if (ptextStatus === 'timeout') {

      mensajeError = 'Time out error.';

    } else if (ptextStatus === 'abort') {

      mensajeError = 'Ajax request aborted.';

    } else {

      mensajeError = 'Uncaught Error: ' + jqXHR.responseText;

    }

    return mensajeError;

  // Swal.fire(
  //   'Error!',
  //   'Ocurrió el siguiente error: '+mensajeError,
  //   'error'
  //   )

}

function errorFunctionMsj (mensajeError){

  Swal.fire(
    'Error!',
    'Ocurrió un error al realizar la transacción: '+mensajeError,
    'error'
    )

}

function errorFunction (){

  Swal.fire(
    'Error!',
    'Ocurrió un error al realizar la transacción.',
    'error'
    )

}



function dateToInputFormat(date){
  var yyyy = date.getFullYear().toString();
  var mm = (date.getMonth()+1).toString(); 
  var dd  = date.getDate().toString();
  return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); 
}


function numDO_0(valor){

  if ( valor != null) {

    valor = numberWithCommas(parseFloat(valor).toFixed(0));

  }else{

    valor = '-';

  }

  return valor;

}