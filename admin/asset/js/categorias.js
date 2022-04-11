$(document).ready(function(){
	 $('#list').DataTable({"bSort": true});
	 
	 var editor = new wysihtml5.Editor("wysihtml5-textarea", { 
	  toolbar:      "wysihtml5-toolbar",
	  parserRules: wysihtml5ParserRules
	});
	
	/*CAMPOS A VALIDAR*/
	jsonDatos=eval('({"campos":['+
		'{"campo":"categoria","validacion":"B"}'+		
		']})');
	
	
	/*UPLOAD CONFIG*/
	var w=1440;
	var h=810;
	var path='../../../../asset/img/uploads/';
	
	var maxWidth=1440;
	var thWidth=1440;
	var thHeight=810;		
	var tipo='unica';
	var allowedTypes='jpg,png,gif';
	var callback=function(){console.log('upload complete');}
	uploaderNoCrop('1',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
	//uploaderMulti('2',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
});


