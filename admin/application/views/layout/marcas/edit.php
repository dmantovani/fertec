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
                <form method="post" action="<?php echo base_url()?>marcas/update/<?php echo $info[0]->{'id'}?>/">
                    <div class="td-input">
                        <b>Nombre:</b><br>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $info[0]->{'nombre'};?>">
                    </div>
                    <div class="td-input">
                        <b>Logo<br>
                        <input type="text" name="galeria1_input" id="galeria1_input" class="img-input" value="<?php echo $info[0]->{'logo'}?>" readonly>
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
                            <?php if($info[0]->{'logo'}<>''){ ?>
                            <div class="list-img-gal"><div class="file-del" onclick="delFile('../../../asset/img/uploads/<?php echo $info[0]->{'logo'}?>',function(){}); $('#galeria1_input').val(''); $(this).parent().remove();"></div><img src="../../../../asset/img/uploads/<?php echo $info[0]->{'logo'}?>" width="auto" height="100"><br><input id="img_desc" type="text"></div>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="tab2">
            </div>
        </div>
        <div class="btn btn-success btn-sm pull-right bt-save" style="margin-right:8px;">GUARDAR</div>
        <a href="<?php echo base_url()?>marcas/">
            <div class="btn btn-default btn-sm pull-right" style="margin-right:8px;">CANCELAR</div>
        </a>
    </div>
</div>
<br style="clear:both;"/>