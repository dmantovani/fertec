
/*VARIABLES GLOBALES DEL PROYECTO*/
var jsonDatos='';

$(document).ready(
	function() {
		try{
			$('body').show();
			$.ajaxSetup({
				url: "/xmlhttp/",
				type: 'POST',
				dataType: 'html',
				//timeout: 5000,
			    async:true,
			    global:false,
				beforeSend: function() {aBeforeSend(this);},
				error: function(e, xhr, settings, exception) {aError(e, xhr, settings, exception);},
				complete: function() {aComplete(this);},
				success: function() {aSuccess(this);}
			});
	
			$('.upload-galeria').sortable({			
				items: ".list-img-gal",
				update: function( event, ui ) {
					updateMultiFileInput(ui.item.parent().attr("id").substring(7,ui.item.parent().attr("id").length));
				}
			 });
			
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
			});
			
			$('input, textarea').keypress(function(){
				ValidarForm();
			});

			$('.nav-tabs li').click(function(){
				if($(this).attr('id')=='tt1'){
					$('.main-buttons').show();
				}else{
					$('.main-buttons').hide();
				}
			});
			
			
			
			$('#l_'+p_section).css('background','#FDBD2C');
			
			
			
			$('.bt-save').click(function(){
				$('.bt-save').attr("disabled", "true");
				var ok=true;
				
				for(var i=0;jsonDatos.campos.length>i;i++){
					if(jsonDatos.campos[i]==null){break;}//para IE falla el for al procesar javascript	
					$('#'+jsonDatos.campos[i].campo).removeClass("error");
					if(jsonDatos.campos[i].validacion.indexOf('B')>-1){ 
						if(esVacio ($('#'+jsonDatos.campos[i].campo).val())){
							$('#'+jsonDatos.campos[i].campo).parent().addClass("error");
							
							ok=false;
						}else{
							$('#'+jsonDatos.campos[i].campo).parent().removeClass("error");
						}
					}
					if(jsonDatos.campos[i].validacion.indexOf('E')>-1){ 
						if(!validarEmail ($('#'+jsonDatos.campos[i].campo).val())){
							$('#'+jsonDatos.campos[i].campo).parent().removeClass("error");
							$('#'+jsonDatos.campos[i].campo).parent().addClass("error_mail");
							
							ok=false;
						}else{
							$('#'+jsonDatos.campos[i].campo).parent().removeClass("error_mail");
						}
					}
				}

				if(!ok){
					$('.bt-save').removeAttr("disabled");
					return;
				}
				$('#adm_form form').submit();
			});
			
			$('#adm_form form').confirmExit('¿Está seguro que desea abandonar la página sin guardar los datos?');
						
			resize();
			window.onresize = resize;	
			
		}catch(err){
			errorMsg(err,arguments);
			return null;
		}				

	}	
);

 

function resize() {
}

function ValidarForm(){
		for(var i=0;jsonDatos.campos.length>i;i++){

			var mensaje='';
			
			if(jsonDatos.campos[i]==null){break;}//para IE falla el for al procesar javascript	
			$('#'+jsonDatos.campos[i].campo).removeClass("error");
			if(jsonDatos.campos[i].validacion.indexOf('B')>-1){ 
				if(esVacio ($('#'+jsonDatos.campos[i].campo).val())){
					ok=false;
				}else{
					$('#'+jsonDatos.campos[i].campo).parent().removeClass("error");
				}
			}
			if(jsonDatos.campos[i].validacion.indexOf('E')>-1){ 
				if(!validarEmail ($('#'+jsonDatos.campos[i].campo).val())){
					ok=false;
				}else{
					$('#'+jsonDatos.campos[i].campo).parent().removeClass("error_mail");
				}
			}
		}
}




function aBeforeSend(e){
	$('body').css('cursor', 'progress');  
	$('#preload').show();
	$('#cms_preloader').show();
}

function aError(e, xhr, settings, exception){
	//alert(xhr+'error in: ' + settings + ' \\n'+'error:\\n' + exception);
	$('body').css('cursor', 'default');
	$('#preload').hide();
	$('#cms_preloader').hide();
}

