<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Controller extends CI_Controller
{
    
	public $data = array();

    public function __construct()
    {
        parent::__construct();

        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);

        $this->data['data'] = '';
    }

    public function set_flashdata($data, $value)
    {
    	return $this->session->set_flashdata($data, $value);
    }
}
