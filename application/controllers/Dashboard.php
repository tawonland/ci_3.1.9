<?php

/**
* 
*/
class Dashboard extends Auth_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->data['content_view'] = 'backend/dashboard_v';
		$this->admin_template($this->data);
	}
}