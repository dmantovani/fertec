<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {
	 
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

		$data['totalSessions']	= 0;//$this->gapi->getSessions();
		$data['totalUsers']		= 0;//$this->gapi->getUsers();
		$data['totalPageViews']	= 0;//$this->gapi->getPageviews();
		$data['totalOrganik']	= 0;//$this->gapi->getOrganicSearches();
		$data['totalBounce']	= 0;//$this->gapi->getBounceRate();
		$data['totalResults']	= 0;//$this->gapi->getResults();
		$data['startDate']       =  date('Y-m-d', strtotime("-31 days"));
		
		$data['counting'] = $this->page_model->countDashboard();
		$data['countingsinasignar'] = $this->page_model->countDashboardSinAsignar();
//		print_r($data['counting']);
		
		$data["total"]=0;
		
		$data["activos"]=0;
		$data["pendientes"]=0;
		$data["ventas"]=0;
		foreach($data["counting"] as $cc)
		{
			$data["total"] = $data["total"] + $cc->kant_total;
			
			if($cc->estado_id == 1) $data["activos"] = $data["activos"]+$cc->kant_total;
			if($cc->estado_id == 2) $data["pendientes"] = $data["pendientes"]+$cc->kant_total;
			if($cc->estado_id == 3) $data["ventas"] = $data["ventas"]+$cc->kant_total;
		}

		foreach($data["countingsinasignar"] as $cc2)
		{
			$data["total_sinasignar"] = $data["total_sinasignar"] + $cc2->kant_total;
		}

		$data['vendedores'] = $this->page_model->get_vendedores_est();
				
		$data['presupuestos'] = $this->page_model->get_clientes_presupuestos();
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/estadisticas/estadisticas', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}


	public function ventas()
	{
		// ----------------------------
		// testing templating method
		// ----------------------------
	
		//como hemos creado el grupo registro podemos utilizarlo
	    $this->template->set_template('template');
	    
		//añadimos los archivos css que necesitemoa
		$this->template->add_css('asset/css/home.css');
		$this->template->add_css('asset/css/usuarios.css');
		
		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/home.js');

		//añadimos los archivos js que necesitemoa
		$this->template->add_js('asset/js/usuarios.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);
		
		$CI =& get_instance();

		$data['totalSessions']	= 0;//$this->gapi->getSessions();
		$data['totalUsers']		= 0;//$this->gapi->getUsers();
		$data['totalPageViews']	= 0;//$this->gapi->getPageviews();
		$data['totalOrganik']	= 0;//$this->gapi->getOrganicSearches();
		$data['totalBounce']	= 0;//$this->gapi->getBounceRate();
		$data['totalResults']	= 0;//$this->gapi->getResults();
		$data['startDate']       =  date('Y-m-d', strtotime("-31 days"));
		
		$data['counting'] = $this->page_model->countDashboard();
		$data['countingventas'] = $this->page_model->countDashboardVentas();
		$data['countingsinasignar'] = $this->page_model->countDashboardSinAsignar();
//		print_r($data['counting']);
		
		$data["total"]=0;
		$data["total_ventas"]=0;
		
		$data["activos"]=0;
		$data["pendientes"]=0;
		$data["ventas"]=0;

		foreach($data["countingventas"] as $vv)
		{
			$data["total_ventas"] = $data["total_ventas"] + $vv->kant_total;
		}
		foreach($data["counting"] as $cc)
		{
			$data["total"] = $data["total"] + $cc->kant_total;
			
			if($cc->estado_id == 1) $data["activos"] = $data["activos"]+$cc->kant_total;
			if($cc->estado_id == 2) $data["pendientes"] = $data["pendientes"]+$cc->kant_total;
			if($cc->estado_id == 3) $data["ventas"] = $data["ventas"]+$cc->kant_total;
		}

		foreach($data["countingsinasignar"] as $cc2)
		{
			$data["total_sinasignar"] = $data["total_sinasignar"] + $cc2->kant_total;
		}

		$data['vendedores'] = $this->page_model->get_vendedores_est();
				
		$data['presupuestos'] = $this->page_model->get_clientes_presupuestos();

		$data['asesores'] = $this->page_model->get_asesores();

		$data['leads_periodo'] = $this->page_model->get_leads_periodo();
		$data['leads_periodo_post'] = $this->page_model->get_leads_periodo_post();

		$data['leads_periodo_dia'] = $this->page_model->get_leads_periodo_dia();
		$data['leads_periodo_post_dia'] = $this->page_model->get_leads_periodo_post_dia();


		$data['leads_edad'] = $this->page_model->get_leads_edad();
		$data['leads_localidad'] = $this->page_model->get_leads_localidad();



		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/estadisticas/ventas', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}

	public function vista_asesores_mes()
	{

		$this->db->select("count(*) as count, presupuestos.*");
		$this->db->select('vendedores.vendedor as vendedor');
		$this->db->group_by('presupuestos.estado_id');
		$this->db->group_by('presupuestos.vendedor_id');
		$this->db->where('presupuestos.estado_id', 4);
		$this->db->order_by("presupuestos.modified_at","asc");

		if(isset($_POST["asesores"]))
		{
			$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
		}

		if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
		{
		    $date_incio = new DateTime($_POST["fecha_inicio"]);
		    $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

		    $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
		}
		
		if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
		{   
		    $date_fin = new DateTime($_POST["fecha_fin"]);
		    $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
		}


		if(isset($_POST["tiempo_modal"]) && strlen($_POST["tiempo_modal"]) > 0)
		{	

			$primer_dia = date('Y-m-01', strtotime($_POST["tiempo_modal"]));
		    $this->db->where('presupuestos.modified_at >=' ,$primer_dia);
		}
		
		if(isset($_POST["tiempo_modal"]) && strlen($_POST["tiempo_modal"]) > 0)
		{   
			$ultimo_dia = date('Y-m-t', strtotime($_POST["tiempo_modal"]));
		    $this->db->where('presupuestos.modified_at <=' ,$ultimo_dia);
		}

		$this->db->join('vendedores','vendedores.id = presupuestos.vendedor_id');

		$query = $this->db->get('presupuestos');
		$asesores = $query->result();
		$response = '
		<h3 style="margin-top: 0;margin-bottom: 20px;font-weight: bold;font-size: 15px;border-bottom: 1px rgba(0, 0, 0, 0.23) solid;padding-bottom: 10px;">Ventas por asesor</h3>
		<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">';
		$response.='<thead>
						<tr>
				  			<th width="">Mes</th>
				  			<th width="">Ventas</th>
				  			<th width="100" style="text-align:center;">Asesor</th>
						</tr>
					</thead>
                    <tbody>';
        foreach($asesores as $asesor):
        	$response.='<tr>
                            <td>'.date("M",strtotime($asesor->{'modified_at'})).'</td>
                            <td>'.$asesor->{'count'}.'</td>
                            <td style="text-align:center">'.$asesor->{'vendedor'}.'</td>
                          </tr>';
        endforeach;

        $response.='</tbody>
                  </table>';
		
		echo $response;

	}

	public function vista_asesores_dia()
	{

		$this->db->select("count(*) as count, presupuestos.*");
		$this->db->select('vendedores.vendedor as vendedor');
		$this->db->group_by('presupuestos.vendedor_id');
		$this->db->where('presupuestos.estado_id', 4);
		$this->db->order_by("presupuestos.modified_at","asc");

		if(isset($_POST["asesores"]))
		{
			$this->db->where('presupuestos.vendedor_id' , $_POST["asesores"]);
		}

		if(isset($_POST["fecha_inicio"]) && strlen($_POST["fecha_inicio"]) > 0)
		{
		    $date_incio = new DateTime($_POST["fecha_inicio"]);
		    $where_inicio =  'modified_at >='.$date_incio->format("d-m-Y H:i:s");

		    $this->db->where('modified_at >=' ,$date_incio->format("Y-m-d H:i:s"));
		}
		
		if(isset($_POST["fecha_fin"]) && strlen($_POST["fecha_fin"]) > 0)
		{   
		    $date_fin = new DateTime($_POST["fecha_fin"]);
		    $this->db->where('modified_at <=' ,$date_fin->format("Y-m-d H:i:s"));
		}



		if(isset($_POST["tiempo_modal_dia"]) && strlen($_POST["tiempo_modal_dia"]) > 0)
		{	

			$primer_dia = date('Y-m-d 01:00:00', strtotime($_POST["tiempo_modal_dia"]));
		    $this->db->where('presupuestos.modified_at >=' ,$primer_dia);
		}
		
		if(isset($_POST["tiempo_modal_dia"]) && strlen($_POST["tiempo_modal_dia"]) > 0)
		{   
			$ultimo_dia = date('Y-m-d 23:59:00', strtotime($_POST["tiempo_modal_dia"]));
		    $this->db->where('presupuestos.modified_at <=' ,$ultimo_dia);
		}

		
		$this->db->join('vendedores','vendedores.id = presupuestos.vendedor_id');

		$query = $this->db->get('presupuestos');
		$asesores = $query->result();

		$response = '
		<h3 style="margin-top: 0;margin-bottom: 20px;font-weight: bold;font-size: 15px;border-bottom: 1px rgba(0, 0, 0, 0.23) solid;padding-bottom: 10px;">Ventas por día</h3>
		<table id="list" class="table table-striped table-bordered dataTable" width="100%" cellspacing="0">';
		$response.='<thead>
						<tr>
				  			<th width="">Día</th>
				  			<th width="">Ventas</th>
				  			<th width="100" style="text-align:center;">Asesor</th>
						</tr>
					</thead>
                    <tbody>';
        foreach($asesores as $asesor):
        	$response.='<tr>
                            <td>'.date("d",strtotime($asesor->{'modified_at'})).'</td>
                            <td>'.$asesor->{'count'}.'</td>
                            <td style="text-align:center">'.$asesor->{'vendedor'}.'</td>
                          </tr>';
        endforeach;

        $response.='</tbody>
                  </table>';
		
		echo $response;

	}

	public function conversiones()
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
		$this->template->add_js('asset/js/usuarios.js');


	    
		//la sección header será el archivo views/registro/header_template
	    $this->template->write_view('header', 'layout/header');
		$this->template->write_view('nav', 'layout/nav');
	    
		//desde aquí también podemos setear el título
		$this->template->write('title', 'Administrador', TRUE);
		$this->template->write('description', 'Administrador de contenidos', TRUE);
		$this->template->write('keywords', '', TRUE);
		
		$CI =& get_instance();

		$data['totalSessions']	= 0;//$this->gapi->getSessions();
		$data['totalUsers']		= 0;//$this->gapi->getUsers();
		$data['totalPageViews']	= 0;//$this->gapi->getPageviews();
		$data['totalOrganik']	= 0;//$this->gapi->getOrganicSearches();
		$data['totalBounce']	= 0;//$this->gapi->getBounceRate();
		$data['totalResults']	= 0;//$this->gapi->getResults();
		$data['startDate']       =  date('Y-m-d', strtotime("-31 days"));
		
		$data['counting'] = $this->page_model->countDashboard();
		$data['countingsinasignar'] = $this->page_model->countDashboardSinAsignar();
//		print_r($data['counting']);
		
		$data["total"]=0;
		
		$data["activos"]=0;
		$data["pendientes"]=0;
		$data["ventas"]=0;
		foreach($data["counting"] as $cc)
		{
			$data["total"] = $data["total"] + $cc->kant_total;
			
			if($cc->estado_id == 1) $data["activos"] = $data["activos"]+$cc->kant_total;
			if($cc->estado_id == 2) $data["pendientes"] = $data["pendientes"]+$cc->kant_total;
			if($cc->estado_id == 3) $data["ventas"] = $data["ventas"]+$cc->kant_total;
		}

		foreach($data["countingsinasignar"] as $cc2)
		{
			$data["total_sinasignar"] = $data["total_sinasignar"] + $cc2->kant_total;
		}
		
		
		$data['vendedores'] = $this->page_model->get_vendedores_est();
				
		$data['presupuestos'] = $this->page_model->get_clientes_presupuestos();

		$data['asesores'] = $this->page_model->get_asesores();

		$data['leads_periodo'] = $this->page_model->get_leads_periodo_conversiones();
		$data['leads_periodo_post'] = $this->page_model->get_leads_periodo_post_conversiones();

		$data['leads_periodo_dia'] = $this->page_model->get_leads_periodo_dia_conversiones();
		$data['leads_periodo_post_dia'] = $this->page_model->get_leads_periodo_post_dia_conversiones();


		$data['leads_edad'] = $this->page_model->get_leads_edad_conversiones();
		$data['leads_localidad'] = $this->page_model->get_leads_localidad_conversiones();

		
		//el contenido de nuestro formulario estará en views/registro/formulario_registro,
		//de esta forma también podemos pasar el array data a registro/formulario_registro
	    $this->template->write_view('content', 'layout/estadisticas/conversiones', $data, TRUE); 
	    
		//la sección footer será el archivo views/registro/footer_template
	    //$this->template->write_view('footer', 'layout/footer');   
	    
		//con el método render podemos renderizar y hacer que se visualice la template
	    $this->template->render();
	
		 //$this->load->view('welcome_message');
	}
}
