<?php

class Main_model extends CI_Model
{
	function get_items()
	{
		$query = $this->db->get("item");
	}
}
?>