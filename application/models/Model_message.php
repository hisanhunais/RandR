<?php 

class Model_message extends CI_Model{
	function insert_message(){

		$data = array(
			'name'=> $this->input->post('name'),
			'eMail'=> $this->input->post('eMail'),
			'phone'=> $this->input->post('phone'),
			'subject'=> $this->input->post('subject'),
			'message'=> $this->input->post('message'),

			);
		return $this->db->insert('message',$data);
	}
	
}