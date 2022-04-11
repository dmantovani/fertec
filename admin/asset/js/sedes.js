var marker='';

$(document).ready(function(){
	 $('#list').DataTable({"bSort": true});	 
	
	var editor = new wysihtml5.Editor("wysihtml5-textarea", { 
	  toolbar:      "wysihtml5-toolbar",
	  parserRules: wysihtml5ParserRules
	});
	
	/*CAMPOS A VALIDAR*/
	jsonDatos=eval('({"campos":['+
		'{"campo":"titulo","validacion":"B"},'+
		'{"campo":"wysihtml5-textarea","validacion":"B"}'+			
		']})');
	
	setMap();
	$('#bt_map_search').click(function(){
		if($('#map_search').val()==''){
			alert('Ingrese una dirección');
		}else{
			var geocoder = new google.maps.Geocoder();
			var direccion = $('#map_search').val();
			geocoder.geocode(
				{
					address: direccion
				}, 
				function(results, status) {
					
					var resultLocations = [];
					
					if(status == google.maps.GeocoderStatus.OK) {
						if(results) {
							var latitude = results[0].geometry.location.lat();
							var longitude = results[0].geometry.location.lng();
							
							$('#latitud_longitud').val(latitude+','+longitude);
							
							var me = new google.maps.LatLng(latitude, longitude);
							marker.setPosition(me);
							
							
						}
					} else if(status == google.maps.GeocoderStatus.ZERO_RESULTS) {
						alert('No se encuentra la dirección ingresada');
					}
					
					
				}
			);
		}
	});
	
	/*UPLOAD CONFIG*/
	var w=1440;
	var h=810;
	var path='../../../../asset/img/uploads/';
	var maxWidth=1440;
	var thWidth=1440;
	var thHeight=810;		
	var tipo='unica';
	var allowedTypes='jpg,png,gif'
	var callback=function(){console.log('upload complete');}

	uploaderMulti('1',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
	uploaderwysihtml5('wysihtml5',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
});


function setMap(){
	var myLatlng = new google.maps.LatLng(-31.423655906597993,-64.17753795637213);
	var myOptions = {
	  zoom: 8,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  scrollwheel: false,
	  streetViewControl: true
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	if($('#latitud_longitud').val()!=''){
		loc = new google.maps.LatLng($('#latitud_longitud').val().split(',')[0],$('#latitud_longitud').val().split(',')[1]);
		var image = base_url+'asset/img/marker.png';
		marker = new google.maps.Marker({
				position: loc,
				map: map, 
				title: '',
				icon: image,
				draggable:true
			});
		map.setCenter(loc);
		google.maps.event.addListener(marker, 'drag',
		function(event) {
			document.getElementById('latitud_longitud').value = this.position.lat()+','+this.position.lng();
			//alert('drag');
		});
	}else{
		loc = new google.maps.LatLng(-31.423655906597993,-64.17753795637213);
		var image = base_url+'asset/img/marker.png';
		marker = new google.maps.Marker({
				position: loc,
				map: map, 
				title: '',
				icon: image,
				draggable:true
			});
		google.maps.event.addListener(marker, 'drag',
		function(event) {
			document.getElementById('latitud_longitud').value = this.position.lat()+','+this.position.lng();
			//alert('drag');
		});
	}
}