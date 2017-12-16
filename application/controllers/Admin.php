<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/home');
	}

	public function items()
	{
		$this->load->model("main_model");
		$data["fetch_itemlist"] = $this->main_model->get_items();
		$this->load->view('admin/items',$data);
	}

	public function orders()
	{
		$this->load->view('admin/orders');
	}

	public function customers()
	{
		$this->load->view('admin/customers');
	}	

	public function add_item()
	{
			$insert_data = array(
				'item_name'	=> $this->input->post('item_name'),
				'item_description'	=> $this->input->post('item_description'),
				'item_price'	=> $this->input->post('item_price'),
				'item_image'	=> "image"
			);
			$this->load->model("main_model");
			$this->main_model->insert_item($insert_data);
			echo "Data Inserted";
		
	}

	function upload_image()
	{
		if(isset($_FILES["item_image"]))
		{
			$extension = explode('.', $_FILES['item_image']['name']);
			$new_name = rand() . '.' . $extension[1];
			$destination = './images/' . $new_name;
			move_uploaded_file($_FILES['item_image']['tmp_name'], $destination);
			return $new_name;
		}
	}
}
