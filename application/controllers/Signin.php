<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends MY_Controller {

    public function process()
    {
        $user = $this->input->post('email');
        $pass = $this->input->post('password');
        if($user != '' && $pass != ''){
          $this->load->library('encryption');
          $this->load->model('Users/Users_model');
          $pass = $this->encryption->encrypt($pass);
          $create = $this->Users_model->new_user($user,$pass);
          if ($create)
          {
              //declaring session
              redirect("login");;
          }else{
              $data['error'] = 'Database error';
              $this->render_page('signin',$data,array('title' => 'Sign in !'));
          }
        }
    }

}
?>
