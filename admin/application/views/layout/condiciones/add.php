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
			 <form method="post" action="<?php echo base_url()?>condiciones/save/">
				
				<div class="td-input">
					<b>Nombre:</b><br>
					<input type="text" name="item" id="item">
				</div>
				
                    <div class="td-input">
                        <b>% Descuento:</b><br>
                        <input type="text" name="descuento" id="descuento" value="0">
                    </div>
				
				<div class="td-input">
					<b>Categorias<br>
					<select name="categoria_id">
						<option value="">Seleccionar Categoria...</option>
						<?php foreach($categorias as $marca): ?>
							<option value="<?=$marca->id?>"><?=$marca->categoria?></option>
						<?php endforeach; ?>
					</select>
				</div>
			 </form>
		  </div>
		  <div class="tab-pane" id="tab2">
		  </div>
	   </div>
	   <div class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">GUARDAR</div>
	   <a href="<?php echo base_url()?>categorias/"><div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div></a>
	</div>
</div>
<br style="clear:both;"/>