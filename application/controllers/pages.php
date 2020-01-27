<?php

class Pages extends CI_Controller{

	function view($page = 'home')
	{
		if( !file_exists('application/views/Pages/'.$page.'.php'))
		{
			show_404();
		}
    $this->load->helper('url');
    $this->load->view('Partials/header.php');
    $this->load->view('Partials/navmenu.php');
		$this->load->view('Pages/'.$page);
    $this->load->view('Partials/footer.php');
	}

}

?>
