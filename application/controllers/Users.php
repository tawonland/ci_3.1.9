<?php

/**
*
*/
class Users extends Auth_Controller
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
		parent::add();
	}


	function insert()
	{

		$this->load->library('form_validation');

		$config = array(
		        array(
		                'field' => 'user_fullname',
		                'label' => 'Nama Lengkap',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'user_email',
		                'label' => 'Email',
		                'rules' => 'trim|required|valid_email|is_unique[users.user_email]'
		        )
		);

		$this->form_validation->set_rules($config);
		$data = $this->input->post();

		if ($this->form_validation->run() == FALSE)
        {
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

	private function validasi($aneh = false)
	{

        $this->form_validation->set_rules('siteid', 'Site ID', 'required', $error);
        $this->form_validation->set_rules('sitename', 'Site Name', 'required', $error);
        $this->form_validation->set_rules('longitude', 'Longitude', 'required', $error);
        $this->form_validation->set_rules('latitude', 'Latitude', 'required', $error);
        $this->form_validation->set_rules('buidingheight', 'Building Height', 'required', $error);
        $this->form_validation->set_rules('towerheight', 'Tower Height', 'required', $error);
        $this->form_validation->set_rules('availabletowerspace', 'Available Tower Space', 'required', $error);
        $this->form_validation->set_rules('availablegroundspace', 'Available Ground Space', 'required', $error);
		
        return $this->form_validation->run();
	}

}
