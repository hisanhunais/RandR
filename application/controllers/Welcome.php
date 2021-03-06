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

	public function myorders()
	{
		$this->load->model("main_model");
		$username = $this->session->userdata['user_name'];
		$data["fetch_pendingorderlist"] = $this->main_model->get_customer_orders("Pending",$username);
		$data["fetch_readyorderlist"] = $this->main_model->get_customer_orders("Ready",$username);
		$data["fetch_completeorderlist"] = $this->main_model->get_customer_orders("Completed",$username);
		$this->load->view('myorders',$data);
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

		$output .= '<center><a href="'.base_url().'index.php/Welcome/checkout"><button type="button" name = "checkout" class="btn btn-primary btn-sm checkout">Proceed to Checkout</button></a></center></div>';

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

	public function addorder()
	{
		$this->load->library('cart');
		$this->load->model('order_processing');
		$this->load->model('main_model');
		$deliveryReq = "";
		$username = $username = $this->session->userdata['user_name'];

		if(isset($_POST['deliveryRequired']))
		{
			$deliveryReq = "Yes";
		}
		else
		{
			$deliveryReq = "No";
		}

		$data = array(
			"customerUsername" => $username,
			"date" => date("Y-m-d"),
			"total" => $this->cart->total(),
			"requiredDate" => $_POST['requiredDate'],
			"requiredTime" => $_POST['requiredTime'],
			"deliveryRequired" => $deliveryReq,
			"status" => "Pending"
		);

		$this->order_processing->insert_order($data);
		$ordercount = $this->main_model->getOrdersCount();
		$count = $ordercount->ordID;
		// foreach($ordercount as $row2)
		// {
		// 	$count = $row2->orderscount;
		// }

		foreach($this->cart->contents() as $items)
		{
			$orderdata = array(
				"ordID"	=> $count,
				"itemID" =>	$items["id"],
				"quantity" => $items["qty"],
				"itemTotal" => $items["subtotal"],
			);

			$this->order_processing->insert_orderdetails($orderdata);
		}

		

		$this->cart->destroy();
		$this->menu();
	}


/*
* Sending 7-bit message
*/
/*$post_body = seven_bit_sms( $username, $password, $seven_bit_msg, $msisdn );
$result = send_message( $post_body, $url );
if( $result['success'] ) {
  print_ln( formatted_server_response( $result ) );
}
else {
  print_ln( formatted_server_response( $result ) );
}
*/
/*
* Sending unicode message
*/
function initializer()
{
  $username = 'KushalNaresh';
  $password = 'kush@123';
  $url = 'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
  $this->load->model("main_model");
  $result = $this->main_model->getAdminNumber();
  $admintel = $result->phonenumber;
  //$msisdn = $contactno2;
  $contactno1=substr($admintel,1,9);
  $contactno2='+94'.$contactno1;
  $post_body = unicode_sms( $username, $password, $unicode_msg, $contactno2 );
  $result = send_message( $post_body, $url );
}


// if( $result['success'] ) {
//   print_ln( formatted_server_response( $result ) );
// }
// else {
//   print_ln( formatted_server_response( $result ) );
// }

/*
* Sending 8-bit message
*/
// $post_body = eight_bit_sms( $username, $password, $eight_bit_msg, $msisdn );
// $result = send_message( $post_body, $url );
// if( $result['success'] ) {
//   print_ln( formatted_server_response( $result ) );
// }
// else {
//   print_ln( formatted_server_response( $result ) );
// }


/*
* If you don't see this, and no errors appeared to screen, you should
* check your Web server's error logs for error output:
*/
print_ln("Script ran to completion");

function print_ln($content) {
  if (isset($_SERVER["SERVER_NAME"])) {
    print $content."<br />";
  }
  else {
    print $content."\n";
  }
}

function formatted_server_response( $result ) {
  $this_result = "";

  if ($result['success']) {
    $this_result .= "Success: batch ID " .$result['api_batch_id']. "API message: ".$result['api_message']. "\nFull details " .$result['details'];
  }
  else {
    $this_result .= "Fatal error: HTTP status " .$result['http_status_code']. ", API status " .$result['api_status_code']. " API message " .$result['api_message']. " full details " .$result['details'];

    if ($result['transient_error']) {
      $this_result .=  "This is a transient error - you should retry it in a production environment";
    }
  }
  return $this_result;
}

function send_message ( $post_body, $url ) {
  /*
  * Do not supply $post_fields directly as an argument to CURLOPT_POSTFIELDS,
  * despite what the PHP documentation suggests: cUrl will turn it into in a
  * multipart formpost, which is not supported:
  */

  $ch = curl_init( );
  curl_setopt ( $ch, CURLOPT_URL, $url );
  curl_setopt ( $ch, CURLOPT_POST, 1 );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
  // Allowing cUrl funtions 20 second to execute
  curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
  // Waiting 20 seconds while trying to connect
  curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );

  $response_string = curl_exec( $ch );
  $curl_info = curl_getinfo( $ch );

  $sms_result = array();
  $sms_result['success'] = 0;
  $sms_result['details'] = '';
  $sms_result['transient_error'] = 0;
  $sms_result['http_status_code'] = $curl_info['http_code'];
  $sms_result['api_status_code'] = '';
  $sms_result['api_message'] = '';
  $sms_result['api_batch_id'] = '';

  if ( $response_string == FALSE ) {
    $sms_result['details'] .= "cURL error: " . curl_error( $ch ) . "\n";
  } elseif ( $curl_info[ 'http_code' ] != 200 ) {
    $sms_result['transient_error'] = 1;
    $sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info[ 'http_code' ] . "\n";
  }
  else {
    $sms_result['details'] .= "Response from server: $response_string\n";
    $api_result = explode( '|', $response_string );
    $status_code = $api_result[0];
    $sms_result['api_status_code'] = $status_code;
    $sms_result['api_message'] = $api_result[1];
    if ( count( $api_result ) != 3 ) {
      $sms_result['details'] .= "Error: could not parse valid return data from server.\n" . count( $api_result );
    } else {
      if ($status_code == '0') {
        $sms_result['success'] = 1;
        $sms_result['api_batch_id'] = $api_result[2];
        $sms_result['details'] .= "Message sent - batch ID $api_result[2]\n";
      }
      else if ($status_code == '1') {
        # Success: scheduled for later sending.
        $sms_result['success'] = 1;
        $sms_result['api_batch_id'] = $api_result[2];
      }
      else {
        $sms_result['details'] .= "Error sending: status code [$api_result[0]] description [$api_result[1]]\n";
      }





    }
  }
  curl_close( $ch );

  return $sms_result;
}

