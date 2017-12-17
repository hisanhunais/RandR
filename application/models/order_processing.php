<?php

class Order_processing extends CI_Model
{
	function get_items()
	{
		$query = $this->db->get("item");
		return $query;
	}

	function get_order_details($id)
	{
		$this->db->select('*');
		$this->db->from('order_details');
		$this->db->join('item', 'order_details.itemID = item.itemID');
		$this->db->where('ordID',$id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_order($id)
	{
		$this->db->select('*');
		$this->db->from('order_master');
		$this->db->where('ordID',$id);
		$query = $this->db->get();
		return $query->result();
	}

	function update_order_status($id,$status)
	{
		$this->db->set('status', $status);
		$this->db->where('ordID', $id);
		$this->db->update('order_master');
	}

	function update_order_dates($id,$date,$time)
	{
		$this->db->set('requiredDate', $date);
		$this->db->set('requiredTime', $time);
		$this->db->where('ordID', $id);
		$this->db->update('order_master');
	}


	function get_item_reviews($id)
	{
		$this->db->select('*');
		$this->db->from('item_review');
		$this->db->where('itemID',$id);
		$query = $this->db->get();
		return $query;
	}

	function get_item_byname($name)
	{
		/*$query = "";


		if($name = "")
		{
			$query = $this->db->get("item");
		}
		else
		{
			$this->db->select('*');
			$this->db->from('item');
			$this->db->where('itemID',$id);
			$query = $this->db->get();
		}

		return $query->result();*/

		$this->db->select("*");
		$whereCondition = array('name' => $name);
		$this->db->where($whereCondition);
		$this->db->from('item');
		$query = $this->db->get();
		return $query->result();
	}

	function insert_item($data)
	{
		$this->db->insert('item', $data);
	}

	function insert_item_review($data)
	{
		$this->db->insert('item_review', $data);
	}

	function insert_order($data)
	{
		$this->db->insert('order_master', $data);
	}

	function insert_orderdetails($data)
	{
		$this->db->insert('order_details', $data);
	}
 
	function insert_delivery($data)
	{
		$this->db->insert('delivery', $data);
	}
}
?>