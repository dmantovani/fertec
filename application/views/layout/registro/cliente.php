<script type="text/javascript">
$(document).ready(function() {
    $(".provincia_id").change(function()
    {
		$(".localidad").empty();
		$.getJSON('<?=base_url()?>/registro_cliente/provincias?provincia='+$(".provincia_id").val(),function(data){
			$.each(data, function(id,value){
				$(".localidad").append('<option value="'+id+'">'+value+'</option>');
     		});
 		});
    });
});
</script>

<section class="header-registro">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-5">
				<div class="conten-registro">
					<p>Cotizador online</p>
				</div>
				<div class="conten-logo">
					<img src="<?php echo base_url() ?>asset/img/norto_logo.png" class="img-fluid logo-header">
				</div>
			</div>
			<div class="col-12 col-md-1"></div>
			<div class="col-12 col-md-5 d-flex flex-column">
				<div class="content-registros">
					<h3>LLena el formulario con los datos del cliente</h3>
					<form class="registro-user" method="post" action="<?php echo base_url() ?>envio/session_user/">
						<input type="text" name="cuit" placeholder="CUIT">
						<input type="text" name="razon_social" placeholder="Razón Social">
	
							
						<div class="row">
							<div class="col-6" style="padding-right:0px">
									<input type="text" name="nombre" placeholder="Nombre" required>
								</div>
								
								<div class="col-6">
									<input type="text" name="apellido" placeholder="Apellido" required>
								</div>	
						</div>
						
						
						<input type="email" name="email" placeholder="Email">
						
						<div class="row">
							<div class="col-5" style="padding-right:0px">						
								<select id="provincia_id" class="provincia_id" name="provincia_id">
    									<option>Provincia</option>
									<?php foreach($provincias as $provincia): ?>
										<option value="<?=$provincia->id?>"><?=$provincia->provincia_nombre?></option>
									<?php endforeach; ?>						
								</select>
							</div>
							
							<div class="col-7" >													
								<!-- La localidad la obtengo desde un select. -->
								<select id="localidad" class="localidad" name="localidad">
									<option>Localidad</option>	
								</select>
							</div>
						</div>

						<input type="text" name="telefono" placeholder="Teléfono *">
						<select name="origen">
							<option value="267060009">Apresid</option>
							<option value="267060006">AgriExpo</option>
							<option value="6">ExpoAgro</option>
							<option value="9">AgroActiva</option>
							<option value="267060003">Cliente</option>
							<option value="267060003">Tranquera</option>
							<option value="267060001">F&aacute;brica</option>
							<option value="11">Ferias</option>
							<option value="267060010">Fertilizar</option>
							<option value="10">Otros</option>
							<option value="267060002">Referido</option>
							<option value="267060008">Rural Rio 4</option>
							<option value="1">Tel&eacute;fono</option>
						</select>

						<input type="submit" value="Cotizar">
					</form>
					<p class="caracteristicas">* El teléfono debera contener la caracteristica sin el 0 y el numero sin el 15.</p>
				</div>
			</div>
		</div>
	</div>
</section>