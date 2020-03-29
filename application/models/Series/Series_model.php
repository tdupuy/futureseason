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

	public function get_followed_series($id_user,$number = 10){
		$query = $this->db->order_by('id DESC')->get_where('followed_series',array('id_user' => $id_user));
		 if ($query->num_rows() > 0){
		 	$data_array = [];
		 	if($query->num_rows() > $number)
	 			$max = $number;
	 		else
	 			$max = $query->num_rows();
	 		foreach ($query->result() as $row){
	 			$i = 0;
	 			if($i > $max)
	 				break;
	 			$data = file_get_contents("https://api.themoviedb.org/3/tv/$row->id_tmdb?api_key=$this->api_key&language=fr-FR");
				$data = json_decode($data);
				$img_path = "https://image.tmdb.org/t/p/w500";
				if($data->in_production)
					$data->production = "En cours";
				else
					$data->production = "Terminé";
				$data->current_season = "Saison ".$data->number_of_seasons;
				// @TODO peut avoir plusieurs genres
				$data->type = "Genre : ".$data->genres[0]->name;
				$data->img_path = $img_path.$data->poster_path;
				// Ajouter la photo network
				$array_data[] = $data;
			}
			return $array_data;
		 }else{
		 	return false;
		 }

	}

	public function get_trending_series($number=10){
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
