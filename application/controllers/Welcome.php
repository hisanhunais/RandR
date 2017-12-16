<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
	 
	    parent::__construct();
	  	$this->load->helper('url');
	  	$this->load->model('User');
	    $this->load->library('session');
	 
	}

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
	public function index()
	{
		$this->load->view('home');
	}

	public function about()
	{
		$this->load->view('about');
	}

	public function admin()
	{
		$this->load->view('admin/home');
	}


	public function menu()
	{
		$this->load->model("main_model");
		$data["fetch_data"] = $this->main_model->get_items();
		$this->load->view('menu',$data);
	}

	public function menu_item($id)
	{
		$this->load->model("main_model");
		$data["fetch_item"] = $this->main_model->get_item_details($id);
		$data["fetch_reviews"] = $this->main_model->get_item_reviews($id);
		$this->load->view('item_page',$data);
	}

	public function menu_item_byname()
	{
		/*$output = array();
		$this->load->model("main_model");
		$data = $this->main_model->get_item_byname($_POST['searchData']);

		foreach ($data as $row) 
		{
			$output['name'] = $row->name;
			$output['description'] = $row->description;
			$output['price'] = $row->price;
			$output['image'] = $row->image;
		}

		echo json_encode($output);*/
		$this->load->model("main_model");
		$search = $this->input->post('search');
		$output = $this->main_model->get_item_byname($search);
		echo json_encode($output);
	}

	public function contact()
	{
		$this->load->view('contact');
	}

	public function add_reviews()
	{
		$this->load->model('main_model');

		$data = array(
			"reviewID" => "REV30",
			"itemID" => "ITEM01",
			"username" => "Nimal",
			"date" => date("Y-m-d"),
			"time" => date("h:i:sa"),
			"comment" => $this->input->post("comment"),
			"rating" => $this->input->post("rating")
		);

		$this->main_model->insert_item_review($data);
		$this->menu_item("ITEM01");
	}
}
