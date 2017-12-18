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
    	if (!isset($this->session->userdata['user_name'])){
        	$this->load->view('register');
    	} else {
    		redirect('');
    	}
    }

    public function register_user(){
 		$this->form_validation->set_rules('username', 'Username', 'required|valid_email');
    	$this->form_validation->set_rules('firstname','First Name', 'required');
    	$this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]');
    	$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
    	$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
      	$user=array(
      	'username'=>$this->input->post('username'),
      	'firstname'=>$this->input->post('firstname'),
      	'lastname'=>$this->input->post('lastname'),
      	'phonenumber'=>$this->input->post('phonenumber'),
      	'password'=>md5($this->input->post('password'))
        );
     
 
		$email_check=$this->User->email_check($user['username']);
		
		if($email_check && $this->form_validation->run() != FALSE){
		  $this->User->register_user($user);
		  $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
		  redirect('Login');
		 
		}
		else{
		  $erorrs = validation_errors();
		  $this->session->set_flashdata('error_msg', $erorrs);
		  redirect('Register');
		 
		 
		}
 
	}
}