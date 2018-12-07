<?php


/**
* 
*/
class Users_model extends MY_Model
{
	
	CONST TABLE 	= 'users';
	CONST KEY 		= 'user_id';
	CONST LIMIT 	= 3;

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

	function a_kolom()
	{
		
		$a_kolom[] = array('label' => array('data' => 'No', 'align' => 'center'), 'field' => 'no:');
		$a_kolom[] = array('label' => 'Nama Lengkap', 'field' => 'user_fullname');
		$a_kolom[] = array('label' => 'No HP', 'field' => 'user_mobile');
		$a_kolom[] = array('label' => array('data' => 'Aktif', 'align' => 'center'), 'td_attributes' => array('align' => 'center'), 'field' => 'user_active');
		
		$isactive = array('<span class="label label-danger">Tidak Aktif</span>', '<span class="label label-success">Aktif</span>');

		$a_kolom[] = array('label' => array('data' => 'Aktif', 'align' => 'center'), 
							'td_attributes' => array('align' => 'center'), 
							'field' => 'user_active', 
							'value' => $isactive);

		return $a_kolom;
	}

			


}
?>