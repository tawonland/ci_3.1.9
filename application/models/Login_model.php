<?php
class Login_model extends App_Model {

    CONST TABLE = 'users';

    function get_user($username)
	{
		$where = array('user_name' => $username);
		$query = $this->db->where($where)->get(static::getTable());
		
		return $query->row();
	}

	function getTable($tes = '')
	{
		
	}
	
}