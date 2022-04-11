
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
				
			 <form class="add-user-concesionario" method="post" action="<?php echo base_url()?>concesionarios/save_user/">
			 	<input type="hidden" name="concesionario_id" value="<?=$this->uri->segment(3)?>">
				<?php if(isset($error)){ ?>
				<div class="td-input error-usuario">
				<?php }else{ ?>
				<div class="td-input">
				<?php } ?>
					<b>Usuario:</b><br>
					<input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST['usuario'])){echo $_POST['usuario'];}?>">
				</div>
				<div class="td-input">
					<b>Provincia:</b><br>
					<select name="provincia" id="provincia">
						<?php
							$html='';
							$html.='<option value="">Seleccionar provincia</option>';
							foreach ( $provincias as $prov ){
								$html.='<option value="'.$prov->{'id'}.'">'.$prov->{'provincia_nombre'}.'</option>';
							}
							echo $html;
						?>
					</select>
				</div>
				<div class="td-input">
					<b>Nombre:</b><br>
					<input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];}?>">
				</div>
				<div class="td-input">
					<b>Apellido:</b><br>
					<input type="text" name="apellido" id="apellido" value="<?php if(isset($_POST['apellido'])){echo $_POST['apellido'];}?>">
				</div>

				<div class="td-input">
					<b>Rol:</b><br>
					<select name="rol" id="rol">
						<option value="">Seleccionar rol</option>
						<option value="administrador">Administrador</option>
						<option value="vendedor">Vendedor</option>
					</select>
				</div>

				<div class="td-input">
					<b>Password:</b><br>
					<input type="text" name="password" id="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];}?>">
				</div>
				<div class="td-input">
					<b>Email:</b><br>
					<input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
				</div>
			 </form>
		  </div>
		  <div class="tab-pane" id="tab2">
			 iframe listado subtabla
		  </div>
	   </div>
	   <input value="GUARDAR" class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">
	   <a href="<?php echo base_url()?>usuarios/"><div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div></a>
	</div>
</div>
<br style="clear:both;"/>