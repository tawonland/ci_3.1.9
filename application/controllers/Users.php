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
		$a_kolom = $this->getKolom();
		parent::listdata($a_kolom);
	}


	function getKolom()
	{
		$a_kolom[] = array('label' => array('data' => 'No', 'align' => 'center'), 'field' => 'no:');
		$a_kolom[] = array('label' => 'Nama Lengkap', 'field' => 'user_fullname');
		$a_kolom[] = array('label' => 'No HP', 'field' => 'user_mobile');
		
		$isactive = array('<span class="label label-danger">Tidak Aktif</span>', '<span class="label label-success">Aktif</span>');

		$a_kolom[] = array('label' => array('data' => 'Aktif', 'align' => 'center'), 
							'td_attributes' => array('align' => 'left'), 
							'field' => 'user_active', 
							'value' => $isactive);

		return $a_kolom;
	}

	function search()
	{
		
		// get search string
    	$search = ($this->input->post("table_search"))? $this->input->post("table_search") : "NIL";
    	$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

    	$this->stringSearch = $search;
    	$this->uri_segment 	= $this->uri->segment(4);

    	$a_kolom = $this->getKolom();
        $this->listdatasearch($a_kolom);

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
           	$data['user_active'] = '';
           	$this->session->set_flashdata('row', $data);

           	$this->session->set_flashdata('error', validation_errors());
            redirect($this->ctl.'/add');

        }

        //load model
        $this->load->model('users/Users_model');

        //
        $data['user_password']  	= password_hash('admin', PASSWORD_BCRYPT);
        $data['user_name']			= $data['user_email'];
        $data['user_fullname']		= $data['user_fullname'];

        //insert data
       	$id = $this->Users_model->insert($data);
        
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
        $this->load->model('users/users_model');

        //
        $data['user_name']		= $data['user_email'];

       	$update = $this->users_model->update($data, $id);

       	if($update === false)
        {
        	$this->session->set_flashdata('error', info('not_saved'));
        	redirect($this->ctl.'/edit/'.$id);
        }

       	$this->session->set_flashdata('success', info('saved'));
       	redirect($this->ctl.'/detail/'.$id);
       
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
