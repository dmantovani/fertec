$(document).ready(function(){	
	$(window).paroller();
	$('#bt_noticias').addClass('active');
	
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
	
});


function resize(){
	var hh = $(window).height()-$('.header').height();
	var hh2 = $('.selector').height();
	$('#menu').css('maxHeight',hh);
	$('.selector').height(hh);
	$('.selector').css('paddingTop',(hh/2-hh2/2)-40);
	$('.section-header').height(hh*0.8);
}

