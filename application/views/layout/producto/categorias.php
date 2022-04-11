<section class="categorias d-flex flex-column">
	<div class="container" style="margin-top:auto;margin-bottom:auto;">
		<div class="row">
			<?php if(!empty($subcategorias)): ?>
			<div class="col-12 col-md-12 info-cat-aling">
				<h3>Seleccioná una categoría</b></h3>
				<form class="form-categorias" action="<?php echo base_url() ?>envio/categoria/" method="post">
					<?php foreach($subcategorias as $subcat): ?>
					<label for="categoraia0<?=$subcat->id?>" class="btn6">
						<p><?=$subcat->categoria?></p>
						<input type="radio" id="categoraia0<?=$subcat->id?>" name="categoria" value="<?=$subcat->id?>" class="sendCategoria">
					</label>
					<?php endforeach; ?>
				</form>
			</div>
			<?php else: ?>
			<div class="col-12 col-md-12 info-cat-aling" style="margin-top:auto;">
				<h3>Unidades de negocio</h3>
				<?php foreach($categorias as $cat): ?>
				<div class="col-12 text-center">
					<a href="<?php echo base_url() ?>categorias?id_subcategoria=<?=$cat->{'id'}?>" class="img-btns">
						<div class="content-logo-cat d-flex align-items-center">
							<?php if(strlen($cat->logo) <= 1): ?>
								<span style="color:#fff; font-weight:bold"><?=$cat->nombre?></span>
							<?php else: ?>
								<img src="<?php echo base_url() ?>asset/img/uploads/<?=$cat->logo?>" <?php if($cat->nombre == 'Fertec'): ?> style="max-width:115px;" <?php endif; ?> <?php if($cat->nombre == 'Agrix'): ?> style="max-width:90px;" <?php endif; ?> <?php if($cat->nombre == 'Luxion'): ?> style="max-width:90px;" <?php endif; ?>>							
							<?php endif; ?>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if(!empty($subcategorias)): ?>
		<div class="col-12 text-center" style="margin-top:auto;">
			<?php if($categoria[0]->id == 1): ?>
				<img src="<?php echo base_url() ?>asset/img/img-footer-02.png" class="img-fluid">
			<?php else: ?>
				<img src="<?php echo base_url() ?>asset/img/uploads/<?=$categoria[0]->logo?>" class="img-fluid" style="margin-bottom:100px;">
			<?php endif; ?>
		</div>
	<?php endif; ?>
</section>