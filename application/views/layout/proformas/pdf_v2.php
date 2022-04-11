<!DOCTYPE html>
<html>
<head>
	<title>Presupuesto Nº<?php echo $user[0]->id ?> | <?php echo $user[0]->nombre ?></title>

	<style media="print">
	@page {
		margin:0;
		padding:0;
	}
		.content_grla {width:100%;background:#fff;margin:0 auto;}
		.header {background:#df0637;padding:20px 0;position:relative;width:100%;display:inline-block;}
		.title_description {background:#000;padding:15px 0;position:relative;display:inline-block;width:100%;}
		.title_description h3 {text-align: center;color: #fff;margin: 0;padding: 0;font-family: Arial, sans-serif;font-weight:900;font-size: 1.2rem;}
		.content_info {background:#fff;position:relative;width:100%;padding:20px 0;display:inline-block;}
		.content-border {display: block;border: 1px solid #df0637;border-radius: 30px;padding:8px 20px;font-family: Arial, sans-serif;margin-bottom: 5px;}
		.add_info {background:#f1f1f1;position:relative;display:inline-block;width:100%;}
		.column_2 {background:#fff;position:relative;display:inline-block;width:100%;}
		.column_1 {background:#fff;position:relative;display:inline-block;width:100%;}
		a {text-decoration:none;outline:none;}
		.red {color: #df0637;}
		ul {margin-top:-1.3em:;}
		ul li {margin:0;font-size:13px;font-family: Arial, sans-serif;}
	</style>
</head>
<body style="width: 800px;
    background: #fff;
    max-height: 1132px;
    height: 1132px;
    min-height: 1132px;
    margin: 0 auto;
    padding:15px;">
    <?php //print_r($user); ?>
   	<div style="width:100%;padding:15px;">
   		<div style="width:49%;display:inline-block;margin:0;vertical-align:middle;float:left;">
   			<p style="width:100%;color:#000;font-family:'Arial';margin:0;padding:3px 5px;">Cliente</p>
   			<p style="width:100%;background:#e2eff5;font-family:'Arial';color:#000;font-weight:bold;padding:3px 5px;margin:0"><?php echo $user[0]->nombre ?></p>
   		</div>
   		<div style="width:49%;display:inline-block;margin:0;vertical-align:middle;float:right;">
   			<p style="width:100%;color:#000;font-family:'Arial';margin:0;padding:3px 5px;">Cotización</p>
   			<p style="width:100%;background:#e2eff5;font-family:'Arial';color:#000;font-weight:bold;padding:3px 5px;margin:0"><?php echo $user[0]->id ?></p>
   		</div>

   		<div style="width:49%;display:inline-block;margin:0;vertical-align:middle;float:left;">
   			<p style="width:100%;color:#000;font-family:'Arial';margin:0;padding:3px 5px;">Cuit</p>
   			<p style="width:100%;background:#e2eff5;font-family:'Arial';color:#000;font-weight:bold;padding:3px 5px;margin:0"><?php echo $user[0]->cuit ?></p>
   		</div>
   		<div style="width:49%;display:inline-block;margin:0;vertical-align:middle;float:right;">
   			<p style="width:100%;color:#000;font-family:'Arial';margin:0;padding:3px 5px;">Email</p>
   			<p style="width:100%;background:#e2eff5;font-family:'Arial';color:#000;font-weight:bold;padding:3px 5px;margin:0"><?php echo $user[0]->email ?></p>
   		</div>

   		<div style="width:49%;display:inline-block;margin:0;vertical-align:middle;float:left;">
   			<p style="width:100%;color:#000;font-family:'Arial';margin:0;padding:3px 5px;">Teléfono</p>
   			<p style="width:100%;background:#e2eff5;font-family:'Arial';color:#000;font-weight:bold;padding:3px 5px;margin:0"><?php echo $user[0]->telefono ?></p>
   		</div>

   		<div style="width:49%;display:inline-block;margin:0;vertical-align:middle;float:right;">
   			<p style="width:100%;color:#000;font-family:'Arial';margin:0;padding:3px 5px;">Fecha</p>
   			<p style="width:100%;background:#e2eff5;font-family:'Arial';color:#000;font-weight:bold;padding:3px 5px;margin:0"><?php echo $user[0]->fecha_registro ?></p>
   		</div>
   	</div>
    <table class="tg" style="padding:15px;width:100%;">
        <tr style="border-bottom:1px solid #000;">
          <th class="tg-0pky" style="font-size:10px;text-align:left;">Modelo</th>
          <th class="tg-0pky" style="font-size:10px;text-align:left;">Precio Neto</th>
          <th class="tg-0pky" style="font-size:10px;text-align:left;">IVA Incluído</th>
        </tr>
       	<?php foreach ( $productos as $producto ){ 

          $suma_precio_producto += $producto->{'precio'}?>
       		  <tr>
       		    <td class="tg-0pky" style="font-size:12px;text-align:left;border-top:1px solid #000;padding:10px 0;">
                <?php echo $producto->{'nombre'} ?><br>
                <?php foreach($this->page_model->get_opcionales_presupuesto_id($user[0]->id, $producto->{'id'},$producto->{'id_producto_session'}) as $opcional):
                  $suma_opcionales += $opcional->{'precio'};
                  ?>
                <span style="font-size:8px;margin:2px 0;"><?php echo $opcional->{'opcional'} ?> - U$S <?php echo $opcional->{'precio'} ?> </span><br>
                <?php endforeach; ?>
              </td>
              <td class="tg-0pky" style="font-size:10px;vertical-align:top;border-top:1px solid #000;padding:10px 0;">U$S <?php echo number_format($producto->precio) ?></td>
       		    <td class="tg-0pky" style="font-size:10px;vertical-align:top;border-top:1px solid #000;padding:10px 0;">10,5</td>
       		  </tr>
       	<?php } ?>
    </table>
    <?php $suma_total = $suma_precio_producto + $suma_opcionales + '10,5'; ?>
    <div style="width:100%;text-align:left;padding:15px;">
      <p style="font-family:'Arial';font-size:15px;">Condiciones de pago:</p>
      <?php foreach ( $productos as $producto ): ?>

        <?php foreach($this->page_model->presupueto_condiciones_id($user[0]->id , $producto->{'id_producto_session'}) as $condiciones):
        $descuento += $condiciones->{'descuento'} ?>
          <p style="font-size:12px;"><?php echo $condiciones->{'nombre_producto'} ?>: <br> 
            <span style="font-size:10px;">> <?php echo $condiciones->{'item'} ?> - <?php echo $condiciones->{'descuento'}; ?></span></p>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
    <div style="width:100%;text-align:right;padding:15px;">
      <p style="font-family:'Arial';font-size:13px;">Descuento: <?php echo $descuento ?>%<br>
      Descuento Especial:  %<br>
      <?php 
        $multiplicacion = $suma_total*$descuento;
        $total_descuento = $multiplicacion / 100;

        $total_total = $suma_total-$total_descuento;

      ?>
      <span style="font-size:17px;line-height:2">Total: U$S <?php echo number_format($total_total) ?></span><br>
      <span style="font-size:10px;">Reintegro fiscal aplicado – Precios con IVA – No incluye flete Industria Argentina</span></p>
    </div>

    <div style="width:100%;text-align:center;padding:15px;">
      <p style="font-size:10px;font-family:'Arial';">
        Usted fue tendido por: <strong style="font-size:12px;"><?php echo $vendedor[0]->name ?> <?php echo $vendedor[0]->last_name ?> | <?php echo $vendedor[0]->telefono ?> | <?php echo $vendedor[0]->user_name ?></strong></p>
    </div>
</body>
</html>
