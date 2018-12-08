<?php

/**
* 
*/
class Roles_model extends MY_Model
{
	
	CONST TABLE 	= 'ref_roles';
	CONST KEY 		= 'role_id';
	CONST LIMIT 	= 3;

	function __construct()
	{
		parent::__construct();
	}

	function make_query()
	{
		$this->db->select("*");
		$this->db->from($this->getTable());
	}

	function make_datatables()
	{
		$this->make_query();

		$query = $this->db->get();
		return $query->result();
	}

	function get_filtered_data()
	{
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data()
	{
		$this->db->select("*");
		$this->db->from($this->getTable());

		return $this->db->count_all_results();
	}
}
?>