<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	 
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
		$this->template->add_css('asset/css/home.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/home.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);
		
		$CI =& get_instance();

		

		$data ='';
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/home/home', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
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
	public function upload() {
		$parmsJSON = (isset($_POST['_p']))?$_POST['_p']:$_GET['_p'];
		$parmsJSON = urldecode(base64_decode ( $parmsJSON ));
		$JSON = new Services_JSON();
		$parmsJSON = $JSON->decode($parmsJSON);
			
		$max_file=$parmsJSON->{'maxSize'};
		$max_width=$parmsJSON->{'maxWidth'};
		$nombreImagen=$parmsJSON->{'nombreImagen'};
		$nombreArchivo=$parmsJSON->{'nombreArchivo'};
		$allowedTypes=$parmsJSON->{'allowedTypes'};
		$dir=$parmsJSON->{'dir'};
		
		
		
		$carpeta=dirname(__FILE__)."/".$dir;
		
		$allowed_image_types = explode(",",$allowedTypes);
		
		$allowed_image_ext = array_unique($allowed_image_types); // Do not change this
		$image_ext = "";
		foreach ($allowed_image_ext as $mime_type => $ext) {
		    $image_ext.= strtoupper($ext)." ";
		}
		
		//print $carpeta;
		if(!is_dir($carpeta)){
//			mkdir($carpeta, 0777);
//			chmod($carpeta, 0777);
		}	
		
		//Get the file information

		$userfile_name = $_FILES['Filedata']['name'];
		$userfile_tmp = $_FILES['Filedata']['tmp_name'];
		$userfile_size = $_FILES['Filedata']['size'];
		$userfile_type = $_FILES['Filedata']['type'];
		$filename = basename($_FILES['Filedata']['name']);
		$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));

		$nombreArchivo = str_replace("#original#", substr($filename, 0,strrpos($filename, '.')), $nombreArchivo);
		$nombreImagen = str_replace("#original#", substr($filename, 0,strrpos($filename, '.')), $nombreImagen);
		
		//Only process if the file is a JPG and below the allowed limit
		if((!empty($_FILES["Filedata"])) && ($_FILES['Filedata']['error'] == 0)) {
			foreach ($allowed_image_types as $ext) {
				//loop through the specified image types and if they match the extension then break out
				//everything is ok so go and check file size
				if($file_ext==$ext){
					$error = "";
					break;
				}else{
					$error = "Solo esta permitido subir archivos <strong>".$image_ext."</strong> <br />";
				}
			}			
		}else{
			$error= "Seleccione un archivo a subir";
		}

		//Everything is ok, so we can upload the image.
		if (strlen($error)==0){
			if (isset($_FILES['Filedata']['name'])){
				if($ext=='jpg' || $ext=='png' || $ext=='gif'){
					$large_image_location = $carpeta.$nombreImagen.'_'.$filename ;
					//check if the file size is above the allowed limit
					
					move_uploaded_file($userfile_tmp, $large_image_location);
//					chmod($large_image_location, 0777);
					
					$output = '{"resultado":"OK","mime":"'.$ext.'","file":"'.$large_image_location.'","url":"'.$dir.$nombreImagen.'_'.$filename.'","img_w":"'.$this->getWidth($large_image_location).'","img_h":"'.$this->getHeight($large_image_location).'"}';
				}else{
					$large_image_location = $carpeta.$nombreArchivo.'_'.$filename ;
					move_uploaded_file($userfile_tmp, $large_image_location);
//					chmod($large_image_location, 0777);
					//echo '{"resultado":"OK","mime":"'.$ext.'","file":"'.$large_image_location.'","url":"./'.$_POST['dir'].$nombreArchivo.'.'.$file_ext.'"}';
					$output = '{"resultado":"OK","mime":"'.$ext.'","file":"'.$large_image_location.'","url":"'.$dir.$nombreArchivo.'_'.$filename.'"}';
				}
				
			}
		}else{
			//echo '{"resultado":"NO","error":"'.$error.'"}';
			$output = '{"resultado":"NO","error":"'.$error.'"}';
		}
		
		print $output;		
	}
	
	function getHeight($image) {
			$size = getimagesize($image);
			$height = $size[1];
			return $height;
		}
		//You do not need to alter these functions
		function getWidth($image) {
			$size = getimagesize($image);
			$width = $size[0];
			return $width;
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
	
	public function defile() {
		$parmsJSON = (isset($_POST['_p']))?$_POST['_p']:$_GET['_p'];
		$parmsJSON = urldecode(base64_decode ( $parmsJSON ));
		$JSON = new Services_JSON();
		$parmsJSON = $JSON->decode($parmsJSON);
		$file = $parmsJSON->{'file'};
		if (isset($this->session->userdata['logged_in'])) {
			print dirname(__FILE__).'/'.$file;
			if (file_exists(dirname(__FILE__).'/'.$file)) {
				unlink(dirname(__FILE__).'/'.$file);
				$output =  '{"resultado":"OK"}';
			}else{
				//echo '{"resultado":"NO"}';
				$output =  '{"resultado":"NO"}';
			}
			print $output;
		}
	}
}
