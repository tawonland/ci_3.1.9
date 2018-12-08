<?php

/**
* 
*/
class Countries_model extends MY_Model
{
	
	CONST TABLE 	= 'countries';
	CONST KEY 		= 'country_id';
	CONST LIMIT 	= 3;

	var $select_column = array("country_id", "country_code", "country_name");
	var $order_column = array(null, "country_code", "country_name", null);

	function __construct()
	{
		parent::__construct();
	}

	function make_query()
	{
		$this->db->select($this->select_column);
		$this->db->from($this->getTable());

		if(isset($_POST["search"]["value"]))
		{
			$search_value = $_POST["search"]["value"];

			$this->db->like("country_code", $search_value);
			$this->db->or_like("country_name", $search_value);
		}
		if(isset($_POST["order"]))
		{
			$order_column = $_POST['order']['0']['column'];
			$this->db->order_by($this->order_column[$order_column], $_POST['order']['0']['dir']);
		}
		else{
			$this->db->order_by(static::KEY,"DESC");
		}
	}

	function make_datatables()
	{
		$this->make_query();

		if($_POST["length"] != -1)
		{
			$this->db->limit($_POST["length"], $_POST["start"]);
		}

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