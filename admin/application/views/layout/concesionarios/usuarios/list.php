
<div class="home-main col-sm-10" id="home_main">
	<div class="home-content" style="margin-top:0px; padding-top:10px;">
		<div class="listado">
			<div class="col-md-12 home-tools">
				<div class="row">
					<div class="col-xs-8 col-md-8">
						<h2 style="text-transform:uppercase;"><?=$concesionario[0]->nombre?> - Lista de usuarios</h2>
					</div>
					<div class="col-xs-4 col-md-4">
						<a href="<?php echo base_url()?>concesionarios/add_usuario/<?=$this->uri->segment(3)?>"><div class="btn btn-success btn-sm bt-save pull-right" style="margin-right:8px;">AGREGAR NUEVO</div></a>
					</div>
				</div>
			</div>
			<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Nombre</th>
						<th>Rol</th>
						<th width="40">Editar</th>
						<th width="40">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$html='';
						foreach ( $info as $fila ){
						
						
							$html.='<tr>
								<td>'.$fila->{'user_name'}.'</td>
								<td>'.$fila->{'name'}.' '.$fila->{'lastname'}.'</td>
								<td>'.$fila->{'rol'}.'</td>
								<td align="center"><a href="'.base_url().'concesionarios/edit_usuario/'.$fila->{'id'}.'/"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td align="center"><a href="#" data-href="'.base_url().'concesionarios/remove_usuario/'.$fila->{'id'}.'/?id_concesionario='.$this->uri->segment(3).'" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
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