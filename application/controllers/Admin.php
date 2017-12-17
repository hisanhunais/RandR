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
		$this->load->model("main_model");
		$data["fetch_orderlist"] = $this->main_model->get_orders();
		$this->load->view('admin/orders',$data);
	}

	public function order_details()
	{
		$orderno = $_POST['orderno'];
		$this->load->model("order_processing");
		$fetch_orderdetailslist = $this->order_processing->get_order_details($orderno);
		$fetch_order = $this->order_processing->get_order($orderno);

		foreach($fetch_order as $row2)
		{
			$date = $row2->requiredDate;
			$time = $row2->requiredTime;
		}

		$output = '';
		$output .= '
				<div class= "table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>Item</td>
							<td>Quantity</td>
						</tr>';
						foreach($fetch_orderdetailslist as $row)
						{
							$output .= '
								<tr>
									<td>'.$row->name.'</td>
									<td>'.$row->quantity.'</td>
								</tr>
							';
						}

		$output .= '		
					</table>
				</div>
				
					<label>Required Date</label>
					<input type="date" name="update_date" id="update_date" class="form-control" value='.$date.'>					
					<br>
					<label>Required Time</label>
					<input type="time" name="update_time" id="update_time" class="form-control" value='.$time.'>					
					<br>
					<input type="hidden" name="updateOrderno" id="updateOrderno" value='.$orderno.'>	
		';
		echo $output;
	}

	public function update_order()
	{
		$orderno = $_POST['updateOrderno'];
		$reqDate = $_POST['update_date'];
		$reqTime = $_POST['update_time'];
		$this->load->model("order_processing");
		$this->order_processing->update_order_dates($orderno,$reqDate,$reqTime);
		$this->orders();
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

	public function complete_order()
	{
		$orderno = $_POST['completedata'];
		$status = "Completed";
		$this->load->model("order_processing");
		$this->order_processing->update_order_status($orderno,$status);
		$this->orders();
	}


}