function seven_bit_sms ( $username, $password, $message, $msisdn ) {
  $post_fields = array (
  'username' => $username,
  'password' => $password,
  'message'  => character_resolve( $message ),
  'msisdn'   => $msisdn,
  'allow_concat_text_sms' => 0, # Change to 1 to enable long messages
  'concat_text_sms_max_parts' => 2
  );

  return make_post_body($post_fields);
}

function unicode_sms ( $username, $password, $message, $msisdn ) {
  $post_fields = array (
  'username' => $username,
  'password' => $password,
  'message'  => string_to_utf16_hex( $message ),
  'msisdn'   => $msisdn,
  'dca'      => '16bit'
  );

  return make_post_body($post_fields);
}
/*
function get_headers ( $msg_type ) {
if( $msg_type == 'wap_push' ) {
$udh = '0605040B8423F0';
$wsp = 'DC0601AE';

return $udh . $wsp;
}
else if( $msg_type == 'vCard' || $msg_type == 'vCalendar' ) {
return '06050423F40000';
}
}
*/
function eight_bit_sms( $username, $password, $message, $msisdn ) {
  $post_fields = array (
  'username' => $username,
  'password' => $password,
  'message'  => $message,
  'msisdn'   => $msisdn,
  'dca'      => '8bit'
  );

  return make_post_body($post_fields);

}

