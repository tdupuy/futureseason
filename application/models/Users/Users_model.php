<?php

Class Users_model extends CI_Model{
   public $name = null;
   public $email;
   public $mdp;

   public function new_user($email,$pass)
   {
           $this->email    = $email; // please read the below note
           $this->mdp  = password_hash($pass, PASSWORD_BCRYPT);
           $this->db->insert('user', $this);
           return ($this->db->affected_rows() != 1) ? false : true;
   }

   public function is_user_exist($email){
      $query = $this->db->get_where('user',array('email' => $email));
      return $query->result() ? true : false;
   }

   public function log_user($email,$pass){
     $query = $this->db->get_where('user',array('email' => $email));
     if ($query->num_rows() > 0){
          $user_row = $query->row();
          if(password_verify($pass, $user_row->mdp)){
            $user_data['id'] = $user_row->email;
            $user_data['login'] = $user_row->id;
            return $user_data;
          }
          return false;
      }
      return false;
   }
}
