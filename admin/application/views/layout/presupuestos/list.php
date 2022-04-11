<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:10px;">
		<div class="listado">
			<div class="col-md-12 home-tools">
			<div class="col-md-8">
				<h2>Presupuestos</h2>
			</div>
			<div class="col-md-4">
				<!--<a href="<?php echo base_url()?>cursos/add/new/"><div class="btn btn-success btn-sm bt-save pull-right" style="margin-right:8px;">AGREGAR NUEVO</div></a>-->
			</div>
			</div>
			<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Asignado a:</th>
						<th>Cliente</th>
						<th>Presupuesto</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$html='';
						foreach ( $info as $fila ){
								$dest = "1";
							$html.='<tr>
								<td><b>'.$fila->{'user_name'}.' '.$fila->{'user_lastname'}.'</b></td>
								<td>'.$fila->{'nombre'}.' '.$fila->{'apellido'}.' <br>'.$fila->{'email'}.' <br> Telefono: '.$fila->{'telefono'}.' <br> '.$fila->{'provincia'}.' - '.$fila->{'localidad'}.'  </td>
								<td>
								
						 		<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Fecha envio:</th>
											<th>Fecha proceso:</th>
											<th>Estado pedido:</th>
											<th>UTM:</th>
											<th>PDF</th>
											<th>Evento</th>
										</tr>
									</thead>
								
								</table>
								
								</td>
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