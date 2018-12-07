<?php

/**
*
*/
class Roles extends Auth_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		parent::listdata();
	}

	function add()
	{
		$this->data['content_view'] = 'backend/template/inc_data_v';
		$this->data['form_action'] 	= $this->ctl.'/insert';
		$this->data['form_data'] 	= 'backend/'.$this->ctl.'_v';
		$this->data['description'] 	= 'Form ';

		$a_form = $this->a_form();

		$this->data['a_form'] = $a_form;

		$row = $this->session->flashdata('row');

		if($row){
			$this->data['row'] = $row;
		}
		
		$this->admin_template($this->data);
	}

	function a_form()
	{

		$a_form = array();
		$a_form[] = array('label' => 'Role ID', 'field' => 'role_id', 'type' => 'text', 'class' => 'required');
		$a_form[] = array('label' => 'Nama Role', 'field' => 'role_name', 'type' => 'text', 'class' => 'required');

		$a_form[] = array('label' => 'Aktif', 'field' => 'isaktif', 'type' => 'checkbox');

		return $a_form;
	}

	// function a_data()
	// {
		
	// 	$data = $this->result();
		
	// 	foreach ($data as $key => $value) {
	// 		foreach ($value as $key2 => $value2) {
	// 			$data2[$key][$key2] = '1';
	// 		}
	// 	}

	// 	//print_r($data2); die();

	// 	return $data2;
	// }


	function insert()
	{

		$this->load->library('form_validation');


		$data = $this->input->post();

		if ($this->validasi() === FALSE)
        {
           	
        	var_dump(validation_errors());
        	die();
           	$this->session->set_flashdata('row', $data);

           	$this->session->set_flashdata('error', validation_errors());
            redirect($this->ctl.'/add');

        }

        //load model
        $this->load->model('users/m_users');

        //
        $data['user_password']  	= password_hash('admin', PASSWORD_BCRYPT);
        $data['user_name']			= $data['user_email'];
        $data['user_fullname']		= $data['user_fullname'];

        //insert data
       	$id = $this->M_Users->insert($data);
        
        if(!$id)
        {
        	$this->session->set_flashdata('error', info('not_saved'));
        	redirect($this->ctl.'/add');
        }

       	$this->session->set_flashdata('success', info('saved'));
       	redirect($this->ctl);
	}

	function update($id)
	{

		$this->load->library('form_validation');

		$config = array(
		        array(
		                'field' => 'user_fullname',
		                'label' => 'Nama Lengkap',
		                'rules' => 'trim|required'
		        )
		);

		$this->form_validation->set_rules($config);
		$data = $this->input->post();

		if ($this->form_validation->run() == FALSE)
        {
           	$this->session->set_flashdata('row', $data);

           	$this->session->set_flashdata('error', validation_errors());
            redirect($this->ctl.'/edit/'.$id);

        }

        //load model
        $this->load->model('users/m_users');

        //
        $data['user_name']		= $data['user_email'];

       	$this->M_Users->update($data, $id);
       
	}

	private function validasi()
	{
		
		$error = formx_error();

		$a_form = $this->a_form();

		// foreach ($a_form as $key => $v) {

		// 	if(isset($v['validate']))
		// 	{
				
		// 		$field        = $v['field'];
		// 		$label        = $v['label'];

		// 		$this->form_validation->set_rules($field, $label, 'required', $error);
		// 	}
	   
		// }

		//$this->form_validation->set_rules('role_id', 'Role ID', 'required', $error);
		
        return $this->form_validation->run();
	}

}
