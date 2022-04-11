<div class="nav col-sm-2">
	
	
	<?php if($this->session->userdata['logged_in']['rol'] == 'zona'): ?>
		<div class="title-nav" style="text-transform:uppercase;">Concesionario</div>
		<a href="<?php echo base_url() ?>concesionarios/"><div class="btn-nav" id="l_concesionarios">Administrar concesionarios >> </div></a>
		<a href="<?php echo base_url() ?>proformas/"><div class="btn-nav" id="l_proformas">Ver Ofertas >> </div></a>
		<a href="<?php echo base_url() ?>estados/"><div class="btn-nav" id="l_estados">Estados >> </div></a>
	<?php endif; ?>

	<?php if($this->session->userdata['logged_in']['administrator']==1){ ?>
	<div class="title-nav">PRODUCTOS</div>
	<a href="<?php echo base_url() ?>productos/"><div class="btn-nav" id="l_productos">Productos >> </div></a>
	<a href="<?php echo base_url() ?>categorias/"><div class="btn-nav" id="l_categorias">Categorias >> </div></a>
	<a href="<?php echo base_url() ?>marcas/"><div class="btn-nav" id="l_marcas">Unidades >> </div></a>

	<div class="title-nav">CONDICIONES COMERCIALES</div>	
	<a href="<?php echo base_url() ?>condiciones_categorias/"><div class="btn-nav" id="l_condiciones_categorias">Categorias Condiciones comerciales >> </div></a>
	<a href="<?php echo base_url() ?>condiciones/"><div class="btn-nav" id="l_condiciones">Condiciones comerciales >> </div></a>

	<div class="title-nav">USUARIOS</div>
	<a href="<?php echo base_url() ?>usuarios/"><div class="btn-nav" id="l_usuarios">Administradores >> </div></a>
	<a href="<?php echo base_url() ?>zonas/"><div class="btn-nav" id="l_zonas">Zonales >> </div></a>
	<div class="title-nav" style="text-transform:uppercase;">Concesionario</div>
	<a href="<?php echo base_url() ?>concesionarios/"><div class="btn-nav" id="l_concesionarios">Administrar concesionarios >> </div></a>
		<a href="<?php echo base_url() ?>proformas/"><div class="btn-nav" id="l_proformas">Ver Ofertas >> </div></a>
	<a href="<?php echo base_url() ?>estados/"><div class="btn-nav" id="l_estados">Estados >> </div></a>
	<?php } ?>
	<?php if($this->session->userdata['logged_in']['concesionario'] >= 1){ ?>
		<div class="title-nav" style="text-transform:uppercase;">Concesionario</div>
		<a href="<?php echo base_url() ?>proformas/"><div class="btn-nav" id="l_proformas">Ver Ofertas >> </div></a>
		<a href="<?php echo base_url() ?>estados/"><div class="btn-nav" id="l_estados">Estados >> </div></a>
	<?php } ?>
</div>