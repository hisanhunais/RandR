<?php
/**
 * Created by PhpStorm.
 * User: Thilakshika-PC
 * Date: 2017-10-24
 * Time: 8:18 AM
 */

class Register extends CI_Controller {
	public function __construct(){
	 
	    parent::__construct();
	  	$this->load->helper('url');
	  	$this->load->model('User');
	    $this->load->library('session');
	    $this->load->library('form_validation');
	 
	}

    public function index() {
    	$this->form_validation->set_rules('username', 'Username', 'required|valid_email');
        $this->load->view('register');
    }

    public function register_user(){
 
      	$user=array(
      	'username'=>$this->input->post('username'),
      	'firstname'=>$this->input->post('firstname'),
      	'lastname'=>$this->input->post('lastname'),
      	'password'=>md5($this->input->post('password')));
     
 
		$email_check=$this->User->email_check($user['username']);
		
		if($email_check){
		  $this->User->register_user($user);
		  $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
		  redirect('Login');
		 
		}
		else{
		 
		  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
		  redirect('Register');
		 
		 
		}
 
	}
}