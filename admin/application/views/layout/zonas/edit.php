<?php
if ($this->session->userdata['logged_in']['administrator']==0) {
	header("location: ".base_url());
}
?>
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
			 <form method="post" action="<?php echo base_url()?>zonas/update/<?php echo $info[0]->{'id'}?>/">
				<div class="td-input">
					<b>Usuario:</b><br>
					<input type="text" name="usuario" id="usuario" value="<?php echo $info[0]->{'user_name'};?>" readonly>
				</div>
				<div class="td-input">
					<?php $zonas = $this->page_model->get_zonas_usuarios($info[0]->{'id'}); ?>
					<select class="selectpicker my-select" multiple data-live-search="true" name="id_concesionario[]">
						<?php foreach($concesionarios as $concesionario): ?>
							<?php if(array_search($concesionario->id,array_column(json_decode(json_encode($zonas), true),'id_concesionario')) !== false): ?>
								<option value="<?=$concesionario->id?>" selected><?=$concesionario->nombre?></option>
							<?php else: ?>
								<option value="<?=$concesionario->id?>"><?=$concesionario->nombre?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="td-input">
					<b>Provincia:</b><br>
					<select name="provincia" id="provincia">
						<?php
							$html='';
							foreach ( $provincias as $prov ){
								if($info[0]->{'provinciaId'}==$prov->{'id'}){
									$html.='<option value="'.$prov->{'id'}.'" selected>'.$prov->{'provincia_nombre'}.'</option>';
								}else{
									$html.='<option value="'.$prov->{'id'}.'">'.$prov->{'provincia_nombre'}.'</option>';
								}
							}
							echo $html;
						?>
					</select>
				</div>
				<div class="td-input">
					<b>Nombre:</b><br>
					<input type="text" name="nombre" id="nombre" value="<?php echo $info[0]->{'name'};?>">
				</div>
				<div class="td-input">
					<b>Apellido:</b><br>
					<input type="text" name="apellido" id="apellido" value="<?php echo $info[0]->{'lastname'};?>">
				</div>
				<div class="td-input" style="padding-top:14px;">
					<b>Password:</b> &nbsp;<div class="btn btn-primary btn-xs" onclick="$('#password').show(); $(this).hide();">Cambiar password</div>
					<input type="text" name="password" id="password" placeholder="Ingrese nuevo password" style="display:none;" value="">
				</div>
				<div class="td-input">
					<b>Email:</b><br>
					<input type="text" name="email" id="email" value="<?php echo $info[0]->{'user_email'};?>">
				</div>
			 </form>
		  </div>
		  <div class="tab-pane" id="tab2">
			 iframe listado subtabla
		  </div>
	   </div>
	   <div class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">GUARDAR</div>
	   <a href="<?php echo base_url()?>zonas/"><div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div></a>
	</div>
</div>
<br style="clear:both;"/>