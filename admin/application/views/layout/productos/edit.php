<?php
    if ($this->session->userdata['logged_in']['administrator']==0) {
    	header("location: ".base_url());
    }
    ?>
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
                <form method="post" action="<?php echo base_url()?>productos/update/<?php echo $info[0]->{'id'}?>/">
                    <div class="td-input">
                        <b>Nombre:</b><br>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $info[0]->{'nombre'};?>">
                    </div>
                    <div class="td-input">
                        <b>Descripcion:</b><br>
                        <textarea name="descripcion"><?=$info[0]->{'descripcion'}?></textarea>
                    </div>
                    <div class="td-input">
                        <b>Equipamiento:</b><br>
                        <textarea name="equipamiento"><?=$info[0]->{'equipamiento'}?></textarea>
                    </div>
                    <div class="td-input">
                        <b>Categorias:</b><br>
                        <select name="categoria">
                            <option value="">Seleccionar...</option>
                            <?php foreach($categorias as $categoria): ?>
                                <option value="<?=$categoria->id?>" <?php if($categoria->id == $info[0]->{'id_categoria'}): echo "selected"; endif;?>><?=$categoria->categoria?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="td-input">
                        <b>Precio:</b><br>
                        <input type="number" name="precio" id="precio" value="<?php echo $info[0]->{'precio'};?>">
                    </div>
                    <div class="td-input">
                        <b>Ficha:</b> (Formato imagen)<br>
                        <input type="text" name="galeria2_input" id="galeria2_input" class="img-input" value="<?php echo $info[0]->{'imagen'}?>" readonly>
                        <div id="main_uploader">
                            <div class="uploader-id1">
                                <div id="uploader2" align="left">
                                    <input id="uploadify2" type="file" class="uploader" />
                                </div>
                            </div>
                            <div id="filesUploaded" style="display:none;"></div>
                            <div id="thumbHeight2" style="display:none;" >800</div>
                            <div id="thumbWidth2" style="display:none;" >1440</div>
                        </div>
                        <div id="galeria2" class="upload-galeria">
                            <?php if($info[0]->{'imagen'}<>''){ ?>
                            <div class="list-img-gal"><div class="file-del" onclick="delFile('../../../asset/img/uploads/<?php echo $info[0]->{'imagen'}?>',function(){}); $('#galeria2_input').val(''); $(this).parent().remove();"></div><img src="../../../../asset/img/uploads/<?php echo $info[0]->{'imagen'}?>" width="auto" height="100"><br><input id="img_desc" type="text"></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="td-input">
                    	<b>Imagen de producto:</b> (Medida: 500x400px)<br>
                    	<input type="text" name="galeria1_input" id="galeria1_input" class="img-input" value="<?php echo $info[0]->{'imagen_render'}?>" readonly>
                    	<div id="main_uploader">
                    		<div class="uploader-id1">
                    			<div id="uploader1" align="left">
                    				<input id="uploadify1" type="file" class="uploader" />
                    			</div>
                    		</div>
                    		<div id="filesUploaded" style="display:none;"></div>
                    		<div id="thumbHeight1" style="display:none;" >800</div>
                    		<div id="thumbWidth1" style="display:none;" >1440</div>
                    	</div>
                    	<div id="galeria1" class="upload-galeria">
                    		<?php if($info[0]->{'imagen_render'}<>''){ ?>
                    		<div class="list-img-gal"><div class="file-del" onclick="delFile('../../../asset/img/uploads/<?php echo $info[0]->{'imagen_render'}?>',function(){}); $('#galeria1_input').val(''); $(this).parent().remove();"></div><img src="../../../../asset/img/uploads/<?php echo $info[0]->{'imagen_render'}?>" width="auto" height="100"><br><input id="img_desc" type="text"></div>
                    		<?php } ?>
                    	</div>
                    </div>

                </form>
            </div>
            <div class="tab-pane" id="tab2">
                iframe listado subtabla
            </div>
        </div>
        <div class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">GUARDAR</div>
        <a href="<?php echo base_url()?>productos/">
            <div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div>
        </a>
    </div>
</div>
<br style="clear:both;"/>