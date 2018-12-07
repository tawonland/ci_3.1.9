<?php
class Auth_Controller extends MY_Controller
{
	public $c_insert 	= true;
	public $c_edit 		= true;
	public $c_delete 	= true;
	
	public $stringSearch = '';
	public $offset 		= '';
	public $a_kolom 	= array();

	function __construct()
	{
		parent::__construct();

		$this->load->library('SessionManager');

		$this->check_session();

		$this->load->library('buttons');

		$this->data['admin_sidebar_menu'] = 'backend/template/admin_sidebar_menu';

		$this->data['page_header'] = ucfirst($this->ctl);
		$this->data['description'] = 'Halaman ' . $this->ctl;

		$this->data['c_edit'] = $this->c_edit;
		$this->data['c_delete'] = $this->c_delete;

		$this->data['buttons'] = array();

		//set table
		$this->load->library('table');

		$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered table-striped">' );

		$this->table->set_template($tmpl);
	}

	function check_session()
    {
    	//$sessions = $this->session->userdata();

        $isAuthenticated = SessionManager::isAuthenticated();
        $username = SessionManager::getUserName();
        
        if(!$isAuthenticated AND !isset($username))
    	{
    		redirect();
    	}
    }

    function admin_template($data = null)
	{
		$this->load->view("backend/template/admin_template_v", $data);
	}

	function listdata()
	{

		$this->data['content_view'] = 'backend/template/inc_list_v';
		$this->data['description'] = 'Data ' . $this->ctl;

		if ($this->c_insert){
			$this->data['buttons']['add'] 	= $this->buttons->add($this->ctl);
		}		

		$page = 'index/';
		$this->uri_segment 	= $this->uri->segment(3);
		$this->offset 		= $this->uri->segment(3);
		$total_rows = $this->{$this->model}->getCount();

		$a_data = array();
		$a_data = $this->a_data();

		$this->data['table_generate'] = $this->tableGenerate($a_data);
		$this->data['pagination'] = $this->getPagination($page, $total_rows);

		//table footer list
		$limit = $this->{$this->model}->getLimit();
		$this->data['showing'] 		= $total_rows < $limit ? $total_rows : $limit;
		$this->data['showingof'] 	= $total_rows;

		$this->admin_template($this->data);
	}

	function search()
	{
		
		// get search string
    	$search = ($this->input->post("table_search"))? $this->input->post("table_search") : "NIL";
    	$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

    	$this->stringSearch = $search;
    	$this->uri_segment 	= $this->uri->segment(4);


        $this->listdatasearch();

	}

	function listdatasearch()
	{
		$search = $this->getStringSearch();
		$page = 'search/'.$search;
		$this->offset 		= $this->uri->segment(4);

		$this->data['content_view'] = 'backend/template/inc_list_v';
		$this->data['description'] = 'Data ' . $this->ctl;

		if ($this->c_insert){
			$this->data['buttons']['add'] 	= $this->buttons->add($this->ctl);
		}

		$a_data = $this->a_data();
		$total_rows = $this->{$this->model}->getCountSearch($search);

		$this->data['table_generate'] = $this->tableGenerate($a_data);
		$this->data['pagination'] = $this->getPagination($page, $total_rows);

		//table footer list
		$this->data['showing'] 		= $this->{$this->model}->getLimit();
		$this->data['showingof'] 	= $total_rows;

		$this->admin_template($this->data);
	}

	function getStringSearch()
	{
		
    	return $this->stringSearch;
	}


	function result()
	{
		if($this->method == 'search')
		{
			
			$search = $this->getStringSearch();
			$data =  $this->{$this->model}->get_where_like($search, $this->getOffset())->result_array();
		}
		else
		{
			
			$data = $this->{$this->model}->getList($this->getOffset());

		}

		return $data;
	}

	function a_data()
	{
		
		return $this->result();
	}

	function type($value, $type = '')
	{

		if($type == '')
		{
			return $value;
		}

		if($type == 'capital')
		{
			return $this->capital($value);
		}
	}

	function capital($value)
	{
		return strtoupper($value);
	}