function aComplete(e){
	$('body').css('cursor', 'default');
	$('#preload').hide();
	$('#cms_preloader').hide();
}

function aSuccess(e){
	$('body').css('cursor', 'default');
	$('#preload').hide();
	$('#cms_preloader').hide();
}

function initHistoryTracker(callback){
    $.history.init(callback);
    /*$('#main-content').find("*[rel='history']").click(function(){
        $.history.load(this.href.replace(/^.*#/, ''));
        return false;
    });*/
}


function errorMsg(err,arg){
	/*try{
		if(showErrors){
			name=arg.callee.toString().substring(arg.callee.toString().indexOf('function')+9,arg.callee.toString().indexOf('('));
			alert('ERROR en funcion "'+name+'"\n\n'+err.name + ': ' + err.message);
		}
	}catch(err){
		if(showErrors){ alert('ERROR en funcion "errorMsg"\n\n'+err.name + ': ' + err.message);}		
	}*/		
}



/*   
 *     EVENTS TRACER
 */    
function traceInit(show){
	try{
		if(typeof v_trace=="undefined"){
			v_trace='- tracer initiated -\n';
			var html='';
			html+='<span id="system_trace" style="text-align:center; width:100px; position:absolute; font-weight:1000; cursor:pointer; background: #ddd" onClick="alert(getTrace());">Show Trace</span>';
			html+='<span id="system_trace_reset" style="left:102px; text-align:center; width:25px; position:absolute; font-weight:1000; cursor:pointer; background: #ddd" onClick="v_trace=\'- tracer reseted -\\n\';">R</span>';
			html+='<span id="system_trace_session" style="left:129px; text-align:center; width:25px; position:absolute; font-weight:1000; cursor:pointer; background: #ddd" onClick="loadSession();alert(unescape(JSONtoString(_SESSION)));">S</span>';
			$('body').prepend(html);
		}
		if(show){ 
			$('#system_trace').show();
			$('#system_trace_reset').show();
			$('#system_trace_session').show();
		}else{
			$('#system_trace').hide();
			$('#system_trace_reset').hide();
			$('#system_trace_session').hide();
		}

	}catch(err){
		errorMsg(err,arguments);
	}
}

function trace(str){
	try{
		v_trace+=str+'\n';
	}catch(err){
		//corrije si no se inicio el tracer para q no de error
		traceInit(true);
		v_trace+=str+'\n';
	}
}

