<?php

class Contact extends CI_Controller{
	public function contactUs(){
	 $this->load->library('form_validation');

	 $this->form_validation->set_rules('name','name','required');
	 $this->form_validation->set_rules('eMail','eMail','required');
	 $this->form_validation->set_rules('phone','phone','required');
	 $this->form_validation->set_rules('subject','subject','required');
	 $this->form_validation->set_rules('message','message','required');

	 if($this->form_validation->run() == False){
	 	$this->load->view('contact');
	 }else{
	 	$this->load->model('Model_message');
	 	$response = $this->Model_message->insert_message();

	 	if($response){
	 		echo"sucess";

	 	}else{
	 		echo"error";
	 	}
	 }

	}

}