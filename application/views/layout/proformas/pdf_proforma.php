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
   	<div style="width:100%;padding:12px;">
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

   	<?php foreach ( $productos_session as $producto ){ ?>

   		<table class="tg" style="padding:12px;">
   		  <tr>
   		    <th class="tg-0pky">2</th>
   		    <th class="tg-0pky">w</th>
   		    <th class="tg-0pky">w</th>
   		  </tr>
   		  <tr>
   		    <td class="tg-0pky">w</td>
   		    <td class="tg-0pky">w</td>
   		    <td class="tg-0pky">w</td>
   		  </tr>
   		  <tr>
   		    <td class="tg-0pky">w</td>
   		    <td class="tg-0pky">w</td>
   		    <td class="tg-0pky">w</td>
   		  </tr>
   		</table>
   	<?php } ?>
</body>
</html>
