<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dynamic_menu {
 
    private $ci;            // para CodeIgniter Super Global Referencias o variables globales
    // --------------------------------------------------------------------
    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }
    // --------------------------------------------------------------------
     /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
 
    function build_menu()
    {
        $menu = array();
 
		$query = $this->ci->db->query("select * from categorias");
 
		$html_out = '';
		// me despliega del query los rows de la base de datos que deseo utilizar
		  foreach ($query->result() as $row){
			    $html_out .= '<li class="menu-item menu-item-type-post_type menu-item-object-page no-mega-menu with-menu" id="menu-item-210">
				<a style="cursor:pointer;" class="menu-item-link one-page-nav-item" href="/convencional">'.$row->categoria.'</a>
								<ul class="sub-menu mega_col_6">
									<li class="menu-item menu-item-type-custom menu-item-object-custom mega_col_6">
										<div class="megamenu-widgets-container" style="width:100%"> 
											<section class="widget widget_text mk-in-viewport" id="text-16">'; 
				$html_out .= $this->get_childs($row->id);
												 
				$html_out .= '				</section>
										</div>
									</li>
								</ul></li>';
		  }
        
 
        return $html_out;
    }
     /**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $id
     * @param    string    $id usuario
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($id)
    {
       
 
        // query q me ejecuta el submenu filtrando por usuario y para buscar el submenu segun el id que traigo
         $query = $this->ci->db->query("select * from productos where categoria_id = $id");
		 $rowcount = $query->num_rows();
		 $html_out='';
		 
         foreach ($query->result() as $row)
            {
                
                   $html_out .= '<div id="image_category_menu cat_210" style="float:left; max-width:'.(100/$rowcount).'%" class="textwidget">
									<a href="/productos/'.$row->id.'/" class="one-page-nav-item">
										<img src="'.base_url().'libraries/timthumb.php?src='.base_url().'asset/img/'.$row->imagen.'&w=150px">
										<span style="display:block;font-size:12px;text-align:left;">'.$row->titulo.'</span>
									</a>
								</div>';
                
			}
        return $html_out ;
 
    }
}
 