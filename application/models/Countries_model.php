<?php

/**
* 
*/
class Countries_model extends Query_Model
{
	
	CONST TABLE 	= 'countries';
	CONST KEY 		= 'country_id';
	CONST LIMIT 	= 3;

	function __construct()
	{
		parent::__construct();
	}

}
?>