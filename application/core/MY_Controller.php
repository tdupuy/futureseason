<?php
class MY_Controller extends CI_Controller{

  protected function render_page($view,$data_content = array(),$data_header = array(),$data_navmenu = array(),$data_footer = array())
  {
    var_dump($data_header);
     $this->load->helper('url');
     $this->load->library('parser');
     $this->parser->parse('Partials/header.php',$data_header);
     $this->parser->parse('Partials/navmenu.php',$data_navmenu);
     $this->parser->parse('Pages/'.$view,$data_content);
     $this->parser->parse('Partials/footer.php',$data_footer);
  }
}
