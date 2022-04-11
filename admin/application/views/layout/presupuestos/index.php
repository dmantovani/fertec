<?php //print_r($this->session->userdata); ?>
<style type="text/css">
    a, a:focus, a:hover {color:#000;}
</style>

<div class="home-main col-sm-10" id="home_main" style="padding:25px 50px;">
      <div class="row">
        <div class="panel panel-default">
                
            <div class="panel-heading">Potenciales clientes</div>
            <div class="panel-body">
            <form id="filtro_presupuesto" method="POST" action="<?=base_url()?>presupuestos/index">
                <div class="form-group" style="display: inline-flex;width: 100%;margin-bottom: 30px;margin-top: 30px;align-items: center;">
                    <div class="col-xs-12 col-md-2" style="padding-right:0;">
                        <div class="input-group" style="padding: 0;width: 100%;">
                            <input type="submit" class="input-group-addon" value="Buscar" style="border-radius: 0;padding: 8px 15px;border-right: 0;">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-10" style="padding-left:0;">
                        <div class="input-group" style="padding: 0;width: 100%;">
                            <input type="text" name="search_text" id="search_text" placeholder="Buscador" class="form-control" style="border: 2px #000 solid;" value="<?php if(isset($this->session->userdata['filters']['search_text'])) print $this->session->userdata['filters']['search_text']?>" />
                        </div>
                    </div>
                </div>
                <div class="flex-row" style="padding-bottom: 25px;border-bottom: 3px #d8d5d5 solid;">
                    <fieldset class="col-md-10">                     
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3" >
                                    <legend>Desde</legend>
                                    <div class="panel-body" style="padding:0;">
                                        <input type="date" name="desde" style="width:100%" value="<?php if(isset($this->session->userdata['filters']['desde'])) print $this->session->userdata['filters']['desde']?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <legend>Hasta</legend>
                                    <div class="panel-body" style="padding:0;">
                                        <input type="date" name="hasta" style="width:100%" value="<?php if(isset($this->session->userdata['filters']['hasta'])) print $this->session->userdata['filters']['hasta']?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <legend>Estado</legend>
                                    <div class="panel-body" style="padding:0;">
                                        <select name="estado">
                                            <option value="">Selecciona..</option>
                                            <?php $estados = $this->page_model->get_presupuestos_estados(); ?>
                                            <?php foreach($estados as $e): $selected=""; ?>
                                                
                                                <?php if($e->{"id"} == $this->session->userdata['filters']['estado']): $selected=" SELECTED "; endif; ?>
                                                <option <?=$selected?> value="<?=$e->{"id"}?>"><?=$e->{"estado"}?></option>                             
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-3">
                                    <legend>Vendedor</legend>
                                    <div class="panel-body" style="padding:0;">
                                        <select name="vendedor_id">
                                            <option value="">Selecciona..</option>
                                            <?php $estados = $this->page_model->get_vendedores(); ?>
                                            <?php foreach($estados as $e): $selected=""; ?>
                                                
                                                <?php if($e->{"id"} == $this->session->userdata['filters']['vendedor_id']): $selected=" SELECTED "; endif; ?>
                                                <option <?=$selected?> value="<?=$e->{"id"}?>"><?=$e->{"vendedor"}?></option>                             
                                            <?php endforeach; ?>
                                        </select>
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
              <div class="thumbnail" style="border: 6px solid #00CE7C">
                  <div class="caption">
                    <div class='col-lg-12 well well-add-card'>
                        <h4><?=$fila->{"nombre"}?> <?=$fila->{"apellido"}?> </h4>
                        
                    </div>
                    <?php //print_r($fila) ?>
                    <div class='col-lg-12'>
                        <p><b>Email: </b><?=$fila->{"email"}?></p>
                        <p><b>Teléfono: </b><?=$fila->{"telefono"}?></p>
                        <p><b>Vendedor asignado: </b> <b style="color:red"><?=$this->page_model->get_vendedor_name_by_id($fila->{"vendedor_id"})?></b> 
                        <?php if($this->session->userdata['logged_in']['administrator']==1 or $this->session->userdata['logged_in']['rol_id']==2){ ?>
	                        &nbsp;<a href="<?=base_url()?>presupuestos/reasignar/<?=$fila->{"id"}?>/" style="color:red;font-weight:bold"><span class="glyphicon glyphicon-refresh"></span> </a>
                        <?php } ?>

                        <?php if(isset($fila->{"volver_a_llamar"}) && strlen($fila->{"volver_a_llamar"}) > 0): ?>
                        	<?php 
                        		$vencido = "green"; 
                        		if(time() > $fila->{"volver_a_llamar"}) $vencido = "red";
                        	?>
	                        <p style="background-color:<?=$vencido?>; padding:5px"><b>Volver a llamar el: </b><?=date("d/m/y",$fila->{"volver_a_llamar"})?> 
                        <?php endif; ?>
                        
                        <p><b>Provincia: </b><?=$fila->{"provincia"}?> - <small><?=$fila->{"localidad"}?></small></p>
                    </div>
                    <div class='col-lg-12 well well-add-card' style="background: #efefef;margin-top: 20px;border-top: 2px rgba(0, 0, 0, 0.27) solid;">
                    	<h5>Presupuestos emitidos:</h5>
                	</div>
                    <!-- begin panel group -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="clear:both;">
                        
                        <!-- panel 1 -->
                        <?php $presupuestos = $this->page_model->get_presupuestos($fila->{"email"});
                        foreach ($presupuestos as $pre => $value): ?>
                            <?php //print_r($value) ?>
                        <div class="panel panel-default">
                            <!--wrap panel heading in span to trigger image change as well as collapse -->
                            <span class="side-tab" data-target="#tab<?=$value->id?>" data-toggle="tab" role="tab" aria-expanded="false">
                                <div class="panel-heading" role="tab" id="heading<?=$value->id?>"data-toggle="collapse" data-parent="#accordion<?=$value->id?>" href="#<?=$value->id?>" aria-expanded="true" aria-controls="<?=$value->id?>" style="background: <?=$value->{"color"}?>">
                                    <h4 class="panel-title"><?=$value->{"added_at"}?>: <?=$value->{"estado"}?> - <?=$value->{"motivo_nombre"}?> </h4>
                                </div>
                            </span>
                            
                            <div id="<?=$value->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$value->id?>">
                                <div class="panel-body">
                                
                                <?php 
                                
                                	$modelo = ""; 
                                ?>
                                
                                <!-- Tab content goes here -->
                                <?=$nombre_producto = "";?>
                                <?php if(!empty($value->{'paso_01'})): ?>
                                    <div style="border-bottom: 2px rgba(0, 206, 124, 0.17) solid;padding: 0 0 5px;margin-bottom: 5px;background: rgba(0, 206, 124, 0.17);padding: 7px 10px;">
                                        <p style="font-weight: bold;border-bottom: 1px #00000029 solid;padding-bottom: 5px;margin-bottom: 5px;display: inline-block;font-size: 12px;">Característica del usuario</p>
                                        <p><b>Años:</b> <?php echo $value->{'paso_01'} ?></p>
                                        <p><b>Plan preferido con amigos:</b> <?php echo $value->{'paso_02'} ?></p>
                                        <p><b>Mejor forma de desconectar:</b> <?php echo $value->{'paso_03'} ?></p>
                                        <p><b>Actividad física preferida:</b> <?php echo $value->{'paso_04'} ?></p>
                                        <p><b>Hijos:</b> <?php echo $value->{'paso_05'} ?></p>
                                        <p><b>Metas:</b> <?php echo $value->{'paso_06'} ?></p>
                                    </div>
                                <?php endif; ?>
                                <p><b>Medio de comunicación:</b> <?=$value->{"medio_comunicacion"}?></p>
                                <p><b>Fecha de ingreso:</b> <?=$value->{"added_at"}?></p>
                                <p><b>Última actualización:</b> <?=$value->{"modified_at"}?></p>
                                <p><b>Tiempo de inactividad:</b> <b style="color:red"><?=round((time()-strtotime($value->{"modified_at"}))/60/60,2)?>Hs</b> sin modificar estado</p>
                                <p><b>UTM Source:</b> <?=$value->{"utm_source"}?></p>
                                <p><b>UTM Medium:</b> <?=$value->{"utm_medium"}?></p>
                                
                                
                                <!-- Tiene usado? -->
                                <?php if($value->{"usado"} >= 1): ?>
                                	<?php $marca_desc = $this->page_model->get_marca_usados_id($value->{"marca_usado"}); ?>
                                	<?php $modelo_desc = $this->page_model->get_modelos_usadas_id($value->{"modelo_usado"}); ?>
                                	
        	                        <p style="background-color:#ddd;padding:5px;"><b>Marca usado:</b> <?=$marca_desc[0]->nombre?></p>                                
    	                            <p style="background-color:#ddd;padding:5px;"><b>Modelo Usado:</b> <?php if(isset($modelo_desc[0])) print $modelo_desc[0]->nombre?></p>
	                                <p style="background-color:#ddd;padding:5px;"><b>Año usado:</b> <?=$value->{"anio"}?></p>
                                <?php endif; ?>
                                
                                <!-- Tiene financiacion? -->
                                <?php if(strlen($value->{"banco"}) > 1): ?>                                
	                                <p style="background-color:#ebeff9; padding: 5px"><b>Financiacion banco: </b> <?=$value->{"banco"}?></p>                                
                                <?php endif; ?>
                                
                                <?php if(false): ?>
                                    <a type="button" href="<?=base_url().'../uploads/'.$value->{'pdf_file'}?>" class="btn btn-primary btn-xs btn-update btn-add-card">Presupuesto</a>
                                <?php endif; ?>
                                <a type="button" href="<?=base_url().'/presupuestos/evento/'.$value->{"id"}.'/'?>" class="btn btn-danger btn-xs btn-update btn-add-card">Historial</a>
                                <?php if($this->session->userdata['logged_in']['administrator'] == 1): ?>
                                    <a href="#" data-href="<?php echo base_url() ?>presupuestos/remove/<?php echo $value->{"id"}?>/" class="btn btn-danger btn-xs btn-update btn-add-card" data-toggle="modal" data-target="#confirm-delete">Eliminar</a>
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
        
              		<!-- paginador -->
              		<div class="row d-flex justify-content-center text-center" style="display:flex; justify-content:center">
					<div class="dataTables_paginate paging_simple_numbers" id="users-list-datatable_paginate">
						<ul class="pagination">
							<?=$this->pagination->create_links()?>
						</ul>
					</div>
					</div>

            
      </div><!-- End row -->
</div>