<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	 
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
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/login.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/login.js');


	    
		//la sección header será el archivo views/registro/header_template
	    //$this->template->write_view('header', 'layout/header');
		//$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);
		//$this->template->write('image', 'asset/img/slides/3.jpg', TRUE);
		//$this->template->write('ogType', 'website', TRUE);
		//obtenemos los usuarios
		//$data['users'] = array("aaa" => "bbb"); // $this->page_model->get_users();	
		$CI =& get_instance();

		$data = '';
		//$history =  $this->page_model->get_history();
		//data['history']=$history;
		
			
		
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/login/login', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	// Check for user login process
	public function user_login_process() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
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
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
			);
			$result = $this->page_model->login($data);
			if ($result == TRUE) {
				$username = $this->input->post('username');
				$result = $this->page_model->read_user_information($username);
				if ($result != false) {
					$session_data = array(
					'id_user' => $result[0]->id,
					'username' => $result[0]->user_name,
					'rol_id' => $result[0]->rol_id,
					'email' => $result[0]->user_email,
					'provinciaId' => $result[0]->provinciaId,
					'provincia' => $result[0]->provincia,
					'vendedor_id' => $result[0]->vendedor_id,
					'administrator' => $result[0]->administrator,
					'concesionario' => $result[0]->concesionario_id,
					'rol' => $result[0]->rol
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
				
					redirect('home/');
				}
			} else {
				$data = array(
				'error_message' => 'Usuario/clave incorrecta'
				);
				redirect('login/fail/');
			}
		}
	}

	
	public function fail() {
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/login.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/login.js');


	    
		//la sección header será el archivo views/registro/header_template
	    //$this->template->write_view('header', 'layout/header');
		//$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Pauny - Carnes Vacunas, Carnes Porcinas, Fiambres', TRUE);
		$this->template->write('description', 'Empresa familiar con más de 100 años de tradición que elabora, comercializa y distribuye tanto fiambres como carnes vacunas y porcinas en Argentina y el mundo.', TRUE);
		$this->template->write('keywords', 'carne vacuna, carne de vaca, carne porcina, carne de cerdo, fiambres, frigorifico, exportacion de carnes, carne argentina, argentinean food', TRUE);
		//$this->template->write('image', 'asset/img/slides/3.jpg', TRUE);
		//$this->template->write('ogType', 'website', TRUE);
		//obtenemos los usuarios
		//$data['users'] = array("aaa" => "bbb"); // $this->page_model->get_users();	
		$CI =& get_instance();

		$data = array(
			'error_message' => 'Invalid Username or Password'
			);
		//$history =  $this->page_model->get_history();
		//data['history']=$history;
		
			
		
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/login/login', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	}
}
