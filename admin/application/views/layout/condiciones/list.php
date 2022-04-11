<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:10px;">
		<div class="listado">
			<div class="col-md-12 home-tools">
				<div class="row">
					<div class="col-xs-8 col-md-8">
						<h2>CONDICIONES COMERCIALES</h2>
					</div>
					<div class="col-xs-4 col-md-4">
						<a href="<?php echo base_url()?>condiciones/add/"><div class="btn btn-success btn-sm bt-save pull-right" style="margin-right:8px;">AGREGAR NUEVO</div></a>
						<a href="<?php echo base_url()?>condiciones/updatecondiciones/"><div class="btn btn-danger btn-sm bt-save pull-right" style="margin-right:3px;">ACTUALIZO CONDICIONES</div></a>						
					</div>
				</div>
			</div>
			<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="40">ID</th>
						<th>Categoria de pago</th>
						<th>Estado</th>
						<th>Item</th>
						<th>DTO %</th>
						<th width="40">Editar</th>
						<th width="40">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$html='';
						foreach ( $info as $fila ){
							
							$estado = "<span style='color:red'>Inactivo</span>";
							if($fila->{'estado'} == 1) $estado = "<span style='color:green'>Activa</span>";
						
							$html.='<tr>
								<td>'.$fila->{'id'}.'</td>
								<td><b>'.$fila->{'categoria'}.'</b></td>
								<td><a href="'.base_url().'condiciones/active/'.$fila->{'id'}.'/"><b>'.$estado.'</b></a></td>
								<td><span style="font-size:11px;">'.$fila->{'item'}.'</span><br><b>'.$fila->{'id_dynamics'}.'</b> </td>
								<td><b>'.$fila->{'descuento'}.'%</b></td>
								<td align="center"><a href="'.base_url().'condiciones/edit/'.$fila->{'id'}.'/"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td align="center"><a href="#" data-href="'.base_url().'condiciones/remove/'.$fila->{'id'}.'/" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
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