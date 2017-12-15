<?php
/**
 * Created by PhpStorm.
 * User: Thilakshika-PC
 * Date: 2017-10-24
 * Time: 8:18 AM
 */

class Login extends CI_Controller {
	public function __construct(){
	 
	    parent::__construct();
	  	$this->load->helper('url');
	  	$this->load->model('User');
	    $this->load->library('session');
	 
	}

    public function index() {
        $this->load->view('login');
    }

    function login_user(){
	  $user_login=array(
	 
	  'username'=>$this->input->post('username'),
	  'password'=>md5($this->input->post('password'))
	 
	    );
	 
	    $data=$this->User->login_user($user_login['username'],$user_login['password']);

          if($data)
	      {
	        $this->session->set_userdata('user_name',$data['username']);
	        $this->load->view('home');
	      }

	      else{
	        $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
	        $this->load->view("login");
	 
	      }
 
 
	}

	public function user_logout(){
	  	$this->session->sess_destroy();
	  	redirect('Login', 'refresh');
	}

}