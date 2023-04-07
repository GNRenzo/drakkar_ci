$(document).ready(function(){

  var id = $('#txtCurrentMenu').val();

  var idItem = $('#txtCurrentMenuItem').val();

  var idHijo = $('#txtCurrentMenuHijo').val();

  // menu-open
    $('#'+id).css({
    	"background":"#0067B8",
        "color": "#fff"
    });

    $('#i'+id).css({

        "color": "#fff"
    });

    $('#li'+id).addClass('menu-open');


	$('#hijo'+idHijo).css({
		"color":"#0067B8"
	});

	$('#li_hijo'+idHijo).addClass('menu-open');

	$('#item'+idItem).css({
    	"color":"#0067B8"
    });



});

