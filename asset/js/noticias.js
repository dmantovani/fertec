
$(document).ready(function(){	
	$(window).paroller();
	
	$('#bt_noticias').addClass('active');
	
	
	$('#form').on('submit', function(e) {
		var ok=true;
		var jsonDatos=parsearJSON('{"campos":['+
			'{"nombre":"Nombre","campo":"nombre","validacion":"B"},'+
			'{"nombre":"Nombre","campo":"email","validacion":"BE"},'+
			'{"nombre":"Nombre","campo":"codarea","validacion":"B"},'+
			'{"nombre":"Nombre","campo":"telefono","validacion":"B"}'+		
			']}');

			for(var i=0;jsonDatos.campos.length>i;i++){

				var mensaje='';
				
				if(jsonDatos.campos[i]==null){break;}//para IE falla el for al procesar javascript	
				$('#'+jsonDatos.campos[i].campo).removeClass("error");
				if(jsonDatos.campos[i].validacion.indexOf('B')>-1){ 
					if(esVacio ($('#'+jsonDatos.campos[i].campo).val())){
						ok=false;
						$('#'+jsonDatos.campos[i].campo).parent().addClass("error");
					}else{
						$('#'+jsonDatos.campos[i].campo).parent().removeClass("error");
					}
				}
				if(jsonDatos.campos[i].validacion.indexOf('E')>-1){ 
					if(!validarEmail ($('#'+jsonDatos.campos[i].campo).val())){
						ok=false;
						$('#'+jsonDatos.campos[i].campo).parent().addClass("error_mail");
					}else{
						$('#'+jsonDatos.campos[i].campo).parent().removeClass("error_mail");
					}
				}
			}
		if(ok){
			$(this).submit();
		}else{
			return false;
		}
	});
});



function resize(){
	var hh = $(window).height()-$('.header').height();
	$('#menu').css('maxHeight',hh);
	$('.section-header').height(hh*0.8);	
}

