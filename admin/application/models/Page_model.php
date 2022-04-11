<?php

class page_model extends CI_Model
{


		public function __construct()
        {
			parent::__construct();
			// Your own constructor code
        }
		

		
		public function getCondicionByDynamicId($dynamic_id)
		{
			$this->db->where('id_dynamics', $dynamic_id);
	        $query = $this->db->get('pago_categorias_items');
			return $query->result();
		}
		        
		public function getCondicionCategoryByDynamicId($dynamic_id)
		{
			$this->db->where('id_dynamics', $dynamic_id);
	        $query = $this->db->get('pago_categorias');
			return $query->result();
		}
		
		
		public function get_all()
		{
			$url = "https://prod-138.westus.logic.azure.com:443/workflows/a926b479d44747faa34cb4621eebf770/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=jitQfvKmPXogVzHQS_o-mVbteoRrCTt6BStQuJJo7v0";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$json_post = json_encode( array( 'id'  	=> rand()) );
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
			return json_decode($server_output);
			
		}
	

		public function get_productos_dynamics()
		{
//			ini_set('display_errors', 1);
//			ini_set('display_startup_errors', 1);
//			error_reporting(E_ALL);
			
			$url = "https://prod-116.westus.logic.azure.com:443/workflows/c367fc4056ee4e18b2c01a1358e2b74b/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=rsTPwHO3WH_JpdxxuMVmNNz7IZm-oCJ2KwghhbrwqXU";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$json_post = json_encode( array( 'id'  	=> rand()) );
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
			return json_decode($server_output);
		}



		// --
		// Actualizo lista de precios
		// --		
		public function get_precios_dynamics()
		{
//			ini_set('display_errors', 1);
//			ini_set('display_startup_errors', 1);
// 			error_reporting(E_ALL);

			
			$url = "https://prod-58.westus.logic.azure.com:443/workflows/5d38768f317745c796547a7570213c8d/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=npelKiU0Fec7HeOyLcXqNch-lFQl4WZSUweDFLlpNws";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$json_post = json_encode( array( 'id'  	=> rand()) );
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
			return json_decode($server_output);			
		}
		
		
		public function get_condiciones_categorias_dynamics()
		{
			$url = "https://prod-35.westus.logic.azure.com:443/workflows/12cac9502a4e4d35937fd90fee0fe10e/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=V5AHCBwOeV-zkx_D0GvR3NriK4HyhcQRlbLJ-Qdwzl0";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$json_post = json_encode( array( 'id'  	=> rand()) );
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
			return json_decode($server_output);	
		}
		
		public function get_condiciones_dynamics()
		{
//			ini_set('display_errors', 1);
//			ini_set('display_startup_errors', 1);
// 			error_reporting(E_ALL);

			
			$url = "https://prod-124.westus.logic.azure.com:443/workflows/4f91d0ffd03e4f6fbc8ea99090885f30/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=zcZmwUpPbgWup7ieoaYCNGljafD_fPn9R9FtePFdWEU";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$json_post = json_encode( array( 'id'  	=> rand()) );
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
			return json_decode($server_output);			
		}
		
		
		//
		public function get_mail_asignado($email)
		{
			$this->db->select("*");
			$this->db->where("email",$email);
			$this->db->where("vendedor_id > 0");
			$query = $this->db->get('presupuestos');
            
            $presupuesto = $query->result();
            
            if(isset($presupuesto[0]->vendedor_id) && $presupuesto[0]->vendedor_id > 0)
            {
            	return $this->get_vendedor_name_by_id($presupuesto[0]->vendedor_id);
            }
			
			return false;            
		}

        public function get_zonas_usuarios($id_usuario)
        {      

            $this->db->where('id_usuario', $id_usuario);
            $this->db->select('id_concesionario');
            $result = $this->db->get('zonas');
            return $result->result();
        }


		public function insert_registro($data)
        {	
        
        	// insert into database
        	$this->db->insert('presupuestos', $data);
        }
		


		public function add_evento($data)
        {
            $this->db->insert('presupuestos_eventos', $data);
        }
        
        public function log_eventos($presupuesto_id)
        {
				$this->db->select("presupuestos_eventos.*");
				$this->db->select("pe.estado");
				$this->db->select("pe.color");
				
                $this->db->where("presupuesto_id",$presupuesto_id);
                
                $this->db->join("presupuestos_estados pe","pe.id = presupuestos_eventos.estado_id","inner");
                $this->db->order_by("presupuestos_eventos.added_at","desc");
                
                $query = $this->db->get('presupuestos_eventos');
                return $query->result();
        }
		
