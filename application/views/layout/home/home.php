<?php //print_r($this->session->userdata()) ?>
<section class="header-home">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-5">
				<div class="conten-logo">
					<img src="<?php echo base_url() ?>asset/img/norto_logo.png" class="img-fluid logo-header">
				</div>
				<form class="form-login" method="post" action="<?php echo base_url() ?>envio/vendedor_login/">
					<span class="content-input">
						<input type="text" name="usuario" placeholder="Usuario">
					</span>
					<span class="content-input left-01">
						<input type="password" name="password" placeholder="Contraseña">
					</span>
					<span class="content-input submit-btn left-02">
						<input type="submit" value="Ingresar">
					</span>
					<div class="content-error" style="display:none;">
						<p>Usuario o Contraseña incorrectas</p>
					</div>
				</form>
			</div>
			<div class="col-12 col-md-1"></div>
			<div class="col-12 col-md-5 img-footer">
				<?php if(false): ?>
					<img src="<?php echo base_url() ?>asset/img/footer-img.png" class="img-fluid">
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>