<?php
ini_set("display_errors", 1);
/**
*
*/
class Countries extends Auth_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		$this->data['content_view'] = 'backend/template/inc_list_v2';
		$this->data['list_view'] = 'countries_list_v';
		$this->admin_template($this->data);
	}

	function fetch_data()
	{
			
		$select_column = array("country_id", "country_code", "country_name");
		$order_column = array(null, "country_code", "country_name", null);

		$fetch_data = $this->getModel()->make_datatables($select_column, $order_column);

		$data = array();
		$recordsTotal = 0;
		$no = 1;
		foreach ($fetch_data as $row) {

			$id = $row->country_id;

			$sub_array = array();
			$sub_array[] = $no;
			$sub_array[] = $row->country_code;
			$sub_array[] = $row->country_name;

			$aksi = '';

			$aksi .= '<button type="button" class="btn btn-info btn-xs btn-flat" data-id="'.$id.'" data-type="detail" data-toggle="tooltip" title="Lihat Detail">
			<i class="fa fa-eye"></i></button> ';
			

			if($this->c_edit){
				$aksi .= '<button type="button" class="btn btn-warning btn-xs btn-flat" data-id="'.$id.'" data-type="edit" data-toggle="tooltip" title="Edit">
							<i class="fa fa-edit"></i></button> ';
			}

			// if($this->c_delete){
			// 	$aksi .= '<button type="button" class="btn btn-danger btn-xs btn-flat" data-id="'.$id.'" data-type="delete" data-toggle="tooltip" title="Hapus">
			// 				<i class="fa fa-trash"></i></button>';
			// }


			$sub_array[] = $aksi;

			$data[] = $sub_array;

			$recordsTotal++;
			$no++;
		}

		$output = array(
			"draw" 				=> intval($_POST["draw"]),
			"recordsTotal"		=> $recordsTotal,
			"recordsFiltered" 	=> $this->getModel()->get_filtered_data(),
			"data" 				=> $data
		);
		echo json_encode($output);
	}

	function add()
	{
		$this->data['content_view'] = 'backend/template/inc_data_v';
		$this->data['form_action'] 	= $this->ctl.'/insert';
		$this->data['form_data'] 	= 'backend/'.$this->ctl.'_data_v';
		$this->data['description'] 	= 'Form ';

		$a_form = $this->get_form();

		$this->data['a_form'] = $a_form;

		$row = $this->session->flashdata('row');

		if($row){
			$this->data['row'] = $row;
		}
		
		$this->admin_template($this->data);
	}

	function get_form()
	{

		$a_form = array();
		$a_form[] = array('label' => 'Kode Negara', 'field' => 'country_code', 'type' => 'text', 'validate' => 'required');
		$a_form[] = array('label' => 'Negara', 'field' => 'country_name', 'type' => 'text', 'validate' => 'required');

		return $a_form;
	}

	function insert()
	{

		$this->load->library('form_validation');

		$data = $this->input->post();

		if ($this->validasi() === FALSE)
        {
           	
           	$this->session->set_flashdata('row', $data);

           	$this->session->set_flashdata('error', validation_errors());
            redirect($this->ctl.'/add');

        }

        //
        $data['country_code']  		= $data['country_code'];
        $data['country_name']		= $data['country_name'];

        //insert data
       	$id = $this->getModel()->insert($data);
        
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

		$data = $this->input->post();

		if ($this->validasi() === FALSE)
        {
           	
           	$this->session->set_flashdata('row', $data);

           	$this->session->set_flashdata('error', validation_errors());
             redirect($this->ctl.'/edit/'.$id);

        }

        //
        $data['country_codes']  	= $data['country_code'];
        $data['country_name']	= $data['country_name'];

       	$this->do_update($data, $id);

	}

	private function validasi()
	{
		
		$error = formx_error();

		$a_form = $this->get_form();

		foreach ($a_form as $key => $v) {

			if(isset($v['validate']))
			{
				
				$field        = $v['field'];
				$label        = $v['label'];
				$validate     = $v['validate'];

				$this->form_validation->set_rules($field, $label, $validate, $error);
			}
	   
		}
		
        return $this->form_validation->run();
	}

}