		public function get_presupuestos($email)
        {
        		$this->db->select("(select count(*) as eventos from presupuestos_eventos where presupuestos_eventos.presupuesto_id = presupuestos.id) as eventoskount");
				$this->db->select('presupuestos.*');
				$this->db->select("pe.estado");
				$this->db->select("pe.color");
				$this->db->select("user_login.name as user_name");
				$this->db->select("user_login.lastname as user_lastname");
				$this->db->select("motivos.nombre as motivo_nombre");
//				$this->db->select("productos.nombre as nombre_producto");
				
//				$this->db->select("vend.nombre as inspector");

//				$this->db->select("distancia_entre_hileras.modelo as modelo");
				$this->db->select("'' as modelo2");
				
//				$this->db->join("productos","productos.id = presupuestos.producto_id","left");
//				$this->db->join("distancia_entre_hileras","distancia_entre_hileras.id = presupuestos.distancia_hileras_id","left");
				
				$this->db->join("user_login","user_login.id = presupuestos.vendedor_id","left");
				$this->db->join("presupuestos_estados pe","pe.id = presupuestos.estado_id","left");
				
				// joineo inspector.
//				$this->db->join("consecionarios con","con.id = user_login.consecionario_id","inner");
//				$this->db->join("vendedores vend","vend.id = con.vendedor_agrometal");
				
				/*
				if(isset($_POST["desde"]) && strlen($_POST["desde"]) > 0)
				{
					$this->db->where("presupuestos.added_at >= ".strtotime($_POST["desde"]));
				}
				
				if(isset($_POST["hasta"]) && strlen($_POST["hasta"]) > 0)
				{
					$this->db->where("presupuestos.added_at <= ".strtotime($_POST["hasta"]));
				}
				
				if(isset($_POST["estado"]) && $_POST["estado"] > 0)
				{
					$this->db->where("presupuestos.estado_id",$_POST["estado"]);
				}
				*/
				
				
				if(isset($email) && strlen($email) >= 0)
				{
					$this->db->where("presupuestos.email",$email);
				}
				/*
                if($this->session->userdata['logged_in']['rol_id']==5)
                {
                    $this->db->where("presupuestos.vendedor_id",$this->session->userdata['logged_in']['id']);
                }
                
                if($this->session->userdata['logged_in']['rol_id']==2)
                {
    				$this->db->where("vend.user_id",$this->session->userdata['logged_in']['id']);
                }
				*/
				
				//if($this->session->userdata['logged_in']['administrator']==0)
				//{
				//	$this->db->where("presupuestos.vendedor_id",$this->session->userdata['logged_in']['id']);
				//}
				
				$this->db->join("motivos","motivos.id = presupuestos.motivo_id","left");
				

				$this->db->group_by("presupuestos.id");
				
				$query = $this->db->get('presupuestos');
                return $query->result();
        }
        
		public function get_presupuestos_sin_asignar($email)
        {
        		$this->db->select("(select count(*) as eventos from presupuestos_eventos where presupuestos_eventos.presupuesto_id = presupuestos.id) as eventoskount");
				$this->db->select('presupuestos.*');
				$this->db->select("pe.estado");
				$this->db->select("pe.color");
				$this->db->select("user_login.name as user_name");
				$this->db->select("user_login.lastname as user_lastname");
				$this->db->select("motivos.nombre as motivo_nombre");
//				$this->db->select("productos.nombre as nombre_producto");
				
//				$this->db->select("vend.nombre as inspector");

//				$this->db->select("distancia_entre_hileras.modelo as modelo");
				$this->db->select("'' as modelo2");
				
//				$this->db->join("productos","productos.id = presupuestos.producto_id","left");
//				$this->db->join("distancia_entre_hileras","distancia_entre_hileras.id = presupuestos.distancia_hileras_id","left");
				
				$this->db->join("user_login","user_login.id = presupuestos.vendedor_id","left");
				$this->db->join("presupuestos_estados pe","pe.id = presupuestos.estado_id","left");
				if($this->session->userdata['logged_in']['rol_id'] != 0){
					$this->db->where("vendedor_id is null");
				}
				
				// joineo inspector.
//				$this->db->join("consecionarios con","con.id = user_login.consecionario_id","inner");
//				$this->db->join("vendedores vend","vend.id = con.vendedor_agrometal");
				
				/*
				if(isset($_POST["desde"]) && strlen($_POST["desde"]) > 0)
				{
					$this->db->where("presupuestos.added_at >= ".strtotime($_POST["desde"]));
				}
				
				if(isset($_POST["hasta"]) && strlen($_POST["hasta"]) > 0)
				{
					$this->db->where("presupuestos.added_at <= ".strtotime($_POST["hasta"]));
				}
				
				if(isset($_POST["estado"]) && $_POST["estado"] > 0)
				{
					$this->db->where("presupuestos.estado_id",$_POST["estado"]);
				}
				*/
				
				
				if(isset($email) && strlen($email) >= 0)
				{
					$this->db->where("presupuestos.email",$email);
				}
				/*
                if($this->session->userdata['logged_in']['rol_id']==5)
                {
                    $this->db->where("presupuestos.vendedor_id",$this->session->userdata['logged_in']['id']);
                }
                
                if($this->session->userdata['logged_in']['rol_id']==2)
                {
    				$this->db->where("vend.user_id",$this->session->userdata['logged_in']['id']);
                }
				*/
				
				//if($this->session->userdata['logged_in']['administrator']==0)
				//{
				//	$this->db->where("presupuestos.vendedor_id",$this->session->userdata['logged_in']['id']);
				//}
				
				$this->db->join("motivos","motivos.id = presupuestos.motivo_id","left");
				

				$this->db->group_by("presupuestos.id");
				
				$query = $this->db->get('presupuestos');
                return $query->result();
        }
		
