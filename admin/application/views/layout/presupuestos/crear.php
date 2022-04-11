<?php //print_r($this->session->userdata()) ?>
<style type="text/css">
    #l_presupuestos, #l_sin_asignar {background:none!important;}
    #l_crear {background:rgb(253, 189, 44) !important;}
    .btn-modal-p:hover {cursor:pointer;}
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {width:100%;}
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
				
			 <form method="post" action="<?php echo base_url()?>presupuestos/creando_lead/">
				<div class="td-input">
					<b>Nombre:</b><br>
					<input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
				</div>
				<div class="td-input">
					<b>Localidad:</b><br>
					<input type="text" name="localidad" id="localidad" placeholder="Localidad" required>
				</div>
				<div class="td-input">
					<b>Celular:</b><br>
					<input type="text" name="celular" id="celular" placeholder="Celular" required>
				</div>
				<div class="td-input">
					<b>Mail:</b><br>
					<input type="email" name="mail" id="mail" placeholder="Mail" required style="width: 100%;background: #fff;border: 1px solid #ddd;padding: 6px;">
				</div>
				<div class="td-input">
					<b>Origen del contacto:</b><br>
					<select name="origen" required style="height:32px;">
						<option value="">Seleccionar Origen</option>
						<option value="WebPage">WebPage</option>
						<option value="Whatsapp">Whatsapp</option>
						<option value="Teléfono">Teléfono</option>
						<option value="Redes Sociales">Redes Sociales</option>
						<option value="Salón">Salón</option>
						<option value="Referido">Referido</option>
						<option value="Vía Pública">Vía Pública</option>
						<option value="TV">TV</option>
						<option value="Radio">Radio</option>
						<option value="Graficas">Graficas</option>
					</select>
				</div>
				<input type="hidden" name="vendedor_id"  value="<?php echo $this->session->userdata['logged_in']['vendedor_id'] ?>">
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