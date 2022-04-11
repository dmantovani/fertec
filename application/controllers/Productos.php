<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

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
	   $this->load->helper('url');
	   $this->load->helper('cookie');
	   
	   $this->load->library('session');
	} 
	 
	
	public function index()
	{
		if(isset($this->session->userdata['logged_in'])){
		} else {
			redirect('/');
			exit;
		}
		
		$this->page_model->autoSetDatos();
		
		
        /*
		$this->load->library('GetResponse'); 
		$this->getresponse->enterprise_domain = 'cloud.oxford.com.ar';

		$result = $this->getresponse->getContacts();
		$data['contactos']= $result;
        */
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');

		$this->template->add_css('asset/css/producto.css?v='.time().'');

		// --		
		// Save utm
		// --
	    if(isset($_GET["utm_medium"]) && strlen($_GET["utm_medium"]) > 1)
	    {
	    	$this->session->set_userdata("utm_medium",$_GET["utm_medium"]);	   
	    }
	   
	    if(isset($_GET["utm_source"])  && strlen($_GET["utm_source"]) > 1)
	    {
 	   	 	$this->session->set_userdata("utm_source",$_GET["utm_source"]);	   
 	    }
		
		//añadimos los archivos js que necesitemoa		
		//$this->template->add_js('asset/js/home.js');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Fertec - Productos', TRUE);
		$this->template->write('description', '', TRUE);
		$this->template->write('keywords', '', TRUE);
		$this->template->write('image', '', TRUE);
		$this->template->write('ogType', 'website', TRUE);
		//obtenemos los usuarios
		//$data['users'] = array("aaa" => "bbb"); // $this->page_model->get_users();	
		$CI =& get_instance();	
		
 		$data['productos'] = $this->page_model->get_productos();
 		$data['productos_todos'] = $this->page_model->get_todos_productos();
 		
 		$data["cart_final"] = $this->page_model->render_cart(true);

		$this->template->write_view('content', 'layout/producto/producto', $data);
		
		$this->template->write_view('header', 'layout/header', $data);
		 
		$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	public function condiciones()
	{
		if(isset($this->session->userdata['logged_in'])){
		} else {
			redirect('/');
			exit;
		}
		$this->load->library('GetResponse'); 
		
		$this->getresponse->enterprise_domain = 'cloud.oxford.com.ar';

		$result = $this->getresponse->getContacts();
		$data['contactos']= $result;
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
		$this->template->add_css('asset/css/producto.css');

		// --		
		// Save utm
		// --
	    if(isset($_GET["utm_medium"]) && strlen($_GET["utm_medium"]) > 1) {
	    		$this->session->set_userdata("utm_medium",$_GET["utm_medium"]);	   
	    }
	   
	    if(isset($_GET["utm_source"])  && strlen($_GET["utm_source"]) > 1) {
 	   	 	$this->session->set_userdata("utm_source",$_GET["utm_source"]);	   
 	    }
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Fertec - Productos - Condiciones', TRUE);
		$this->template->write('description', '', TRUE);
		$this->template->write('keywords', '', TRUE);
		$this->template->write('image', '', TRUE);
		$this->template->write('ogType', 'website', TRUE);
		
		//obtenemos los usuarios
		$CI =& get_instance();	
		
        // ---
        // Getting condiciones categorias
        // ---
        $data["categorias"] = $this->page_model->getPagoCategorias();
        $data["cart_final"] = $this->page_model->render_cart(true);       
 
		$this->template->write_view('content', 'layout/producto/condiciones', $data);
		$this->template->write_view('header', 'layout/header', $data);
		$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	}
}
