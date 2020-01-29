<?php

class Pages extends CI_Controller{
	function view($page = 'home')
	{
		if( !file_exists('application/views/Pages/'.$page.'.php'))
		{
			show_404();
		}
		/*$data = file_get_contents("https://api.themoviedb.org/3/discover/tv?api_key=5b6d508b82c80bff9bf92f391b6d9d4f&language=fr-FR&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&include_null_first_air_dates=false");
		var_dump(json_decode($data));
		die();*/

		$this->load->model('Series/Series_model');
		var_dump($this->Series_model->get_random_series());die();
		$data_header = [];
		$data_navmenu = [];
		$data_footer = [];
		$data_content = [];

		switch ($page) {
			case 'home':
				$data_header = [
					'title' => 'Home page'
				];
				$data_content = [
					'heading' => 'Quand est-ce que ça sort ?!'
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
