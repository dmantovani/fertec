$(document).ready(function(){	
	
});


function resize(){
	var hh = $(window).height()-$('.header').height();
	var hh2 = $('.selector').height();
	$('.selector').height(hh);
	$('.selector').css('paddingTop',(hh/2-hh2/2)-40);
	$('.section-header').height(hh*0.8);
	
	$('.list-curso .imagen').height($('.list-curso .imagen img').height());
}

