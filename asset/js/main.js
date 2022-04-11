var form = $("#example-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});

var enviocv = 'finish';
var prev = '<i class="fa fa-chevron-left"></i>';
var next = '<i class="fa fa-chevron-right"></i>';
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    labels: {
      finish: enviocv,
      previous: prev,
      next: next
    },
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
});





$(document).ready(function(){

  $('.step01').click(function(){
    $('.paso-2').addClass('z-index-1');
  });

  $('.step02').click(function(){
    $('.paso-3').addClass('z-index-1');
  });

  $('.step03').click(function(){
    $('.paso-4').addClass('z-index-1');
  });

  $('.step04').click(function(){
    $('.paso-5').addClass('z-index-1');
  });

  $('.step05').click(function(){
    $('.paso-6').addClass('z-index-1');
  });

  $('.step06').click(function(){
    $('.paso-7').addClass('z-index-1');
  });


	$('.bt-prov-selected').click(function(){
		$('.bt-prov-content').toggleClass('active');
	});
	
	$(window).scroll(function () {
			if ($(this).scrollTop() > $('.header').height()) {				
				$('.header').addClass('fixed-header');
				$('.main-content').addClass('fixed-header-content');
			}else {
				$('.header').removeClass('fixed-header');
				$('.main-content').removeClass('fixed-header-content');
			}
	});
	
	window.onresize = resize;
	$(window).load(function() {
		resize();
	});
	
});

var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "Pause";
  } else {
    video.pause();
    btn.innerHTML = "Play";
  }
}


function esVacio (a) {
    if (a == "")
		return true;
	else
		return false;
}

function validarEmail(str) 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str))
	{
		return (true);
  	} 
  	else 
  	{
     	return (false);
  	}
}

function parsearJSON(str){
	try{
		return eval('('+str+')');
	}catch(err){
		return null;
	}
}

function JSONtoString(json){
	try{
		return JSON.stringify(json);
	}catch(err){
		return null;
	}
}

function encode(str){
	try{
		return $.base64Encode(str);
	}catch(err){
		return null;
	}
}

function decode(str){
	try{
		if(str.indexOf('}str_end')>-1){
			str=str.substring(0,str.lastIndexOf('}str_end'))
		}
		return $.base64Decode(str);
	}catch(err){
		return null;
	}
}


function utf8_encode (argString) {

    if (argString === null || typeof argString === "undefined") {
        return "";
    }
     var string = (argString + '');
    var utftext = "",
        start, end, stringl = 0;
 
    start = end = 0;    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;
         if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.slice(start, end);            }
            utftext += enc;
            start = end = n + 1;
        }
    } 
    if (end > start) {
        utftext += string.slice(start, stringl);
    }
     return utftext;
}

function utf8_decode (str_data) {
  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 < 128) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 > 191 && c1 < 224) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    }
  }

  return tmp_arr.join('');
}

function convertToPath(str){
	str=str.replace(/"/g,'_');
	var tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ;,%'\"°!$";
	var replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn________";
	
	tofind = tofind.split('');
	replac = replac.split('');
	for(var i=0 ; i < tofind.length ; i++){
		str=str.replace(new RegExp(tofind[i],'g'),replac[i]);
	}
	str = str.toLowerCase().split(".");
	str = str.join("_");
	str = str.toLowerCase().split(" ");
	str = str.join("-");

	return str;
}	