	function tableGenerate($a_data)
	{
		
		$a_kolom = $this->{$this->model}->a_kolom();

		$type = '';

		$no = 0;
		foreach ($a_data as $key => $row) {
			
			$p_key = $this->{$this->model}->getKey();
			$id    = $row[$p_key];

			$no++;

			$td_attributes = array();

			foreach ($a_kolom as $k => $v) {

				$field = $v['field'];
				if(isset($v['td_attributes'])){
					$td_attributes = $v['td_attributes'];
				}

				
				if($field == 'no:'){
					$col[$key][] = $no;
				}
				else{
					
					$value = $row[$field];

					if(isset($v['value'])){

						if(is_array($v['value'])){
							$value = $v['value'][$value];
						}
						else
						{
							$value = $v['value'];
						}

					}

					if(isset($v['url'])){
						$value = "<a href = ".$v['url'].">".$value."</a>";
					}

					if(isset($v['type'])){
						$value = $this->type($value, $v['type']);
					}

					$col[$key][] = array('data' => $value) + $td_attributes;
				}

			}

			$aksi = '';

			$aksi .= '<button type="button" class="btn btn-info btn-xs btn-flat" data-id="'.$id.'" data-type="detail" data-toggle="tooltip" title="Lihat Detail">
			<i class="fa fa-eye"></i></button> ';
			

			if($this->c_edit){
				$aksi .= '<button type="button" class="btn btn-warning btn-xs btn-flat" data-id="'.$id.'" data-type="edit" data-toggle="tooltip" title="Edit">
							<i class="fa fa-edit"></i></button> ';
			}

			if($this->c_delete){
				$aksi .= '<button type="button" class="btn btn-danger btn-xs btn-flat" data-id="'.$id.'" data-type="delete" data-toggle="tooltip" title="Hapus">
							<i class="fa fa-trash"></i></button>';
			}

			if(!empty($aksi)){
				$col[$key][] = array('data' => $aksi, 'align' => 'center');
			}
			
			$this->table->add_row($col[$key]);
		}

		$th = array();
		foreach ($a_kolom as $k => $v) 
		{
			$th[] = $v['label'];
		}

		if($this->c_edit)
		{
			$th[] = array('data' => 'Aksi', 'align' => 'center');
		}

		$this->table->set_heading($th);

		return $this->table->generate();
	}

	function getOffset()
	{
		return $this->offset;
	}

	function add()
	{
		$this->data['content_view'] = 'backend/template/inc_data_v';
		$this->data['form_action'] 	= $this->ctl.'/insert';
		$this->data['form_data'] 	= 'backend/'.$this->ctl.'_v';
		$this->data['description'] 	= 'Form ';

		$row = $this->session->flashdata('row');

		if($row){
			$this->data['row'] = $row;
		}
		
		$this->admin_template($this->data);
	}

	function detail($id)
	{

		$this->data['c_edit'] = false;

		$key 	= $this->{$this->model}->getKey();
		$id 	= $this->uri->segment(3);
		$where 	= array($key => $id);
		$row 	= $this->{$this->model}->get_where($where)->row_array();

		$this->data['content_view'] = 'backend/template/inc_detail_v';
		$this->data['form_action'] 	= '';
		$this->data['form_data'] 	= 'backend/'.$this->ctl.'_v';
		$this->data['description'] 	= 'Form ';
		$this->data['id']  = $id;
		$this->data['row'] = $row;	

		$this->admin_template($this->data);
	}

	function edit($id)
	{
		
		if($this->c_edit !== true)
		{

			die(info('has_no_access'));
		}

		$key 	= $this->{$this->model}->getKey();
		$id 	= $this->uri->segment(3);
		$where 	= array($key => $id);
		$row 	= $this->{$this->model}->get_where($where)->row_array();
		

		$this->data['content_view'] = 'backend/template/inc_data_v';
		$this->data['form_action'] 	= $this->ctl.'/update/'.$id;
		$this->data['form_data'] 	= 'backend/'.$this->ctl.'_v';
		$this->data['description'] 	= 'Form ';
		$this->data['row'] 	= $row;

		$this->admin_template($this->data);
	}

	function insert()
	{
		echo '<pre>';
		print_r($_REQUEST);
	}

	function update($id)
	{
		
		
	}

	function delete()
	{
		
		if($this->c_delete !== true)
		{
			die(info('has_no_access'));
		}

		$id = $this->input->post('key');

		list($ok, $msg) = $this->{$this->model}->delete($id);

		if(!$ok)
        {
            $this->session->set_flashdata('danger', $msg);
        }

       	$this->session->set_flashdata('success', info('deleted'));
       	redirect($this->ctl);
		
	}

	function getUriSegment()
	{
		return $this->uri_segment;
	}

	function getPagination($page, $total_rows)
	{

		// Pagination
		$this->load->library('pagination');		

		$pagging['base_url'] = base_url().$this->ctl.'/'.$page;
		$pagging['total_rows'] = $total_rows;
		$pagging['per_page'] = $this->{$this->model}->getLimit();
		$pagging['uri_segment'] = $this->getUriSegment();
		$pagging['use_page_numbers'] = TRUE;
		$pagging['cur_page'] = $this->getUriSegment();
		// echo $pagging['uri_segment'];
		// die();
		
		$pagging['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$pagging['full_tag_close'] = '</ul>';
		
		$pagging['first_tag_open'] = '<li class="paginate_button">';
		$pagging['first_tag_close'] = '</li>';
		
		$pagging['cur_tag_open'] = '<li class="paginate_button active"><a href="#">';
		$pagging['cur_tag_close'] = '</a></li>';
		
		$pagging['prev_tag_open'] = '<li class="paginate_button">';
		$pagging['prev_tag_close'] = '</li>';
		
		$pagging['num_tag_open'] = '<li class="paginate_button">';
		$pagging['num_tag_close'] = '</li>';
		
		$pagging['next_tag_open'] = '<li class="paginate_button">';
		$pagging['close_tag_open'] = '</li>';
		
		$pagging['last_tag_open'] = '<li class="paginate_button">';
		$pagging['last_tag_close'] = '</li>';

		$this->pagination->initialize($pagging);

		return $this->pagination->create_links();
	}
}
