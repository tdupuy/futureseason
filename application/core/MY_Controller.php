<?php
class MY_Controller extends CI_Controller{

  protected function render_page($view,$data_content = array(),$data_header = array(),$data_navmenu = array(),$data_footer = array())
  {
    $this->load->helper('url');
    $this->load->library('javascript');
    $this->load->library('javascript/jquery');
    $this->load->view('Partials/header.php',$data_header);
    $this->load->view('Partials/navmenu.php',$data_navmenu);
    $this->load->view('Pages/'.$view,$data_content);
    $this->load->view('Partials/footer.php',$data_footer);
  }
}