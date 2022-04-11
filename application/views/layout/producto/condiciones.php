<section class="producto">  
	<div class="container">
		<div class="row m-0">
			<div class="col-10">
				<div class="row m-0">
					<div class="col-12 col-md-6">
						<div class="conten-categoria-nombre">
							<p>Condiciones</p>
						</div>
					</div>
					<div class="col-12 col-md-6"></div>
					<div class="col-12 col-md-1"></div>
					<div class="col-12 col-md-6">
						<div id="accordion">
						  <div class="card">
						    <?php $i=0; ?>
                            <?php foreach($categorias as $cat): ?>
                            <?php  $show = ""; if($i<=0) $show=" show ";   ?>
                            
                            <div class="card-header" id="financiacionBtn">
						      <h5 class="mb-0">
						        <button class="btn btn-link" data-toggle="collapse" data-target="#financiacionBtn<?=$cat->id?>" aria-expanded="true" aria-controls="financiacionBtn<?=$cat->id?>">
						          <?=$cat->categoria?>
						        </button>
						      </h5>
						    </div>
                            
						    <div id="financiacionBtn<?=$cat->id?>" class="collapse <?=$show?> " aria-labelledby="financiacionBtn<?=$cat->id?>" data-parent="#accordion">
						      <div class="card-body body-radio-buttons">
                              <?php foreach($this->page_model->getPagoCategoriasItems($cat->id) as $item): ?>
						      	<p>
						      	    <input data-id-product="<?=$this->uri->segment(3)?>" type="checkbox" class="finaciacion_<?=$item->id?> fina" id="finaciacion_<?=$item->id?>" name="financiacion" value="<?=$item->id?>">
						      	    <label for="finaciacion_<?=$item->id?>"><?=$item->item?> </label>
					      	  	</p>
                                
                                <script type="text/javascript">
        				  	  		$('.finaciacion_<?php echo $item->{'id'} ?>').change(function() {
	        				  	  		event.preventDefault();
        		  	  			  	    var producto = $(this).attr("data-id-product"); //Encode form elements for submission
        		  	  			  	    var pago_item = $('.fina[name=financiacion]:checked').map(function(){ return $(this).val(); }).get();
                                        
        		  	  			  	    $.ajax({
        		  	  			  	    	url : '<?php echo base_url() ?>envio/pago_session/',
        		  	  			  	    	type: 'post',
        		  	  			  	    	data : {'producto':producto,'pago_item':pago_item},
        		  	  			  	    	beforeSend: function() {
        		  	  			  	            // setting a timeout
        		  	  			  	            $('.enviar-btn').addClass('disable');
        		  	  			  	            $('.gif-load').show('slow');
        		  	  			  	        },
        		  	  			  	        success: function(response){
                                                  $('.content').html(response);
        		  	  			  	        }
        		  	  			  	    });
        		  	  			  	});
        				  	  	</script>
                                
                                <?php endforeach; ?>
						      </div>
						    </div>
                            <?php $i++; ?>
                            
 
                            <?php endforeach; ?>
                            
						  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2">
				
			</div>
		</div>
	</div>
	<div class="row m-0">
		<div class="col-12 menu-desplegable <?php if(empty($this->session->userdata['cant_cart']['total'])): ?>inactivo <?php endif; ?>">
			<div class="row m-0" style="width:100%;height:100%;">
				<div class="col-2 content-frist d-flex flex-column align-items-start">
					<div class="icon-cart abrir">
						<i class="numero-cantidad" data-cantidad="<?php echo $this->session->userdata['cant_cart']['total'] ?>"><?php echo $this->session->userdata['cant_cart']['total'] ?></i>
						<img src="<?php echo base_url() ?>asset/img/icon-04.png" class="img-fluid">
					</div>
					<div class="text-vertical abrir">
						<img src="<?php echo base_url() ?>asset/img/text-menu.png" class="img-fluid">
					</div>

				</div>
				
				<div class="col-9 content-int">

					<div class="row m-0">
						<div class="col-6 p-0 text-vertical-int">
							<h4 class="click-volver">X CERRAR</h4>
						</div>
						<div class="col-6 p-0 text-right">
							
							<div class="icon-cart-int">
								<i class="numero-cantidad"><?php echo $this->session->userdata['cant_cart']['total'] ?></i>
								<img src="<?php echo base_url() ?>asset/img/icon-04.png" class="img-fluid cart-img">
							</div>
						</div>
						<div class="content">
							<?=$cart_final["contenido"]?>
						</div>
					</div>

				</div>
				<div class="col-1"></div>
			</div>
		</div>
	</div>
</section>

<div class="content-compartir">
	<div class="cont-icons">
		<div class="icon-com guardar" data-save="guardar">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-01.png" class="img-fluid">
		</div>
		<div class="icon-com guardar" data-save="imprimir">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-02.png" class="img-fluid">
		</div>
		<div class="icon-com guardar" data-save="whatsapp">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-03.png" class="img-fluid">
		</div>
		<div class="icon-com guardar" data-save="correo">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-04.png" class="img-fluid">
		</div>
	</div>
	<div class="icon-avion">
		<img src="<?php echo base_url() ?>asset/img/icon-avion.png" class="img-fluid">
	</div>
</div>
