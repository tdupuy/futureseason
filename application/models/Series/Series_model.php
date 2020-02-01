<?php
Class Series_model extends CI_Model{
	private $api_key = "5b6d508b82c80bff9bf92f391b6d9d4f";

	public function get_random_series($number = 10){
		$data = file_get_contents("https://api.themoviedb.org/3/discover/tv?api_key=$this->api_key&language=fr-FR&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&include_null_first_air_dates=false");
		$data = json_decode($data);
		$i = 0;
		$img_path = "https://image.tmdb.org/t/p/original";
		for ($i=0; $i < $number; $i++) {
			$array_data[] = $data->results[$i];
			$id_tmdb = $data->results[$i]->id;
			$details = file_get_contents("https://api.themoviedb.org/3/tv/$id_tmdb?api_key=$this->api_key");
			$details = json_decode($details);

			if($details->in_production){
				$array_data[$i]->production = "En cours";
			}else{
				$array_data[$i]->production = "Terminé";
			}
			$array_data[$i]->current_season = "Saison ".$details->number_of_seasons;
			// @TODO peut avoir plusieurs genres
			$array_data[$i]->type = "Genre : ".$details->genres[0]->name;
			$array_data[$i]->img_path = $img_path.$data->results[$i]->poster_path;
		}
		return $array_data;
	}
}
