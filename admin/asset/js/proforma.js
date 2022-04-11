$(document).ready(function(){
	 $('#list').DataTable({"bSort": true});

	/*CAMPOS A VALIDAR*/
	if($('#password').is(":visible")){
		jsonDatos=eval('({"campos":['+
		'{"campo":"nombre","validacion":"B"},'+
		'{"campo":"password","validacion":"B"}'+		
		']})');
	}else{
		jsonDatos=eval('({"campos":['+
		'{"campo":"nombre","validacion":"B"},'+
		'{"campo":"localidad","validacion":"B"},'+
		'{"campo":"celular","validacion":"B"},'+
		'{"campo":"celular","validacion":"B"},'+
		'{"campo":"mail","validacion":"B"},'+
		'{"campo":"origen","validacion":"B"},'+
		
		']})');		
	}
	
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

	uploaderwysihtml5('wysihtml5',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
});


