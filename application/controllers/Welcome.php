<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	} 
	 
	
	public function index()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('registro');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('css/estilos.css');
		
		//añadimos los archivos js que necesitemoa
		//$this->template->add_js('js/jquery.min.js');
	    //$this->template->add_js('js/validate.jquery.js');
	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Pauny', TRUE);
		
		//obtenemos los usuarios
		$data['users'] = array("aaa" => "bbb"); // $this->page_model->get_users();	
		
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'registro/formulario_registro', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    $this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
	

	// testing diego uri method
	function diego()
	{
	
		print "hola diego";
		exit;
			
	}
}
