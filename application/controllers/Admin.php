<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/home');
	}

	public function items()
	{
		$this->load->view('admin/items');
	}

	public function orders()
	{
		$this->load->view('admin/orders');
	}

	public function customers()
	{
		$this->load->view('admin/customers');
	}	
}
