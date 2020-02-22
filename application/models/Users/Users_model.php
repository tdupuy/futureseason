<?php

Class Users_model extends CI_Model{
   public $name = null;
   public $email;
   public $mdp;

   public function new_user($email,$pass)
   {
           $this->email    = $email; // please read the below note
           $this->mdp  = $pass;
           $this->db->insert('user', $this);
           return ($this->db->affected_rows() != 1) ? false : true;
   }

   public function is_user_exist($email){
      $query = $this->db->get_where('user',array('email' => $email));
      return $query->result() ? true : false;
   }
}
