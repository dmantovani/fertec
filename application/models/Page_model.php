<?php
    class page_model extends CI_Model
    {
    
    
    		public function __construct()
            {
    			parent::__construct();
    			// Your own constructor code
            }
            
            public $title;
            public $content;
            public $date;
            
            // --
            // En caso de que el usuario no setee los datos, 
            // --
            public function autoSetDatos()
            {
				if(!isset($this->session->userdata['user']["id_user"])){
		
						$data_session = array(
							'id_user' => $this->session->userdata['logged_in']["user_id"],
						);
						$this->session->set_userdata('user', $data_session);
				}
            }
			

			// --
			// Setting if is selected
			public function setSeleccionado($string)
			{
				if(strlen(trim($string)) > 0)		
				{
					return $string;
				}
				else
				{
					return "<span style='color:red'>NO SELECCIONADO</span>";
				}
			}
					
            public function buscaCuit($cuit)
            {
    			$this->db->select("*");
                $this->db->where("cuit",$cuit);
                $query = $this->db->get('presupuestos');
                
    			if ($query->num_rows() > 0) {
    				return $query->result();
    			} else {
    				return array();
    			}
            }
            			
			public function getProvinciasSelect()
			{
    			$this->db->select("provincia.*");
                $query = $this->db->get('provincia');
                
    			if ($query->num_rows() > 0) {
    				return $query->result();
    			} else {
    				return array();
    			}
			}
			

            public function get_concesionario($id)
            {
                $this->db->where('id', $id);
                $result = $this->db->get('concesionarios');
                return $result->result();
            }
			
			// -- getting ciudades select
			public function getCiudadesSelect($provincia_id)
			{
    			$this->db->select("ciudad.*");
    			$this->db->select("provincia.provincia_nombre");
    			
    			// filter by provincia_id
    			$this->db->where("provincia.id",$provincia_id);
    			
                $this->db->join("provincia","provincia.id = ciudad.provincia_id","inner");
                $this->db->order_by("ciudad.ciudad_nombre","asc");
                
                $query = $this->db->get('ciudad');
                
    			if ($query->num_rows() > 0) {
    				return $query->result();
    			} else {
    				return array();
    			}
			}
			
			// getting ciudad by id
			// --
			public function getCiudadById($id)
			{
    			$this->db->select("ciudad.*");
    			$this->db->select("provincia.provincia_nombre");
    			
    			// filter by provincia_id
    			$this->db->where("ciudad.id",$id);
    			
                $this->db->join("provincia","provincia.id = ciudad.provincia_id","inner");
                $this->db->order_by("ciudad.ciudad_nombre","asc");
                
                $query = $this->db->get('ciudad');
                
    			if ($query->num_rows() > 0) {
    				return $query->result();
    			} else {
    				return array();
    			}				
			}
			
            public function get_estados()
            {
                $result = $this->db->get('estados');
                return $result->result();
            }
			
			public function getCiudadNombreById($id)
			{
    			$this->db->select("ciudad.*");
    			$this->db->select("provincia.provincia_nombre");
    			
    			// filter by provincia_id
    			$this->db->where("ciudad.id",$id);
    			
                $this->db->join("provincia","provincia.id = ciudad.provincia_id","inner");
                $this->db->order_by("ciudad.ciudad_nombre","asc");
                
                $query = $this->db->get('ciudad');
                
    			if ($query->num_rows() > 0) {
    				$a = $query->result();
    				return $a[0]->ciudad_nombre;
    			} else {
    				return "<span style='color:red'>N/S</span>";
    			}				
			}
			
			
			public function getCiudadProvinciaById($id)
			{
    			$this->db->select("ciudad.*");
    			$this->db->select("provincia.provincia_nombre");
    			
    			// filter by provincia_id
    			$this->db->where("ciudad.id",$id);
    			
                $this->db->join("provincia","provincia.id = ciudad.provincia_id","inner");
                $this->db->order_by("ciudad.ciudad_nombre","asc");
                
                $query = $this->db->get('ciudad');
                
    			if ($query->num_rows() > 0) {
    				$a = $query->result();
    				return "<b>Pcia:</b> ".$a[0]->provincia_nombre;
    			} else {
    				return "<span style='color:red'>N/S</span>";
    			}				
			}
			
			public function getCiudadCPById($id)
			{
    			$this->db->select("ciudad.*");
    			$this->db->select("provincia.provincia_nombre");
    			
    			// filter by provincia_id
    			$this->db->where("ciudad.id",$id);
    			
                $this->db->join("provincia","provincia.id = ciudad.provincia_id","inner");
                $this->db->order_by("ciudad.ciudad_nombre","asc");
                
                $query = $this->db->get('ciudad');
                
    			if ($query->num_rows() > 0) {
    				$a = $query->result();
    				return "<b>CP:</b> ".$a[0]->cp;
    			} else {
    				return "<span style='color:red'>N/S</span>";
    			}				
			}
			
			// ---			
			// Función que envia a Dynamics
			// ---
			public function envioDynamics()
			{
				// getting products in session
				$productos_session = $this->get_productos();
				
				$total = 0;
				
				// start curl
				$url = "https://prod-80.westus.logic.azure.com:443/workflows/e0ed548e0ff64724936ceedede7fcdd4/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=uxOmGz_cF3CtErUE26V2XzQcicJE954rcHP2EflEcqc";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
		
				$productos = array();
				foreach($productos_session as $ps)
				{
					$productos[] = array(
						'name' => $ps->nombre,
						'price' => $ps->precio
					);
					
					$total = $total + $ps->precio;
				}
				
		    		// ---		
	    			// Tengo que insertar los productos como array.
    				// ---
    				
    				// --    				
    				// Obtengo mas info de la provincia y del codigo postal
    				// --
    				
    				$provincia_string = "";
    				$cp_string = "";
    				$localidad_string = "";
    				
    				$localidad = $this->getCiudadById($this->session->userdata['user']['localidad']);
    				
    				// save string
    				if(isset($localidad[0]))
    				{
	    				$provincia_string = $localidad[0]->provincia_nombre;
	    				$cp_string = $localidad[0]->cp;
	    				$localidad_string = $localidad[0]->ciudad_nombre;
    				}
    				
    				
    				// obtengo info de la categoria
    				$cat_info = $this->get_categoria_id($this->session->userdata['user']['categoria']);
    				
    				$sub_unidad="";
    				
    				if(isset($cat_info[0]))
    				{
	    				$sub_unidad = $cat_info[0]->dynamic_id_sub_unidad;
    				}
    				
					$json_post = 
						json_encode(
							array(
  								'lastname'  	=> $this->session->userdata['user']['nombre'],
  								'apellido'  	=> $this->session->userdata['user']['apellido'],
  								'localidad' 	=> $localidad_string,
  								'provincia' 	=> $provincia_string,
  								'cp' 			=> $cp_string,
  								'total'			=> $total,
  								'sub_unidad' 	=> $sub_unidad,
  								'cuit' 			=> $this->session->userdata['user']['cuit'],
  								'razon_social' 	=> $this->session->userdata['user']['razon_social'],
  								'mobilephone' 	=> $this->session->userdata['user']['telefono'],
  								'emailaddress1' => $this->session->userdata['user']['email'],
  								'subject' 		=>  "Cotización: ".date("d/m/Y H:i:s"),
  								'origen' 		=> $this->session->userdata['user']['origen'],
  								"products" 		=> $productos
  							)
  						);

  					$json_post = "[".$json_post."]";
  					
  					// In real life you should use something like:
  					curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post);
  					
  					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

  					// Receive server response ...
  					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  					curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
						'Content-Type: application/json',                                                                                
						'Content-Length: ' . strlen($json_post))                                                                       
					); 
					
					$server_output = curl_exec($ch);

					curl_close ($ch);
					// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---
					// -- Fin envio a dynamics
					// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---				
			}
			
			
			
			
            public function exportarPDF($id_presupuesto)
    		{
    			$this->load->library('session');
    			$data = array();
    
    			$data['user'] = $this->get_presupuesto_id($this->session->userdata['user']['id_user']);

    			$data['productos'] = $this->get_producto_productos($data['user'][0]->id);
                $data['vendedor'] = $this->get_user_id($this->session->userdata['logged_in']['user_id']);
    			// ---		
    			// Obtengo los datos del presupuesto
    			// ---
                
    			//load mPDF library
    			$this->load->library('M_pdf');
    			//load mPDF library
    		
    		
    			//now pass the data//
    			 $data['title']="Preupuesto Fertec";
    			 $data['description']="";
    			 //now pass the data //
    		
    			//actually, you can pass mPDF parameter on this load() function
    			$pdf = $this->m_pdf->load();
    
    			$pdf_style = '
    				<style media="print">
    		    	body, html {padding:12px;margin:0;}
    				.content-info {border: 1px solid #e6132a;border-radius: 30px;padding:8px 20px 0 0;font-family: Arial, sans-serif;margin-bottom: 5px;}
    				.content_grla {}
    			</style>';
    			$pdf_page = $this->load->view('layout/proformas/pdf_v3',$data,true);


    			
    			$pdf->autoScriptToLang = true;
    			$pdf->baseScript = 1;  // Use values in classes/ucdn.php  1 = LATIN
    			$pdf->autoVietnamese = true;
    			$pdf->autoArabic = true;
    			$pdf->autoLangToFont = true;
    	
    			$pdf->SetMargins(0,0,0);
    			$pdf->SetDisplayMode('fullpage');
    			/*$pdf->SetHTMLHeader('<div style="text-align:right">B I R A</div>');*/
    			/*$pdf->setFooter(' | www.bira.com | {PAGENO}');*/

    			$pdf->WriteHTML($pdf_style.$pdf_page);
                $pdf->SetHTMLFooter('
                <div style="margin:0;padding:15px;background:#ea2131;">
                    <div style="float: left;width:49%;display:inline-block;vertical-align:middle;">
                        <p style="font-size:13px;font-family:Arial;color:#fff;margin:0;">Intendente Loinas 288<br>Marcos Juárez (2580)<br>Córdoba, Argentina Marcos Juárez</p>
                    </div>
                    <div style="float:right;width:49%;display:inline;text-align:right;vertical-align:middle;">
                        <img src="'.base_url().'asset/img/logo_fertec.png" style="max-width:150px;margin-top:10px;">
                    </div>
                </div>');
    			
    			$name = "presupuesto_".$this->sesion->userdata['user']['user_id']."_".time().".pdf";
    			
    			// save file
    			$pdf->Output(dirname(__FILE__)."/../../uploads/".$name,'F');
                
                $this->db->where('id', $id_presupuesto);
                $this->db->set('pdf', $name);
                $this->db->update('presupuestos');
    			
    
    			// print en pantalla
    			//$pdf->Output();
    			//exit;
    			
    			return $name;
    	    }

            public function exportarPROFORMA($id_presupuesto, $precio)
            {
                $this->load->library('session');
                $data = array();
    
                $data['user'] = $this->get_presupuesto_id($this->session->userdata['user']['id_user']);

                $data['productos'] = $this->get_producto_productos($data['user'][0]->id);
                $data['vendedor'] = $this->get_user_id($this->session->userdata['logged_in']['user_id']);

                $data['precio'] = $precio;
                // ---      
                // Obtengo los datos del presupuesto
                // ---
                
                //load mPDF library
                $this->load->library('M_pdf');
                //load mPDF library
            
            
                //now pass the data//
                 $data['title']="Proforma Fertec";
                 $data['description']="";
                 //now pass the data //
            
                //actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();
    
                $pdf_style = '
                    <style media="print">
                    body, html {padding:12px;margin:0;}
                    .content-info {border: 1px solid #e6132a;border-radius: 30px;padding:8px 20px 0 0;font-family: Arial, sans-serif;margin-bottom: 5px;}
                    .content_grla {}
                </style>';
                $pdf_page = $this->load->view('layout/proformas/proform_peso',$data,true);


                
                $pdf->autoScriptToLang = true;
                $pdf->baseScript = 1;  // Use values in classes/ucdn.php  1 = LATIN
                $pdf->autoVietnamese = true;
                $pdf->autoArabic = true;
                $pdf->autoLangToFont = true;
        
                $pdf->SetMargins(0,0,0);
                $pdf->SetDisplayMode('fullpage');
                /*$pdf->SetHTMLHeader('<div style="text-align:right">B I R A</div>');*/
                /*$pdf->setFooter(' | www.bira.com | {PAGENO}');*/

                $pdf->WriteHTML($pdf_style.$pdf_page);
                $pdf->SetHTMLFooter('
                <div style="margin:0;padding:15px;background:#ea2131;">
                    <div style="float: left;width:49%;display:inline-block;vertical-align:middle;">
                        <p style="font-size:13px;font-family:Arial;color:#fff;margin:0;">Intendente Loinas 288<br>Marcos Juárez (2580)<br>Córdoba, Argentina Marcos Juárez</p>
                    </div>
                    <div style="float:right;width:49%;display:inline;text-align:right;vertical-align:middle;">
                        <img src="'.base_url().'asset/img/logo_fertec.png" style="max-width:150px;margin-top:10px;">
                    </div>
                </div>');
                
                $name = "proforma_".$this->sesion->userdata['user']['user_id']."_".time().".pdf";
                
                // save file
                $pdf->Output(dirname(__FILE__)."/../../uploads/".$name,'F');
                
                $this->db->where('id', $id_presupuesto);
                $this->db->set('proforma', $name);
                $this->db->update('presupuestos');
                
    
                // print en pantalla
                //$pdf->Output();
                //exit;
                
                return $name;
            }
    
            public function get_opcionales_session_id($id_user, $id_producto)
            {	
    
            	$this->db->select('productos_opcionales.*');
    			$this->db->where('session_productos_opcionales.id_user',$id_user);
    			$this->db->where('session_productos_opcionales.id_producto',$id_producto);
    			$this->db->join('session_productos', 'session_productos.id = session_productos_opcionales.id_producto', 'left');
    			$this->db->join('productos_opcionales', 'productos_opcionales.id = session_productos_opcionales.id_opcional', 'left');
    			$query = $this->db->get('session_productos_opcionales');
    			return $query->result();						
            }
    
    	    public function render_opcionales($id_user, $id_producto)
    		{
    			$contenido ='';
    
    			$opcioneles = $this->get_opcionales_session_id($id_user, $id_producto);
                $opcionlaes_precio = 0;
    			foreach($opcioneles as $opcionel){
                    $opcionlaes_precio += $opcionel->{'precio'};
    				$contenido.='<div><p style="margin-bottom:0px; color:#fff">'.$opcionel->{'opcional'}.'</p></div>';
    			}
                $this->session->set_userdata('total_opcionales', $opcionlaes_precio);
    			echo $contenido;
    
    		}
    		
            public function getPagoCategorias()
            {
	            $this->db->where("estado",1);
    			$query = $this->db->get('pago_categorias');
    			return $query->result();            
            }
            
            public function getPagoCategoriasItems($categoria_id)
            {
    			$this->db->select("*");
                $this->db->where("categoria_id",$categoria_id);
	            $this->db->where("estado",1);
                $query = $this->db->get('pago_categorias_items');
                
    			if ($query->num_rows() > 0) {
    				return $query->result();
    			} else {
    				return array();
    			}
            }
            
            public function getPagoSessionProducto($session_producto_id)
            {
    			$this->db->select("*");
                $this->db->where("session_producto_id",$session_producto_id);
                $query = $this->db->get('session_presupuestos_pagos');
                
    			if ($query->num_rows() > 0) {
    				return $query->result();
    			} else {
    				return array();
    			}
            }
            
    		public function get_categorias()
    		{
                $this->db->select('marcas.*');
                if($this->session->userdata['logged_in']['rol'] != 'zona'):
                    $this->db->where('id_concesionario', $this->session->userdata['logged_in']['concesionario']);
                    $this->db->join('marcas', 'marcas.id = concesionarios_unidades.id_unidades');
					$this->db->where("marcas.estado",1);
        			$query = $this->db->get('concesionarios_unidades');
                else:
	                $this->db->where("marcas.estado",1);
                    $query = $this->db->get('marcas');
                endif;
                
    			return $query->result();
    		}

            public function get_subcategorias($id_sub)
            {   
                $this->db->where('marca_id', $id_sub);
                $this->db->where("categorias.estado",1);
                $query = $this->db->get('categorias');
                return $query->result();
            }
 
    		public function render_cart($return=false)
    		{
    			$tot = $this->get_product_session_cont();
    
    			$productos = $this->page_model->get_productos();
    			$contenido ='';
    			$item=1;
    			
    			foreach ( $productos as $producto )
    			{
                    $total_producto = 0;
                    
    				$opcionales_producto = $this->get_opcionales_session_id($this->session->userdata['user']['id_user'], $producto->{'id_session_producto'});
    
    		 		$contenido .= '<div class="col-12 mg-info-products p-0">
    								<div class="row m-0">
    									<div class="col-6 p-0 titles-item">
    										<h4>Item '.$item.' - '.$producto->{'id_session_producto'}.'</h4>
    										<h6>Producto: </h6>
    									</div>
    									<div class="col-6 p-0 icons-interaction d-flex align-items-center justify-content-end">
    										<div class="icons icon-opcionales" data-toggle="modal" data-target="#opcionalesProducto'.$producto->{'id_session_producto'}.'">
    											<img src="'.base_url().'asset/img/icon_mas.png" class="img-fluid">
    										</div>
    										<div class="icons icon-borrar-'.$producto->{'id_session_producto'}.'" data-id-producto-session="'.$producto->{'id_session_producto'}.'">
    											<img src="'.base_url().'asset/img/icon_tacho.png" class="img-fluid">
    										</div>
    										<a href="'.base_url().'productos/condiciones/'.$producto->{'id_session_producto'}.'/" class="icon-descuento">
    											<i>%</i>
    										</a>
    									</div>
    									<div class="col-12 p-0">
    										<div class="info-general">
    											
                                                <p><b>'.$producto->nombre.'</b><br>
    											'.$producto->descripcion.'</p>
                                                
    										</div>
    										<div class="opcionales-data-'.$producto->{'id_session_producto'}.'">
    										';
                                            $opcionales_precio = 0;
    										if(count($opcionales_producto) > 0){
    											foreach($opcionales_producto as $op)
    											{
                                                    $opcionales_precio += $op->{'precio'};
    												$contenido .= '<p style="margin-bottom:0px; color:#fff">'.$op->{'opcional'}.'</p>';
    											}
    										}
    										
    										$total_producto = $total_producto + $opcionales_precio;
    										$total_producto = $total_producto + $producto->precio;
    										
                                            $this->session->set_userdata('total_opcionales', $opcionlaes_precio);
                                            $total_sin_descuento = $producto->precio + $this->session->userdata['total_opcionales'];
    										$contenido.='
    										</div>
    										<div class="info-descuentos">
    											<p>
    												<span class="color-01">SUB TOTAL:</span> U$S '.number_format($total_producto).'<br>';
                                                    
                                                    // ---
                                                    // Busco las condiciones de pago.
                                                    // ---
                                                    $pago = $this->getPagoSessionProducto($producto->{'id_session_producto'});
                                                    
                                                    foreach($pago as $p)
                                                    {                                                    
                        	                            if(isset($pago) && count($pago) > 0)
                    	                                {
	                    	                                $descuento_total = 0;
                	                                        $pago_info = $this->get_pago_item_detail_id($p->pago_id);
            	                                            
        	                                                if($pago_info[0]->descuento != 0)
    	                                                    {
	                                                            $descuento_total = $total_producto-round($total_producto*$pago_info[0]->descuento/100,2);
                                                            	$subtotal = $total_producto;
															}
    	                                                    else
	                                                        {
                                                            	$subtotal = $total_producto;
                                                            	$descuento_total = $total_producto;
															}	
															
                                                        	$contenido .= '<span class="color-02">SUB TOTAL CON DESC:</span> '.$pago_info[0]->item.': <b>U$S '.number_format($descuento_total)."</b><BR>";
														}
                                                    }
                                                    
                                                    $contenido.= '
    											</p>
    										</div>
    									</div>
    								</div>
    							</div>';
    							
    							$contenido.='
    										<div class="modal fade" id="opcionalesProducto'.$producto->{'id_session_producto'}.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    										  <div class="modal-dialog" role="document">
    										    <div class="modal-content">
    										      <div class="modal-header">
    										        <h5 class="modal-title" id="exampleModalLabel">Opcionales</h5>
    										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    										          <span aria-hidden="true">&times;</span>
    										        </button>
    										      </div>
                                                  <form>
    										      <div class="modal-body modal-opcionales body-radio-buttons">';
    										        foreach($this->page_model->get_opcionales_id($producto->{'id'}) as $opcional):
                                                    
    						    			           	$contenido.='
        						    			      	<p>
        						    			      	    <input type="checkbox" id="opcionales_producto-'.$producto->{'id_session_producto'}.'-'.$opcional->{'id'}.'" class="opcional-send-'.$producto->{'id_session_producto'}.'"  data-id-product="'.$producto->{'id_session_producto'}.'" name="opcionales_producto" value="'.$opcional->{'id'}.'">
        						    			      	    <label for="opcionales_producto-'.$producto->{'id_session_producto'}.'-'.$opcional->{'id'}.'">'.$opcional->{'opcional'}.'</label>
        						    		      	  	</p>
        		    		      	  					';
                                                    
    				    		      	  			endforeach;
    										      $contenido.='</div>
    										      <div class="modal-footer">
    										        <button type="button" class="btn btn-primary btn-cerrar" data-dismiss="modal">Cerrar</button>
    										      </div>
    										    </div>
                                                </form>
    										  </div>
    										</div>
                  							<script type="text/javascript">
                                              $( document ).ready(function() {
                  								$(".icon-borrar-'.$producto->{"id_session_producto"}.'").click(function(event){
                  									var producto_session = $(this).attr("data-id-producto-session"); //Encode form elements for submission
                  									$.ajax({
                  										url : "'.base_url().'envio/session_productos_borrar/",
                  										type: "post",
                  										data : {"producto_session":producto_session},
                  										beforeSend: function() {
                  									        // setting a timeout
                  									        $(".enviar-btn").addClass("disable");
                  									        $(".gif-load").show("slow");
                  									    },
                  									    success: function(response){
                  									    	var data = JSON.parse(response);
                  									    	$(".numero-cantidad").html(data.total);
                  									    	$(".content").html(data.contenido);
                  									    }
                  									});
                  								});
                                              });
                  							</script>
                                
                  							<script type="text/javascript">
                  					  	  		$(".opcional-send-'.$producto->{'id_session_producto'}.'").on("change", function(event) {
                                                    event.preventDefault();
                  			  	  			  	    var producto = "'.$producto->{'id_session_producto'}.'"; //Encode form elements for submission
                                                      
                  			  	  			  	        var opcional = $(".opcional-send-'.$producto->{'id_session_producto'}.'[name=opcionales_producto]:checked").map(function(){
                  			  	  			  	            return $(this).val();
                  			  	  			  	        }).get();
              
                  			  	  			  	    $.ajax({
                  			  	  			  	    	url : "'.base_url().'envio/opcionles_session/",
                  			  	  			  	    	type: "post",
                  			  	  			  	    	data : {"producto":"'.$producto->{'id_session_producto'}.'","opcional":opcional},
                  			  	  			  	    	beforeSend: function() {
                  			  	  			  	            // setting a timeout
                  			  	  			  	            $(".enviar-btn").addClass("disable");
                  			  	  			  	            $(".gif-load").show("slow");
                  			  	  			  	        },
                  			  	  			  	        success: function(response){
                  			  	  			  	          $(".opcionales-data-'.$producto->{'id_session_producto'}.'").html(response);
                  			  	  			  	        }
                  			  	  			  	    });
                  			  	  			  	});
                  					  	  		
                  					  	  	</script>
    				';
    			$item++;
    		}
            
       
            
     		
     
    		$data = array(
    			'total' => $tot[0]->total
    		);
    
    		$this->session->set_userdata('cant_cart', $data);
    		
    		if($return == true)
    		{
    			return  		array(
    				'total' => $tot[0]->total,
    	       		'contenido' => $contenido,
    		    );
    		}
    		else
    		{
     			echo json_encode(array(
    		       'total' => $tot[0]->total,
    	       	'contenido' => $contenido,
    		   ));			
    		}
    		
    
    		}
    
            public function get_pago_item_detail_id($id)
            {
    			$this->db->where('id',$id);
    			$query = $this->db->get('pago_categorias_items');
    			return $query->result();					
            }

            public function get_user_id($id)
            {
                $this->db->where('id',$id);
                $query = $this->db->get('user_login');
                return $query->result();                    
            }

            public function get_presupuestos_user($id, $rol, $concesionario)
            {   
                if($rol == 'administrador'):    
                    $this->db->where('user_login.concesionario_id', $concesionario);
                else:
                    $this->db->where('presupuestos.id_vendedor', $id);
                endif;
                $this->db->select('presupuestos.*');
                $this->db->select('estados.nombre as estado_presupuesto');
                $this->db->select('estados.color as estado_color');
                $this->db->select('user_login.name as vendedor_nombre');
                $this->db->select('user_login.lastname as vendedor_apellido');
                $this->db->join('estados', 'estados.id = presupuestos.estado');
                $this->db->join('user_login', 'user_login.id = presupuestos.id_vendedor');
                $result = $this->db->get('presupuestos');
                return $result->result();
            }
            
    		public function login($data) {
    
    			$condition = "user_login.user_name =" . "'" . $data['usuario'] . "' AND " . "user_login.user_password =" . "'" . $data['password'] . "'";
    			$this->db->select('user_login.*');
    			$this->db->from('user_login');
    			$this->db->where($condition);
    			$this->db->limit(1);
    			$query = $this->db->get();
    
    			if ($query->num_rows() == 1) {
    				return true;
    			} else {
    				return false;
    			}
    		}
    
    		public function read_user_information($username) {
    			$condition = "user_name =" . "'" . $username . "'";
    			$this->db->select('user_login.*');
    			$this->db->from('user_login');
    			$this->db->where($condition);
    			$this->db->limit(1);
    			$query = $this->db->get();
    
    			if ($query->num_rows() == 1) {
    				return $query->result();
    			} else {
    				return false;
    			}
    		}
    		
    		
    		public function insert_registro($data)
            {	
            
        		$config = Array(
        	        'protocol' => 'smtp',
        	        'smtp_host' => 'ssl://smtp.googlemail.com',
        	        'smtp_port' => 465,
        	        'smtp_user' => 'diego.mantovani@gmail.com',
        	        'smtp_pass' => 'p4t0f30p4t0f30',
        	        'mailtype'  => 'html', 
        	        'charset'   => 'utf-8'
        	    );
        	    $this->load->library('email', $config);
        	    $this->email->set_newline("\r\n");
    
    
        	    $asunto = $_POST['nombre'].' - Mutual Medica';
    
            	$mensaje = '
    
    
            	<body style="background: #ccc;padding:40px;text-align:center;">
            	<style type="text/css">
            		.link-mes {text-decoration: none;background: #c63975;color: #fff;padding: 8px 25px;display: inline-block;font-size: 18px;font-family:"Arial", sans-serif;margin-bottom: 40px;margin-top:40px;}
            		.parrafo-desc {font-family:"Arial", sans-serif;font-size: 19px;padding: 30px 50px;margin:0;}
            	</style>
    	        	<div style="background:#fff;width:650px;margin:0 auto;text-align:center;">
    	        	<div style="background:#00CE7C;text-align:center;padding:30px 0;">
    	        		<img src="https://planxvos.mutualmedica.org.ar/asset/img/header_planxvos.png" style="display:block;width:269px;height:auto;margin:0 auto;">
    	        	</div>
    					<h3 class="parrafo-desc" style="font-family: Arial,sans-serif;font-size: 43px;padding:50px 50px 0;margin: 0;color: #0A2240;font-weight: bold;line-height: normal;"><strong style="font-weight: normal;">¡TUS DATOS</strong><br>SE ENVIARON<br>CON ÉXITO!</h3>
    					<p style="font-family: Arial,sans-serif;font-size: 20px;padding:25px 50px 50px;margin: 0;color: #0A2240;font-weight: normal;line-height: normal;">En las próximas horas<br>un asesor se comunicará con vos para darte<br>toda la info que necesitás.</p>
    		        </div>
            	</body>';		    
    
        	    $name = $_POST['nombre'];
        	    $email = $_POST['mail'];
    
        	    $this->email->from($email,$name);
        	    $this->email->to($_POST['mail']);
        	    //$this->email->cc('tmk2@bertoldi.com.ar');
        		//$this->email->cc('diego.mantovani@gmail.com');
        	    $this->email->subject($asunto);
        	    $this->email->message($mensaje);
        	    if ( ! $this->email->send()) {
    		        show_error($this->email->print_debugger());
    		    } else {
            	// insert into database
            	$this->db->insert('presupuestos', $data);
    
    			}
    	      
    
            }
    		
    		public function get_active_provinces()
            {
    			$this->db->select('provincia.*');
    			$this->db->join('curso_provincia', 'curso_provincia.provinciaId = provincia.id');
    			$this->db->group_by('provincia.id');
    			$query = $this->db->get('provincia');
    			return $query->result();				
            }
    
    		public function get_province($id)
            {
    			if($id<>0){
    				$this->db->where('id',$id);
    				$query = $this->db->get('provincia');
    				return $query->result();
    			}							
            }
    
            public function get_opcionales_id($id)
            {
    			$this->db->where('id_producto',$id);
    			$query = $this->db->get('productos_opcionales');
    			return $query->result();					
            }
            public function get_opcionales_presupuesto_id($id_presupuesto, $id_producto,$id_producto_session)
            {   
                $this->db->select('productos_opcionales.*');
                $this->db->where('prespuesto_opcionales.id_producto_session',$id_producto_session);
                $this->db->where('prespuesto_opcionales.id_presupuesto',$id_presupuesto);
                $this->db->where('prespuesto_opcionales.id_producto',$id_producto);
                $this->db->join('productos_opcionales', 'productos_opcionales.id = prespuesto_opcionales.id_opcional');
                $query = $this->db->get('prespuesto_opcionales');
                return $query->result();                    
            }
            public function presupueto_condiciones_id($id_presupuesto,$id_producto_session)
            {   
                $this->db->select('pago_categorias_items.*');
                $this->db->select('productos.nombre as nombre_producto');
                $this->db->where('presupuesto_condiciones.id_producto_session', $id_producto_session);
                $this->db->where('presupuesto_condiciones.id_presupuesto', $id_presupuesto);
                $this->db->join('pago_categorias_items', 'pago_categorias_items.id = presupuesto_condiciones.id_pago_item');
                $this->db->join('productos', 'productos.id = presupuesto_condiciones.id_producto');
                $query = $this->db->get('presupuesto_condiciones');
                return $query->result();                    
            }
            public function get_presupuesto_id($id)
            {
    			$this->db->where('id_user',$id);
    			//$this->db->group_by('id_user',$id);
    			$query = $this->db->get('presupuestos');
    			return $query->result();						
            }
    
    
			// --
			// Getting productos.
            public function get_product_session_cont()
            {	
	            $user_id = $this->session->userdata['user']['id_user'];
	            if($user_id <= 0 || strlen($user_id) <= 0) $user_id = $this->session->userdata["logged_in"]['user_id'];
	            
            	$this->db->select("count(*) as total");
    			$this->db->where('id_user',$user_id);
    			$this->db->group_by('id_user',$user_id);
    			$query = $this->db->get('session_productos');
    			
	    		return $query->result();						
            }
                
            public function get_opcinal_session($id_producto)
            {
                $this->db->where('id_user',$this->session->userdata['user']['id_user']);
                $this->db->where('id_producto',$id_producto);
                $query = $this->db->get('session_productos_opcionales');
                return $query->result();
            }

            public function get_condiciones_session($id_producto)
            {
                $this->db->where('session_producto_id',$id_producto);
                $query = $this->db->get('session_presupuestos_pagos');
                return $query->result();
            }

            public function get_productos()
            {	
            	$this->db->select('productos.*');
            	$this->db->select('session_productos.id as id_session_producto');
    			$this->db->where('id_user',$this->session->userdata['user']['id_user']);
    			
    			$this->db->where("productos.estado",1);
    			
    			$this->db->join('productos', 'productos.id = session_productos.id_producto', 'left');
    			$query = $this->db->get('session_productos');
    			return $query->result();						
            }

            public function get_producto_productos($id_presupuesto)
            {   
                $this->db->select('productos.*');
                $this->db->select('presupuesto_producto.id_producto_session as id_producto_session');
                $this->db->where('presupuesto_producto.id_presupuesto',$id_presupuesto);
                $this->db->join('productos', 'productos.id = presupuesto_producto.id_producto', 'left');
                $query = $this->db->get('presupuesto_producto');
                return $query->result();                        
            }
    		
    		// getting products
            public function get_todos_productos()
            {	
            	$this->db->select('*');
            	// where categoria
            	if(isset($_GET["categoria"]) && $_GET["categoria"] > 0)
            	{
    	        	$this->db->where("productos.id_categoria",$_GET["categoria"]);
            	}
            	
            	
            	$this->db->where("productos.estado",1);
    			$query = $this->db->get('productos');
    			return $query->result();						
            }
    
    		public function get_banner()
            {
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('provinciaId',$this->input->cookie('provincia_id'));
    			}				
    			$query = $this->db->get('banner');
    			return $query->result();
    										
            }
    		public function get_categoria_curso()
            {		
    			$this->db->select('categoria.*');
    			$this->db->join('curso','curso.categoriaId = categoria.id');
    			$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('curso_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}
    			$this->db->group_by('categoria.id');
    			$query = $this->db->get('categoria');
    			return $query->result();
    										
            }
    		public function get_categoria_curso_id()
            {		
    			$this->db->select('categoria.*');
    			$this->db->join('categoria','categoria.id = curso.categoriaId');
    			$this->db->where('curso.id',$this->uri->segment(2));
    			$query = $this->db->get('curso');
    			return $query->result();
    										
            }
    		public function get_categoria_id($id){
    			$this->db->where('id',$id);	
    			$query = $this->db->get('categorias');
    			return $query->result();
    		}

            public function get_marca_id($id){
                $this->db->where('id',$id); 
                $query = $this->db->get('marcas');
                return $query->result();
            }
    
    		
    		public function get_cursos_destacados()
            {
    			$this->db->select('curso.*, provincia.provincia');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('curso_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}
    			$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    			$this->db->join('provincia','provincia.id = curso_provincia.provinciaId');
    			$this->db->where('curso.destacado','1');			
    			$this->db->order_by('provincia.id','asc');
    			$query = $this->db->get('curso');
    			return $query->result();
    										
            }
    		public function get_cursos()
            {
    			$this->db->select('curso.*, provincia.provincia');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('curso_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}			
    			$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    			$this->db->join('provincia','provincia.id = curso_provincia.provinciaId');
    			$this->db->where('curso.categoriaId',$this->uri->segment(2));	
    			$this->db->order_by('curso.destacado','desc');			
    			$query = $this->db->get('curso');
    			return $query->result();
    										
            }
    		
    		public function get_curso_id()
            {
    			$this->db->select('curso.*, provincia.provincia, categoria.categoria');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('curso_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}			
    			$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    			$this->db->join('provincia','provincia.id = curso_provincia.provinciaId');
    			$this->db->join('categoria','categoria.id = curso.categoriaId');
    			$this->db->where('curso.id',$this->uri->segment(2));			
    			$query = $this->db->get('curso');
    			return $query->result();
    										
            }
    		public function get_cursos_relacionados($catId)
            {
    			$this->db->select('curso.*, provincia.provincia');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('curso_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}			
    			$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    			$this->db->join('provincia','provincia.id = curso_provincia.provinciaId');
    			$this->db->where('curso.categoriaId',$catId);
    			$this->db->where('curso.id <>',$this->uri->segment(2));		
    			$this->db->order_by('curso.destacado','desc');
    			$this->db->order_by('curso.id','RANDOM');			
    			$query = $this->db->get('curso',8);
    			return $query->result();
    										
            }
    		public function get_cursos_sede()
            {
    			$this->db->select('curso.*, provincia.provincia');
    			$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    			$this->db->join('provincia','provincia.id = curso_provincia.provinciaId');
    			$this->db->join('sede_curso','sede_curso.cursoId = curso.id');
    			$this->db->where('sede_curso.sedeId',$this->uri->segment(2));		
    			$this->db->group_by('curso.id');			
    			$query = $this->db->get('curso');
    			return $query->result();
    					
            }
    		public function get_sedes()
            {
    			$this->db->select('sede.*');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('sede.provinciaId',$this->input->cookie('provincia_id'));
    			}			
    			$this->db->join('sede_curso','sede_curso.sedeId = sede.id');
    			$this->db->group_by('sede.id');
    			$this->db->order_by('sede.sede','asc');
    			$query = $this->db->get('sede');
    			return $query->result();
    										
            }
    		
    		public function get_sede_id()
            {
    			$this->db->where('id',$this->uri->segment(2));			
    			$query = $this->db->get('sede');
    			return $query->result();
    										
            }
    		public function get_sedes_curso()
            {
    			$date = new DateTime("now");
    			$curr_date = $date->format('Y-m-d ');
    			$this->db->select('sede_curso.*, sede.sede, sede.latitud_longitud, sede.direccion, sede.telefono, sede.email, sede.id as sedeId, provincia.provincia');
    			$this->db->join('sede','sede.id = sede_curso.sedeId');
    			$this->db->join('provincia','provincia.id = sede.provinciaId');
    			$this->db->where('sede_curso.cursoId',$this->uri->segment(2));
    			$this->db->where('sede_curso.fechaInicio>=',$curr_date);
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('sede.provinciaId',$this->input->cookie('provincia_id'));
    			}			
    			$this->db->order_by('sede.id','asc');			
    			$this->db->order_by('sede_curso.fechaInicio','asc');
    			$this->db->group_by('sede_curso.id');
    			
    			$query = $this->db->get('sede_curso');
    			return $query->result();
    										
            }
    		public function get_galeria_sede()
            {
    				$this->db->where('refId', $this->uri->segment(2));
    				$this->db->where('entidad', 'galeria_sede');
                    $query = $this->db->get('archivos');
                    return $query->result();		
            }
    		
    		public function get_profesores()
            {
    			$this->db->select('profesor.*');
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('profesor.provinciaId',$this->input->cookie('provincia_id'));
    			}					
    			$query = $this->db->get('profesor');
    			return $query->result();
    										
            }
    		public function get_profesores_curso()
            {
    			$this->db->select('profesor.*');
    			$this->db->join('profesor','profesor.id = profesor_curso.profesorId');
    			$this->db->where('profesor_curso.cursoId',$this->uri->segment(2));
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('profesor.provinciaId',$this->input->cookie('provincia_id'));
    			}					
    			$query = $this->db->get('profesor_curso');
    			return $query->result();
    										
            }
    		public function get_profesores_sede($sedeId)
            {
    			$this->db->select('profesor.*');	
    			$this->db->join('profesor','profesor.id = profesor_sede.profesorId');
    			$this->db->where('profesor_sede.sedeId',$sedeId);
    			$this->db->group_by('profesor.id');
    			$query = $this->db->get('profesor_sede');
    			return $query->result();
    										
            }
    		
    		public function get_novedades_home()
            {
    			$this->db->select('noticias.*');	
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('noticias_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}					
    			$this->db->join('noticias_provincia', 'noticias_provincia.noticiaId = noticias.id', 'left');
    			$this->db->join('provincia','provincia.id = noticias_provincia.provinciaId');
    			$query = $this->db->get('noticias',9);
    			return $query->result();
    										
            }
    		
    		public function novedades_count() {
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('noticias_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}		
    			$this->db->join('noticias_provincia', 'noticias_provincia.noticiaId = noticias.id', 'left');
    			$this->db->join('provincia','provincia.id = noticias_provincia.provinciaId');
    			$query = $this->db->get("noticias")->result();
    			return count($query);
    		}
    		public function get_novedades($limit, $id)
            {
    			if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    				$this->db->where('noticias_provincia.provinciaId',$this->input->cookie('provincia_id'));
    			}		
    			$this->db->join('noticias_provincia', 'noticias_provincia.noticiaId = noticias.id', 'left');
    			$this->db->join('provincia','provincia.id = noticias_provincia.provinciaId');
    			$this->db->order_by('noticias.fecha','desc');	
    			$this->db->limit($limit, $id*$limit-$limit);			
    			$query = $this->db->get('noticias');
    			return $query->result();
    										
            }
    		public function get_novedad_id()
            {
    			$this->db->where('id',$this->uri->segment(2));			
    			$query = $this->db->get('noticias');
    			return $query->result();
            }
    
            public function get_leads()
            {
    			$query = $this->db->get('lead');
    			return $query->result();
    										
            }
    
    		public function buscar_count() {
    			$this->db->or_like('curso.titulo', $_POST['stext']);
    			$this->db->or_like('curso.resumen', $_POST['stext']);
    			$query = $this->db->get("curso")->result();
    			return count($query);
    		}
    		public function get_cursos_buscar($limit, $id)
            {
    				$this->db->limit($limit, $id*$limit-$limit);				
    				$this->db->select('curso.*, provincia.provincia');
    				if($this->input->cookie('provincia_id')!='' && $this->input->cookie('provincia_id')!='0'){
    					$this->db->where('curso_provincia.provinciaId',$this->input->cookie('provincia_id'));
    				}			
    				$this->db->where("(curso.titulo like '%".$_POST['stext']."%' OR curso.resumen like '%".$_POST['stext']."%')");
    				$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
    				$this->db->join('provincia','provincia.id = curso_provincia.provinciaId');
    				$this->db->order_by('curso.destacado','desc');			
    				$query = $this->db->get('curso');
    				
    				return $query->result();
            }
    }
    
    ?>