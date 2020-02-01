<?php

class Pages extends CI_Controller{
	function view($page = 'home')
	{
		if( !file_exists('application/views/Pages/'.$page.'.php'))
		{
			show_404();
		}

		$data_header = [];
		$data_navmenu = [];
		$data_footer = [];
		$data_content = [];

		$this->load->model('Series/Series_model');

		switch ($page) {
			case 'home':
				$data_header = [
					'title' => 'Home page'
				];
				$data_content = [
					'heading' => 'Quand est-ce que ça sort ?!',
					'series' => $this->Series_model->get_random_series(3)
				];
				break;

			default:
				# code...
				break;
		}

    	$this->load->helper('url');
    	$this->load->library('parser');
		$this->parser->parse('Partials/header.php',$data_header);
		$this->parser->parse('Partials/navmenu.php',$data_navmenu);
		$this->parser->parse('Partials/footer.php',$data_footer);
		$this->parser->parse('Pages/'.$page,$data_content);
	}


}
