<?php print_r($this->session->userda) ?>
<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:10px;">
		<div class="listado">
			<div class="col-md-12 home-tools">
				<div class="row">
					<div class="col-xs-8 col-md-8">
						<h2>OFERTAS</h2>
					</div>
					<div class="col-xs-4 col-md-4">
						<a href="<?php echo base_url()?>usuarios/add/"><div class="btn btn-success btn-sm bt-save pull-right" style="margin-right:8px;">AGREGAR NUEVO</div></a>
					</div>
				</div>
			</div>
			<div class="row">
				<?php foreach($zonas_users as $zu): ?>
					<div class="col-md-4">
						<h3>Concesionario:<?=$zu->nombre?></h3>
						<?php foreach($this->page_model->get_proformas_concesionario_zonas($zu->id) as $users): ?>
							<p>
								Usuario: <?=$users->name_user?><br>
								Rol: <?=$users->rol_user?><br>
							</p>
							<a href="#" class="ver-proforma">Ver proforma</a>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<br style="clear:both;"/>