function make_post_body($post_fields) {
  $stop_dup_id = make_stop_dup_id();
  if ($stop_dup_id > 0) {
    $post_fields['stop_dup_id'] = make_stop_dup_id();
  }
  $post_body = '';
  foreach( $post_fields as $key => $value ) {
    $post_body .= urlencode( $key ).'='.urlencode( $value ).'&';
  }
  $post_body = rtrim( $post_body,'&' );

  return $post_body;
}

function character_resolve($body) {
  $special_chrs = array(
  'Δ'=>'0xD0', 'Φ'=>'0xDE', 'Γ'=>'0xAC', 'Λ'=>'0xC2', 'Ω'=>'0xDB',
  'Π'=>'0xBA', 'Ψ'=>'0xDD', 'Σ'=>'0xCA', 'Θ'=>'0xD4', 'Ξ'=>'0xB1',
  '¡'=>'0xA1', '£'=>'0xA3', '¤'=>'0xA4', '¥'=>'0xA5', '§'=>'0xA7',
  '¿'=>'0xBF', 'Ä'=>'0xC4', 'Å'=>'0xC5', 'Æ'=>'0xC6', 'Ç'=>'0xC7',
  'É'=>'0xC9', 'Ñ'=>'0xD1', 'Ö'=>'0xD6', 'Ø'=>'0xD8', 'Ü'=>'0xDC',
  'ß'=>'0xDF', 'à'=>'0xE0', 'ä'=>'0xE4', 'å'=>'0xE5', 'æ'=>'0xE6',
  'è'=>'0xE8', 'é'=>'0xE9', 'ì'=>'0xEC', 'ñ'=>'0xF1', 'ò'=>'0xF2',
  'ö'=>'0xF6', 'ø'=>'0xF8', 'ù'=>'0xF9', 'ü'=>'0xFC',
  );

  $ret_msg = '';
  if( mb_detect_encoding($body, 'UTF-8') != 'UTF-8' ) {
    $body = utf8_encode($body);
  }
  for ( $i = 0; $i < mb_strlen( $body, 'UTF-8' ); $i++ ) {
    $c = mb_substr( $body, $i, 1, 'UTF-8' );
    if( isset( $special_chrs[ $c ] ) ) {
      $ret_msg .= chr( $special_chrs[ $c ] );
    }
    else {
      $ret_msg .= $c;
    }
  }
  return $ret_msg;
}

/*
* Unique ID to eliminate duplicates in case of network timeouts - see
* EAPI documentation for more. You may want to use a database primary
* key. Warning: sending two different messages with the same
* ID will result in the second being ignored!
*
* Don't use a timestamp - for instance, your application may be able
* to generate multiple messages with the same ID within a second, or
* part thereof.
*
* You can't simply use an incrementing counter, if there's a chance that
* the counter will be reset.
*/
function make_stop_dup_id() {
  return 0;
}

function string_to_utf16_hex( $string ) {
  return bin2hex(mb_convert_encoding($string, "UTF-16", "UTF-8"));
}

function xml_to_wbxml( $msg_body ) {

  $wbxmlfile = 'xml2wbxml_'.md5(uniqid(time())).'.wbxml';
  $xmlfile = 'xml2wbxml_'.md5(uniqid(time())).'.xml';

  //create temp file
  $fp = fopen($xmlfile, 'w+');

  fwrite($fp, $msg_body);
  fclose($fp);

  //convert temp file
  exec(xml2wbxml.' -v 1.2 -o '.$wbxmlfile.' '.$xmlfile.' 2>/dev/null');
  if(!file_exists($wbxmlfile)) {
    print_ln('Fatal error: xml2wbxml conversion failed');
    return false;
  }

  $wbxml = trim(file_get_contents($wbxmlfile));

  //remove temp files
  unlink($xmlfile);
  unlink($wbxmlfile);
  return $wbxml;
}
}
