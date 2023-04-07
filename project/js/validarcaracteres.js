/*
* Validador de LETRAS y NUMEROS
* Comentar o borrar la teclas que se deseen bloquear.
*/ 


$(document).ready(function(){


	$(".nameFile").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 65 || key.charCode > 90) //letras mayúsculas
			&& (key.charCode < 97 || key.charCode > 122)//letras minusculas
			&& (key.charCode < 48 || key.charCode > 57) //números
			&& (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ        
			&& (key.charCode != 32) //espacio
			&& (key.charCode != 127) //delete
			&& (key.charCode != 8) //backspace
			& (key.charCode != 95) //GUIONBAJO
			&& (key.charCode != 40) // (
			&& (key.charCode != 41) // )
			&& (key.charCode != 190) // .
			&& (key.charCode != 45) // -


		)
			return false;
	});


	
	$(".onlyAtoZ").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 97 || key.charCode > 122)//letras minusculas
			&& (key.charCode < 65 || key.charCode > 90) //letras mayusculas
			&& (key.charCode != 45) //retroceso
			/* && (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ            */
			&& (key.charCode != 32) //espacio
			/* && (key.charCode != 225) //á
			&& (key.charCode != 233) //é
			&& (key.charCode != 237) //í
			&& (key.charCode != 243) //ó
			&& (key.charCode != 250) //ú
			&& (key.charCode != 193) //Á
			&& (key.charCode != 201) //É
			&& (key.charCode != 205) //Í
			&& (key.charCode != 211) //Ó
			&& (key.charCode != 218) //Ú            */
		)
			return false;
	});

		$(".onlyAtoZTil").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 97 || key.charCode > 122)//letras minusculas
			&& (key.charCode < 65 || key.charCode > 90) //letras mayusculas
			&& (key.charCode != 45) //retroceso
			/* && (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ            */
			&& (key.charCode != 32) //espacio
			&& (key.charCode != 225) //á
			&& (key.charCode != 233) //é
			&& (key.charCode != 237) //í
			&& (key.charCode != 243) //ó
			&& (key.charCode != 250) //ú
			&& (key.charCode != 193) //Á
			&& (key.charCode != 201) //É
			&& (key.charCode != 205) //Í
			&& (key.charCode != 211) //Ó
			&& (key.charCode != 218) //Ú            
		)
			return false;
	});


	$(".onlyAtoZUser").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 97 || key.charCode > 122)//letras minusculas
			//&& (key.charCode < 65 || key.charCode > 90) //letras mayusculas
			&& (key.charCode != 45) //retroceso
			/* && (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ            */
			&& (key.charCode != 32) //espacio
			&& (key.charCode != 95) //GUIONBAJO
			&& (key.charCode != 64) //@
			/* && (key.charCode != 225) //á
			&& (key.charCode != 233) //é

			&& (key.charCode != 237) //í
			&& (key.charCode != 243) //ó
			&& (key.charCode != 250) //ú
			&& (key.charCode != 193) //Á
			&& (key.charCode != 201) //É
			&& (key.charCode != 205) //Í
			&& (key.charCode != 211) //Ó
			&& (key.charCode != 218) //Ú            */
		)
			return false;
	});


	$(".onlyAtoZEsp").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 97 || key.charCode > 122)//letras minusculas
			&& (key.charCode < 65 || key.charCode > 90) //letras mayusculas
			//&& (key.charCode != 45) //retroceso
			 && (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ            
			&& (key.charCode != 32) //espacio
			&& (key.charCode != 225) //á
			&& (key.charCode != 233) //é
			&& (key.charCode != 237) //í
			&& (key.charCode != 243) //ó
			&& (key.charCode != 250) //ú
			&& (key.charCode != 193) //Á
			&& (key.charCode != 201) //É
			&& (key.charCode != 205) //Í
			&& (key.charCode != 211) //Ó
			&& (key.charCode != 218) //Ú     
			//&& (key.charCode != 45) //-          
		)
			return false;
	});

	$(".onlyAtoZDir").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 97 || key.charCode > 122)//letras minusculas
			&& (key.charCode < 65 || key.charCode > 90) //letras mayusculas
			&&(key.charCode < 48 || key.charCode > 57)//numeros del 0-9
			&& (key.charCode != 45) //retroceso
			 && (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ            
			&& (key.charCode != 32) //espacio
			&& (key.charCode != 225) //á
			&& (key.charCode != 233) //é
			&& (key.charCode != 237) //í
			&& (key.charCode != 243) //ó
			&& (key.charCode != 250) //ú
			&& (key.charCode != 193) //Á
			&& (key.charCode != 201) //É
			&& (key.charCode != 205) //Í
			&& (key.charCode != 211) //Ó
			&& (key.charCode != 218) //Ú
			&& (key.charCode != 46) //Punto decimal            
		)
			return false;
	});

		$(".onlyAtoZPreg").keypress(function (key) {
		/* // window.console.log(key.charCode) //muestra en consola la letra pulsada */
		if ((key.charCode < 97 || key.charCode > 122)//letras minusculas
			&& (key.charCode < 65 || key.charCode > 90) //letras mayusculas
			&&(key.charCode < 48 || key.charCode > 57)//numeros del 0-9
			&& (key.charCode != 45) //retroceso
			 && (key.charCode != 241) //ñ
			&& (key.charCode != 209) //Ñ            
			&& (key.charCode != 32) //espacio
			&& (key.charCode != 225) //á
			&& (key.charCode != 233) //é
			&& (key.charCode != 237) //í
			&& (key.charCode != 243) //ó
			&& (key.charCode != 250) //ú
			&& (key.charCode != 193) //Á
			&& (key.charCode != 201) //É
			&& (key.charCode != 205) //Í
			&& (key.charCode != 211) //Ó
			&& (key.charCode != 218) //Ú
			&& (key.charCode != 46) //Punto decimal
			&& (key.charCode != 63) //?Pregunta               
		)
			return false;
	});
	
	$(".only0to9").keypress(function (key) {
		if ((key.charCode < 48 || key.charCode > 57) //numeros del 0-9
			&& (key.charCode != 45) //retroceso
		)
			return false;
	});
	

	$(".only0to9andPunto").keypress(function (key) {
		if ((key.charCode < 48 || key.charCode > 57) //numeros del 0-9
			&& (key.charCode != 46) //Punto decimal
		)
			return false;
	});
	
	
});