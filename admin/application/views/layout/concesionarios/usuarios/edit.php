
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
			 <form method="post" action="<?php echo base_url()?>concesionarios/update_user/<?php echo $info[0]->{'id'}?>/">
			 	<input type="hidden" name="concesionario_id" value="<?=$info[0]->{'concesionario_id'}?>">
				<div class="td-input">
					<b>Usuario:</b><br>
					<input type="text" name="usuario" id="usuario" value="<?php echo $info[0]->{'user_name'};?>" readonly>
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
				<div class="td-input">
					<b>Rol:</b><br>
					<select name="rol" id="rol">
						<option value="">Seleccionar rol</option>
						<option value="administrador" <?php if($info[0]->{'rol'} == 'administrador'): echo "selected"; endif; ?>>Administrador</option>
						<option value="vendedor" <?php if($info[0]->{'rol'} == 'vendedor'): echo "selected"; endif; ?>>Vendedor</option>
					</select>
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
	   <a href="<?php echo base_url()?>usuarios/"><div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div></a>
	</div>
</div>
<br style="clear:both;"/>