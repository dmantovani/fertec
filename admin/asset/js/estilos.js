$(document).ready(function(){
	$('#list').DataTable({"bSort": true});
	 
	$('#categoria').change(function(){
		obtenerMarcas($(this).val(),0);
	});
	obtenerMarcas($('#categoria').val(),1);
	
	/*CAMPOS A VALIDAR*/
	jsonDatos=eval('({"campos":['+
		'{"campo":"estilo","validacion":"B"}'+		
		']})');
	
	var editor = new wysihtml5.Editor("wysihtml5-textarea", { 
	  toolbar:      "wysihtml5-toolbar",
	  parserRules: wysihtml5ParserRules
	});
	
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
	
	uploaderwysihtml5('wysihtml5',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
	uploaderNoCrop('1',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
	uploaderMulti('2',path,maxWidth,thHeight,thWidth,tipo,5,allowedTypes,true,callback);
});

function obtenerMarcas(categoria, first){
	url=base_url+'estilos/getmarcas/?categoria='+categoria;
		$.ajax({
			url: url,
			success: function(response){	
				$('#marca').html(response);
				if(p_accion=='edit' && first==1){
					url=base_url+'estilos/getmarcaestilo/?estilo='+p_id;
					$.ajax({
						url: url,
						success: function(response){	
							$('#marca').val(response);
						}
					});
				}
			}
		});	
}

