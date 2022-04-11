<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Envio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	function __construct()
	{
       parent::__construct();
       // testing load model
       $this->load->model('page_model');
	   // Load form helper library
	   $this->load->helper('form');
	   $this->load->helper('security');
	   $this->load->helper('url');
	   // Load form validation library
	   $this->load->library('form_validation');

	   // Load session library
	   $this->load->library('session');
	} 
	 
	
	public function index()
	{
		print "--";
		exit;
	}

	
	public function session_user()
	{
		// ---		
		// Valido que exista o el email o el telefono
		// ---
		
		if(strlen(trim($_POST["email"])) <= 4 && strlen(trim($_POST["telefono"])) <= 4)
		{
			print "errorMail";
			exit;
		}
		
		
		if(isset($_POST['telefono']) && strlen($_POST['telefono']) > 1)
		{
			$_POST['telefono'] = str_ireplace(" ","",$_POST['telefono']);
			$_POST['telefono'] = str_ireplace("+","",$_POST['telefono']);
		}
		
		// --
		// Verifico el CUIT
		/*
		if(isset($_POST["cuit"]))
		{
			$cuit = $this->page_model->buscaCuit($_POST["cuit"]);
			if(count($cuit) > 0)
			{
				print "errorcuit";
				exit;		
			}
		}
		*/
		
		$data = array(
			'cuit' => $_POST['cuit'],
			'nombre' => $_POST['nombre'],
			'apellido' => $_POST['apellido'],
			'razon_social' => $_POST['razon_social'],
			'email' => $_POST['email'],
			'localidad' => $_POST['localidad'],
			'telefono' => $_POST['telefono'],
			'origen' => $_POST['origen'],
			'fecha_registro' => date("Y-m-d H:i:s")
		);

		$this->db->insert('session', $data);
		$id_user = $this->db->insert_id();

		$data_session = array(
			'id_user' => $id_user,
			'cuit' => $_POST['cuit'],
			'razon_social' => $_POST['razon_social'],
			'localidad' => $_POST['localidad'],
			'nombre' => $_POST['nombre'],
			'apellido' => $_POST['apellido'],
			'email' => $_POST['email'],
			'telefono' => $_POST['telefono'],
			'origen' => $_POST['origen'],
		);

		$this->session->set_userdata('user', $data_session);
		$this->session->set_userdata('cant_cart', array('total'=>0));

		echo base_url().'categorias/';
		exit;
	}


	public function update_session_modal()
	{
		$data_session = array(
			'id_user' => $this->session->userdata['user']['id_user'],
			'cuit' => $this->session->userdata['user']['cuit'],
			'nombre' => $this->session->userdata['user']['nombre'],
			'apellido' => $this->session->userdata['user']['apellido'],
			'razon_social' => $this->session->userdata['user']['razon_social'],
			'localidad' => $this->session->userdata['user']['localidad'],
			'email' => $this->session->userdata['user']['email'],
			'telefono' => $this->session->userdata['user']['telefono'],
			'origen' => $this->session->userdata['user']['origen'],
			'categoria' =>$this->session->userdata['user']['categoria'],
			'domicilio_extra' => $_POST['domicilio_extra'],
			'telefono_extra' => $_POST['telefono_extra'],
			'email_extra' => $_POST['email_extra']
		);

		$this->session->set_userdata('user', $data_session);
	}

	public function categoria()
	{
		$data_session = array(
			'id_user' => $this->session->userdata['user']['id_user'],
			'cuit' => $this->session->userdata['user']['cuit'],
			'nombre' => $this->session->userdata['user']['nombre'],
			'apellido' => $this->session->userdata['user']['apellido'],
			'razon_social' => $this->session->userdata['user']['razon_social'],
			'localidad' => $this->session->userdata['user']['localidad'],
			'email' => $this->session->userdata['user']['email'],
			'telefono' => $this->session->userdata['user']['telefono'],
			'origen' => $this->session->userdata['user']['origen'],
			'categoria' => $_POST['categoria']
		);

		$this->session->set_userdata('user', $data_session);
		

		$this->db->where('id', $this->session->userdata['user']['id_user']);
		$data_update = array(
			'id_categoria' => $this->session->userdata['user']['categoria']
		);
		$this->db->update('session', $data_update);

		echo base_url()."productos?categoria=".$_POST["categoria"];
		exit;
	}

	public function session_productos()
	{
	    $user_id = $this->session->userdata['user']['id_user'];
	    if($user_id <= 0 || strlen($user_id) <= 0) $user_id = $this->session->userdata["logged_in"]['user_id'];
	            
		
		$data_producto_session = array(
			'id_user' => $user_id,
			'id_categoria' => $this->session->userdata['user']['categoria'],
			'id_producto' => $_POST['producto']
 		);

 		$this->db->insert('session_productos', $data_producto_session);

 		$this->page_model->render_cart();
		
	}
    
	public function opcionles_session()
	{
		$this->db->where('id_user',$this->session->userdata['user']['id_user']);
        $this->db->where('id_producto',$_POST['producto']);
		$this->db->delete('session_productos_opcionales');

        if(isset($_POST['opcional']) && count($_POST['opcional']) > 0)
        {
    		foreach($_POST['opcional'] as $key => $op){
    			$data_producto_opcional_session = array(
    			'id_user' => $this->session->userdata['user']['id_user'],
    			'id_producto' => $_POST['producto'],
    			'id_opcional' => $op
     			);
    
     			$this->db->insert('session_productos_opcionales', $data_producto_opcional_session);
    		}
        }
		$this->page_model->render_opcionales($this->session->userdata['user']['id_user'], $_POST['producto']);
		//print_r($_POST['value']);
		//exit;
	}
    // ---
    // Saving pago session
    // ---
    public function pago_session()
    {
        // limpio la config anterior
		$this->db->where('session_producto_id',$_POST['producto']);
		$this->db->where("id_user",$this->session->userdata['user']['id_user']);
		$this->db->delete('session_presupuestos_pagos');
		
		// ok save muli array
		if(isset($_POST["pago_item"]) && count($_POST["pago_item"]) > 0)
		{
			foreach($_POST["pago_item"] as $pa)
			{
				$data_producto_opcional_session = array(
					'pago_id' => $pa,
					'id_user' => $this->session->userdata['user']['id_user'],
					'session_producto_id' => $_POST['producto'],
				);
		 		$this->db->insert('session_presupuestos_pagos', $data_producto_opcional_session);
			}
		}
		
        // render cart
        $ret = $this->page_model->render_cart(true);
        
        print $ret["contenido"];
        exit;
    }	

	public function session_productos_borrar()
	{
		$data_producto_session = array(
			'id_user' => $this->session->userdata['user']['id_user'],
			'id_categoria' => $this->session->userdata['user']['categoria'],
			'id_producto' => $_POST['producto']
 		);

		$this->db->where('id', $_POST['producto_session']);
        $this->db->delete('session_productos');

 		$this->page_model->render_cart();
		
	}
	
	// ---// ---// ---// ---// ---
	// Hago -- LOGIN --
	// ---// ---// ---// ---// ---
	public function vendedor_login()
	{
		$this->session->set_userdata('logged_in', '');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				//print 'Login ok';
				redirect('home/');
			}else{
				//print 'Login false';
				redirect('login/');
			}
		} else {
			
	
			$data = array(
			'usuario' => $this->input->post('usuario'),
			'password' => md5($this->input->post('password'))
			);
			$result = $this->page_model->login($data);
			if ($result == TRUE) {
				$usuario = $this->input->post('usuario');
				$result = $this->page_model->read_user_information($usuario);
				if ($result != false) {

					$session_data = array(
					'user_id' => $result[0]->id,
					'usuario' => $result[0]->user_name,
					'rol' => $result[0]->rol,
					'email' => $result[0]->user_email,
					'vendedor_id' => $result[0]->vendedor_id,
					'concesionario' => $result[0]->concesionario_id,
					'administrator' => $result[0]->administrator
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
					
					if($result[0]->administrator == 1):
						echo base_url().'admin/';
						exit;
					else:
						echo base_url().'registro_cliente/';
						exit;
					endif;

					
				}
			} else {
				$data = array(
				'error_message' => 'Usuario/clave incorrecta'
				);
				echo 'error';
				exit;
			}
		}
		
		echo base_url()."registro_cliente/";
		exit;
	}

	public function envio_compartido()
	{
		$this->db->where('id_user',$this->session->userdata['user']['id_user']);
		$this->db->delete('presupuestos');
		$data = array(
			'id_user' => $this->session->userdata['user']['id_user'],
			'nombre' => $this->session->userdata['user']['nombre'],
			'apellido' => $this->session->userdata['user']['apellido'],
			'razon_social' => $this->session->userdata['user']['razon_social'],
			'localidad' => $this->session->userdata['user']['localidad'],
			'cuit' => $this->session->userdata['user']['cuit'],
			'email' => $this->session->userdata['user']['email'],
			'telefono' => $this->session->userdata['user']['telefono'],
			'origen' => $this->session->userdata['user']['origen'],
			'fecha_registro' => date("Y-m-d H:i:s"),
			'id_vendedor'=> $this->session->userdata['logged_in']['user_id'],
			'email_extra'=> $this->session->userdata['logged_in']['email_extra'],
			'domicilio_extra'=> $this->session->userdata['logged_in']['domicilio_extra'],
			'telefono_extra'=> $this->session->userdata['logged_in']['telefono_extra'],
		);

		$this->db->insert('presupuestos', $data);
		$id_presupuesto = $this->db->insert_id();

		$productos_session = $this->page_model->get_productos();

		//print_r($productos_session);

		foreach($productos_session as $producto){
			$data_producto = array(
				'id_presupuesto'=> $id_presupuesto,
				'id_producto' => $producto->{'id'},
				'id_producto_session' => $producto->{'id_session_producto'}
			);
			foreach($this->page_model->get_opcinal_session($producto->{'id_session_producto'}) as $opcional){

				$data_opcional = array(
					'id_opcional'=> $opcional->{'id_opcional'},
					'id_presupuesto'=> $id_presupuesto,
					'id_producto_session' => $producto->{'id_session_producto'},
					'id_producto'=> $producto->{'id'}
				);
				$this->db->insert('prespuesto_opcionales', $data_opcional);
			}

			foreach($this->page_model->get_condiciones_session($producto->{'id_session_producto'}) as $condicion){
				$data_condicion = array(
					'id_producto' => $producto->{'id'},
					'id_pago_item' => $condicion->{'pago_id'},
					'id_producto_session' => $producto->{'id_session_producto'},
					'id_presupuesto' => $id_presupuesto
				);
				$this->db->insert('presupuesto_condiciones', $data_condicion);
			}

			$this->db->insert('presupuesto_producto', $data_producto);
		}
		// $presupuesto = $this->page_model->exportarPDF($id_presupuesto);
		
		// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---
		// Envio a Dynamics
		// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---
		$this->page_model->envioDynamics();
		
		
//		print "envio OK";
//		exit;
		

		/* ENVIO POR WHATSAPP */
		
		if($_POST['estado'] == 'whatsapp'){
			$contenido.='<div class="col-12">
				<p>¿Enviar por whahtsapp?</p>
				<div class="btn-enviar">
				<a href="https://api.whatsapp.com/send?phone=54'.$this->session->userdata['user']['telefono'].'&text=Presupuesto:'.base_url().'uploads/'.$presupuesto.'" target="_blank">Enviar</a>
				</div>
				<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
			</div>';
 			echo json_encode(array(
	        'estado' => $_POST['estado'],
	       	'contenido' => $contenido,
		   ));
		   exit;
		}

		/* ENVIO POR DESCARGAR */
		
		if($_POST['estado'] == 'guardar'){
			$contenido.='<div class="col-12">
				<p>¿Descargar presupuesto?</p>
				<div class="btn-enviar">
				<a href="'.base_url().'uploads/'.$presupuesto.'" download>Descargar</a>
				</div>
				<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
			</div>';
 			echo json_encode(array(
	        'estado' => $_POST['estado'],
	       	'contenido' => $contenido,
		   ));
		   exit;
		}

		/* ENVIO POR IMPRIMIR */
		
		if($_POST['estado'] == 'imprimir'){
			$contenido.='<div class="col-12">
				<p>¿Imprimir prespuesto?</p>
				<div class="btn-enviar">
				<a href="'.base_url().'uploads/'.$presupuesto.'" target="_blank">Imprimir</a>
				</div>
				<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
			</div>';
 			echo json_encode(array(
	        'estado' => $_POST['estado'],
	       	'contenido' => $contenido,
		   ));
		   exit;
		}

		/* ENVIO POR CORREO */

		if($_POST['estado'] == 'correo'){
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


		    $asunto = 'Presupuesto enviado';

	    	$mensaje = '<p>Presupuesto:'.base_url().'uploads/'.$presupuesto.'</p>';

		    $name = $this->session->userdata['user']['nombre'];
		    $email = $this->session->userdata['user']['email'];

		    $this->email->from($email,$name);
		    $this->email->to($this->session->userdata['user']['email']);
		    $this->email->cc('hernanebaigorria@gmail.com');
		  
		    $this->email->subject($asunto);
		    $this->email->message($mensaje);
		    if ( ! $this->email->send()) {
		        show_error($this->email->print_debugger());
		    } else {
		    	$contenido.='<div class="col-12">
		    		<p>Presupuesto enviado con éxito</p>
		    		<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
		    	</div>';
		    }
			
 			echo json_encode(array(
	        'estado' => $_POST['estado'],
	       	'contenido' => $contenido,
		   ));
		   exit;
		}
		exit;

	}

	public function envio_proforma()
	{

		$this->db->where('id_user',$this->session->userdata['user']['id_user']);
		$this->db->delete('presupuestos');
		$data = array(
			'id_user' => $this->session->userdata['user']['id_user'],
			'nombre' => $this->session->userdata['user']['nombre'],
			'apellido' => $this->session->userdata['user']['apellido'],
			'razon_social' => $this->session->userdata['user']['razon_social'],
			'localidad' => $this->session->userdata['user']['localidad'],
			'cuit' => $this->session->userdata['user']['cuit'],
			'email' => $this->session->userdata['user']['email'],
			'telefono' => $this->session->userdata['user']['telefono'],
			'origen' => $this->session->userdata['user']['origen'],
			'fecha_registro' => date("Y-m-d H:i:s"),
			'id_vendedor'=> $this->session->userdata['logged_in']['user_id'],
			'email_extra'=> $this->session->userdata['user']['email_extra'],
			'domicilio_extra'=> $this->session->userdata['user']['domicilio_extra'],
			'telefono_extra'=> $this->session->userdata['user']['telefono_extra'],
		);

		$this->db->insert('presupuestos', $data);
		$id_presupuesto = $this->db->insert_id();

		$productos_session = $this->page_model->get_productos();

		//print_r($productos_session);

		foreach($productos_session as $producto){
			$data_producto = array(
				'id_presupuesto'=> $id_presupuesto,
				'id_producto' => $producto->{'id'},
				'id_producto_session' => $producto->{'id_session_producto'}
			);
			foreach($this->page_model->get_opcinal_session($producto->{'id_session_producto'}) as $opcional){

				$data_opcional = array(
					'id_opcional'=> $opcional->{'id_opcional'},
					'id_presupuesto'=> $id_presupuesto,
					'id_producto_session' => $producto->{'id_session_producto'},
					'id_producto'=> $producto->{'id'}
				);
				$this->db->insert('prespuesto_opcionales', $data_opcional);
			}

			foreach($this->page_model->get_condiciones_session($producto->{'id_session_producto'}) as $condicion){
				$data_condicion = array(
					'id_producto' => $producto->{'id'},
					'id_pago_item' => $condicion->{'pago_id'},
					'id_producto_session' => $producto->{'id_session_producto'},
					'id_presupuesto' => $id_presupuesto
				);
				$this->db->insert('presupuesto_condiciones', $data_condicion);
			}

			$this->db->insert('presupuesto_producto', $data_producto);
		}
		$proforma = $this->page_model->exportarPROFORMA($id_presupuesto, $_POST['precio']);

		/* ENVIO POR WHATSAPP */
		
		if($_GET['tipo'] == 'whatsapp'){

			echo 'https://api.whatsapp.com/send?phone=54'.$this->session->userdata['user']['telefono'].'&text=Presupuesto:'.base_url().'uploads/'.$proforma.'';
			exit;
		}

		/* ENVIO POR DESCARGAR */
		
		if($_GET['tipo'] == 'descargar'){
			echo base_url().'uploads/'.$proforma.'';
			exit;
		}

		/* ENVIO POR IMPRIMIR */
		
		if($_GET['tipo'] == 'imprimir'){

			echo base_url().'uploads/'.$proforma.'';
			exit;
		}

		/* ENVIO POR CORREO */

		if($_GET['tipo'] == 'correo'){
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


		    $asunto = 'Presupuesto enviado';

	    	$mensaje = '<p>Presupuesto:'.base_url().'uploads/'.$proforma.'</p>';

		    $name = $this->session->userdata['user']['nombre'];
		    $email = $this->session->userdata['user']['email'];

		    $this->email->from($email,$name);
		    $this->email->to($this->session->userdata['user']['email']);
		    $this->email->cc('hernanebaigorria@gmail.com');
		  
		    $this->email->subject($asunto);
		    $this->email->message($mensaje);
		    if ( ! $this->email->send()) {
		        show_error($this->email->print_debugger());
		    } else {
		    	$contenido.='<div class="col-12">
		    		<p>Presupuesto enviado con éxito</p>
		    		<div class="btn-cerrar" data-dismiss="modal">Cerrar</div>
		    	</div>';
		    }
			
 			echo "exito";
		   exit;
		}
		exit;

	}

	// ---	
	// Send presupuesto
	// ---
	public function send_presupuesto()
	{
		$data = array(
			'nombre' => $this->session->userdata['user']['nombre'],
			'cuit' => $this->session->userdata['user']['cuit'],
			'email' => $this->session->userdata['user']['email'],
			'telefono' => $this->session->userdata['user']['telefono'],
			'origen' => $this->session->userdata['user']['origen'],
		);

		$this->db->insert('presupuestos', $data);
		$id_presupuesto = $this->db->insert_id();

		$productos_session = $this->page_model->get_productos();

		//print_r($productos_session);

		foreach($productos_session as $producto){
			$data_producto = array(
				'id_presupuesto'=> $id_presupuesto,
				'id_producto' => $producto->{'id'}
			);
			$this->db->insert('presupuesto_producto', $data_producto);
		}
		
		// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---
		// Envio a Dynamics
		// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---
		/*
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
		}
		*/
		// ---		
		// Tengo que insertar los productos como array.
		// ---
		/*
		$json_post = 
			json_encode(
				array(
  						'lastname' => $this->session->userdata['user']['nombre'],
	  					'mobilephone' => $this->session->userdata['user']['telefono'],
  						'emailaddress1' => $this->session->userdata['user']['cuit'],
			  			'subject' =>  "Cotización: ".date("d/m/Y H:i:s"),
			  			'origen' => $this->session->userdata['user']['origen'],
			  			"products" => $productos
		      		)
			);
        $json_post = "[".$json_post."]";
          	
		// In real life you should use something like:
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post);

		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($json_post))                                                                       
		); 
		$server_output = curl_exec($ch);

		curl_close ($ch);
		*/
		// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---
		// -- Fin envio a dynamics
		// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---// ---

		echo base_url().'home/gracias/';
		exit;
	}

	
}
