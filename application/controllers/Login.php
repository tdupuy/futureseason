<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    /*public function index()
    {
        $this->render_page('login');
    }*/
    public function process()
    {
        $user = $this->input->post('email');
        $pass = $this->input->post('password');
        if ($user=='juhi@aaa.fr' && $pass=='123')
        {
            //declaring session
            $this->session->set_userdata(array('user'=>$user));
            redirect("home");;
        }
        else{
            $data['error'] = 'Your Account is Invalid';
            $this->render_page('login',$data,array('title' => 'Login'));
        }
    }
    public function logout()
    {
        //removing session
        $this->session->unset_userdata('user');
        redirect("Login");
    }

}
?>
