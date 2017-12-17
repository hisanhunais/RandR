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
	    $this->load->library('form_validation');
	 
	}

    public function index() {
    	if (!isset($this->session->userdata['user_name'])){
        	$this->load->view('login');
    	} else {
    		redirect('');
    	}
    }

    function login_user(){
    	$this->form_validation->set_rules('username', 'Username', 'required|valid_email');
	  $user_login=array(
	 
	  'username'=>$this->input->post('username'),
	  'password'=>md5($this->input->post('password'))
	 
	    );

	  if ($this->form_validation->run() != FALSE){
	 
	    $data=$this->User->login_user($user_login['username'],$user_login['password']);

          if($data)
	      {
	        $this->session->set_userdata('user_name',$data['username']);
	        //$this->load->view('home');
	        redirect('');
	      }

	      else{
	        $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
	        redirect('Login');	
	      }
	  } else {
	  		$erorrs = validation_errors();
	  		$this->session->set_flashdata('error_msg', $erorrs);
	        redirect('Login');
	  }
 
 
	}

	public function user_logout(){
	  	$this->session->sess_destroy();
	  	redirect('Login', 'refresh');
	}

}