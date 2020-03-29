<?php

class Pages extends MY_Controller{
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
		$this->load->library('session');
		switch ($page) {
			case 'home':
				$data_header = [
					'title' => 'Home page'
				];
				$data_content = [
					'heading' => 'Quand est-ce que ça sort ?!',
					'random_series' => $this->Series_model->get_random_series(10),
					'trending_series' => $this->Series_model->get_trending_series(10),
					'followed_series' => $this->Series_model->get_followed_series($this->session->user['id'],10),
				];
				break;
			case 'login':
				$data_header = [
					'title' => 'Login'
				];
			case 'signin':
					$data_header = [
						'title' => 'Sign in !'
					];
			default:
				# code...
				break;
		}

			$this->render_page($page,$data_content,$data_header,$data_navmenu,$data_footer);
	}

	function follow_serie($id_user,$id_tmdb,$ajax = false){
		$this->load->model('Series/Series_model');
		if($this->Series_model->set_follow_serie($id_user,$id_tmdb)){
			if($ajax)
				echo "true";
			else
				return true;
		}else{
			if($ajax)
				echo "false";
			else
				return false;
		}
	}
}
