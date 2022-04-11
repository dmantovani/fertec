<header class="header-nav-user d-flex align-items-center justify-content-center">
	<?php $concesionario = $this->page_model->get_concesionario($this->session->userdata['logged_in']['concesionario']); ?>
	<div class="content-vendedor">
	    <?php if($this->uri->segment(2) == "condiciones"):?>
            <a style="font-weight:bold" href="<?php echo base_url() ?>productos/" class="nuevo"><< Volver a Productos</a>
        <?php else: ?>
            <a href="<?php echo base_url() ?>registro_cliente/" class="nuevo">Nuevo cliente</a>
            <span style="display:inline-block;color:#fff;margin:0 5px;">|</span>
            <a href="<?php echo base_url() ?>categorias/" class="nuevo">Unidades de negocio</a>
            <span style="display:inline-block;color:#fff;margin:0 5px;">|</span>
            <div class="nuevo" data-toggle="modal" data-target="#DatosAdicionales" style="display:inline-block;">Datos adicionales</div>
        <?php endif; ?>
	</div>
	<ul class="nav d-inline-flex nav-pills justify-content-end">
	  <li class="nav-item dropdown ">
	      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <?php if($this->session->userdata['logged_in']['rol'] != 'zona'): ?>
            <?=$concesionario[0]->{'nombre'}?> - <?php echo $this->session->userdata['logged_in']['usuario'] ?>
          <?php else: ?>
            <?php echo $this->session->userdata['logged_in']['usuario'] ?>
          <?php endif; ?>    
        </a>
	      <div class="dropdown-menu" style="min-width:100%;">
          <?php if($this->session->userdata['logged_in']['rol'] == 'zona'): ?>
            <a class="dropdown-item" href="<?php echo base_url() ?>admin/">Administrar</a>
          <?php endif; ?>	        
	        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#proformas">Mis ofertas</a>
	        <a class="dropdown-item" href="<?php echo base_url() ?>">Salir</a>
	      </div>
	    </li>
	</ul>
</header>


<div id="DatosAdicionales" class="modal fade" role="dialog">
    <div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content moda-dinamico">
	    <div class="modal-body-proforma">
	    	<div class="col-12">
				<p style="margin-top:1rem;">Datos adicionales</p>
				<form class="send-usuario-actualizar" action="<?php echo base_url() ?>envio/update_session_modal/" method="post" style="margin-bottom:15px;">
					<input type="text" name="domicilio_extra" placeholder="Domicilio adicional" style="width:100%;padding:5px 15px;margin-bottom:10px;" value="<?php echo $this->session->userdata['user']['domicilio_extra'] ?>">
					<input type="text" name="telefono_extra" placeholder="Telefono adicional" style="width:100%;padding:5px 15px;margin-bottom:10px;" value="<?php echo $this->session->userdata['user']['telefono_extra'] ?>">
					<input type="email" name="email_extra" placeholder="Email adicional" style="width:100%;padding:5px 15px;margin-bottom:10px;" value="<?php echo $this->session->userdata['user']['email_extra'] ?>">
					<div class="btn-enviar">
					<input type="submit" value="Guardar" style="width:100%;background:transparent;border:none;color:#ffff;cursor:pointer;">
					</div>
					<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
				</form>
				
			</div>
	    </div>
	  </div>

    </div>
  </div>

  <?php //print_r($this->session->userdata()); ?>
  <?php

  $prespuestos = $this->page_model->get_presupuestos_user($this->session->userdata['logged_in']['user_id'], $this->session->userdata['logged_in']['rol'], $this->session->userdata['logged_in']['concesionario']);
  $estados = $this->page_model->get_estados();

  ?>
  <!-- Modal -->
  <div class="modal fade" id="proformas" tabindex="-1" role="dialog" aria-labelledby="proformasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="proformasLabel">Mis ofertas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="example" class="display" style="width:100%">
              <thead>
                  <tr>
                      <th>Vendedor</th>
                      <th>CUIT</th>
                      <th>Razon Social</th>
                      <th>Estado</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
              	<?php foreach($prespuestos as $presupuesto): ?>
                  <tr>
                      <td><?php echo $presupuesto->vendedor_nombre ?> <?php echo $presupuesto->vendedor_apellido ?></td>
                      <td><?php echo $presupuesto->cuit ?></td>
                      <td><?php echo $presupuesto->razon_social ?></td>
                      <td style="color:<?php echo $presupuesto->estado_color ?>"><?php echo $presupuesto->estado_presupuesto ?><a href="#" data-toggle="modal" data-target="#modalEstado<?=$presupuesto->id?>"><i class="fas fa-exchange-alt" style="margin-left: 10px;margin-right: 0;color: #000;"></i></a></td>
                      <td align="center"><a href="/../../uploads/<?=$presupuesto->pdf?>" target="_blank" style="color:#ea212e;text-decoration:none;">Ver oferta</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal -->
  <?php foreach($prespuestos as $presupuesto): ?>
  <div class="modal fade" id="modalEstado<?=$presupuesto->id?>" tabindex="-1" role="dialog" aria-labelledby="modalEstadoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEstadoLabel">¿Desa cambiar el estado su proforma?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="cambio-estado" action="<?php echo base_url() ?>home/cambiar_estado/" method="post">
            <input type="hidden" name="presupuesto_id" value="<?php echo $presupuesto->id ?>">
            <select name="estado" style="width: 100%;padding: 5px 10px;font-size: 14px;">
              <option value="">Seleccionar...</option>
              <?php foreach($estados as $estado): ?>
                <option value="<?=$estado->id?>" <?php if($estado->nombre == $presupuesto->estado_presupuesto): echo "selected"; endif; ?>><?=$estado->nombre?></option>
              <?php endforeach; ?>
            </select>
            <input type="submit" value="Cambiar estado">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>