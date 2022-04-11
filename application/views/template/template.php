<!DOCTYPE html>
<html>
   <head>
   	  <meta charset="utf-8" />
      <title><?= $title ?></title>
	  <meta name="description" content="<?= $description ?>">
	  <meta name="keywords" content="<?= $keywords ?>">
	  <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
	  
	  <meta property="og:title" content="<?= $title ?>" />
	  <meta property="og:type" content="<?= $ogType ?>" />
	  <meta property="og:url" content="<?php echo base_url(uri_string()) ?>" />
	  <meta property="og:image" content="<?= base_url().$image ?>" />
	  <meta property="og:description" content="<?= $description ?>" />
	  
	  <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>asset/img/favicon.png?">  
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/main.css" type="text/css" media="all" />
	  <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/masterslider.main.css" media="all" />
	  <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/animations.css" media="all" />
	  <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700,800,900" rel="stylesheet"> 
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
	  <script>var base_url = "<?php echo base_url() ?>";</script>
      <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	  <?= $_styles ?>
	  <style type="text/css">
	  	#example_length {display:none;}
	  	.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {    background: #3b3644;color:#fff !important;}
	  	.dataTables_paginate.paging_simple_numbers {width:100%;text-align:center;}
	  	.dataTables_wrapper .dataTables_paginate .paginate_button {font-size:14px;}
	  	.dataTables_wrapper .dataTables_info {font-size:14px;}
	  	#proformas .modal-dialog {max-width:700px;}

	  	.cambio-estado input {width:100%;border:none;background:#dee0e2;padding: 10px 20px;border-radius: 15px;}
	  	.cambio-estado select {width:100%;border:none;background:#dee0e2;padding: 14px 20px;margin-bottom: 10px;border-radius: 15px;height:45px;}
	  	.cambio-estado input[type="submit"] {background: #ea212e;color: #fff;font-weight: normal;font-size: 15px;transition: .6s;border:2px transparent solid;}
	  	.cambio-estado input[type="submit"]:hover {cursor:pointer;opacity:.5;color:#fff;transition: .6s;}


	  </style>
	 

   </head>
   <body>
	  <div class="main-content col-md-12 p-0">
	  <?= $header ?>        
	  <?= $content ?>
   	  <?= $footer ?>
	  </div>
	  <div class="content-loding" style="display:none;">
	  	<div class="content-items d-flex align-items-center justify-content-center flex-column">
	  		<img src="<?php echo base_url() ?>asset/img/logo_fertec.png" class="img-01">
	  		<img src="<?php echo base_url() ?>asset/img/gif_load.gif" class="img-02">
	  	</div>
	  </div>
	  <!-- Modal -->
	  <div id="ModalEnviar" class="modal fade" role="dialog">
	    <div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content moda-dinamico">
		    <div class="modal-body">
		    </div>
		  </div>

	    </div>
	  </div>

	  <div id="ModalProforma" class="modal fade" role="dialog">
	    <div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content moda-dinamico">
		    <div class="modal-body-proforma">
		    </div>
		  </div>

	    </div>
	  </div>
 
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
	  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <?= $_scripts ?>

	  <?php $leads = $this->page_model->get_leads();
	  //print_r($leads[0]->nombre); ?>
	  <script type="text/javascript">
	  	$('#example').DataTable({
            responsive: true,
            language: {
		        "decimal":        "",
		    "emptyTable":     "No hay datos",
		    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
		    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
		    "infoFiltered":   "(Filtro de _MAX_ total registros)",
		    "infoPostFix":    "",
		    "thousands":      ",",
		    "lengthMenu":     "Mostrar _MENU_ registros",
		    "loadingRecords": "Cargando...",
		    "processing":     "Procesando...",
		    "search":         "Buscar:",
		    "zeroRecords":    "No se encontraron coincidencias",
		    "paginate": {
		        "first":      "Primero",
		        "last":       "Ultimo",
		        "next":       "Próximo",
		        "previous":   "Anterior"
		    },
		    "aria": {
		        "sortAscending":  ": Activar orden de columna ascendente",
		        "sortDescending": ": Activar orden de columna desendente"
		    }
		      }
        });
	  </script>
    <script type="text/javascript">

	$(".abrir").click(function() {  //use a class, since your ID gets mangled

		var data_menu = $('.numero-cantidad').attr("data-cantidad"); //Encode form elements for submission
	    $('.menu-desplegable').toggleClass("active-menu");      //add the class to the clicked element
	    $('.icon-cart').toggleClass("ocultar");      //add the class to the clicked element
	    $('.text-vertical').toggleClass("ocultar");      //add the class to the clicked element
	    $('.content-compartir').show();      //add the class to the clicked element
	    $('.content-proforma').show();      //add the class to the clicked element
	    if(data_menu > 2){
	    	$('.menu-desplegable').toggleClass('remove-height');
	    }
	  });

	$(".add-cart").click(function(event){
		var producto = $(this).attr("data-id-product"); //Encode form elements for submission
		
		$.ajax({
			url : '<?php echo base_url() ?>envio/session_productos/',
			type: 'post',
			data : {'producto':producto},
			beforeSend: function() {
		        // setting a timeout
		        $('.enviar-btn').addClass('disable');
		        $('.gif-load').show('slow');
		    },
		    success: function(response){
		    		var data = JSON.parse(response);
			    	$('.menu-desplegable').removeClass('inactivo');
			    	$('.numero-cantidad').html(data.total);
			    	$('.numero-cantidad').data('cantidad',data.total); //setter
		    		$('.content').html(data.contenido);
					// alert(response);
		    }
		});
	});

	$(".icon-save").click(function(event){
		var user_id = <?php echo $this->session->userdata['user']['id_user'] ?>;
		$.ajax({
			url : '<?php echo base_url() ?>envio/send_presupuesto/',
			type: 'post',
			data : {'user_id':user_id},
			beforeSend: function() {
		        // setting a timeout
		        $('.enviar-btn').addClass('disable');
		        $('.gif-load').show('slow');
		    },
		    success: function(response){
		    	alert("presupuesto enviado");
		      // window.location.replace(response);
		    }
		});
	});

	$(".guardar").click(function(event){
		var user_id = <?php echo $this->session->userdata['user']['id_user'] ?>;
		var estado = $(this).attr("data-save");
		$.ajax({
			url : '<?php echo base_url() ?>envio/envio_compartido/',
			type: 'post',
			data : {'user_id':user_id, 'estado':estado},
			beforeSend: function() {
		        // setting a timeout
		        $('.content-loding').show();
		    },
		    success: function(response){
		    	var data = JSON.parse(response);

		    		$('.content-loding').hide();
		    		$('#ModalEnviar').modal('show');
		    		$('.modal-body').html(data.contenido);
		    }
		});
	});

	$(".send-proforma").submit(function(event){
		event.preventDefault(); //prevent default action 
  		var post_url = $(this).attr("action"); //get form action url
  		var request_method = $(this).attr("method"); //get form GET/POST method
  		var form_data = $(this).serialize(); //Encode form elements for submission
		$.ajax({
			url : post_url,
  			type: request_method,
  			data : form_data,
			beforeSend: function() {
		        // setting a timeout
		        $('.content-loding').show();
		    },
		    success: function(response){
		    		if(response == 'exito'){
		    			alert("Proforma enviada con exito");
		    		} else {
		    		  window.location.replace(response);
		    		}
		        $('.content-loding').hide();
		    }
		});
	});

    </script>

      <script type="text/javascript">

	  	$(".click-volver").click(function() {  //use a class, since your ID gets mangled
	  	    $('.menu-desplegable').toggleClass("active-menu");      //add the class to the clicked element
	  	    $('.icon-cart').toggleClass("ocultar");      //add the class to the clicked element
	  	    $('.text-vertical').toggleClass("ocultar");      //add the class to the clicked element
	  	    $('.menu-desplegable').toggleClass('remove-height');
	  	    $('.content-compartir').hide();
	  	    $('.content-proforma').hide();
  	  	});
  	  	$(".icon-avion").click(function() {
  	  		$('.cont-icons').toggleClass('mostrar-icons-content');
  	  	});
  	  	$(".icon-proforma-open").click(function() {
  	  		$('.cont-icons-prof').toggleClass('mostrar-icons-content');
  	  	});
	  	$('.sendCategoria').on('change', function() {
	  	    $(this).closest(".form-categorias").submit();
	  	});
	  	$(".form-categorias").submit(function(event){
	  		event.preventDefault(); //prevent default action 
	  		var post_url = $(this).attr("action"); //get form action url
	  		var request_method = $(this).attr("method"); //get form GET/POST method
	  		var form_data = $(this).serialize(); //Encode form elements for submission
	  		
	  		$.ajax({
	  			url : post_url,
	  			type: request_method,
	  			data : form_data,
	  			beforeSend: function() {
	  		        // setting a timeout
	  		        $('.enviar-btn').addClass('disable');
	  		        $('.gif-load').show('slow');
	  		    },
	  		    success: function(response){
	  		       window.location.replace(response);
	  		    }
	  		});
	  	});

	  	$(".registro-user").submit(function(event){
	  		event.preventDefault(); //prevent default action 
	  		var post_url = $(this).attr("action"); //get form action url
	  		var request_method = $(this).attr("method"); //get form GET/POST method
	  		var form_data = $(this).serialize(); //Encode form elements for submission
	  		
	  		$.ajax({
	  			url : post_url,
	  			type: request_method,
	  			data : form_data,
	  			beforeSend: function() {
	  		        // setting a timeout
	  		        $('.enviar-btn').addClass('disable');
	  		        $('.gif-load').show('slow');
	  		    },
	  		    success: function(response){
		  		    
	  				if(response == "errorMail") {
	  					alert("Es obligatorio rellenar el Email, o el teléfono.");
					}
					else{
						window.location.replace(response);						
					}
	  		    }
	  		});
	  	});

	  	$(".form-login").submit(function(event){
	  		event.preventDefault(); //prevent default action 
	  		var post_url = $(this).attr("action"); //get form action url
	  		var request_method = $(this).attr("method"); //get form GET/POST method
	  		var form_data = $(this).serialize(); //Encode form elements for submission
	  		
	  		$.ajax({
	  			url : post_url,
	  			type: request_method,
	  			data : form_data,
	  			beforeSend: function() {
	  		        // setting a timeout
	  		        $('.enviar-btn').addClass('disable');
	  		        $('.gif-load').show('slow');
	  		    },
	  		    success: function(response){
	  		    	if(response == 'error'){
	  		    		$('.content-error').show();
	  		    	} else {
						window.location.replace(response);
					}
	  		    }
	  		});
	  	});


		$(".send-usuario-actualizar").submit(function(event){
	  		event.preventDefault(); //prevent default action 
	  		var post_url = $(this).attr("action"); //get form action url
	  		var request_method = $(this).attr("method"); //get form GET/POST method
	  		var form_data = $(this).serialize(); //Encode form elements for submission
	  		
	  		$.ajax({
	  			url : post_url,
	  			type: request_method,
	  			data : form_data,
	  			beforeSend: function() {
	  		        // setting a timeout
	  		        $('.enviar-btn').addClass('disable');
	  		        $('.gif-load').show('slow');
	  		    },
	  		    success: function(response){
	  		    	location.reload();
	  		    }
	  		});
	  	});	  	
	  	

  	  	$(".cambio-estado").submit(function(event){
  	  		event.preventDefault(); //prevent default action 
  	  		var post_url = $(this).attr("action"); //get form action url
  	  		var request_method = $(this).attr("method"); //get form GET/POST method
  	  		var form_data = $(this).serialize(); //Encode form elements for submission
  	  		
  	  		$.ajax({
  	  			url : post_url,
  	  			type: request_method,
  	  			data : form_data,
  	  			beforeSend: function() {
  	  		        // setting a timeout
  	  		        $('.enviar-btn').addClass('disable');
  	  		        $('.gif-load').show('slow');
  	  		    },
  	  		    success: function(response){
  		  		   location.reload(true);
  	  		    }
  	  		});
  	  	});
	  	
	  </script>

   </body>
</html>