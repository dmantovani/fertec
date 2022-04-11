<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {
	 
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
		$this->template->add_css('asset/css/banner.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/banner.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_marcas();
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/marcas/list', $data, TRUE); 
	    
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
		$this->template->add_css('asset/css/banner.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/banner.js?v='.time().'');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec Alimentos', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		$data ="";
		
		$this->template->write_view('content', 'layout/marcas/add', $data, TRUE); 
		$this->template->render();
	}
	
	public function save(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'nombre' => $_POST['nombre'],
				'logo' => basename($_POST['galeria1_input'])
			);
			$this->page_model->insert_marca($data);
			redirect('marcas/');
		}else{
			redirect('login/');
		}
		
	}
	public function update(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'nombre' => $_POST['nombre'],
				'logo' => basename($_POST['galeria1_input'])
			);
			$this->page_model->update_marca($data);
			redirect('marcas/');
		}else{
			redirect('login/');
		}
		
	}
	public function remove(){
		if (isset($this->session->userdata['logged_in'])) {
			$this->page_model->remove_marca();
			redirect('marcas/');
		}else{
			redirect('login/');
		}
		
	}
	
	public function edit(){
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/banner.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/banner.js?v='.time().'');
		
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info =  $this->page_model->get_marca_id($this->uri->segment(3));
		$data['info']=$info;	
		
		$this->template->write_view('content', 'layout/marcas/edit', $data, TRUE); 
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
	
	public function active()
	{
		$info =  $this->page_model->get_marca_id($this->uri->segment(3));	
		
		if($info[0]->estado == 1)
		{
			// set as inactive
			$this->db->where('id', $info[0]->id);
			$this->db->set('estado', 0);
			$this->db->update('marcas');
		}
		else
		{
			// set as active
			$this->db->where('id', $info[0]->id);
			$this->db->set('estado', 1);
			$this->db->update('marcas');
		}
		
		redirect('marcas/');
	}
}
