<html>
   <head>
   	  <meta charset="utf-8" />
      <title>Administrador Cotizador</title>
	  <meta name="description" content="Administrador de contenidos">
	  <meta name="keywords" content="<?= $keywords ?>">
	  <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
	  
	  <meta property="og:title" content="Administrador" />
	  <meta property="og:type" content="<?= $ogType ?>" />
	  <meta property="og:url" content="<?php echo base_url(uri_string()) ?>" />
	  <meta property="og:image" content="<?= base_url().$image ?>" />
	  <meta property="og:description" content="<?= $description ?>" />
  	  
  	  <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>asset/img/favicon.png">  

	  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
	  <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap.min.css">
	  <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap-theme.min.css">
	  <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/jquery-ui.css">
	  <link rel="stylesheet"  href="<?php echo base_url() ?>asset/css/datatables.css" type="text/css" media="all" />
	  <link rel="stylesheet"  href="<?php echo base_url() ?>asset/css/bootstrap-wysihtml5.css" type="text/css" media="all" />
	  <link rel="stylesheet"  href="<?php echo base_url() ?>asset/css/uploadify.css" type="text/css" media="all" />
	  <link rel="stylesheet"  href="<?php echo base_url() ?>asset/css/main.css" type="text/css" media="all" />
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/utils.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
	  
	  <script>var p_section = "<?php echo $this->uri->segment(1);?>"; var p_accion = "<?php echo $this->uri->segment(2);?>"; var p_id = "<?php echo $this->uri->segment(3);?>"; var base_url = "<?php echo base_url() ?>";</script>
	  <?= $_styles ?>
   </head>
   <body>
	  <?= $header ?>
	  <div class="col-md-12 admin-content">
		  <?= $nav ?>	  
		  <?= $content ?>
	  </div>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery-1.11.1.js"></script>		  
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/main.js"></script> 
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery.dataTables.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/dataTables.bootstrap.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery.base64.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/wysihtml5.js"></script>
	  <!--<script type="text/javascript" src="<?php echo base_url() ?>asset/js/editor/tinymce.min.js"></script>-->
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/advanced.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery.uploadifive.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery.confirmExit.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery-ui.min.js"></script>
	 
	  <script type="text/javascript">
	  	    $('.collapse-header').on('click', function () {
	  	        $($(this).data('target')).collapse('toggle');
	  	    });
	  </script>
	  <script type="text/javascript">
	  	$('[data-toggle="collapse"]').click(function() {
	  	  $('.collapse.in').collapse('hide')
	  	});
	  </script>

	  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

	  <?= $_scripts ?>

	  <script type="text/javascript">
	  	$('.my-select').selectpicker();
	  </script>

	  
	  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<h3>Esta seguro que desde eliminar este registro?</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-danger btn-ok">Eliminar</a>
					</div>
				</div>
			</div>
	   </div>
	   <div class="modal fade" id="confirm-quit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<h3>Esta seguro que desea salir sin guardar los datos?</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-danger btn-ok">Salir</a>
					</div>
				</div>
			</div>
	   </div>
	   <div class="alert alert-danger alert-dismissible" id="main_alert"></div>

	   <script type="text/javascript">
	   		$(".add-user-concesionario").submit(function(event){
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
	   			        //$('.bt-save').addClass('disabled');
	   			    },
	   			    success: function(response){
	   			    	if(response == 'nouser'){
	   			    		alert("Usuario existente");
	   			    		$('.bt-save').removeAttr('disabled');
	   			    	} else {
	   			    		window.location.replace('<?=base_url()?>'+response);
	   			    	}
	   			    }
	   			});
	   		});
	   </script>
	   
   </body>
</html>