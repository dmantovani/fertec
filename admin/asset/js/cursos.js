var marker='';

$(document).ready(function(){
	 $('#list').DataTable({"bSort": true, "order": [[ 4, "desc" ]]});	 
	
	var editor = new wysihtml5.Editor("wysihtml5-textarea", { 
	  toolbar:      "wysihtml5-toolbar",
	  parserRules: wysihtml5ParserRules
	});
	/*tinymce.init({ 
		selector:'textarea', 
		plugins: 'code, advlist, image, media', 
		setup: function (editor) {
			editor.on('change', function () {
				editor.save();
			});
		} 
	});*/
	
	/*CAMPOS A VALIDAR*/
	jsonDatos=eval('({"campos":['+
		'{"campo":"titulo","validacion":"B"},'+
		'{"campo":"wysihtml5-textarea","validacion":"B"}'+			
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
	uploaderwysihtml5('wysihtml5',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
	
	$('#tt1').click(function(){
		$('.bt-save').show();
		$('.btn-default').show();
	});
	$('#tt2').click(function(){
		$('.bt-save').hide();
		$('.btn-default').hide();
	});
	
	
	 
	
});

function hideProfesores(){
	$('.list-prof').hide();
	$('.list-prof').each(function(){
		if($(this).attr('prv-id')==$('#provincia').val()){
			$(this).show();
		}
	});
}

