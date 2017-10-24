<?php
defined('BASEPATH') OR exit('No direct script access allowed')

class Main extends CI_Controller
{
	function index()
	{
		$this->load->model("main_model");
		$data["fetch_data"] = $this->main_model->get_items();
		$this->load->view("menu",$data); 
	}
}
?>