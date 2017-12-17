<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//This is the Controller for codeigniter crud using ajax application.
class Item extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('item_model');
	 	}


	public function index()
	{

		$data['items']=$this->book_model->get_all_books();
		$this->load->view('admin/items',$data);
	}
	public function item_add()
		{
			$data = array(
					'itemID'	=> 'ITEM08',
					'name'	=> $this->input->post('item_name'),
					'description'	=> $this->input->post('item_description'),
					'price'	=> $this->input->post('item_price'),
					'image'	=> "images/".$imgname
				);
			$insert = $this->book_model->item_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->book_model->get_by_id($id);



			echo json_encode($data);
		}

		public function item_update()
	{
		$data = array(
				'name'	=> $this->input->post('item_name'),
				'description'	=> $this->input->post('item_description'),
				'price'	=> $this->input->post('item_price'),
				'image'	=> "images/".$imgname
			);
		$this->item_model->item_update(array('itemID' => $this->input->post('itemID')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function item_delete($id)
	{
		$this->item_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}