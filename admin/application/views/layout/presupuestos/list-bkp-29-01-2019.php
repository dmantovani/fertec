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
						<th>Nombre</th>
						<th>Email</th>
						<th>Fecha envio</th>
						<th width="100%">Estado Pedido</th>
						<th width="10">PDF</th>
						<th width="10">Evento</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$html='';
						foreach ( $info as $fila ){
								$dest = "1";
							$html.='<tr>
								<td><b>'.$fila->{'user_name'}.' '.$fila->{'user_lastname'}.'</b></td>
								<td>'.$fila->{'nombre'}.' '.$fila->{'apellido'}.' </td>
								<td>'.$fila->{'email'}.' <br> Telefono: '.$fila->{'telefono'}.' <br> '.$fila->{'provincia'}.' - '.$fila->{'localidad'}.'</td>
								<td>'.date("d/m/Y H:i:s",$fila->{'added_at'}).'</td>
								<td style=" background-color: '.$fila->{"color"}.'"><a style="font-size:10px; href="'.base_url().'/presupuestos/evento/'.$fila->{"id"}.'/"><center>'.$fila->{"estado"}.'</center></a><br><center><span class="label label-info"><b>'.$fila->{"eventoskount"}.'</b> Eventos</span></center></td>
								<td align="center"><a target="_blank" href="'.base_url().'../uploads/'.$fila->{'pdf_file'}.'"><span class="glyphicon glyphicon-export" aria-hidden="true"></span></a></td>
								<td align="center"><a href="'.base_url().'/presupuestos/evento/'.$fila->{"id"}.'/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> </td>
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