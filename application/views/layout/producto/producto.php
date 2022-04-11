<?php //print_r($this->session->userdata()) ?>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<section class="producto">
	<div class="col-12">
		<div class="row m-0">
			<div class="col-11">
				<div class="row m-0">
					<div class="col-12 col-md-6">
						<div class="conten-categoria-nombre">
							<?php $categoria = $this->page_model->get_categoria_id($this->session->userdata['user']['categoria']) ?>
							<p><?php echo $categoria[0]->{'categoria'} ?></p>
						</div>
					</div>
					<div class="col-12 col-md-6 d-flex justify-content-center align-items-center flex-wrap">
						<div class="conteinter-user">
							<h3>Datos de usuario:</h3>
							<p><strong>Nombre: </strong> <?php echo $this->page_model->setSeleccionado($this->session->userdata['user']['nombre']); ?></p>
							
							<p><strong>Email: </strong> <?php echo $this->page_model->setSeleccionado($this->session->userdata['user']['email']); ?></p>

							<?php if(isset($this->session->userdata['user']['email_extra'])): ?>
							<p><strong>Email Adicional: </strong> <?php echo $this->session->userdata['user']['email_extra'] ?></p>
							<?php endif; ?>

							<p><strong>Cuit: </strong> <?php echo $this->page_model->setSeleccionado($this->session->userdata['user']['cuit']); ?></p>
							<p><strong>Razón Social: </strong> <?php echo $this->page_model->setSeleccionado($this->session->userdata['user']['razon_social']); ?></p>
							<p><strong>Teléfono: </strong> <?php echo $this->page_model->setSeleccionado($this->session->userdata['user']['telefono']); ?></p>
							<?php if(isset($this->session->userdata['user']['telefono_extra'])): ?>
							<p><strong>Teléfono Adicional: </strong> <?php echo $this->session->userdata['user']['telefono_extra'] ?></p>
							<?php endif; ?>
							
							
							<p><strong>Localidad: </strong> <?php echo $this->page_model->getCiudadNombreById($this->session->userdata['user']['localidad']) ?> - <?php echo $this->page_model->getCiudadProvinciaById($this->session->userdata['user']['localidad']) ?> <?php echo $this->page_model->getCiudadCPById($this->session->userdata['user']['localidad']) ?></p>
							
							<?php if(isset($this->session->userdata['user']['domicilio_extra'])): ?>
							<p><strong>Domicilio Adicional: </strong> <?php echo $this->session->userdata['user']['domicilio_extra'] ?></p>
							<?php endif; ?>
							
							<p><strong>Origen: </strong> <?php echo $this->page_model->setSeleccionado($this->session->userdata['user']['origen']); ?></p>
							
							<!-- alerta -->
							<?php if(strlen(trim($this->session->userdata['user']['cuit'])) <= 0): ?>
								<hr>
								<div style="font-size:12px;" class="alert alert-danger" role="alert"> Debe ingresar un CUIT para poder enviar el presupuesto! <a style="color:#000;font-weight:bold" href="<?=base_url()?>/registro_cliente/" class="nuevo">Nuevo cliente</a></div>
								
							<?php else: ?>
								<hr>
								<p><a class="btn btn-danger " style="text-align:center" href="<?=base_url()?>/registro_cliente/" class="nuevo">Modificar datos</a></p>
							<?php endif; ?>
							
						</div>
					</div>
					
					<?php foreach ( $productos_todos as $producto ){ ?>
						<div class="col-12 col-md-3 mg-box">
							<div class="row m-0" style="position:relative;">
								
								
								<!-- # -->
								
								<?php if(strlen($producto->{'imagen_render'}) <= 0): ?>
									<div class="img-content col-12" style="background: rgb(0 0 0 / 100%);">																
										
										<img class="img-fluid" style="position:absolute; padding-top:23%; max-width:60%; padding-left:40px;" src="http://localhost:8888/fertec_cotizador/asset/img/norto_logo.png">
										
								<?php else: ?>
									<div class="img-content col-12" style="background:url('<?php echo base_url() ?>asset/img/uploads/<?php echo $producto->{'imagen_render'} ?>');">								
								<?php endif; ?>
								

									
								</div>
								<div class="tira-iconos col-2 text-center">
									<?php if(!empty($producto->{'imagen'})): ?>
										<a href="#" class="icon-interaction" data-toggle="modal" data-target="#ficha<?php echo $producto->{'id'} ?>">
											<img src="<?php echo base_url() ?>asset/img/icon-01.png" class="img-fluid">
										</a>
									<?php endif; ?>
									<div class="icon-interaction add-cart" data-id-product="<?php echo $producto->{'id'} ?>">
										<img src="<?php echo base_url() ?>asset/img/icon-02.png" class="img-fluid">
									</div>
									<?php if(!empty($producto->{'equipamiento'})): ?>
										<a class="icon-interaction opcionales" data-toggle="collapse" href="#opcionalesid<?php echo $producto->{'id'}?>" role="button" aria-expanded="false" aria-controls="opcionalesid<?php echo $producto->{'id'}?>">
											<img src="<?php echo base_url() ?>asset/img/information.png" class="img-fluid">
										</a>
									<?php endif; ?>
								</div>
								<div class="col-12 p-0">
									<div class="conten-title-producto">
										<p><?=$producto->nombre?></p>
									</div>
								</div>
								<div class="col-3"></div>
							</div>
							<div class="collapse" id="opcionalesid<?php echo $producto->{'id'}?>">
							  <div class="card card-body card-opcionales body-radio-buttons">
							    <div class="row w-100">
							    	<div class="col-12 p-0">
							    		<h3>EQUIPAMIENTO/INFORMACIÓN</h3>
							    		<p><?=$producto->equipamiento?></p>
							    	</div>
                                    <?php if(false): ?>
							    	<div class="col-6 p-0">
							    		<h3>EQUIPAMIENTO OPCIONAL</h3>
							    		<form class="form-opcionales-<?php echo $producto->{'id'} ?>" action="<?php echo base_url() ?>envio/opcionles_session/" method="post">
							    		<?php foreach($this->page_model->get_opcionales_id($producto->{'id'}) as $opcional): ?>
						    			      	<p>
						    			      	    <input type="checkbox" id="op-<?php echo $opcional->{'id'} ?>" class="opcional-send-<?php echo $producto->{'id'} ?>" data-id-product="<?php echo $producto->{'id'} ?>" data-id-opcional="<?php echo $opcional->{'id'} ?>" name="opcionales" value="<?php echo $opcional->{'id'} ?>">
						    			      	    <label for="op-<?php echo $opcional->{'id'} ?>"><?php echo $opcional->{'opcional'} ?></label>
						    		      	  	</p>
				    		      	  	<?php endforeach; ?>
				    		      	  	</form>
							    	</div>
                                    <?php endif; ?>
							    </div>
							  </div>
							</div>
						</div>

				  	  	<!-- Modal -->
				  	  	<div class="modal modal-ficha fade" id="ficha<?php echo $producto->{'id'} ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	  	  <div class="modal-dialog" role="document">
				  	  	    <div class="modal-content">
				  	  	      <div class="modal-header">
				  	  	        <h5 class="modal-title" id="exampleModalLabel">Detalle del producto</h5>
				  	  	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  	  	          <span aria-hidden="true">&times;</span>
				  	  	        </button>
				  	  	      </div>
				  	  	      <div class="modal-body">
				  	  	      	<?php if(!empty($producto->{'imagen'})): ?>
					  	  	      <img src="<?php echo base_url()."asset/img/uploads/".$producto->{'imagen'} ?>" style="max-width:700px">
				  	  	      	<?php endif; ?>
				  	  	      </div>
				  	  	      <div class="modal-footer">
				  	  	        <button type="button" class="btn btn-primary btn-cerrar" data-dismiss="modal">Cerrar</button>
				  	  	      </div>
				  	  	    </div>
				  	  	  </div>
				  	  	</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-1">
				
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
						<div class="content" style="width:100%">
							<?=$cart_final["contenido"]?>
						</div>
					</div>
				</div>
				<div class="col-1"></div>
			</div>

			
		</div>
	</div>
</section>

  <div id="Proformadescargar" class="modal fade" role="dialog">
    <div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content moda-dinamico">
	    <div class="modal-body-proforma">
	    	<div class="col-12">
				<p>¿Descargar proforma?</p>
				<form class="send-proforma" action="<?php echo base_url() ?>envio/envio_proforma?tipo=descargar" method="post" style="margin-bottom:15px;">
					<input type="text" name="precio" required placeholder="Precio Dolar" style="width:100%;padding:5px 15px;margin-bottom:10px;">
					<div class="btn-enviar">
					<input type="submit" value="Descargar" style="width:100%;background:transparent;border:none;color:#ffff;cursor:pointer;">
					</div>
					<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
				</form>
				
			</div>
	    </div>
	  </div>

    </div>
  </div>
  <div id="Proformaimprimir" class="modal fade" role="dialog">
    <div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content moda-dinamico">
	    <div class="modal-body-proforma">
	    	<div class="col-12">
				<p>¿Imprimir Proforma?</p>
				<form class="send-proforma" action="<?php echo base_url() ?>envio/envio_proforma?tipo=imprimir" method="post" style="margin-bottom:15px;">
					<input type="text" name="precio" required placeholder="Precio Dolar" style="width:100%;padding:5px 15px;margin-bottom:10px;">
					<div class="btn-enviar">
					<input type="submit" value="Imprimir" style="width:100%;background:transparent;border:none;color:#ffff;cursor:pointer;">
					</div>
					<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
				</form>
				
			</div>
	    </div>
	  </div>

    </div>
  </div>
  <div id="Proformawhatsapp" class="modal fade" role="dialog">
    <div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content moda-dinamico">
	    <div class="modal-body-proforma">
	    	<div class="col-12">
				<p>¿Enviar por WhatsApp su proforma?</p>
				<form class="send-proforma" action="<?php echo base_url() ?>envio/envio_proforma?tipo=whatsapp" method="post" style="margin-bottom:15px;">
					<input type="text" name="precio" required placeholder="Precio Dolar" style="width:100%;padding:5px 15px;margin-bottom:10px;">
					<div class="btn-enviar">
					<input type="submit" value="Enviar" style="width:100%;background:transparent;border:none;color:#ffff;cursor:pointer;">
					</div>
					<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
				</form>
				
			</div>
	    </div>
	  </div>

    </div>
  </div>
  <div id="Proformacorreo" class="modal fade" role="dialog">
    <div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content moda-dinamico">
	    <div class="modal-body-proforma">
	    	<div class="col-12">
				<p>¿Enviar por correo su proforma?</p>
				<form class="send-proforma" action="<?php echo base_url() ?>envio/envio_proforma?tipo=correo" method="post" style="margin-bottom:15px;">
					<input type="text" name="precio" required placeholder="Precio Dolar" style="width:100%;padding:5px 15px;margin-bottom:10px;">
					<div class="btn-enviar">
					<input type="submit" value="Enviar" style="width:100%;background:transparent;border:none;color:#ffff;cursor:pointer;">
					</div>
					<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
				</form>
				
			</div>
	    </div>
	  </div>

    </div>
  </div>

<!--
<div class="content-proforma">
	<div class="cont-icons-prof">
		<div class="icon-com" data-toggle="modal" data-target="#Proformadescargar">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-01.png" class="img-fluid">
		</div>
		<div class="icon-com" data-toggle="modal" data-target="#Proformaimprimir">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-02.png" class="img-fluid">
		</div>
		<div class="icon-com" data-toggle="modal" data-target="#Proformawhatsapp">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-03.png" class="img-fluid">
		</div>
		<div class="icon-com" data-toggle="modal" data-target="#Proformacorreo">
			<img src="<?php echo base_url() ?>asset/img/icon-comp-04.png" class="img-fluid">
		</div>
	</div>
	<div class="icon-proforma-open">
		<img src="<?php echo base_url() ?>asset/img/proforma_icons.png" class="img-fluid">
	</div>
</div>
-->

	<div class="content-compartir">
<?php if(strlen(trim($this->session->userdata['user']['cuit'])) <= 0): ?>
	<div style="font-size:12px;" class="alert alert-danger" role="alert"> Debe ingresar un CUIT para poder enviar el presupuesto! <a style="color:#000;font-weight:bold" href="<?=base_url()?>/registro_cliente/" class="nuevo">Nuevo cliente</a></div>
<?php else: ?>
								

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

<?php endif; ?>
	</div>