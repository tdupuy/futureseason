<?php 
Class Series_model extends CI_Model{
	private $api_key = "5b6d508b82c80bff9bf92f391b6d9d4f";

	public function get_random_series($number = 10){
		$data = file_get_contents("https://api.themoviedb.org/3/discover/tv?api_key=$this->api_key&language=fr-FR&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&include_null_first_air_dates=false");
		$data = json_decode($data);
		return $data;
	}	
}