function getTrace(){
	try{
		return v_trace;
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}


function include(file){
	if(file.indexOf('.css')>-1){
		document.write('<link href="'+file+'" rel="stylesheet" type="text/css" />');
	}else{
		document.write('<script type="text/javascript" src="'+file+'"></script>');
	}
}

function getBaseURL() {
	var url = window.location.href;
	baseURL=url.substring(0,url.lastIndexOf('/')+1);
	return baseURL;
}

function gup( name ){
	url_actual=window.location.href;
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( unescape(url_actual) ); 
	if( results == null )
	return "";
	else
	return results[1];
}


function fileExists(uri){	
	var result='';
	$.ajax({
		url: uri,
		async:false,
		global:false,
		cache:true,
		type:'HEAD',
		success: function(html,state) {
			result=state;
		}
	});
	
	if(result=='success')
		return true;
	else
		return false;
}

function getFiles(carpeta,success){
	try{
		var valores ='"accion":"selFiles",';	
		valores +='"carpeta":"'+carpeta+'"';

		valores='_p='+encode(escape('{'+valores+'}'));

		var url='../src/main.php';	
		
		$.ajax({
			url:  url,
			data: valores,
			success: function(response){
				success(carpeta,parsearJSON(decode(response)));
			}
		});
	}catch(e){
		alert(e);
	}	
}

function getFileContent(file,success){
		var url=file;	
		
		$.ajax({
			url: url,
			success: function(response){
				success(response);
			}
		});
}


function parsearJSON(str){
	try{
		//if(debug) alert('parsearJSON:'+str);
		return eval('('+str+')');
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}

function JSONtoString(json){
	try{
		//if(debug) alert('parsearJSON:'+str);
		return JSON.stringify(json);
	}catch(err){
		errorMsg(err,arguments);
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

function geti18nLang(success){
	try{
		var valores ="'accion':'sel',";
		valores+="'id':'0'";

		valores='_p='+encode(escape('{'+valores+'}'));
				
		url='./src/controller/i18n_lenguaje.php';

		$.ajax({
		    url: url,
		    data: valores,
		    success: function(response){
				success(parsearJSON(decode(response)));
			}
		});
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}

function geti18nClaves(success){
	try{
		var valores ="'accion':'sel',";
		valores+="'id':'0'";

		valores='_p='+encode(escape('{'+valores+'}'));
				
		url='./src/controller/i18n.php';

		$.ajax({
		    url: url,
		    data: valores,
		    success: function(response){
				success(parsearJSON(decode(response)));
			}
		});
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}
/*if(filtro == 'producto'){
	productosJson.filas.sort(sort_by(filtro, (reversa=='true')? true : false, function(a){return a.toUpperCase();}));
}else{
	productosJson.filas.sort(sort_by(filtro, (reversa=='true')? true : false, parseInt));
}*/

function pressEnter(event, e, success) {
	if (event.keyCode == '13'){
		success(e);
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

function limpiaEspacios(string){
	var tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ.;,'";
	var replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn____'";
	string = unescape(string);
	string = string.replace(/[^a-zA-Z 0-9.]+/g,' ');
	string = string.split(" ");
	string = string.join("_");
	string = string.toLowerCase()

	return (string);
}

function uploader(id,path,maxWidth,thHeight,thWidth,tipo,maxSize,allowedTypes,areaSelect,callback){
	try{

    	var rand=new Date().getTime();//Math.floor(Math.random()*9000000000);;
		thumbHeight=thHeight;
		thumbWidth=thWidth;
				rand=new Date().getTime();
				
				nombreImagenTemp = rand;
				nombreArchivoTemp = rand;
				
				var valores ="'accion':'subirArchivo',";	
				valores +="'nombreImagen':'"+nombreImagenTemp+"',";	
				valores +="'nombreArchivo':'"+nombreArchivoTemp+"',";	
				valores +="'maxWidth':'"+maxWidth+"',";	
				valores +="'maxSize':'"+maxSize+"',";	
				valores +="'allowedTypes':'"+allowedTypes+"',";
				valores +="'dir':'"+path+"',";	
				valores +="'maxWidth':'"+maxWidth+"'";	

				valores=encode('{'+valores+'}');
		$('#confirmar'+id).hide();

		$('#uploadify'+id).uploadifive({
		    'uploadScript': './src/main.php',
			'formData': {'_p' : valores, 'session' : encode(JSONtoString(loadSession()))},
		    'buttonText': 'Examinar',
			'height' : 30,
			'width' : 100,
		    'cancelImg': 'css/images/ico_cerrar.gif',
			'onCancel':function(){$('#confirmar'+id).hide(); $('#uploadifive-uploadify'+id+'-queue').show();},
		    'onSelect':function() {
				$('#uploadifive-uploadify'+id+'-queue').show();
				//if(tipo=='galeria') 
				//$('#confirmar'+id).show();
				$('#uploadify'+id+'Queue').attr('align','left'); //alineacion izquierda de la barra
			},
			'removeCompleted' : true,
		    'onUploadComplete': 		
			    function(file, response, data) {
					try{				
						
						var json = parsearJSON(decode(response));
						if(json.resultado=='OK'){
							$('#uploadifive-uploadify'+id+'-queue').hide();
							if((json.mime == 'jpg' || json.mime == 'png' || json.mime == 'bmp' || json.mime == 'gif') && areaSelect){
								//IMAGEN			

								var th=$('#thumbHeight'+id).html();
								var tw=$('#thumbWidth'+id).html();
								
								var image=json.url+'?a='+Math.floor(Math.random()*9000000000);

								var html2='<div id="uploaded_image'+id+'"><div id="editThumb'+id+'">';								
								html2+='	<div class="areaSelect-img">'
								html2+='  		<div class="areaSelect-txt">Seleccione sobre la imagen para crear la imagen a guardar... 	<input class="areaselect_button" id="btn_save_thumb'+id+'" type="button" value="Guardar Selecci&oacute;n"/></div>'
								html2+='  		<img src="'+image+'" style="border:1px solid #ccc; float: left; margin-right: 10px;" id="thumbnail'+id+'" alt="Create Thumbnail" />'													
								html2+='	</div>';
								html2+='	<div>';
								html2+='    	<input type="hidden" name="x1" value="" id="x1" />';
								html2+='    	<input type="hidden" name="y1" value="" id="y1" />';
								html2+='    	<input type="hidden" name="x2" value="" id="x2" />';
								html2+='    	<input type="hidden" name="y2" value="" id="y2" />';
								html2+='    	<input type="hidden" name="w" value="" id="w" />';
								html2+='    	<input type="hidden" name="h" value="" id="h" />';
								html2+='    	<div id="uploaded_image'+id+'"></div>\n';
								html2+='	</div>';
								html2+='</div></div>';
								
								html2+='<div class="areaSelect-preview" style="display:none;">'
								html2+='  <div class="areaSelect-txt-bold">PREVIEW DE IMAGEN A GUARDAR</div>'
								html2+='  <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:'+tw+'px; height:'+th+'px;">'
								html2+='    <img src="'+image+'" id="thumbnail_preview" alt="Thumbnail Preview" />'
								html2+='  </div><br style="clear:both;">';
								html2+='</div>';
								
								getModalContent('Recortar imagen',$(window).width(), $(window).height()-50, html2);
								
								
								$('#btn_save_thumb'+id).click(function(){
									$('#uploadifive-uploadify'+id+'-queue').hide();
									//RESET RANDOM
									rand=new Date().getTime();
									nombreThumbTemp = rand;
									saveThumb(json.url,nombreThumbTemp,tw,th,
										function(json){
											if(json.resultado=='OK'){
												
												$('#confirmar'+id).hide();
												$('#editThumb'+id).html('');
												$('.uploader-id'+id).each(function(){$(this).show();});
												$('#main_galeria').show();
												$('#btn_upld_pest2').show();
												$('#galeria'+id).html('<div class="list-img-gal"><div class="file-del" onClick="delFile(\''+json.url+'\',function(){}); $(this).parent().remove();"></div><img src="'+json.thumb.substring(json.thumb.indexOf('static'))+'" height="100" width="auto"/></div>');
											}else{
												alert('ERROR: '+json.error);
												$('#uploadifyUploader'+id).show();
												$('.uploader-id'+id).each(function(){$(this).show();});
												$('#main_galeria').show();
												$('#confirmar'+id).hide();
												$('#btn_upld_pest2').show();
												
											}		
											if(callback!=null && areaSelect) callback(decode(response));											
										}
									);
								});
								
								
								//find the image inserted above, and allow it to be cropped
								uploaderId=id;
								if(jQuery.browser.msie){
									var ias = $('#uploaded_image'+id).find('#thumbnail'+id).imgAreaSelect({ aspectRatio: '1:'+th/tw, onSelectEnd: imgAreaSelectPreview, handles: true, x1: 0, y1: 0, x2: json.img_w/2, y2: (json.img_w/2)*(th/tw) });

								}else{
									var ias = $('#uploaded_image'+id).find('#thumbnail'+id).imgAreaSelect({ aspectRatio: '1:'+th/tw, onSelectChange: imgAreaSelectPreview, handles: true, x1: 0, y1: 0, x2: json.img_w/2, y2: (json.img_w/2)*(th/tw) });

								}
								

								$("#dialog_modal_content").bind( "dialogdrag", function(event, ui) {
									//$('#uploaded_image'+id).find('#thumbnail'+id).cancelSelection();
									$('.imgareaselect-outer').remove();
									$('.imgareaselect-selection').parent().remove()
								});
								$("#dialog_modal_content").bind( "dialogclose", function(event, ui) {
									//$('#uploaded_image'+id).find('#thumbnail'+id).cancelSelection();
									$('.imgareaselect-outer').remove();
									$('.imgareaselect-selection').parent().remove();
									$('.uploader-id').each(function(){$(this).show();});
									$('#uploadifive-uploadify'+id+'-queue').show();
								});
								$('#confirmar'+id).hide();
								//$('.uploader-id').each(function(){$(this).hide();});
								$('#main_galeria').hide();
								if(callback!=null && !areaSelect) callback(decode(response));
							}else{
								//ARCHIVOS
								$('#uploadifive-uploadify'+id+'-queue').show();
								$('#confirmar'+id).hide();
								$('#editThumb'+id).html('');
								$('.uploader-id'+id).each(function(){$(this).show();});
								$('#main_galeria').show();
								$('#btn_upld_pest2').show();							
								//getFiles(path,function(path,json){pintarGaleria(path,json);});
								$('#galeria'+id).html('<div class="list-img-gal"><div class="file-del" onClick="delFile(\''+json.url+'\',function(){}); $(this).parent().remove();"></div><a href="'+json.url+'" target="_blank"><img src="css/images/pdf_icon.jpg" height="100" width="auto"/></a></div>');
								if(callback!=null && !areaSelect) callback(decode(response));
							}						
						}else{
							$('.uploader-id'+id).each(function(){$(this).show();});
							$('#main_galeria').show();
							$('#confirmar'+id).hide();						
							alert('ERROR: '+json.error);
							if(callback!=null && !areaSelect) callback(decode(response));
						}
					}catch(err){
						alert('Uploadify on complete ERROR:'+response)
						return null;
					}

			    },
		    'onQueueComplete': 
		    	function(event, queueID, fileObj, response, data) {
					$('#uploadify'+id+'Uploader').show();
					$('.uploader-id').each(function(){$(this).show();});
					
			    },
		    'multi': false
		});
		
		$('#confirmar'+id).hide();
	   
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}
function uploaderNoCrop(id,path,maxWidth,thHeight,thWidth,tipo,maxSize,allowedTypes,areaSelect,callback){
	try{

    	var rand=new Date().getTime();//Math.floor(Math.random()*9000000000);;
		thumbHeight=thHeight;
		thumbWidth=thWidth;
				rand=new Date().getTime();
				nombreImagenTemp = rand;
				nombreArchivoTemp = rand;
				
				var valores ="'accion':'subirArchivoMulti',";	
				valores +="'nombreImagen':'"+nombreImagenTemp+"',";	
				valores +="'nombreArchivo':'"+nombreArchivoTemp+"',";	
				valores +="'maxWidth':'"+maxWidth+"',";	
				valores +="'maxSize':'"+maxSize+"',";	
				valores +="'allowedTypes':'"+allowedTypes+"',";
				valores +="'dir':'"+path+"',";	
				valores +="'maxWidth':'"+maxWidth+"'";	

				valores=encode('{'+valores+'}');
		
		$('#confirmar'+id).hide();
		
		$('#uploadify'+id).uploadifive({
		    'uploadScript': base_url+'/home/upload/',
			'formData': {'_p' : valores},
		    'buttonText': 'Examinar',
			'height' : 30,
			'width' : 100,
		    'cancelImg': 'css/images/ico_cerrar.gif',
			'onCancel':function(){$('#confirmar'+id).hide(); $('#uploadifive-uploadify'+id+'-queue').show();},
		    'onSelect':function() {
				$('#uploadify'+id+'Queue').attr('align','left'); //alineacion izquierda de la barra
			},
			'removeCompleted' : true,
		    'onUploadComplete': 		
			    function(file, response, data) {
					
					var json = parsearJSON(response);
					
					if(json.resultado=='OK'){					
						$('#confirmar'+id).hide();	
						var urlPrint = json.url.replace('../../../../asset/img/uploads/','../../../asset/img/uploads/');	
						var urlCrop = json.url.replace('../../../../asset/img/uploads/','');
						if(json.mime == 'jpg' || json.mime == 'jpeg' || json.mime == 'png' || json.mime == 'bmp' || json.mime == 'gif'){
							$('#galeria'+id).html('<div class="list-img-gal"><div class="file-del" onClick="delFile(\''+urlPrint+'\',function(){}); $(\'#galeria'+id+'_input\').val(\'\'); $(this).parent().remove();"></div><img src="'+json.url+'" height="100" width="auto"/><br/><input type="text" id="img_desc"/></div>');
						}else{
							$('#galeria'+id).html('<div class="list-img-gal"><div class="file-del" onClick="delFile(\''+urlPrint+'\',function(){}); $(this).parent().remove();"></div><a href="'+json.url+'" target="_blank"><img src="../../../asset/img/pdf_icon.jpg" height="100" width="auto"/></a><br/><input  type="text" id="img_desc"/></div>');
						}
						
						$('#galeria'+id+'_input').val(urlCrop);
					}else{
						$('#main_alert').html('ERROR: '+json.error);
						$('#main_alert').show();
						setTimeout(function(){
						  $('#main_alert').hide();
						}, 4000);
						$('#uploadifive-uploadify'+id+'-queue').show();
						$('.uploader-id').each(function(){$(this).show();});
						$('#confirmar'+id).hide();
					}
			    },
		    'onQueueComplete': 
		    	function(event, queueID, fileObj, response, data) {
					$('#uploadify'+id+'Uploader').show();
					$('.uploader-id').each(function(){$(this).show();});
					
			    },
		    'multi': false
		});
	
		
	    $('#confirmar'+id).click(function() {
	    	try{
				$('#uploadify'+id).uploadifive('upload');
				return false;
			}catch(err){
				errorMsg(err,arguments);
				return null;
			}
	    });
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}

function uploaderMulti(id,path,maxWidth,thHeight,thWidth,tipo,maxSize,allowedTypes,areaSelect,callback){
	try{

    	var rand=new Date().getTime();//Math.floor(Math.random()*9000000000);;
		thumbHeight=thHeight;
		thumbWidth=thWidth;
				rand=new Date().getTime();
				nombreImagenTemp = rand;
				nombreArchivoTemp = rand;
				
				var valores ="'accion':'subirArchivoMulti',";	
				valores +="'nombreImagen':'"+nombreImagenTemp+"',";	
				valores +="'nombreArchivo':'"+nombreArchivoTemp+"',";	
				valores +="'maxWidth':'"+maxWidth+"',";	
				valores +="'maxSize':'"+maxSize+"',";	
				valores +="'allowedTypes':'"+allowedTypes+"',";
				valores +="'dir':'"+path+"',";	
				valores +="'maxWidth':'"+maxWidth+"'";	

				valores=encode('{'+valores+'}');
		
		$('#confirmar'+id).hide();
		
		$('#uploadify'+id).uploadifive({
		    'uploadScript': base_url+'/home/upload/',
			'formData': {'_p' : valores},
		    'buttonText': 'Examinar',
			'height' : 30,
			'width' : 100,
		    'cancelImg': 'css/images/ico_cerrar.gif',
			'onCancel':function(){$('#confirmar'+id).hide(); $('#uploadifive-uploadify'+id+'-queue').show();},
		    'onSelect':function() {
				$('#uploadify'+id+'Queue').attr('align','left'); //alineacion izquierda de la barra
			},
			'removeCompleted' : true,
		    'onUploadComplete': 		
			    function(file, response, data) {
					var json = parsearJSON(response);
					
					if(json.resultado=='OK'){					
						$('#confirmar'+id).hide();	
						var urlPrint = json.url.replace('../../../../asset/img/uploads/','../../../asset/img/uploads/');	
						var urlCrop = json.url.replace('../../../../asset/img/uploads/','');
						if(json.mime == 'jpg' || json.mime == 'png' || json.mime == 'bmp' || json.mime == 'gif'){
							$('#galeria'+id).append('<div class="list-img-gal"><div class="file-del" onClick="delFile(\''+urlPrint+'\',function(){});  $(this).parent().remove(); updateMultiFileInput('+id+');"></div><img src="'+json.url+'" height="100" width="auto"/><br/><input type="text" id="img_desc"/></div>');
						}else{
							$('#galeria'+id).append('<div class="list-img-gal"><div class="file-del" onClick="delFile(\''+urlPrint+'\',function(){}); $(this).parent().remove();"></div><a href="'+json.url+'" target="_blank"><img src="../../../asset/img/pdf_icon.jpg" height="100" width="auto"/></a><br/><input  type="text" id="img_desc"/></div>');
						}
						
						if($('#galeria'+id+'_input').val()==''){
							$('#galeria'+id+'_input').val(urlCrop);
						}else{
							$('#galeria'+id+'_input').val($('#galeria'+id+'_input').val()+','+urlCrop);
						}
						
					}else{
						$('#main_alert').html('ERROR: '+json.error);
						$('#main_alert').show();
						setTimeout(function(){
						  $('#main_alert').hide();
						}, 4000);
						$('#uploadifive-uploadify'+id+'-queue').show();
						$('.uploader-id').each(function(){$(this).show();});
						$('#confirmar'+id).hide();
					}

			    },
		    'onQueueComplete': 
		    	function(event, queueID, fileObj, response, data) {
					$('#uploadify'+id+'Uploader').show();
					$('.uploader-id').each(function(){$(this).show();});
					
			    },
		    'multi': true
		});
		
		$('.uploadifive-button input[multiple="multiple"]').parent().addClass('multiple');
		
	    $('#confirmar'+id).click(function() {
	    	try{
				
				$('#uploadify'+id).uploadifive('upload');
				return false;
			}catch(err){
				errorMsg(err,arguments);
				return null;
			}
	    });
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}   

function uploaderwysihtml5(id,path,maxWidth,thHeight,thWidth,tipo,maxSize,allowedTypes,areaSelect,callback){
	try{

    	var rand=new Date().getTime();//Math.floor(Math.random()*9000000000);;
		thumbHeight=thHeight;
		thumbWidth=thWidth;
		rand=new Date().getTime();
		nombreImagenTemp = rand;
		nombreArchivoTemp = rand;
		
		var valores ="'accion':'subirArchivoMulti',";	
		valores +="'nombreImagen':'"+nombreImagenTemp+"',";	
		valores +="'nombreArchivo':'"+nombreArchivoTemp+"',";	
		valores +="'maxWidth':'"+maxWidth+"',";	
		valores +="'maxSize':'"+maxSize+"',";	
		valores +="'allowedTypes':'"+allowedTypes+"',";
		valores +="'dir':'"+path+"',";	
		valores +="'maxWidth':'"+maxWidth+"'";	

		valores=encode('{'+valores+'}');
		
		$('#confirmar'+id).hide();

		$('#uploadify'+id).uploadifive({
		    'uploadScript': base_url+'/home/upload/',
			'formData': {'_p' : valores},
		    'buttonText': 'Examinar',
			'height' : 30,
			'width' : 100,
		    'cancelImg': 'css/images/ico_cerrar.gif',
			'onCancel':function(){$('#confirmar'+id).hide(); $('#uploadifive-uploadify'+id+'-queue').show();},
		    'onSelect':function() {
				$('#uploadify'+id+'Queue').attr('align','left'); //alineacion izquierda de la barra
				$('a[data-wysihtml5-dialog-action="save"]').attr('disabled','disabled');
				$('a[data-wysihtml5-dialog-action="save"]').text('Cargando...');
			},
			'removeCompleted' : true,
		    'onUploadComplete': 		
			    function(file, response, data) {
					
						var json = parsearJSON(response);
						if(json.resultado=='OK'){					
							$('#confirmar'+id).hide();							
							$('#inpt_wysihtml5').val(json.url.replace('../../../../asset/img/uploads/',base_url.replace('admin/','')+'asset/img/uploads/'));
						}else{
							$('#main_alert').html('ERROR: '+json.error);
							$('#main_alert').show();
							setTimeout(function(){
							  $('#main_alert').hide();
							}, 4000);
							$('#uploadifive-uploadify'+id+'-queue').show();
							$('.uploader-id').each(function(){$(this).show();});
							$('#confirmar'+id).hide();
						}
						$('a[data-wysihtml5-dialog-action="save"]').removeAttr('disabled');
						$('a[data-wysihtml5-dialog-action="save"]').text('OK');

			    },
		    'onQueueComplete': 
		    	function(event, queueID, fileObj, response, data) {
					$('#uploadify'+id+'Uploader').show();
					$('.uploader-id').each(function(){$(this).show();});
					
			    },
		    'multi': false
		});

		
	    $('#confirmar'+id).click(function() {
	    	try{
				
				$('#uploadify'+id).uploadifive('upload');
				return false;
			}catch(err){
				errorMsg(err,arguments);
				return null;
			}
	    });
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}

//create a preview of the selection
function imgAreaSelectPreview(img, selection) {
	try{
		//get width and height of the uploaded image.
		var current_width = $('#uploaded_image'+uploaderId).find('#thumbnail'+uploaderId).width();
		var current_height = $('#uploaded_image'+uploaderId).find('#thumbnail'+uploaderId).height();

		var th=$('#thumbHeight'+uploaderId).html();
		var tw=$('#thumbWidth'+uploaderId).html();
		
		var scaleX = tw / selection.width; 
		var scaleY = th / selection.height; 
		
		$('#uploaded_image'+uploaderId).find('#thumbnail_preview').css({ 
			width: Math.round(scaleX * current_width) + 'px', 
			height: Math.round(scaleY * current_height) + 'px',
			marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
			marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
		});
		$('#x1').val(selection.x1);
		$('#y1').val(selection.y1);
		$('#x2').val(selection.x2);
		$('#y2').val(selection.y2);
		$('#w').val(selection.width);
		$('#h').val(selection.height);
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}

//create the thumbnail
function saveThumb(image,thumb,thumbWidth,thumbHeight,success) {
	try{
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			//alert("You must make a selection first");
			alert("Primero debes hacer la selección");
			return false;
		}else{
			//hide the selection and disable the imgareaselect plugin
			$('#uploaded_image'+uploaderId).find('#thumbnail'+uploaderId).imgAreaSelect({ disable: true, hide: true });
			$('#editThumb'+uploaderId).hide();
			
			var th=$('#thumbHeight'+uploaderId).html();
			var tw=$('#thumbWidth'+uploaderId).html();
			
			/*var params='accion=saveThumb';
			params+='&imagen='+image;
			params+='&thumb='+thumb;
			params+='&thumbWidth='+tw;
			params+='&thumbHeight='+th;
			params+='&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2+'&w='+w+'&h='+h;*/
			
			var valores ="'accion':'saveThumb',";	
			valores +="'imagen':'"+image+"',";	
			valores +="'thumb':'"+thumb+"',";	
			valores +="'thumbWidth':'"+tw+"',";	
			valores +="'thumbHeight':'"+th+"',";	
			valores +="'x1':'"+x1+"',";	
			valores +="'y1':'"+y1+"',";	
			valores +="'x2':'"+x2+"',";	
			valores +="'y2':'"+y2+"',";	
			valores +="'w':'"+w+"',";	
			valores +="'h':'"+h+"'";
			
			valores='_p='+encode('{'+valores+'}');
			
			$.ajax({
				type: 'POST',
				url: './src/main.php',
				data: valores,
				cache: false,
				success: function(response){
					success(parsearJSON(decode(response)));
				}
			});		
		}
	}catch(err){
		errorMsg(err,arguments);
		return null;
	}
}

function delFile(file,success){
	var valores ='"accion":"delFile",';	
	valores +='"file":"'+file+'"';

	valores='_p='+encode(escape('{'+valores+'}'));
	
	var url=base_url+'/home/defile/';	
	
	$.ajax({
		url: url,
		data: valores,
		type: 'post',
		success: function(response){
			console.log(response);
		}
	});
}

function updateMultiFileInput(id){
	var html='';
	$('#galeria'+id).find('.list-img-gal').each(function(){		
		if(html==''){
			html += $(this).find('img').attr('src').replace('../../../../asset/img/uploads/','');
		}else{
			html += ','+$(this).find('img').attr('src').replace('../../../../asset/img/uploads/','');
		}
	});
	$('#galeria'+id+'_input').val(html);
}

function iframeLoaded(iframe) {
		// here you can make the height, I delete it first, then I make it again
		$(iframe).height("0");
		setTimeout(function(){
			var hh = iframe.contentWindow.document.body.scrollHeight;		
			$(iframe).height(hh);
			console.log(hh);
			
		},100);
		
}