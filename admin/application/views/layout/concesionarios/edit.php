<style type="text/css">
	label {margin: 0 5px;line-height: normal;}
</style>
<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:20px;">
		<div class="navbar-inner">
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Datos</a></li>
			  <!--<li role="presentation"><a href="#tab2" data-toggle="tab">Subtabla relacionada</a></li>-->
			</ul>
		</div>
		<div class="tab-content" id="adm_form">
		  <div class="tab-pane active" id="tab1">
			 <form method="post" action="<?php echo base_url()?>concesionarios/update/<?php echo $info[0]->{'id'}?>/">
				<div class="td-input">
					<b>Nombre:</b><br>
					<input type="text" name="nombre" id="nombre" value="<?php echo $info[0]->{'nombre'};?>">
				</div>
				<div class="td-input">
					<b>Unidades de negocio:</b><br>
					<hr>			

						<?php
							$html='';
							//$countries_array = explode(',',$this->session->userdata['logged_in']['countryId']);
							foreach ( $unidades as $row ){
								if(array_search($row->{'id'},array_column(json_decode(json_encode($concesionarios_unidades), true),'id_unidades')) !== false){
									$html.='<input type="checkbox" id="'.$row->{'id'}.'" value="'.$row->{'id'}.'" name="unidades[]" checked><label for="'.$row->{'id'}.'">'.$row->{'nombre'}.'</label>';
								}else{ 
									$html.='<input type="checkbox" id="'.$row->{'id'}.'" value="'.$row->{'id'}.'" name="unidades[]"><label for="'.$row->{'id'}.'">'.$row->{'nombre'}.'</label>';
								}
							}
							echo $html;
						?>
					<hr>
				</div>
			 </form>
		  </div>
		  <div class="tab-pane" id="tab2">
			 iframe listado subtabla
		  </div>
	   </div>
	   <div class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">GUARDAR</div>
	   <a href="<?php echo base_url()?>concesionarios/"><div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div></a>
	</div>
</div>
<br style="clear:both;"/>