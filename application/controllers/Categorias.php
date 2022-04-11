<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

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
		
		// auto-seteo los datos.
		$this->page_model->autoSetDatos();
		
		
		$this->load->library('GetResponse'); 
		
		$this->getresponse->enterprise_domain = 'cloud.oxford.com.ar';

		
		$result = $this->getresponse->getContacts();
		$data['contactos']= $result;
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');

		$this->template->add_css('asset/css/home.css?v='.time().'');

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
		$this->template->write('title', 'Fertec - Categorias', TRUE);
		$this->template->write('description', '', TRUE);
		$this->template->write('keywords', '', TRUE);
		$this->template->write('image', '', TRUE);
		$this->template->write('ogType', 'website', TRUE);
		//obtenemos los usuarios
		//$data['users'] = array("aaa" => "bbb"); // $this->page_model->get_users();	
		$CI =& get_instance();
		$data["categorias"] = $this->page_model->get_categorias();
		$data["subcategorias"] = $this->page_model->get_subcategorias($_GET['id_subcategoria']);
		$data["categoria"] = $this->page_model->get_marca_id($_GET['id_subcategoria']);

		$this->template->write_view('content', 'layout/producto/categorias', $data);
		$this->template->write_view('header', 'layout/header', $data);
		$this->template->write_view('footer', 'layout/footer');   
		
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	}
	
	
	public function send_form()
	{	

		$utm_medium = $this->session->userdata("utm_medium");
		$utm_source = $this->session->userdata("utm_source");
	
			$data = array(
				'nombre' => $_POST['nombre'],
				'localidad' => $_POST['localidad'],
				'telefono' => $_POST['celular'],
				'email' => $_POST['mail'],
				'medio_comunicacion' => $_POST['medio_comunicacion'],
				'added_at' => date("Y-m-d H:i:s"),
				'utm_source' => $utm_source,
				'utm_medium' => $utm_medium,
				'modified_at' => date("Y-m-d H:i:s"),
				'estado_id' => 1,
			);
			
			if(isset($_POST["paso_01"])) $data["paso_01"] = $_POST["paso_01"];
			if(isset($_POST["paso_02"])) $data["paso_02"] = $_POST["paso_02"];
			if(isset($_POST["paso_03"])) $data["paso_03"] = $_POST["paso_03"];
			if(isset($_POST["paso_04"])) $data["paso_04"] = $_POST["paso_04"];
			if(isset($_POST["paso_05"])) $data["paso_05"] = $_POST["paso_05"];
			if(isset($_POST["paso_06"])) $data["paso_06"] = $_POST["paso_06"];
			
			$email = $_POST['mail'];
			$this->page_model->insert_registro($data);
			
			/*
			$query = $this->db->query("SELECT * FROM lead WHERE mail='$email'");

			if ($query->row() > 0) {
			  	  echo "taken";
			  	  exit();
			  	}
			else {
				
			}
			*/

			//print_r("enviado");
			//exit;

			$this->email->clear(TRUE);

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

		    $asunto = $_POST['nombre'].' se registro en Fertec';

	    	$mensaje = '<h1>Datos ingresados</h1>
		    			<b>Nombre (Completo): </b>'.$_POST['nombre'].'<br>
		    			<b>Localidad: </b>'.$_POST['localidad'].'<br>
		    			<b>Telefono: </b>'.$_POST['celular'].'<br>
		    			<b>Email: </b>'.$_POST['mail'].'<br>';		    

		    $name = $_POST['nombre'];
		    $email = $_POST['mail'];

		    $this->email->from($email,$name);
		    $this->email->to('asociados@mutualmedica.org.ar');
//		    $this->email->cc('landbertoldi@bertoldi.com.ar');
			$this->email->cc('diego.mantovani@gmail.com');
		    $this->email->subject($asunto);
		    $this->email->message($mensaje);



		    if ( ! $this->email->send()) {
		        show_error($this->email->print_debugger());
		    } else {
		    	redirect('home/gracias/');
		    }
			
	}
	
	
	
	public function gracias()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa

		$this->template->add_css('asset/css/home.css');

		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/home.js');

	    
		//la sección header será el archivo views/registro/header_template
	   $this->template->write_view('header', 'layout/header', $data);
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Fertec - Gracias', TRUE);
		$this->template->write('description', '', TRUE);
		$this->template->write('keywords', '', TRUE);
		
		//obtenemos los usuarios
		//$data['users'] = array("aaa" => "bbb"); // $this->page_model->get_users();	
		$CI =& get_instance();

		
		
		
		
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/home/gracias', $data); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    $this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
	
}
