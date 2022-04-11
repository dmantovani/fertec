<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condiciones extends CI_Controller {
	 
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
		$this->template->write('title', 'Administrador', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_condiciones();
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/condiciones/list', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
	

	
	public function updateCondiciones()
	{
		// ---
		// Actualizo las categorias de las condiciones comerciales
		$categorias_condiciones = $this->page_model->get_condiciones_categorias_dynamics();
		foreach($categorias_condiciones as $cd)
		{
			$id = $cd->ItemInternalId;
			$name = $cd->aw_name;
			$cond_dynamic = $this->page_model->getCondicionCategoryByDynamicId($id);
			
			if(count($cond_dynamic) <= 0)
			{
				// ok insert
				$data = array(
					'estado' => $cd->statuscode,
					'id_dynamics' => $id,
					'categoria' => $name
				);
				$this->db->insert('pago_categorias', $data);
			}
			else
			{
				$this->db->where('id_dynamics', $id);
				$this->db->set('categoria', $name);
				$this->db->set('estado', $cd->statuscode);
				$this->db->update('pago_categorias');
			}
		}
		
		// ---
		// Actualizo las condiciones comerciales
		$condiciones = $this->page_model->get_condiciones_dynamics();
		foreach($condiciones as $cc)
		{
			$cond_dynamic2 = $this->page_model->getCondicionCategoryByDynamicId($cc->_aw_categoria_value);
			$cond_categ_id = $cond_dynamic2[0]->id;
			
			$cond_dynamic_mysql = $this->page_model->getCondicionByDynamicId($cc->ItemInternalId);
			
			if(count($cond_dynamic_mysql) <= 0)
			{
				// ok insert
				$data = array(
					'item' => $cc->aw_name,
					'estado' => $cc->statuscode,
					'id_dynamics' => $cc->ItemInternalId,
					'descuento'	 => "0.00",
					'categoria_id' => $cond_categ_id
				);
				$this->db->insert('pago_categorias_items', $data);
			}
			else
			{
				$this->db->set('item', $cc->aw_name);
				$this->db->set('categoria_id', $cond_categ_id);
				$this->db->set('estado', $cd->statuscode);
				$this->db->set('descuento', 0);
				$this->db->where('id_dynamics', $id);
				$this->db->update('pago_categorias_items');
			}
		}
 
		print "<script>alert('-- Condiciones de pago actualizadas correctamente -- '); window.location='".base_url()."condiciones/'; </script>";
		exit;
		
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
		$this->template->write('title', 'Administrador - Fertec', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		$data['categorias'] = $this->page_model->get_condiciones_categorias();	
		
		$this->template->write_view('content', 'layout/condiciones/add', $data, TRUE); 
		$this->template->render();
	}
	
	public function save(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'item' => $_POST['item'],
				'descuento' => $_POST['descuento'],
				'categoria_id' => $_POST['categoria_id']
			);
			$this->page_model->insert_condiciones($data);
			redirect('condiciones/');
		}else{
			redirect('login/');
		}
		
	}
	public function update(){
		if (isset($this->session->userdata['logged_in'])) {
			
			$data = array(
				'item' => $_POST['item'],
				'descuento' => $_POST['descuento'],
				'categoria_id' => $_POST['categoria_id']
			);
			$this->page_model->update_condiciones($data);
			redirect('condiciones/');
		}else{
			redirect('login/');
		}
		
	}
	public function remove(){
		if (isset($this->session->userdata['logged_in'])) {
			$this->page_model->remove_condiciones();
			redirect('condiciones/');
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
		$this->template->write('title', 'Administrador', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info =  $this->page_model->get_condicion_comercial_id($this->uri->segment(3));
		$data['info']=$info;
		$data['categorias'] = $this->page_model->get_condiciones_categorias();	
		
		$this->template->write_view('content', 'layout/condiciones/edit', $data, TRUE); 
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
		$info =  $this->page_model->get_condicion_comercial_id($this->uri->segment(3));	
		
		if($info[0]->estado == 1)
		{
			// set as inactive
			$this->db->where('id', $info[0]->id);
			$this->db->set('estado', 0);
			$this->db->update('pago_categorias_items');
		}
		else
		{
			// set as active
			$this->db->where('id', $info[0]->id);
			$this->db->set('estado', 1);
			$this->db->update('pago_categorias_items');
		}
		
		redirect('condiciones/');
	}
}
