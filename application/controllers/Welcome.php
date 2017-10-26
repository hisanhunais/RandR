<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function contact()
	{
		$this->load->view('contact');
	}
}
