<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//This is the Book Model for CodeIgniter CRUD using Ajax Application.
class Item_model extends CI_Model
{

	var $table = 'item';


	public function __construct()
	{
		parent::__construct();
	}


	public function get_all_items()
	{
	$this->db->from('item');
	$query=$this->db->get();
	return $query->result();
	}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('itemID',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function item_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function item_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('itemID', $id);
		$this->db->delete($this->table);
	}


}