        public function get_presupuestos_estados()
        {
			 $this->db->select('*');
			 $this->db->order_by("id","asc");
			 $query = $this->db->get('presupuestos_estados');
             return $query->result();  
        }
        
		
        public function login($data) {

			$condition = "user_login.user_name =" . "'" . $data['username'] . "' AND " . "user_login.user_password =" . "'" . $data['password'] . "'";
			$this->db->select('user_login.*');
			//$this->db->join('provincia', 'provincia.id = user_login.provinciaId', 'left');
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
		public function checkuser($user) {

			$condition = "user_name =" . "'" . $user . "'";
			$this->db->select('*');
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

			// Read data from database to show data in admin page
		public function read_user_information($username) {
			$condition = "user_name =" . "'" . $username . "'";
			$this->db->select('user_login.*');
			//$this->db->join('provincia', 'provincia.id = user_login.provinciaId', 'left');
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
			
		public function get_banners()
        {
				$this->db->select('banner.*, provincia.provincia');
				if($this->session->userdata['logged_in']['administrator']==0){
					$this->db->where('sede.provinciaId',$this->session->userdata['logged_in']['provinciaId']);
				}
				$this->db->join('provincia', 'provincia.id = banner.provinciaId', 'left');
                $query = $this->db->get('banner');
                return $query->result();
        }

        public function get_productos_backend()
        {
            $this->db->select("productos.*");
            $this->db->select("categorias.categoria");
            $this->db->select("marcas.nombre as marca");
            
            $this->db->join("categorias","categorias.id = productos.id_categoria","LEFT");
            $this->db->join("marcas","marcas.id = categorias.marca_id","LEFT");
            
            $query = $this->db->get('productos');
            return $query->result();
        }
        
        public function get_productos()
        {
            $this->db->select("productos.*");
            $this->db->select("categorias.categoria");
            $this->db->select("marcas.nombre as marca");
            
            $this->db->join("categorias","categorias.id = productos.id_categoria","LEFT");
            $this->db->join("marcas","marcas.id = categorias.marca_id","LEFT");
            
            $this->db->where("productos.estado",1);
            
            $query = $this->db->get('productos');
            return $query->result();
        }

        public function get_productos_dynamic_id($id)
        {
                $this->db->where('dynamic_id', $id);
                $query = $this->db->get('productos');
                return $query->result();
        }
        
        public function get_productos_id($id)
        {
                $this->db->where('id', $id);
                $query = $this->db->get('productos');
                return $query->result();
        }

		public function get_banner_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('banner');
                return $query->result();
        }
        
        
        public function get_leads_periodo_post_conversiones()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('MONTH(added_at), YEAR(added_at)');
            $this->db->group_by('presupuestos.estado_id');
            $this->db->order_by("added_at","asc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'added_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('added_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('added_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }


            $this->db->limit("6");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }


        public function get_leads_periodo_post_dia_conversiones()
        {
            $this->db->select("count(*) as count, presupuestos.*, DATE_FORMAT(presupuestos.added_at,'%Y-%m-%d') as Created_Day1");

            //$this->db->group_by('MONTH(added_at), YEAR(added_at)');
            
            $this->db->group_by('Created_Day1');
            $this->db->order_by("added_at","asc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'added_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('added_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('added_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }


            //$this->db->limit("6");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }


        public function get_leads_periodo_post()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('MONTH(modified_at), YEAR(modified_at)');
            $this->db->group_by('presupuestos.estado_id');
            $this->db->where('presupuestos.estado_id', 4);
            $this->db->order_by("modified_at","asc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }


            $this->db->limit("6");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }


        public function get_leads_periodo_post_dia()
        {
            $this->db->select("count(*) as count, presupuestos.*, DATE_FORMAT(presupuestos.modified_at,'%Y-%m-%d') as Created_Day1");

            //$this->db->group_by('MONTH(added_at), YEAR(added_at)');
            $this->db->group_by('presupuestos.estado_id');
            $this->db->group_by('Created_Day1');
            $this->db->where('presupuestos.estado_id', 4);
            $this->db->order_by("modified_at","asc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }


            //$this->db->limit("6");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }


        public function get_leads_edad()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('presupuestos.paso_01');
            $this->db->where('presupuestos.estado_id', 4);

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }

            $query = $this->db->get('presupuestos');
            return $query->result();
        }
		
		public function get_leads_edad_conversiones()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('presupuestos.paso_01');

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'added_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('added_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('added_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }

            $query = $this->db->get('presupuestos');
            return $query->result();
        }

        public function get_leads_localidad()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('presupuestos.localidad');
            $this->db->where('presupuestos.estado_id', 4);
            $this->db->order_by('count', 'asc');


            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }


            $query = $this->db->get('presupuestos');
            return $query->result();
        }
		
		public function get_leads_localidad_conversiones()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('presupuestos.localidad');
            $this->db->order_by('count', 'asc');


            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'added_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('added_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('added_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }


            $query = $this->db->get('presupuestos');
            return $query->result();
        }

        public function get_leads_periodo()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('MONTH(modified_at), YEAR(modified_at)');
            $this->db->group_by('presupuestos.estado_id');
            $this->db->where('presupuestos.estado_id', 4);
            $this->db->order_by("modified_at","desc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }

            $this->db->limit("6");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }

        public function get_leads_periodo_dia()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('DAY(modified_at) ,MONTH(modified_at), YEAR(modified_at)');
            $this->db->group_by('presupuestos.estado_id');
            $this->db->where('presupuestos.estado_id', 4);
            $this->db->order_by("modified_at","desc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }

            $this->db->limit("7");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }
        
        
        public function get_leads_periodo_conversiones()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('MONTH(added_at), YEAR(added_at)');
            $this->db->order_by("added_at","asc");


            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'added_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('added_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('added_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }

            $this->db->limit("6");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }

        public function get_leads_periodo_dia_conversiones()
        {
            $this->db->select("count(*) as count, presupuestos.*");

            $this->db->group_by('DAY(added_at) ,MONTH(added_at), YEAR(added_at)');
            $this->db->group_by('presupuestos.estado_id');
            $this->db->order_by("added_at","desc");

            if(!empty($_POST["asesores"]))
            {
            	$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
            }

            if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
            {
                $date_incio = new DateTime($_POST["fecha_inicio"]);
                $where_inicio =  'added_at >='.$date_incio->format("d-m-Y H:i:s");

                $this->db->where('added_at >=' ,$date_incio->format("Y-m-d H:i:s"));
            }
            
            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
            {   
                $date_fin = new DateTime($_POST["fecha_fin"]);
                $this->db->where('added_at <=' ,$date_fin->format("Y-m-d H:i:s"));
            }

            $this->db->limit("7");
            $query = $this->db->get('presupuestos');
            return $query->result();
        }

        public function get_asesores()
        {
            $query = $this->db->get('vendedores');
            return $query->result();
        }

        public function get_asesor_id($id)
        {		
        	$this->db->where('id', $id);
            $query = $this->db->get('vendedores');
            return $query->result();
        }	
		
		public function get_sedes()
        {
				$this->db->select('sede.*, provincia.provincia');
				if($this->session->userdata['logged_in']['administrator']==0){
					$this->db->where('sede.provinciaId',$this->session->userdata['logged_in']['provinciaId']);
				}
				$this->db->join('provincia', 'provincia.id = sede.provinciaId', 'left');
                $query = $this->db->get('sede');
                return $query->result();
        }
		public function get_sede_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('sede');
                return $query->result();
        }	
		public function get_cursos()
        {
				$this->db->select('curso.*, categoria.categoria');
				if($this->session->userdata['logged_in']['administrator']==0){
					$this->db->where('curso_provincia.provinciaId',$this->session->userdata['logged_in']['provinciaId']);
				}
				$this->db->join('curso_provincia', 'curso_provincia.cursoId = curso.id', 'left');
				$this->db->join('categoria', 'categoria.id = curso.categoriaId', 'left');
                $this->db->order_by('curso.destacado','desc');
				$this->db->group_by('curso.id');
				$query = $this->db->get('curso');
                return $query->result();
        }
		public function get_curso_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('curso');
                return $query->result();
        }	
		public function get_sede_curso($id)
        {
				$this->db->select('sede_curso.*, sede.sede');
				$this->db->where('sede_curso.cursoId', $id);
				$this->db->join('sede', 'sede.id = sede_curso.sedeId', 'left');
                $query = $this->db->get('sede_curso');
                return $query->result();
        }	
		public function get_sede_curso_id($id)
        {
				$this->db->select('sede_curso.*, sede.provinciaId');
				$this->db->where('sede_curso.id', $id);
				$this->db->join('sede', 'sede.id = sede_curso.sedeId', 'left');
                $query = $this->db->get('sede_curso');
                return $query->result();
        }
		
