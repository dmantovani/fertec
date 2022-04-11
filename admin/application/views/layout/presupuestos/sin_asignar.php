<style type="text/css">
    #l_presupuestos {background:none!important;}
    #l_sin_asignar {background:rgb(253, 189, 44) !important;}
    .btn-modal-p:hover {cursor:pointer;}
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {width:100%;}
    a, a:focus, a:hover {color:#000;}
</style>


<div class="home-main col-sm-10" id="home_main" style="padding:25px 50px;">
      <div class="row">
        <div class="panel panel-default">
                
            <div class="panel-heading">Sin Asignar</div>
            <div class="panel-body">
            <form id="filtro_presupuesto" method="POST" action="#">
                <div class="flex-row" style="padding-bottom: 25px;border-bottom: 3px #d8d5d5 solid;">
                    <fieldset class="col-md-10">                     
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                    <legend>Desde</legend>
                                    <div class="panel-body" style="padding:0;">
                                        <input type="date" name="desde" style="width:100%" value="<?php if(isset($_POST["desde"])) print $_POST["desde"]?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <legend>Hasta</legend>
                                    <div class="panel-body" style="padding:0;">
                                        <input type="date" name="hasta" style="width:100%" value="<?php if(isset($_POST["hasta"])) print $_POST["hasta"]?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-2" style="margin:auto 0 3px;">                     
                        <div class="panel panel-default" style="background:transparent;box-shadow:none;border:none">
                            <div style="display: inline-block;width: 100%;padding: 0;">
                                <div class="panel-body" style="padding:0;">
                                    <input type="submit" name="filtro" class="btn btn-primary btn-xs btn-update btn-add-card" value="Filtrar" style="margin:0">
                                </div>
                            </div>
                        </div>
                    </fieldset> 
                </div>
            </form>  
                
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-12"></div>
        <div class="row flex-row">
            <?php foreach ( $info as $fila ): ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <div class="thumbnail" style="border: 6px solid #000">
                  <div class="caption">
                    <div class='col-lg-12 well well-add-card'>
                        <h4><?=$fila->{"cliente"}?> <?=$fila->{"apellido"}?> </h4>
                        
                    </div>
                    <?php //print_r($fila) ?>
                    <div class='col-lg-12'>
                        <p><b>Email: </b><?=$fila->{"email"}?></p>
                        <p><b>Teléfono: </b><?=$fila->{"telefono"}?></p>
                        <p><b>Provincia: </b><?=$fila->{"provincia"}?> - <small><?=$fila->{"localidad"}?></small></p>
                    </div>
                    <div class='col-lg-12 well well-add-card' style="background: #efefef;margin-top: 20px;border-top: 2px rgba(0, 0, 0, 0.27) solid;">
                    	<h5>Presupuestos emitidos:</h5>
                	</div>
                    <!-- begin panel group -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="clear:both;">
                        
                        <!-- panel 1 -->
                        <?php $presupuestos = $this->page_model->get_presupuestos_sin_asignar($fila->{"email"});
                        foreach ($presupuestos as $pre => $value): ?>
                        <div class="panel panel-default">
                            <!--wrap panel heading in span to trigger image change as well as collapse -->
                            <span class="side-tab" data-target="#tab<?=$value->id?>" data-toggle="tab" role="tab" aria-expanded="false">
                                <div class="panel-heading" role="tab" id="heading<?=$value->id?>"data-toggle="collapse" data-parent="#accordion<?=$value->id?>" href="#<?=$value->id?>" aria-expanded="true" aria-controls="<?=$value->id?>" style="background: #ff993a">
                                    <h4 class="panel-title"><?=$value->{"added_at"}?>: PRESUPUESTO SIN ASIGNAR </h4>
                                </div>
                            </span>
                            
                            <div id="<?=$value->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$value->id?>">
                                <div class="panel-body">
                                
                                <!-- Tab content goes here -->
                                <?php $pasos = $this->page_model->get_pasos_id($value->{'id'});
                                      $dosificador = ""; ?>
                                      
                                <p><b>Producto:</b> <?php echo ""; ?></p>
                                <p><b>Fecha de ingreso:</b> <?=$value->{"added_at"}?></p>
                                <p><b>Última actualización:</b> <?=$value->{"modified_at"}?></p>
                                <p><b>Tiempo de inactividad:</b> <b style="color:red"><?=round((time()-$value->{"modified_at"})/60/60,2)?>Hs</b> sin modificar estado</p>
                                <p><b>UTM Source:</b> <?=$value->{"utm_source"}?></p>
                                <p><b>UTM Medium:</b> <?=$value->{"utm_medium"}?></p>
                                
                                <a data-toggle="modal" data-target="#myModal" href="#" class="presup<?php echo $value->{'id'}?> btn btn-primary btn-xs btn-update btn-add-card">Asignar a Vendedor</a>
                                <?php if($this->session->userdata['logged_in']['administrator'] == 1): ?>
                                    <a href="#" data-href="<?php echo base_url() ?>presupuestos/remove/<?php echo $value->{"id"}?>/" class="btn btn-danger btn-xs btn-update btn-add-card" data-toggle="modal" data-target="#confirm-delete">Eliminar</a>
                                <?php endif; ?>
                                
                                
                                <?php if($this->page_model->get_mail_asignado($fila->{"email"}) != false): ?>
                                <br>
                                <br>
                                <p style="background-color:red; color:#fff; padding:20px;">
                                 	Nota: <span>Ojo, este cliente ya ha sido asignado a: <span class="badge"><?=$this->page_model->get_mail_asignado($fila->{"email"})?></span>, sugerimos asignarlo al mismo vendedor.
                                </p>
                                 
                                 <?php endif; ?>
                                 
                                </div>
                                
                                
                                

                                
                                
                            </div>
                        </div> 
                        <?php endforeach; ?>
                        <!-- / panel 1 -->
                        
                    </div> <!-- / panel-group -->
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            
        </div>
        
            <?php if(count($info) <= 0): ?>
            <div class="row">
            	<div class="col-xs-12">
            	<div class="col-xs-12">
				<div class="alert alert-danger" role="alert">
					<center>No hemos encontrado resultados con los filtros de b&uacute;squeda activos!</center>
				</div>
				</div>
				</div>
			</div>
            <?php endif;?>
            
        </div>
        

            
      </div><!-- End row -->
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      <form method="POST" action="<?=base_url()?>presupuestos/sin_asignar/">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Vendedores</h4>
        </div>
        <div class="modal-body">
        
        	<input type="hidden" id="presupuesto_id" name="presupuesto_id" value="0">
          		<select name="concesionario_id" class="selectpicker" data-show-subtext="true" data-live-search="true">
            		<?php foreach($this->page_model->get_vendedores() as $con): ?>
                    	<option value="<?php echo $con->{'id'}; ?>" data-subtext="<?php echo $con->{'vendedor'} ?>"><?php echo $con->{'vendedor'}; ?></option>
          			<?php endforeach; ?>
            	</select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </form>
      </div>
      
    </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php foreach ( $info as $fila ): ?>
<?php $presupuestos = $this->page_model->get_presupuestos_sin_asignar($fila->{"email"}); ?>
<?php if(count($presupuestos) > 0): ?>
<?php foreach ($presupuestos as $pre => $value): ?>                      
<script type="text/javascript">
    $('.presup<?php echo $value->{'id'} ?>').on( "click", function() {
        $('#presupuesto_id').val('<?php echo $value->{'id'} ?>');
    });
</script>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>