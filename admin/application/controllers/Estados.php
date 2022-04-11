<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estados extends CI_Controller {
	 
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
		$this->template->write('title', 'Administrador - Pauny', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();

		$info =  $this->page_model->get_estados();
		$data['info']=$info;
		

		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/estados/list', $data, TRUE); 
	    
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
		$this->template->write('title', 'Administrador - Pauny', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		
		$data = '';
		
		$this->template->write_view('content', 'layout/estados/add', $data, TRUE); 
		$this->template->render();
	}
	
	public function save(){
		$data = array(
			'nombre' => $_POST['nombre'],
		);
		$this->page_model->insert_estados($data);
		redirect('estados/');
		
	}
	public function update(){
		$data = array(
			'nombre' => $_POST['nombre'],
		);
		$this->page_model->update_estados($data);
		redirect('estados/');
		
	}
	public function remove(){
		if (isset($this->session->userdata['logged_in'])) {
			$this->page_model->remove_estados();
			redirect('estados/');
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
		$this->template->write('title', 'Administrador - Pauny', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);

		$CI =& get_instance();
		$info =  $this->page_model->get_estados_id($this->uri->segment(3));		
		$data['info']=$info;
		
		$this->template->write_view('content', 'layout/estados/edit', $data, TRUE); 
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
	
	public function SendForm()
	{
		$parmsJSON = (isset($_POST['_p']))?$_POST['_p']:$_GET['_p'];
		$parmsJSON = urldecode(base64_decode ( $parmsJSON ));
		$JSON = new Services_JSON();
		$parmsJSON = $JSON->decode($parmsJSON);
		$asunto = $parmsJSON->{'asunto'};
		$mensaje = rawURLdecode($parmsJSON->{'mensaje'});
		$name = $parmsJSON->{'name'};
		$email = $parmsJSON->{'email'};
		$para = $parmsJSON->{'para'};
			
		$mAIL = new MAIL;
		$mAIL->From($email,$name);
        							
		$mAIL->AddTo($para);
		 $mAIL->Subject(utf8_encode($asunto));
									
	     $contact['message_body'] = $mensaje;
							        
		$mAIL->Html($contact['message_body']);
									
	 
		$cON = $mAIL->Connect("smtp.gmail.com", (int)465, "diego.mantovani@gmail.com", "p4t0f30p4t0f30", "tls") or die(print_r($mAIL->Result));
        $mAIL->Send($cON) ? $sent = true : $sent = false;
		$mAIL->Disconnect();
		
		
		if(!$sent) {
		 print '{"resultado":"NO","error":"'.$mAIL->Result.'"}';
		} else {
		  print '{"resultado":"OK"}';
		}

		exit;
			
	}
}
