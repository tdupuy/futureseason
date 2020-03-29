<?php
class MY_Controller extends CI_Controller{

  protected function render_page($view,$data_content = array(),$data_header = array(),$data_navmenu = array(),$data_footer = array())
  {
     $this->load->helper('url');
     $this->load->library('parser');
  	 $this->load->library('javascript');
  	 $this->load->library('javascript/jquery');
     $this->parser->parse('Partials/header.php',$data_header);
     $this->parser->parse('Partials/navmenu.php',$data_navmenu);
     $this->parser->parse('Pages/'.$view,$data_content);
     $this->parser->parse('Partials/footer.php',$data_footer);

  }
}
