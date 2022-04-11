<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Concesionarios extends CI_Controller {
	 
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
	} 
	 
	
	public function index()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		if($this->session->userdata['logged_in']['rol'] == 'zona'):
			$info =  $this->page_model->get_concesionarios_zona();
		else:
			$info =  $this->page_model->get_concesionarios();
		endif;
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/concesionarios/list', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	public function proformas()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		
		$data['concesionario'] = $this->page_model->get_concesionario_id($this->uri->segment(3));
		$data['info']=$this->page_model->get_proformas_concesionario_id($this->uri->segment(3));
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/concesionarios/proformas', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}


	public function usuarios()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_concesionarios_usuarios();
		$data['concesionario'] = $this->page_model->get_concesionario_id($this->uri->segment(3));
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/concesionarios/usuarios/list', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	public function add(){
		
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		$data = '';
	
		$this->template->write_view('content', 'layout/concesionarios/add', $data, TRUE); 
		$this->template->render();
	}

	public function add_usuario(){
		
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		$info =  $this->page_model->get_provincias();
		$data['provincias']=$info;
	
		$this->template->write_view('content', 'layout/concesionarios/usuarios/add', $data, TRUE); 
		$this->template->render();
	}
	
	public function save(){
		$data = array(
			'nombre' => $_POST['nombre']
		);

		if($this->session->userdata['logged_in']['rol'] == 'zona'):
			$this->db->insert('concesionarios', $data);
			$id_concesionario = $this->db->insert_id();
			$data_zona = array(
				'id_usuario' => $this->session->userdata['logged_in']['id_user'],
				'id_concesionario' => $id_concesionario
			);
			$this->db->insert('zonas', $data_zona);
		else:
			$this->page_model->insert_concesionario($data);
		endif;
		redirect('concesionarios/');
		
	}
	public function update(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'nombre' => $_POST['nombre']
			);
			$this->page_model->update_concesionario($data);
			redirect('concesionarios/');
		}else{
			redirect('login/');
		}
		
	}
	public function remove(){
		if (isset($this->session->userdata['logged_in'])) {
			$this->page_model->remove_concesionario();
			redirect('concesionarios/');
		}else{
			redirect('login/');
		}
		
	}

	public function remove_usuario(){
		if (isset($this->session->userdata['logged_in'])) {
			$this->page_model->remove_concesionario_usuario();
			redirect('concesionarios/usuarios/'.$_GET['id_concesionario'].'');
		}else{
			redirect('login/');
		}
		
	}
	
	public function edit(){
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_concesionario_id($this->uri->segment(3));		
		$data['info']=$info;

		$concesionarios_unidades =  $this->page_model->get_unidades_concesionario($data['info'][0]->{'id'});
		$data['concesionarios_unidades']=$concesionarios_unidades;
		
		$data['unidades'] = $this->page_model->get_marcas();

		$this->template->write_view('content', 'layout/concesionarios/edit', $data, TRUE); 
		$this->template->render();
	}


	public function edit_usuario(){
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info =  $this->page_model->get_usuarios_id($this->uri->segment(3));		
		$data['info']=$info;
		
		$info =  $this->page_model->get_provincias();
		$data['provincias']=$info;
		
		$this->template->write_view('content', 'layout/concesionarios/usuarios/edit', $data, TRUE); 
		$this->template->render();
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
	
	public function save_user(){
		//comprobar si el usuario no existe

		$this->db->where('user_name', $_POST['usuario']);
		$get = $this->db->get('user_login');
		if($get->num_rows() > 0):
			echo "nouser";
		else:

			$data = array(
				'user_name' => $_POST['usuario'],
				'provinciaId' => $_POST['provincia'],
				'name' => $_POST['nombre'],
				'lastname' => $_POST['apellido'],
				'user_password' => md5($_POST['password']),
				'user_email' => $_POST['email'],
				'rol' => $_POST['rol'],
				'concesionario_id' => $_POST['concesionario_id']
			);
			$this->page_model->insert_usuario($data);

			echo 'concesionarios/usuarios/'.$_POST['concesionario_id'].'';

		endif;
		
	}

	public function update_user(){
		if (isset($this->session->userdata['logged_in'])) {
			if(isset($_POST['administrator'])){$adminn = 1;}else{$adminn = 0;} 
			$data = array(
				'user_name' => $_POST['usuario'],
				'provinciaId' => $_POST['provincia'],
				'name' => $_POST['nombre'],
				'lastname' => $_POST['apellido'],
				'user_password' => md5($_POST['password']),
				'user_email' => $_POST['email'],
				'rol' => $_POST['rol'],
				'concesionario_id' => $_POST['concesionario_id']
			);
			$this->page_model->update_usuario_concesionario($data);
			redirect('concesionarios/usuarios/'.$_POST['concesionario_id'].'');
		}else{
			redirect('login/');
		}
		
	}
	
}
