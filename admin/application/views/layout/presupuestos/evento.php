<script type="text/javascript" src="<?=base_url()?>/asset/js/jquery-1.11.1.js"></script>		  
<script>
    $(document).ready(function(){
    
        $("#estado_id").change(function(){
            var deptid = $(this).val();
            
            if(deptid == 2)
            {
            	$('.proximo_contacto').show();
            }
            else
            {
            	$('.proximo_contacto').hide();        
            }

            if(deptid == 4)
            {
            	$('.buttons-modal').show();
            }
            else
            {
            	$('.buttons-modal').hide();        
            }
    
            $.ajax({
                url: '#',
                type: 'post',
                data: {depart:deptid},
                dataType: 'json',
                success:function(response){
                    var len = response.length;
    
                    $("#motivo_id").empty();
                    for( var i = 0; i<len; i++){
                        var id = response[i]['id'];
                        var name = response[i]['name'];
                        
                        $("#motivo_id").append("<option value='"+id+"'>"+name+"</option>");
    
                    }
                }
            });
        });
    
    });
    
</script>
<style type="text/css">
	.buttons-modal {margin:15px 0;}
	.btn-modal {background: #fdbd2c;border: none;transition:.6s;font-size: 12px;text-shadow: none;color:#fff;}
	.btn-modal:hover, .btn-modal:focus {color:#fff;opacity:.6;transition:.6s;}
	.guardar {background: #fdbd2c;color: #fff;padding: 8px;margin: 0;border: none;padding: 10px 25px;display: inline-block;transition: .6s;}
	.guardar:hover {cursor: pointer;transition: .6s;opacity: .6;}
	.btn-cerrar {padding: 10px 25px;margin: 0;border: none;box-shadow: none;display: inline-block;line-height: normal;background: #000;color: #fff;text-shadow: none;vertical-align: inherit;float: right;transition: .6s;}
	.disable {pointer-events:none;opacity:.3;}
</style>
<div class="home-main col-sm-10" id="home_main">
    <div class="home-content" style="margin-top:0px; padding-top:20px;">
        <div class="navbar-inner">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Información del presupuesto Nro: <b></b><?=$this->uri->segment(3)?></b></a></li>
            </ul>
        </div>
        <div id="adm_form">
            <form method="post" action="<?php echo base_url()?>presupuestos/update/<?=$this->uri->segment(3)?>/">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="td-input">
                            <b>Tipo de contacto:</b><br>
                            <select name="tipo_contacto">
                                <option value="telefono">Teléfono</option>
                                <option value="email">Email</option>
                                <option value="whatsapp">Whatsapp</option>
                                <option value="visita">Visita</option>
                                <option value="salon">Salón</option>
                                <option value="otro">Otro Contacto</option>
                            </select>
                        </div>
                        <div class="td-input">
                            <b>Descripción del evento:</b><br>
                            <textarea type="text" name="evento" id="evento" value="asd"> </textarea>
                        </div>
                        <div class="td-input">
                            <b>Cambiar estado a:</b><br>
                            <select name="estado_id" id="estado_id">
                                <?php $estados = $this->page_model->get_presupuestos_estados(); ?>
                                <?php foreach($estados as $e): ?>
                                <option <?php if($presupuesto[0]->estado_id == $e->{"id"}): print "selected"; endif; ?>  value="<?=$e->{"id"}?>"><?=$e->{"estado"}?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="td-input">
                            <b>Motivos:</b><br>
                            <select name="motivo_id" id="motivo_id">
                                <?php $motivos = $this->page_model->get_motivos_estados($presupuesto[0]->estado_id); ?>
                                <?php foreach($motivos as $m): ?>
                                <option <?php if($presupuesto[0]->motivo_id == $m->{"id"}): print "selected"; endif; ?>  value="<?=$m->{"id"}?>"><?=$m->{"nombre"}?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="td-input proximo_contacto" <?php if($presupuesto[0]->estado_id != 2): print 'style="display:none"'; endif; ?>>
                            <b>Fecha Próximo Contacto:</b><br>
                            <input type="date" id="" name="proximo_contacto">
                        </div>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <!-- LOG DE EVENTOS + CAMBIOS DE ESTADO -->
                        <div class="td-input">
                            <h1>Log de eventos</h1>
                            <br>
                            <?php  $log = $this->page_model->log_eventos($this->uri->segment(3)); ?>
                            <table id="list eventolist" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Tipo de contacto</th>
                                        <th>Evento</th>
                                        <th>Fecha evento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $html='';
                                        foreach ( $log as $fila ){
                                        		$dest = "1";
                                        		$html.='<tr>
                                        			<td style=" background-color: '.$fila->{"color"}.'"><center>'.$fila->{"estado"}.'</center></td>
                                        			<td><center><b>'.$fila->{'tipo_contacto'}.'</b></center></td>
                                        			<td>'.$fila->{'evento'}.'</td>
                                        			<td>'.date("d/m/Y h:i:s",$fila->{'added_at'}).'</td>
                                        		</tr>';
                                        }
                                        echo $html;
                                        ?>
                                </tbody>
                            </table>
                            <?php if(count($log)<=0) print "<p style='text-align:center; background-color:#ccc;padding:10px;'>No tiene eventos por el momento</p>"; ?>
                        </div>
                        <div class="col-md-6">
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <input style="display:none" type="text" name="descripcion" id="descripcion" value="asd">
                        <div class="td-input" style="display:none;">
                            <b>Descripción:</b><br>
                            <div id="wysihtml5-toolbar" style="display: none;">
                                <header>
                                    <ul class="commands">
                                        <li class="command" title="Make text bold (CTRL + B)" data-wysihtml5-command="bold" href="javascript:;" unselectable="on"></li>
                                        <li class="command" title="Make text italic (CTRL + I)" data-wysihtml5-command="italic" href="javascript:;" unselectable="on"></li>
                                        <li class="command" title="Insert an unordered list" data-wysihtml5-command="insertUnorderedList" href="javascript:;" unselectable="on"></li>
                                        <li class="command" title="Insert an ordered list" data-wysihtml5-command="insertOrderedList" href="javascript:;" unselectable="on"></li>
                                        <li class="command" title="Insert a link" data-wysihtml5-command="createLink" href="javascript:;" unselectable="on"></li>
                                        <li class="command" title="Insert an image" data-wysihtml5-command="insertImage" href="javascript:;" unselectable="on" ></li>
                                        <li class="command" title="Insert speech" data-wysihtml5-command="insertSpeech" href="javascript:;" unselectable="on" style="display: none;"></li>
                                        <li class="action" title="Show HTML" data-wysihtml5-action="change_view" href="javascript:;" unselectable="on"></li>
                                    </ul>
                                </header>
                                <div data-wysihtml5-dialog="createLink" style="display: none;">
                                    <label>
                                    Link:
                                    <input data-wysihtml5-dialog-field="href" value="http://">
                                    </label>
                                    <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                </div>
                                <div data-wysihtml5-dialog="insertImage" style="display:none;">
                                    <label>
                                        Image:
                                        <input data-wysihtml5-dialog-field="src" id="inpt_wysihtml5" value="">
                                        <div class="pull-right">
                                            <div id="galeriawysihtml5" ></div>
                                            <div id="main_uploader" >
                                                <div class="uploader-idwysihtml5">
                                                    <div id="uploaderwysihtml5" align="left">
                                                        <input id="uploadifywysihtml5" type="file" class="uploader" />
                                                    </div>
                                                </div>
                                                <div id="filesUploaded" style="display:none;"></div>
                                                <div id="thumbHeightwysihtml5" style="display:none;" >960</div>
                                                <div id="thumbWidthwysihtml5" style="display:none;" >1400</div>
                                            </div>
                                        </div>
                                    </label>
                                    <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                </div>
                            </div>
                            <textarea id="wysihtml5-textarea" name="descripcion" style="display:none;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">GUARDAR</div>
        <a href="<?php echo base_url()?>presupuestos/">
            <div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div>
        </a>
    </div>
</div>
<br style="clear:both;"/>

<!-- Modal Proformas -->
<div id="proformas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear proforoma</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="formproforma" action="<?php echo base_url()?>proformas/save/<?=$this->uri->segment(3)?>/">
			<div class="tab-content">
			  <div class="tab-pane active" id="tab1">		
			  
					<div class="td-input">
						<b>Entidad Bancaria:</b><br>
						<input type="text" name="entidad_bancaria" id="entidad_bancaria">
					</div>
					
					<div class="td-input">
						<b>Sucursal Banco:</b><br>
						<input type="text" name="sucursal_banco" id="sucursal_banco">
					</div>
					
					<div class="td-input">
						<b>Tipo de Financiación:</b><br>
						<input type="text" name="tipo_financiacion" id="tipo_financiacion">
					</div>
					
					<div class="td-input">
						<b>TNA:</b><br>
						<input type="text" name="tna" id="tna">
					</div>
					
					<div class="td-input">
						<b>Monto a Financiar:</b><br>
						<input type="text" name="monto_financiar" id="monto_financiar">
					</div>
					
					<div class="td-input">
						<b>Duración del Préstamo:</b><br>
						<input type="text" name="duracion_prestamo" id="duracion_prestamo">
					</div>
					
					<div class="td-input">
						<input type="submit" class="guardar" value="Crear proforma">
						<button type="button" class="btn btn-cerrar btn-default" data-dismiss="modal">Close</button>
					</div>
					
					<input style="display:none" type="text" name="descripcion" id="descripcion" value="asd">
					
					<div class="td-input" style="display:none;">
					   	<b>Descripción:</b><br>
					   	<div id="wysihtml5-toolbar" style="display: none;">
					   		<header>
					   			<ul class="commands">
					   			  <li class="command" title="Make text bold (CTRL + B)" data-wysihtml5-command="bold" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Make text italic (CTRL + I)" data-wysihtml5-command="italic" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Insert an unordered list" data-wysihtml5-command="insertUnorderedList" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Insert an ordered list" data-wysihtml5-command="insertOrderedList" href="javascript:;" unselectable="on"></li>	
					   			  <li class="command" title="Insert a link" data-wysihtml5-command="createLink" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Insert an image" data-wysihtml5-command="insertImage" href="javascript:;" unselectable="on" ></li>
					   			  <li class="command" title="Insert speech" data-wysihtml5-command="insertSpeech" href="javascript:;" unselectable="on" style="display: none;"></li>
					   			  <li class="action" title="Show HTML" data-wysihtml5-action="change_view" href="javascript:;" unselectable="on"></li>
					   			</ul>
					   		  </header>
					   		  <div data-wysihtml5-dialog="createLink" style="display: none;">
					   			<label>
					   				Link:
					   				<input data-wysihtml5-dialog-field="href" value="http://">
					   			</label>
					   			<a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
					   		  </div>
					   		  <div data-wysihtml5-dialog="insertImage" style="display:none;">
					   			  <label>
					   				Image:
					   				<input data-wysihtml5-dialog-field="src" id="inpt_wysihtml5" value="">
					   				<div class="pull-right">
					   					<div id="galeriawysihtml5" ></div>
					   					<div id="main_uploader" >
					   					<div class="uploader-idwysihtml5">
					   					<div id="uploaderwysihtml5" align="left">
					   					<input id="uploadifywysihtml5" type="file" class="uploader" />
					   					</div>
					   					</div>
					   					<div id="filesUploaded" style="display:none;"></div>
					   					
					   					<div id="thumbHeightwysihtml5" style="display:none;" >960</div>
					   					<div id="thumbWidthwysihtml5" style="display:none;" >1400</div>
					   					</div>
					   				</div>
					   				
					   			  </label>
					   			  <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
					   		</div>
					   	</div>
					   	<textarea id="wysihtml5-textarea" name="descripcion" style="display:none;"></textarea>
				   </div>
			  </div>				  
		   </div>
	   </form>
      </div>
    </div>

  </div>
</div>

<!-- Modal Notas de pedido -->
<div id="notapedido" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear nota de pedido</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="notapedidoform" action="<?php echo base_url()?>notas_pedido_ventas/save/<?=$this->uri->segment(3)?>/">
			<div class="tab-content">
			  <div class="tab-pane active" id="tab1">		
			  
					<div class="td-input">
						<b>Lugar de entrega:</b><br>
						<input type="text" name="lugar_entrega" id="lugar_entrega">
					</div>
					
					
					<div class="navbar-inner">
					<ul class="nav nav-tabs" style="display: inline-block;min-height: inherit;width: 100%;background: transparent;">
					  <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Comprador adicional 1</b></a></li>
					</ul>
					</div>
					<div class="tab-content">
					  <div class="tab-pane active" id="tab1">	
							<div class="td-input">
								<b>Nombre y apellido:</b><br>
								<input type="text" name="nombre_apellido1" id="nombre_apellido1">
							</div>
							
							<div class="td-input">
								<b>C.U.I.T:</b><br>
								<input type="text" name="cuit1" id="cuit1">
							</div>
					
							<div class="td-input">
								<b>Domicilio:</b><br>
								<input type="text" name="domicilio1" id="domicilio1">
							</div>
						</div>
					</div>
					
					
					
					<div class="navbar-inner">
					<ul class="nav nav-tabs" style="display: inline-block;min-height: inherit;width: 100%;background: transparent;">
					  <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Comprador adicional 2</b></a></li>
					</ul>
					</div>
					<div class="tab-content">
					  <div class="tab-pane active" id="tab1">	
							<div class="td-input">
								<b>Nombre y apellido:</b><br>
								<input type="text" name="nombre_apellido2" id="nombre_apellido2">
							</div>
							
							<div class="td-input">
								<b>C.U.I.T:</b><br>
								<input type="text" name="cuit2" id="cuit2">
							</div>
					
							<div class="td-input">
								<b>Domicilio:</b><br>
								<input type="text" name="domicilio2" id="domicilio2">
							</div>
						</div>
					</div>

					<div class="td-input">
						<input type="submit" class="guardar" value="Crear nota de pedido">
						<button type="button" class="btn btn-cerrar btn-default" data-dismiss="modal">Close</button>
					</div>
					
					<input style="display:none" type="text" name="descripcion" id="descripcion" value="asd">
					
					<div class="td-input" style="display:none;">
					   	<b>Descripción:</b><br>
					   	<div id="wysihtml5-toolbar" style="display: none;">
					   		<header>
					   			<ul class="commands">
					   			  <li class="command" title="Make text bold (CTRL + B)" data-wysihtml5-command="bold" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Make text italic (CTRL + I)" data-wysihtml5-command="italic" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Insert an unordered list" data-wysihtml5-command="insertUnorderedList" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Insert an ordered list" data-wysihtml5-command="insertOrderedList" href="javascript:;" unselectable="on"></li>	
					   			  <li class="command" title="Insert a link" data-wysihtml5-command="createLink" href="javascript:;" unselectable="on"></li>
					   			  <li class="command" title="Insert an image" data-wysihtml5-command="insertImage" href="javascript:;" unselectable="on" ></li>
					   			  <li class="command" title="Insert speech" data-wysihtml5-command="insertSpeech" href="javascript:;" unselectable="on" style="display: none;"></li>
					   			  <li class="action" title="Show HTML" data-wysihtml5-action="change_view" href="javascript:;" unselectable="on"></li>
					   			</ul>
					   		  </header>
					   		  <div data-wysihtml5-dialog="createLink" style="display: none;">
					   			<label>
					   				Link:
					   				<input data-wysihtml5-dialog-field="href" value="http://">
					   			</label>
					   			<a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
					   		  </div>
					   		  <div data-wysihtml5-dialog="insertImage" style="display:none;">
					   			  <label>
					   				Image:
					   				<input data-wysihtml5-dialog-field="src" id="inpt_wysihtml5" value="">
					   				<div class="pull-right">
					   					<div id="galeriawysihtml5" ></div>
					   					<div id="main_uploader" >
					   					<div class="uploader-idwysihtml5">
					   					<div id="uploaderwysihtml5" align="left">
					   					<input id="uploadifywysihtml5" type="file" class="uploader" />
					   					</div>
					   					</div>
					   					<div id="filesUploaded" style="display:none;"></div>
					   					
					   					<div id="thumbHeightwysihtml5" style="display:none;" >960</div>
					   					<div id="thumbWidthwysihtml5" style="display:none;" >1400</div>
					   					</div>
					   				</div>
					   				
					   			  </label>
					   			  <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
					   		</div>
					   	</div>
					   	<textarea id="wysihtml5-textarea" name="descripcion" style="display:none;"></textarea>
				   </div>
			  </div>				  
		   </div>
		   
	   </form>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	$('.btn-modal').on('click', function() {
	    $('.guardar').removeClass('disable');
	});
	$("#formproforma").submit(function(event){
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
		        $('.guardar').addClass('disable');
		    },
		}).done(function(response){ //
			$('#proformas').modal('hide');
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
			alert('Proforma creada con exito');
			$("#formproforma")[0].reset();
		});
	});
	$("#notapedidoform").submit(function(event){
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
		        $('.guardar').addClass('disable');
		    },
		}).done(function(response){ //
			$('#notapedido').modal('hide');
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
			alert('Nota de pedido creada con exito.');
			$("#notapedidoform")[0].reset();
		});
	});
</script>	