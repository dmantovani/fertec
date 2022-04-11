var marker='';

$(document).ready(function(){
	 $('#list').DataTable({"bSort": true});	 
	
	
	
	/*CAMPOS A VALIDAR*/
	jsonDatos=eval('({"campos":['+
		'{"campo":"fechaInicio","validacion":"B"}'+		
		']})');
		
	
	$('#provincia').change(function(){
		hideSedes();
	});
	hideSedes();
	
	$.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	 weekHeader: 'Sm',
	 dateFormat: 'dd/mm/yy',
	 firstDay: 1,
	 isRTL: false,
	 showMonthAfterYear: false,
	 yearSuffix: ''
	 };
	 $.datepicker.setDefaults($.datepicker.regional['es']);
	$('#fechaInicio').datepicker();
});

function hideSedes(){
	$('#sede option').hide();
	$first=0;
	$('#sede option').each(function(){
		if($(this).attr('prv-id')==$('#provincia').val()){
			if($first==0){$first=1; $(this).attr('selected','selected');}
			$(this).show();
		}
	});
}