		public function get_profesores()
        {
                $query = $this->db->get('profesor');
                return $query->result();
        }
		public function get_profesor_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('profesor');
                return $query->result();
        }	
		public function get_profesor_curso($id)
        {
				$this->db->where('cursoId', $id);
                $query = $this->db->get('profesor_curso');
                return $query->result();
        }	
		public function get_profesor_sede($id)
        {
				$this->db->where('sedeId', $id);
                $query = $this->db->get('profesor_sede');
                return $query->result();
        }	
        
		public function get_condiciones()
        {
	        $this->db->select("pago_categorias_items.*");
	        $this->db->select("pc.categoria");
	        
	        $this->db->join("pago_categorias pc","pc.id = pago_categorias_items.categoria_id ","inner");
	        
            $query = $this->db->get('pago_categorias_items');
            return $query->result();
        }
             
		public function get_categorias()
        {
	        $this->db->select("categorias.*");
	        $this->db->select("marcas.nombre as marca");
	        
	        $this->db->join("marcas","marcas.id = categorias.marca_id","left");
	        
            $query = $this->db->get('categorias');
            return $query->result();
        }


        public function get_condiciones_categorias_id($id)
        {
	        	$this->db->where("id",$id);
                $query = $this->db->get('pago_categorias');
                return $query->result();
        }
        
        public function get_condiciones_categorias()
        {
                $query = $this->db->get('pago_categorias');
                return $query->result();
        }
        
        public function get_marcas()
        {
                $query = $this->db->get('marcas');
                return $query->result();
        }

        public function get_unidades_concesionario($id)
        {
            $this->db->where('id_concesionario', $id);
            $result = $this->db->get('concesionarios_unidades');
            return $result->result();
        }


		public function get_condicion_comercial_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('pago_categorias_items');
                return $query->result();
        }
        
		public function get_categoria_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('categorias');
                return $query->result();
        }

        public function get_marca_id($id)
        {
                $this->db->where('id', $id);
                $query = $this->db->get('marcas');
                return $query->result();
        }	
		
		public function get_provincias()
        {	
				if($this->session->userdata['logged_in']['administrator']==0){
					$this->db->where('id',$this->session->userdata['logged_in']['provinciaId']);
				}
                $query = $this->db->order_by('provincia_nombre','asc');
				$query = $this->db->get('provincia');
                return $query->result();
        }
		public function get_active_provinces()
        {
			$this->db->select('provincia.*');
			if($this->session->userdata['logged_in']['administrator']==0){
				$this->db->where('provincia.id',$this->session->userdata['logged_in']['provinciaId']);
			}
			$this->db->join('sede','sede.provinciaId = provincia.id');
			$this->db->group_by('provincia.id');
			$query = $this->db->get('provincia');
			return $query->result();				
        }
		public function get_provincia_curso($id)
        {
				$this->db->where('cursoId', $id);
                $query = $this->db->get('curso_provincia');
                return $query->result();
        }	
		
		public function get_noticias()
        {
				$this->db->select('noticias.*');
				$this->db->order_by('id','desc');
                $query = $this->db->get('noticias');
                return $query->result();		
        }
		public function get_noticia_id($id)
        {
				$this->db->where('id', $id);	
                $query = $this->db->get('noticias');
                return $query->result();		
        }
		public function get_provincia_noticia($id)
        {
				$this->db->select('noticias_provincia.*, provincia.provincia');
				$this->db->where('noticiaId', $id);
				$this->db->join('provincia', 'provincia.id = noticias_provincia.provinciaId', 'left');
                $query = $this->db->get('noticias_provincia');
                return $query->result();
        }		
		
		public function get_vendedores()
        {
				$this->db->select('vendedores.*');
				$this->db->select("(select count(*) from presupuestos where presupuestos.id_vendedor = vendedores.id) as kantt");
				
                $query = $this->db->get('vendedores');
                return $query->result();
        }

        public function get_vendedores_est()
        {
				$this->db->select('vendedores.*');
				$this->db->select("count(*) as kantt");

				if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
	            {
	                $date_incio = new DateTime($_POST["fecha_inicio"]);
	                $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

	                $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
	            }
	            
	            if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
	            {   
	                $date_fin = new DateTime($_POST["fecha_fin"]);
	                $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
	            }

				$this->db->join('presupuestos', 'presupuestos.vendedor_id = vendedores.id', 'left');
				$this->db->group_by("presupuestos.vendedor_id");
                $this->db->order_by('presupuestos.modified_at', 'DESC');
				
                $query = $this->db->get('vendedores');
                return $query->result();
        }


        public function get_origen_vendedor_utm($id, $origen)
        {
				$this->db->select('*');
				$this->db->select("count(*) as kantt");
				$this->db->select("GROUP_CONCAT(presupuestos.utm_source) as origen_utm");

				if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
				{
					$this->db->where("presupuestos.added_at >= ".strtotime($_POST["fecha_inicio"]));
				}
				
				if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
				{
					$this->db->where("presupuestos.added_at <= ".strtotime($_POST["fecha_fin"]));
				}

				$this->db->group_start();
					$this->db->like('presupuestos.utm_source' , $origen);
				$this->db->group_end();

				$this->db->where("presupuestos.vendedor_id", $id);

				$this->db->group_by("presupuestos.utm_source");
                $this->db->order_by('presupuestos.modified_at', 'DESC');
				
                $query = $this->db->get('presupuestos');
                return $query->result();
        }

        public function get_origen_vendedor_exutm($id, $origen)
        {

			$this->db->select('*');
			$this->db->select("count(*) as kantt");

			if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
			{
				$this->db->where("presupuestos.added_at >= ".strtotime($_POST["fecha_inicio"]));
			}
			
			if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
			{
				$this->db->where("presupuestos.added_at <= ".strtotime($_POST["fecha_fin"]));
			}

			$this->db->not_like('presupuestos.utm_source' , $origen);

			$this->db->where("presupuestos.vendedor_id", $id);

			$this->db->group_by("presupuestos.utm_source");
            $this->db->order_by('presupuestos.modified_at', 'DESC');
			
            $query = $this->db->get('presupuestos');
            return $query->result();

        }
        
        public function get_vendedor_name_by_id($id)
        {
			$this->db->select("*");
			$this->db->where("id",$id);
            $query = $this->db->get('vendedores');
            $array = $query->result();
            
            return $array[0]->vendedor;
        }
        
        
		public function get_usuarios()
        {
                $this->db->where('concesionario_id', 0);
                $this->db->or_where('concesionario_id', NULL);
                $this->db->where_not_in('rol', 'zona');
				$this->db->select('user_login.*');
                $query = $this->db->get('user_login');
                return $query->result();
        }

        public function get_usuarios_zonas()
        {
                $this->db->where('user_login.concesionario_id', 0);
                $this->db->or_where('user_login.concesionario_id', NULL);
                $this->db->select('user_login.*');
                $this->db->group_by('zonas.id_usuario');
                $this->db->join('user_login', 'user_login.id = zonas.id_usuario');
                $query = $this->db->get('zonas');
                return $query->result();
        }

        public function get_usuarios_zonas_id()
        {

            $this->db->select('concesionarios.*');
            $this->db->where('zonas.id_usuario', $this->session->userdata['logged_in']['id_user']);
            $this->db->join('concesionarios', 'concesionarios.id = zonas.id_concesionario');
            $query = $this->db->get('zonas');
            return $query->result();
        }

        public function get_proformas_concesionario()
        {
                $this->db->select('presupuestos.*');
                $this->db->join('user_login', 'user_login.id = presupuestos.id_vendedor');
                $this->db->where('user_login.concesionario_id', $this->session->userdata['logged_in']['concesionario']);
                $query = $this->db->get('presupuestos');
                return $query->result();
        }


        public function get_proformas_concesionario_id($id_concesionario)
        {
                $this->db->select('presupuestos.*');
                $this->db->select('user_login.name as nombre_vendedor');
                $this->db->select('user_login.rol as rol_vendedor');

                $this->db->select('session.nombre as nombre_usuario');
                $this->db->select('session.apellido as apellido_usuario');
                $this->db->select('session.cuit as cuit_usuario');

                $this->db->select('estados.nombre as estado_nombre');
                $this->db->select('estados.color as estado_color');

                $this->db->join('user_login', 'user_login.id = presupuestos.id_vendedor');
                $this->db->join('session', 'session.id = presupuestos.id_user');
                $this->db->join('estados', 'estados.id = presupuestos.estado');
                $this->db->where('user_login.concesionario_id', $id_concesionario);
                $query = $this->db->get('presupuestos');
                return $query->result();
        }


        public function get_proformas_concesionario_zonas($id_concesionario)
        {
            print_r($id_concesionario);
                $this->db->select('presupuestos.*');
                $this->db->select('user_login.name as name_user');
                $this->db->select('user_login.rol as rol_user');
                $this->db->join('user_login', 'user_login.id = presupuestos.id_vendedor');
                $this->db->where('user_login.concesionario_id',$id_concesionario);
                $query = $this->db->get('presupuestos');
                return $query->result();
        }

        public function get_estados()
        {
            $this->db->select('estados.*');
            $query = $this->db->get('estados');
            return $query->result();
        }

        public function get_concesionarios()
        {
                $this->db->select('concesionarios.*');
                $query = $this->db->get('concesionarios');
                return $query->result();
        }


        public function get_concesionarios_zona()
        {   
            if($this->session->userdata['logged_in']['user_id']):
                $id_user = $this->session->userdata['logged_in']['user_id'];
            endif;
            if($this->session->userdata['logged_in']['id_user']):
                $id_user = $this->session->userdata['logged_in']['id_user'];
            endif;
            $this->db->select('concesionarios.*');
            $this->db->where('zonas.id_usuario', $id_user);
            $this->db->join('concesionarios', 'concesionarios.id = zonas.id_concesionario');
            $query = $this->db->get('zonas');
            return $query->result();
        }

        public function get_concesionarios_usuarios()
        {
                $this->db->select('user_login.*');
                $this->db->where('concesionario_id', $this->uri->segment(3));
                $query = $this->db->get('user_login');
                return $query->result();
        }


		public function get_usuarios_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('user_login');
                return $query->result();
        }

        public function get_estados_id($id)
        {
                $this->db->where('id', $id);
                $query = $this->db->get('estados');
                return $query->result();
        }

        public function get_concesionario_id($id)
        {
                $this->db->where('id', $id);
                $query = $this->db->get('concesionarios');
                return $query->result();
        }		
        
		public function get_vendedor_id($id)
        {
				$this->db->where('id', $id);
                $query = $this->db->get('vendedores');
                return $query->result();
        }
			
		public function get_imagenes_archivo($entidad,$id)
        {
				$this->db->where('refId', $id);
				$this->db->where('entidad', $entidad);
                $query = $this->db->get('archivos');
                return $query->result();		
        }
		
		
		
		
		
		
		/*INSERTS*/
		
		public function insert_condiciones($data)
        {
				$this->db->insert('pago_categorias_items', $data);	
        }
		public function insert_condiciones_categorias($data)
        {
			$this->db->insert('pago_categorias', $data);	
        }
        
		public function insert_categoria($data)
        {
				$this->db->insert('categorias', $data);	
        }

        public function insert_marca($data)
        {
                $this->db->insert('marcas', $data); 
        }
				
		public function insert_usuario($data)
        {
                $this->db->insert('user_login', $data);
        }


        public function insert_estados($data)
        {
                $this->db->insert('estados', $data);
        }

        public function insert_concesionario($data)
        {
                $this->db->insert('concesionarios', $data);
        }
        
		public function insert_vendedor($data)
        {
                $this->db->insert('vendedores', $data);
        }
		
		
		public function insert_banner($data)
        {
                $this->db->insert('banner', $data);
        }

        public function insert_producto($data)
        {
                $this->db->insert('productos', $data);
        }
		
		public function insert_sede($data)
        {
                $this->db->insert('sede', $data);
				$insert_id = $this->db->insert_id();
				
				/*PROFESORES*/
				if(isset($_POST['profesor'])){
					foreach ( $_POST['profesor'] as $servicio ){
						$this->db->set('profesorId', $servicio);
						$this->db->set('sedeId', $insert_id);		
						$this->db->insert('profesor_sede');					
					}
				}
				
				/*GALERIA*/
				if(isset($_POST['galeria1_input'])){
					$galeria =explode(",",$_POST['galeria1_input']);
					foreach ( $galeria as $gal ){
						$this->db->set('entidad', 'galeria_sede');
						$this->db->set('refId', $insert_id);
						$this->db->set('archivo', $gal);					
						$this->db->insert('archivos');					
					}
				}
        }
		
		public function insert_profesor($data)
        {
                $this->db->insert('profesor', $data);
        }
        
        
        
        public function distribuir_presupuesto($presupuesto_id,$vendedor_id)
        {
				$this->db->where('id', $presupuesto_id);
				$this->db->set('vendedor_id', $vendedor_id);
				$this->db->update('presupuestos');
        }
		
		public function insert_curso($data)
        {
                $this->db->insert('curso', $data);
				$insert_id = $this->db->insert_id();
				
				if(isset($_POST['profesor'])){
					foreach ( $_POST['profesor'] as $servicio ){
						$this->db->set('profesorId', $servicio);
						$this->db->set('cursoId', $insert_id);		
						$this->db->insert('profesor_curso');					
					}
				}
				
				if(isset($_POST['provincia'])){
					foreach ( $_POST['provincia'] as $provincia ){
						$this->db->set('provinciaId', $provincia);
						$this->db->set('cursoId', $insert_id);		
						$this->db->insert('curso_provincia');					
					}
				}
				
				/*ACTUALIZAR ID EN VARIANTE PROUDUCTO*/
				$this->db->set('cursoId', $insert_id);
				$this->db->where('cursoId', $this->input->get('tempid'));
				$this->db->update('sede_curso');
        }
		public function insert_sede_curso($data)
        {
                $this->db->insert('sede_curso', $data);
        }
		
		public function insert_noticia($data)
        {
                $this->db->insert('noticias', $data);
				$insert_id = $this->db->insert_id();
				
				
				if(isset($_POST['provincia'])){
					foreach ( $_POST['provincia'] as $provincia ){
						$this->db->set('provinciaId', $provincia);
						$this->db->set('noticiaId', $insert_id);		
						$this->db->insert('noticias_provincia');					
					}
				}
				
				/*GALERIA*/
				if(isset($_POST['galeria2_input'])){
					$galeria =explode(",",$_POST['galeria2_input']);
					foreach ( $galeria as $gal ){
						$this->db->set('entidad', 'galeria_noticia');
						$this->db->set('refId', $insert_id);
						$this->db->set('archivo', $gal);					
						$this->db->insert('archivos');					
					}
				}
        }
		
		
		
		/*UPDATES*/
		public function update_banner($data)
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->update('banner', $data);
        }
        public function update_producto($data)
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->update('productos', $data);
        }
        
		public function update_condiciones_categoria($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('pago_categorias', $data);
        }
        
		public function update_condiciones($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('pago_categorias_items', $data);
        }
        
		public function update_categoria($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('categorias', $data);
        }

        public function update_marca($data)
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->update('marcas', $data);
        }
		public function update_sede($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('sede', $data);
				
				$this->db->where('sedeId', $this->uri->segment(3));
                $this->db->delete('profesor_sede');
				
				$this->db->where('refId', $this->uri->segment(3));
				$this->db->where('entidad', 'galeria_sede');
                $this->db->delete('archivos');
				
				if(isset($_POST['profesor'])){
					foreach ( $_POST['profesor'] as $servicio ){
						$this->db->set('profesorId', $servicio);
						$this->db->set('sedeId', $this->uri->segment(3));		
						$this->db->insert('profesor_sede');					
					}
				}
				
				/*GALERIA*/
				if(isset($_POST['galeria1_input'])){
					$galeria =explode(",",$_POST['galeria1_input']);
					foreach ( $galeria as $gal ){
						$this->db->set('entidad', 'galeria_sede');
						$this->db->set('refId', $this->uri->segment(3));
						$this->db->set('archivo', $gal);					
						$this->db->insert('archivos');					
					}
				}
        }
		public function update_profesor($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('profesor', $data);
        }
		public function update_curso($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('curso', $data);
				
				$this->db->where('cursoId', $this->uri->segment(3));
                $this->db->delete('profesor_curso');
				
				$this->db->where('cursoId', $this->uri->segment(3));
                $this->db->delete('curso_provincia');
				
				if(isset($_POST['profesor'])){
					foreach ( $_POST['profesor'] as $servicio ){
						$this->db->set('profesorId', $servicio);
						$this->db->set('cursoId', $this->uri->segment(3));		
						$this->db->insert('profesor_curso');					
					}
				}
				
				if(isset($_POST['provincia'])){
					foreach ( $_POST['provincia'] as $provincia ){
						$this->db->set('provinciaId', $provincia);
						$this->db->set('cursoId', $this->uri->segment(3));		
						$this->db->insert('curso_provincia');					
					}
				}
        }
		public function update_sede_curso($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('sede_curso', $data);
        }
		
		public function update_vendedor($data)
        {
				$this->db->set('vendedor', $data['vendedor']);
				$this->db->where('id', $this->uri->segment(3));
                $this->db->update('vendedores');
        }
        
		public function update_usuario($data)
        {
				$this->db->set('name', $data['name']);
				$this->db->set('provinciaId', $data['provinciaId']);
				$this->db->set('vendedor_id', $data['vendedor_id']);
				$this->db->set('administrator', $data['administrator']);
				$this->db->set('lastname', $data['lastname']);
				$this->db->set('user_email', $data['user_email']);
				if($data['user_password']<>''){
					$this->db->set('user_password', $data['user_password']);
				}
				$this->db->where('id', $this->uri->segment(3));
                $this->db->update('user_login');
        }


        public function update_estados($data)
        {
            $this->db->set('nombre', $data['nombre']);
            $this->db->where('id', $this->uri->segment(3));
            $this->db->update('estados');
        }

        public function update_usuario_concesionario($data)
        {
                $this->db->set('name', $data['name']);
                $this->db->set('provinciaId', $data['provinciaId']);
                $this->db->set('lastname', $data['lastname']);
                $this->db->set('user_email', $data['user_email']);
                $this->db->set('rol', $data['rol']);
                $this->db->set('concesionario_id', $data['concesionario_id']);
                if($data['user_password']<>''){
                    $this->db->set('user_password', $data['user_password']);
                }
                $this->db->where('id', $this->uri->segment(3));
                $this->db->update('user_login');
        }

        public function update_concesionario($data)
        {
                $this->db->set('nombre', $data['nombre']);
                $this->db->where('id', $this->uri->segment(3));
                $this->db->update('concesionarios');


                $this->db->where('id_concesionario', $this->uri->segment(3));
                $this->db->delete('concesionarios_unidades');

                foreach ( $_POST['unidades'] as $row ){
                    $this->db->set('id_concesionario',$this->uri->segment(3));
                    $this->db->set('id_unidades', $row);
                    $this->db->insert('concesionarios_unidades');
                }
        }

		
		public function update_distribuidores($data)
		{	
			$this->db->where('id', $this->uri->segment(3));
			$this->db->update('distribuidores', $data);
	
			
			$this->db->where('distribuidorId', $this->uri->segment(3));
            $this->db->delete('distribuidor_categoria');
			
			/*CATEGORIAS*/ 	
			if(isset($_POST['categoria'])){
				foreach ( $_POST['categoria'] as $servicio ){
					$this->db->set('categoriaId', $servicio);
					$this->db->set('distribuidorId', $this->uri->segment(3));		
					$this->db->insert('distribuidor_categoria');					
				}
			}
			
			
		}
		
		public function update_noticia($data)
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->update('noticias', $data);
				$insert_id = $this->uri->segment(3);
				
				$this->db->where('refId', $this->uri->segment(3));
				$this->db->where('entidad', 'galeria_noticia');
                $this->db->delete('archivos');
				
				$this->db->where('noticiaId', $this->uri->segment(3));
                $this->db->delete('noticias_provincia');
				
				if(isset($_POST['provincia'])){
					foreach ( $_POST['provincia'] as $provincia ){
						$this->db->set('provinciaId', $provincia);
						$this->db->set('noticiaId', $insert_id);		
						$this->db->insert('noticias_provincia');					
					}
				}
				
				/*GALERIA*/
				if(isset($_POST['galeria2_input'])){
					$galeria =explode(",",$_POST['galeria2_input']);
					foreach ( $galeria as $gal ){
						$this->db->set('entidad', 'galeria_noticia');
						$this->db->set('refId', $insert_id);
						$this->db->set('archivo', $gal);					
						$this->db->insert('archivos');					
					}
				}
        }
		
		
		/*REMOVES*/
		
		public function remove_noticia()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('noticias');
				
				$this->db->where('refId', $this->uri->segment(3));
				$this->db->where('entidad', 'galeria_noticia');
                $this->db->delete('archivos');
        }
		
		public function remove_banner()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('banner');
        }

        public function remove_producto()
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->delete('productos');
        }
		
		public function remove_profesor()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('profesor');
				
				$this->db->where('profesorId', $this->uri->segment(3));
                $this->db->delete('profesor_curso');
        }
		
		public function remove_categoria()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('categorias');
        }
        
		public function remove_condiciones()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('pago_categorias_items');
        }
        
		public function remove_condiciones_categorias()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('pago_categorias');
        }

        public function remove_marca()
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->delete('marcas');
        }
		public function remove_curso()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('curso');
				
				$this->db->where('cursoId', $this->uri->segment(3));
                $this->db->delete('profesor_curso');
				
				$this->db->where('cursoId', $this->uri->segment(3));
                $this->db->delete('sede_curso');
        }
		public function remove_sede()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('sede');
        }
		public function remove_sede_curso()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('sede_curso');
        }
		
		
		public function remove_usuario()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('user_login');
        }

        public function remove_estados()
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->delete('estados');
        }

        public function remove_concesionario()
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->delete('concesionarios');
        }

        public function remove_concesionario_usuario()
        {
                $this->db->where('id', $this->uri->segment(3));
                $this->db->delete('user_login');
        }
        
		public function remove_vendedores()
        {
				$this->db->where('id', $this->uri->segment(3));
                $this->db->delete('vendedores');
        }

        public function remove_presupuesto($data)
        {
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('presupuestos', $data);
        }
		
		/*CHANGE*/
		public function change_status_curso()
        {
				$this->db->set('destacado', $this->uri->segment(4));
				$this->db->where('id', $this->uri->segment(3));
                $this->db->update('curso');
				print $this->db->last_query();
        }
		
}

?>