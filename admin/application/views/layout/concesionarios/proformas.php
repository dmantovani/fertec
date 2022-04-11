<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:10px;">
		<div class="listado">
			<div class="col-md-12 home-tools">
				<div class="row">
					<div class="col-xs-8 col-md-8">
						<h2 style="text-transform:uppercase;">Proformas de: <?php echo $concesionario[0]->nombre ?></h2>
					</div>
					<div class="col-xs-4 col-md-4">
					</div>
				</div>
			</div>
			<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Vendedor</th>
						<th>Rol</th>
						<th>Usuario</th>
						<th>CUIT / CUIL</th>
						<th>Estado</th>
						<th width="40" align="center" style="text-align:center;">Ver</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$html='';
						foreach ( $info as $fila ){
						
						
							$html.='<tr>
								<td>'.$fila->nombre_vendedor.'</td>
								<td>'.$fila->rol_vendedor.'</td>
								<td>'.$fila->nombre_usuario.' '.$fila->apellido_usuario.'</td>
								<td>'.$fila->cuit_usuario.'</td>
								<td style="color:'.$fila->estado_color.'">'.$fila->estado_nombre.'</td>
								<td style="text-align:center;"><a href="'.base_url().'../uploads/'.$fila->pdf.'" target="_blank"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
							</tr>';
							
						}
						echo $html;
					?>				
				</tbody>
			</table>
		</div>
	</div>
</div>
<br style="clear:both;"/>