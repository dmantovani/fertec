	 <script type="text/javascript" src="<?=base_url()?>/asset/js/jquery-1.11.1.js"></script>		  
	  
<script>
$(document).ready(function(){

    $("#estado_id").change(function(){
        var deptid = $(this).val();

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

<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:20px;">
		<div class="navbar-inner">
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Reasignar presupuesto Nro: <b></b><?=$this->uri->segment(3)?></b></a></li>
			</ul>
		</div>
		<div id="adm_form">
			<form method="post" action="<?php echo base_url()?>presupuestos/reasignar/<?=$this->uri->segment(3)?>/">
				<div class="tab-content">
				  <div class="tab-pane active" id="tab1">		
				  	
				  	<input type="hidden" name="email" value="<?=$presupuesto[0]->email?>">
						<div class="td-input">
							<b>Reasignar a vendedor:</b><br>
							<select name="vendedor_id">
								<?php
								$get_presupuesto_id = $this->page_model->get_presupuesto_id($this->uri->segment(3));
								$vendedores = $this->page_model->get_vendedores($get_presupuesto_id[0]->consecionario_id);
								?>

								<?php foreach($vendedores as $vend): ?>
								<?php $selected=""; ?>								
									<?php if($vend->id === $presupuesto[0]->vendedor_id) $selected=" selected "; ?>
									<option <?=$selected?> value="<?=$vend->id?>"><?=$vend->vendedor?></option>
								<?php endforeach; ?>
							</select>
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
	   <a href="<?php echo base_url()?>presupuestos/"><div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div></a>
	</div>
</div>
<br style="clear:both;"/>