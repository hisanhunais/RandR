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

	public function add()
	{
		$this->load->library("cart");
		$data = array(
			"id"		=> $_POST["itemID"],
			"name"		=> $_POST["name"],
			"qty"		=> $_POST["quantity"],
			"price"		=> $_POST["price"]
		);
		$this->cart->insert($data);	//insert data into cart and return rowid
		echo $this->viewcart();
	}

	public function load()
	{
		echo $this->viewcart();
	}

	public function remove()
	{
		$this->load->library("cart");
		$row_id = $_POST['row_id'];
		$data = array(
			'rowid'		=> $row_id,
			'qty'		=> 0
		);
		$this->cart->update($data);
		echo $this->viewcart();
	}

	public function clear()
	{
		$this->load->library("cart");
		$this->cart->destroy();
		echo $this->viewcart();
	}

	public function viewcart()
	{
		$this->load->library("cart");
		$output = '';
		$output .= '
			<div>
				<div align="right">
					<button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
				</div>
				<br>
				<table class="table table-striped">
					<tr>
						<th width="40%">Item</th>
						<th width="15%">Quantity</th>
						<th width="15%">Price</th>
						<th width="15%">Total</th>
						<th width="15%">Action</th>
					</tr>
			</div>
		';
		$count = 0;
		foreach($this->cart->contents() as $items)
		{
			$count++;
			$output .= '
				<tr>
					<td>'.$items["name"].'</td>
					<td>'.$items["qty"].'</td>
					<td>'.$items["price"].'</td>
					<td>'.$items["subtotal"].'</td>
					<td><button type="button" name = "remove" id="'.$items["rowid"].'" class="btn btn-danger btn-xs remove_inventory">Remove</button></td>
				</tr>
			';
		}

		$output .= '
			<tr>
				<td colspan="4" align="right">Total</td>
				<td>'.$this->cart->total().'</td>
			</tr>
		</table>
		';

		$output .= '<center><a href="'.base_url().'index.php/Welcome/checkout"><button type="button" name = "checkout" id="'.$items["rowid"].'" class="btn btn-primary btn-sm checkout">Proceed to Checkout</button></a></center></div>';

		if($count == 0)
		{
			$output = '<h3 align="center">Cart is Empty</h3>';
		}

		return $output;
	}

	public function checkout()
	{
		$this->load->library('cart');
		$this->load->view('checkout');
	}
}
