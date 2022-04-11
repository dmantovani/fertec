<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuestos extends CI_Controller {
	 
	function __construct()
	{
       parent::__construct();
       // testing load model
       $this->load->model('page_model');
	   // Load form helper library
	   $this->load->helper('form');
	   $this->load->helper('url');
	   // Load form validation library
	   $this->load->library('form_validation');

	   // Load session library
	   $this->load->library('session');
	   
	  error_reporting(E_ALL);
	  ini_set('display_errors', 1);

	} 
	 
	
	public function index()
	{

		/* FECHA HASTA */
			if(isset($_POST["hasta"])):
				$hasta = $_POST["hasta"];
			elseif(isset($this->session->userdata['filters']['hasta'])):
				$hasta=$this->session->userdata['filters']['hasta'];
			else:
				$hasta='';
			endif;
		/* FECHA HASTA */

		/* FECHA DESDE */
			if(isset($_POST["desde"])):
				$desde = $_POST["desde"];
			elseif(isset($this->session->userdata['filters']['desde'])):
				$desde=$this->session->userdata['filters']['desde'];
			else:
				$desde='';
			endif;
		/* FECHA DESDE */

		/* FECHA ESTADO */
			if(isset($_POST["estado"])):
				$estado = $_POST["estado"];
			elseif(isset($this->session->userdata['filters']['estado'])):
				$estado=$this->session->userdata['filters']['estado'];
			else:
				$estado='';
			endif;
		/* FECHA ESTADO */

		/* FECHA VENDEDOR ID */
			if(isset($_POST["vendedor_id"])):
				$vendedor_id = $_POST["vendedor_id"];
			elseif(isset($this->session->userdata['filters']['vendedor_id'])):
				$vendedor_id=$this->session->userdata['filters']['vendedor_id'];
			else:
				$vendedor_id='';
			endif;
		/* FECHA VENDEDOR ID */

		/* FECHA BUSCANDO */
			if(isset($_POST["search_text"])):
				$search_text = $_POST["search_text"];
			elseif(isset($this->session->userdata['filters']['search_text'])):
				$search_text=$this->session->userdata['filters']['search_text'];
			else:
				$search_text='';
			endif;
		/* FECHA BUSCANDO */

		$session_filters = array(
		    'desde' => $desde, 
		    'hasta' => $hasta,
		    'estado' => $estado,
		    'vendedor_id' => $vendedor_id,
		    'search_text' => $search_text
		);
		$this->session->set_userdata('filters', $session_filters);

		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/cursos.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/cursos.js');

		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Agrometal', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		
		// ---
		// START Paginator
		// ---
		$page = $this->uri->segment(3);
		$config['per_page'] = 12;
				
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."presupuestos/index";
		$config['total_rows'] = $this->page_model->get_clientes_presupuestos(true, $config['per_page'],$page);

		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open'] = '<li class="paginate_button page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li class="paginate_button page-item">';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li class="paginate_button page-item">';
	    $config['next_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li class="paginate_button page-item">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li class="paginate_button page-item">';
	    $config['last_tag_close'] = '</li>';
		$config['first_link'] = '<<'; 
		$config['last_link'] = '>>';


		$this->pagination->initialize($config);
		// ---		
		// END paginator
		// ---
		

		$info =  $this->page_model->get_clientes_presupuestos(false, $config['per_page'],$page);
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/presupuestos/index', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	public function crear()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/proforma.js');

		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Agrometal', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

//		$info =  $this->page_model->get_clientes_presupuestos();
		$data['info']=array();
		
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/presupuestos/crear', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	public function creando_lead()
	{
		if($_POST['vendedor_id'] == 0){

			$vendedor_id = NULL;

		} else {

			$vendedor_id = $_POST['vendedor_id'];

		}
		$data = array(
			'nombre' => $_POST['nombre'],
			'localidad' => $_POST['localidad'],
			'telefono' => $_POST['celular'],
			'email' => $_POST['mail'],
			'utm_source' => $_POST['origen'],
			'vendedor_id' => $vendedor_id,
			'added_at' => date("Y-m-d H:i:s"),
			'modified_at' => date("Y-m-d H:i:s"),
			'estado_id' => 1,
		);
		$this->page_model->insert_registro($data);

		if($_POST['vendedor_id'] != 0){
			redirect('presupuestos/');
		} else {
			redirect('presupuestos/sin_asignar/');
		}
	}

	public function sin_asignar()
	{
		// --	
		// Asigno consecionario - vendedor
		// --
		if(count($_POST) > 0 && isset($_POST["presupuesto_id"]) && isset($_POST["concesionario_id"]))
		{
        	// distribuidor de presupuestos
			$vendedor_asignado = $this->page_model->distribuir_presupuesto($_POST["presupuesto_id"],$_POST["concesionario_id"]);
			
			redirect('presupuestos/sin_asignar/');	
		}
	
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/cursos.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/cursos.js');

		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Agrometal', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_clientes_presupuestos_sin_asignar();
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/presupuestos/sin_asignar', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
	
	
	public function index2()
	{
		if(isset($_POST["hasta"])):$hasta = $_POST["hasta"];else:$hasta='';endif;
		if(isset($_POST["desde"])):$desde = $_POST["desde"];else:$desde = '';endif;
		if(isset($_POST["estado"])):$estado = $_POST["estado"];else:$estado = '';endif;
		if(isset($_POST["vendedor_id"])):$vendedor_id = $_POST["vendedor_id"];else:$vendedor_id = '';endif;
		$session_filters = array(
		    'desde' => $desde, 
		    'hasta' => $hasta,
		    'estado' => $estado,
		    'vendedor_id' => $vendedor_id
		);
		$this->session->set_userdata('filters', $session_filters);
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/cursos.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/cursos.js');

		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Agrometal', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_clientes_presupuestos();
		$data['info']=$info;

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/presupuestos/index', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
	
	
	
	public function evento()
	{
		// select populate?
		if(isset($_POST["depart"]))
		{
			$this->db->select("*");
            $this->db->where("evento_id",$_POST["depart"]);
            $query = $this->db->get('motivos');
            $arr = $query->result();
            
            $users_arr = array();
            foreach($arr as $a)
            {
				$userid = $a->id;
			    $name = $a->nombre;
	
    			$users_arr[] = array("id" => $userid, "name" => $name);
            }
			echo json_encode($users_arr);
			exit;
		}
		
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/productos.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/productos.js');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Agrometal', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info = array();
//		$info =  $this->page_model->get_producto_id($this->uri->segment(3));	
		
		$data['info']=$info;
		
		$data["presupuesto"] = $this->page_model->get_presupuesto_id($this->uri->segment(3));
		
		$this->template->write_view('content', 'layout/presupuestos/evento', $data, TRUE); 
		$this->template->render();
	
	}

	// ---	
	// Reasignar presupuesto
	// ---
	public function reasignar()
	{
	
		$presupuesto_reasignar = $this->uri->segment(3);

		// --		
		// redirect vendedor?
		// --
		if(isset($_POST["vendedor_id"]))
		{
			$this->db->set('vendedor_id', $_POST["vendedor_id"]);
			$this->db->where('email', $_POST["email"]);
			$this->db->update('presupuestos');
				
			redirect('presupuestos/');
		}
		
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/productos.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/productos.js');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Agrometal', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info = array();
		
		$data['info']=$info;
		$data["presupuesto"] = $this->page_model->get_presupuesto_id($presupuesto_reasignar);
		
		$this->template->write_view('content', 'layout/presupuestos/reasignar', $data, TRUE); 
		$this->template->render();
	}

	// ---	
	// -- Update de reasignar.
	// ---
	public function updatereasignar()
	{
	
	
		print "en construccion";
		exit;
	
	}
	
	public function remove(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'mostrar' => 'no'
			);
			$this->page_model->remove_presupuesto($data);
			redirect('presupuestos/');
		}else{
			redirect('login/');
		}
		
	}
	
	public function update()
	{
		if (isset($this->session->userdata['logged_in'])) {
			
			
			$proximo_llamado_time = 0;
			if(isset($_POST["proximo_contacto"]) && strlen($_POST["proximo_contacto"]) > 8)
			{
				$proximo_llamado_time = strtotime($_POST["proximo_contacto"]);
			}
			
			$data = array(
				'tipo_contacto'	=> $_POST["tipo_contacto"],
				'estado_id' => $_POST["estado_id"],
				'evento'	=> $_POST["evento"],
				'motivo_id'	=> $_POST["motivo_id"],
				'presupuesto_id' => $this->uri->segment(3),
				'added_at' => time()
			);
			$this->page_model->add_evento($data);
			
			
			// ---
			// hago update del estado
			// ---
			$this->db->set("motivo_id",$_POST["motivo_id"]);
			$this->db->set("estado_id",$_POST["estado_id"]);
			$this->db->set("modified_at",date("Y-m-d H:i:s"));
			$this->db->set("volver_a_llamar",$proximo_llamado_time);
			$this->db->where("id",$this->uri->segment(3));
			$this->db->update("presupuestos");
			
			redirect('presupuestos/');
		}else{
			redirect('login/');
		}
	}
	
	public function changestatus(){
		$this->page_model->change_status_curso();	
		redirect('cursos/');		
	}
	
	// Logout from admin page
	public function logout() {
		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		redirect('home/');
	}
}
