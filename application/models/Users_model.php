<?php

/**
* 
*/
class Users_model extends MY_Model
{
	
	CONST TABLE 	= 'users';
	CONST KEY 		= 'user_id';
	//CONST LIMIT 	= 3;

	function __construct()
	{
		parent::__construct();
	}

	function get_login($username)
	{
		$where = array('user_name' => $username, 'user_email' => $user_name);
		$query = $this->db->or_where($where)
							->get(static::getTable());

		$num = $query->num_rows();

		if($num < 1)
		{
			return FALSE;
		}

		$row = $query->row();

		return $row;
	}

}
?>