<?php
class MY_Controller extends CI_Controller
{
	public $ctl;
	public $model;
	public $method;
	public $data = array();

	function __construct()
	{
		parent::__construct();

		$this->ctl = strtolower(get_class($this));
		$this->method = $this->uri->segment(2);

		$this->data['ctl'] = $this->ctl;
		$this->data['page'] = $this->ctl;

		//load model
		$this->model = ucfirst($this->ctl).'_model';
		$this->load->model($this->model);
	}
}
