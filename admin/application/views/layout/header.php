<?php
if (isset($this->session->userdata['logged_in'])) {
	$username = ($this->session->userdata['logged_in']['username']);
	$email = ($this->session->userdata['logged_in']['email']);
	$provinciaId = ($this->session->userdata['logged_in']['provinciaId']);
	$provincia = ($this->session->userdata['logged_in']['provincia']);
	$admin = ($this->session->userdata['logged_in']['administrator']);
	
}else{
	header("location: ".base_url()."login/");
}
?>
<div class="header col-md-12">
	<a href="<?php echo base_url() ?>"><div class="header-logo"></div></a>
	<div class="header-info">
		<a href="<?php echo base_url() ?>home/logout/"><div id="logout" align="center"><span class="glyphicon glyphicon-off" aria-hidden="true"></span><br>Log out</div></a>
		<div class="user-data">
			Bienvenido: <h1><?php echo $username ?></h1>
		</div>
	</div>
	<?php if($this->session->userdata['logged_in']['rol'] == 'zona'): ?>
		<div class="site-preview"><a href="<?php echo base_url() ?>../" target="_blank"><div class="btn btn-default btn-sm">COTIZADOR</div></a>
		</div>
	<?php endif; ?>
</div>