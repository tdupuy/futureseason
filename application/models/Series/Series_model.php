<?php
Class Series_model extends CI_Model{
	private $api_key = "5b6d508b82c80bff9bf92f391b6d9d4f";

	public function get_random_series($number = 10){
		$data = file_get_contents("https://api.themoviedb.org/3/discover/tv?api_key=$this->api_key&language=fr-FR&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&include_null_first_air_dates=false");
		$data = json_decode($data);
		$i = 0;
		$img_path = "https://image.tmdb.org/t/p/w500";
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
			// Ajouter la photo network
		}
		return $array_data;
	}

	public function set_follow_serie($id_user,$id_tmdb){
       if(!$this->if_serie_followed($id_user,$id_tmdb)){
       		 $this->db->insert('followed_series', array('id_user' => $id_user, 'id_tmdb' => $id_tmdb));
       		return ($this->db->affected_rows() != 1) ? false : true;
       	}else
       		return false;
	}

	public function if_serie_followed($id_user,$id_tmdb){
		$query = $this->db->get_where('followed_series',array('id_user' => $id_user,'id_tmdb' => $id_tmdb));
		return $query->num_rows() ? $query->row()->id : false;
	}
}
