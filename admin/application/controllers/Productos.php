<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	 
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
		$this->template->write('title', 'Administrador - Pauny', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_productos_backend();
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/productos/list', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
	
	
	// ---	// ---	// ---	// ---	// ---
	// Actualizo precios y productos
	// ---	// ---	// ---	// ---	// ---
	public function updatePrices()
	{
		// ---
		// Actualizo los productos
		$productos = $this->page_model->get_productos_dynamics();	
		foreach($productos as $p){
			
			$prod_dynamic = $this->page_model->get_productos_dynamic_id($p->ItemInternalId);
			
			$marca_id = 0;
			$categoria_id = 0;
			
			$arr = explode("\\",$p->hierarchypath);
			if(count($arr) > 1)
			{
				$marca = $arr[0];
				$categoria = $arr[1];
			}
			else
			{
				$marca = $p->hierarchypath;
				$categoria = $p->hierarchypath;
			}
			
			// --
			// OK sincronizo la marca y la categoria
			$marca = trim($marca);
			$this->db->select('*');
			$this->db->from('marcas');
			$this->db->where("nombre",$marca);
			$query = $this->db->get();
			if ($query->num_rows() >= 1)
			{
				$re = $query->result();
				$marca_id = $re[0]->id;
			} 
			else {
				// ok insert
				$data = array(
					'nombre' 		=> $marca,
					'estado'		=> 1
				);
				$this->db->insert('marcas', $data);
				$marca_id = $this->db->insert_id();
			}
			
			$categoria = trim($categoria);
			$this->db->select('*');
			$this->db->from('categorias');
			$this->db->where("categoria",$categoria);
			$query = $this->db->get();
			if ($query->num_rows() >= 1)
			{
				$re = $query->result();
				$categoria_id = $re[0]->id;
			} 
			else {
				// ok insert
				$data = array(
					'categoria' 		=> $categoria,
					'estado'			=> 1,
					'marca_id' 			=> $marca_id
				);
				$this->db->insert('categorias', $data);
				$categoria_id = $this->db->insert_id();
			}

			// ---
			// OK ahora sobre el producto			
			
			if(count($prod_dynamic) <= 0)
			{
				// ok insert
				$data = array(
					'id_categoria' 		=> $categoria_id, // under construction
					'equipamiento' 		=> $p->description,
					'descripcion' 		=> $p->description,
					'estado' 			=> $p->statuscode,					
					'nombre' 			=> $p->name,
					'dynamic_id' 		=> $p->ItemInternalId
				);
				$this->db->insert('productos', $data);
			}
			else
			{
				$this->db->set('id_categoria', $categoria_id);
				$this->db->set('equipamiento', $p->description);
				$this->db->set('descripcion', $p->description);
				$this->db->set('nombre', $p->name);
				$this->db->set('estado', $p->statuscode);
				$this->db->where('dynamic_id', $p->ItemInternalId);
				$this->db->update('productos');
			}
		}
		
		// ---
		// Actualizo los precios
		$precio = 0;
		$priceLists = $this->page_model->get_precios_dynamics();
		foreach($priceLists as $pl)
		{
			$precio = $pl->amount;
			
			$this->db->set('precio', $pl->amount);
			$this->db->where('dynamic_id', $pl->_productid_value);
			$this->db->update('productos');
		}
		
		if($precio <= 0 || strlen(trim($precio)) <= 0) 
		{
			 // pongo inactivo el producto.
			$this->db->set('xestado', 0);
			$this->db->where('dynamic_id', $p->ItemInternalId);
			$this->db->update('productos');
		}
		
		print "<script>alert('-- PRODUCTOS Y PRECIOS actualizadas correctamente -- '); window.location='".base_url()."productos/'; </script>";
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
		$this->template->write('title', 'Administrador - Pauny Alimentos', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		$data['categorias'] = $this->page_model->get_categorias();
		
		$this->template->write_view('content', 'layout/productos/add', $data, TRUE); 
		$this->template->render();
	}
	
	public function save(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'nombre' => $_POST['nombre'],
				'descripcion' => $_POST['descripcion'],
				'equipamiento' => $_POST['equipamiento'],
				'precio' => $_POST['precio'],
				'id_categoria' => $_POST['categoria'],
				'imagen_render' => basename($_POST['galeria1_input']),
				'imagen' => basename($_POST['galeria2_input'])
			);
			$this->page_model->insert_producto($data);
			redirect('productos/');
		}else{
			redirect('login/');
		}
		
	}
	public function update(){
		if (isset($this->session->userdata['logged_in'])) {
			$data = array(
				'nombre' => $_POST['nombre'],
				'descripcion' => $_POST['descripcion'],
				'equipamiento' => $_POST['equipamiento'],
				'precio' => $_POST['precio'],
				'id_categoria' => $_POST['categoria'],
				'imagen_render' => basename($_POST['galeria1_input']),
				'imagen' => basename($_POST['galeria2_input'])
			);
			$this->page_model->update_producto($data);
			redirect('productos/');
		}else{
			redirect('login/');
		}
		
	}
	public function remove(){
		if (isset($this->session->userdata['logged_in'])) {
			$this->page_model->remove_producto();
			redirect('productos/');
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
		$this->template->write('title', 'Administrador - Pauny', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info =  $this->page_model->get_productos_id($this->uri->segment(3));
		$data['info']=$info;	
		$data['categorias'] = $this->page_model->get_categorias();
		
		$this->template->write_view('content', 'layout/productos/edit', $data, TRUE); 
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
		$info =  $this->page_model->get_productos_id($this->uri->segment(3));	
		
		if($info[0]->estado == 1)
		{
			// set as inactive
			$this->db->where('id', $info[0]->id);
			$this->db->set('estado', 0);
			$this->db->update('productos');
		}
		else
		{
			// set as active
			$this->db->where('id', $info[0]->id);
			$this->db->set('estado', 1);
			$this->db->update('productos');
		}
		
		redirect('productos/');
	}
}
