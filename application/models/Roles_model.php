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

	function a_kolom()
	{
		
		$a_kolom = array();
		$a_kolom[] = array('label' => array('data' => 'No', 'align' => 'center'), 'field' => 'no:');
		$a_kolom[] = array('label' => 'Role ID', 'field' => 'role_id');

		$a_kolom[] = array('label' => 'Nama Role', 'field' => 'role_name', 'url' => '#');

		$isactive = array('<span class="label label-danger">Tidak Aktif</span>', '<span class="label label-success">Aktif</span>');

		$a_kolom[] = array('label' => array('data' => 'Aktif', 'align' => 'center'), 
							'td_attributes' => array('align' => 'center'), 
							'field' => 'isactive', 
							'value' => $isactive);

		return $a_kolom;
	}
}
?>