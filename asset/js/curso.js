var markersArrayP=[];
var markerCluster;
var map;
var bounds;
var infowindow = null;

$(document).ready(function(){	
	$(window).paroller();
	$('#bt_academia').addClass('active');
	
	var slider = new MasterSlider();
	slider.setup('banner_top' , {
		width:1440,    // slider standard width
		height:650,   // slider standard height
		space:5,
		speed:17,
		layout: "autofill",
		autoplay: true,
		loop:true,
		view: "fade",
		init:1
	});
	slider.control('bullets' , {autohide:false  , dir:"h", align:"bottom"});
	
	var slider = new MasterSlider();
	slider.setup('novedades' , {
		width:800,    // slider standard width
		height:400,   // slider standard height
		space:0,
		speed:75,
		layout: "fullview",
		autoHeight:true,
		autoplay: false,
		overPause: false,
		loop:false,
		init:1
	});
    // adds Arrows navigation control to the slider.
    slider.control('arrows' , {autohide:false});
	
	$('#pay_btn').click(function(){
		$('.customer-data').addClass('active');	
	});
	$('.close-chk').click(function(){
		$('.customer-data').removeClass('active');	
	});
	
	$('#chk_sede_horario').find('option').hide();
	$('#chk_sede_horario').find('option[sede-id="'+$('#chk_sede').find('option:selected').attr('data-id')+'"]').show();
	$('#chk_sede_horario').val($('#chk_sede_horario').find("option:not(:hidden):eq(0)").val());
	
	$('#chk_sede').change(function(){
		$('#chk_sede_horario').find('option').hide();
		$('#chk_sede_horario').find('option[sede-id="'+$(this).find('option:selected').attr('data-id')+'"]').show();
		$('#chk_sede_horario').val($('#chk_sede_horario').find("option:not(:hidden):eq(0)").val());
	});
	
	setMap();
	
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
	
	
	$('#chkform').on('submit', function(e) {
		var ok=true;
		var jsonDatos=parsearJSON('{"campos":['+
			'{"nombre":"Nombre","campo":"chk_nombre","validacion":"B"},'+
			'{"nombre":"Nombre","campo":"chk_apellido","validacion":"B"},'+
			'{"nombre":"Nombre","campo":"chk_email","validacion":"BE"},'+
			'{"nombre":"Nombre","campo":"chk_dni","validacion":"B"},'+
			'{"nombre":"Nombre","campo":"chk_codearea","validacion":"B"},'+
			'{"nombre":"Nombre","campo":"chk_telefono","validacion":"B"}'+		
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

function setMap(){
	var myLatlng = new google.maps.LatLng(-35.4327369,-72.1046738);
     	  var myOptions = {
    	  zoom: 5,
    	  center: myLatlng,
    	  mapTypeId: google.maps.MapTypeId.ROADMAP,
    	  scrollwheel: false,
    	  streetViewControl: true
    	};
    	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        bounds = new google.maps.LatLngBounds();
		
		infowindow = new google.maps.InfoWindow({
			maxWidth: 350 
		});
		
		for(var i=0; i<sedes.length; i++){
			var latcat=sedes[i].latitud_longitud;
            var location=new google.maps.LatLng(latcat.split(',')[0],latcat.split(',')[1]);
	        var lab = sedes[i].sede;
            

			var contentString = '<div class="infow-content">'+
            '<h3 class="infow-title">'+sedes[i].sede+'</h3>'+
            '<div class="bodyContent">'+
			'<div class="infow-address">'+sedes[i].direccion+'</div>'+
			'<div class="infow-phone">'+sedes[i].telefono+'</div>'+
			'<div class="infow-email">'+sedes[i].email+'</div>'+
			'<div class="infow-description"><a href="'+base_url+'sede/'+sedes[i].sedeId+'/'+convertToPath(sedes[i].sede)+'/"><div class="btn btn-sm btn-info col-md-12">VER MÁS</div></a></div>'+
            '</div>'+
            '</div>';
			
			var marker = new google.maps.Marker({
			   position: location,
			   map: map,
			   title: lab,
			   infow: contentString,
			   icon: base_url+'asset/img/marker.png'
			});
			
			markersArrayP.push(marker);
			bounds.extend(marker.getPosition());
			map.fitBounds(bounds);
			markerCluster = new MarkerClusterer(map, markersArrayP);
			
			marker.addListener('click', function(e) {
				infowindow.setContent(this.get('infow'));
				if (infowindow) {
					infowindow.close();
				}
				infowindow.open(map, this);
			});

			
		}
}

function resize(){
	var hh = $(window).height()-$('.header').height();
	var hh2 = $('.selector').height();
	$('#menu').css('maxHeight',hh);
	$('.selector').height(hh);
	$('.selector').css('paddingTop',(hh/2-hh2/2)-40);
	$('.section-header').height(hh*0.8);
	$('.list-curso .imagen').height($('.list-curso .imagen img').height());
	$('.customer-data').height(hh);
}

