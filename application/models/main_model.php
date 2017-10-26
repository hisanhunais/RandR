<?php

class Main_model extends CI_Model
{
	function get_items()
	{
		$query = $this->db->get("item");
		return $query;
	}

	function get_item_details($id)
	{
		//$this->get->where("itemID",$id);
		//$query = $this->db->get("item");

		$this->db->select('*');
		$this->db->from('item');
		$this->db->where('itemID',$id);
		$query = $this->db->get();

		/*$this->db->select('*');
		$query = $this->db->get_where('item','itemID',$id);*/
		return $query;
	}

	function get_item_reviews($id)
	{
		$this->db->select('*');
		$this->db->from('item_review');
		$this->db->where('itemID',$id);
		$query = $this->db->get();
		return $query;
	}
}
?>