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

		$this->load->library('session');
		switch ($page) {
			case 'home':
				$this->prepare_home();
				break;
			case 'login':
				$this->prepare_login();
				break;
			case 'signin':
				$this->prepare_signin();
				break;
			default:
				$this->render_page($page,$data_content,$data_header,$data_navmenu,$data_footer);
				break;
		}
        //
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

	function prepare_home(){
		$page = 'home';
		$this->load->model('Series/Series_model');
		$data_header = [];
		$data_navmenu = [];
		$data_footer = [];
		$data_content = [];

		$data_header = [
			'title' => 'Home page'
		];
		$random_series = $this->Series_model->get_random_series(10);
		$trending_series = $this->Series_model->get_trending_series(10);
		if($this->session->user)
			$followed_series = $this->Series_model->get_followed_series($this->session->user['id'],10);
		else 
			$followed_series = array();
		$data_content = [
			'heading' => 'Quand est-ce que ça sort ?!',
			'random_series' => $random_series ? $random_series : array(),
			'trending_series' => $trending_series ?$trending_series : array(),
			'followed_series' => $followed_series ? $followed_series : array()
		];
        $this->render_page($page,$data_content,$data_header,$data_navmenu,$data_footer);

	}

	function prepare_login(){
		$page = 'login';
		$data_header = [];
		$data_navmenu = [];
		$data_footer = [];
		$data_content = [];
		$data_header = [
			'title' => 'Login'
		];
        $this->render_page($page,$data_content,$data_header,$data_navmenu,$data_footer);
	}

	function prepare_signin(){
		$page = 'signin';
		$data_header = [];
		$data_navmenu = [];
		$data_footer = [];
		$data_content = [];
		$data_header = [
			'title' => 'Sign in !'
		];
        $this->render_page($page,$data_content,$data_header,$data_navmenu,$data_footer);
	}

}
