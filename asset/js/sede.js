var markersArrayP=[];
var markerCluster;
var map;
var bounds;
var infowindow = null;

$(document).ready(function(){	
	$(window).paroller();
	$('#bt_sedes').addClass('active');
	setMap();
	//$('.fancybox').fancybox();
});

function setMap(){
	var latcat=$('.latitud_longitud').val();
	
	var myLatlng = new google.maps.LatLng(latcat.split(',')[0],latcat.split(',')[1]);
     	  var myOptions = {
    	  zoom: 12,
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
		
				
		
        var location=new google.maps.LatLng(latcat.split(',')[0],latcat.split(',')[1]);
		var marker = new google.maps.Marker({
			   position: location,
			   map: map,
			   icon: base_url+'asset/img/marker.png'
		});

}

function resize(){
	var hh = $(window).height()-$('.header').height();
	var hh2 = $('.selector').height();
	$('#menu').css('maxHeight',hh);
	$('.list-curso .imagen').height($('.list-curso .imagen img').height());
}

