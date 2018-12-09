<?php
class Query_Model extends Conn_Model
{

	CONST SCHEMA 	= NULL;
    CONST TABLE 	= NULL;
    CONST SEQUENCE 	= NULL;
    CONST KEY 		= NULL;
    CONST VALUE 	= NULL;
    CONST ORDER 	= NULL;
    CONST LABEL 	= NULL;
    //
    CONST KOLOM     = NULL; 
    // UNTUK PAGING
    CONST NAV = 3;
    CONST LIMIT = 10;
    CONST FINDLIMIT = 20;

	function __construct()
	{
		parent::__construct();
	}

    function insert($data, $insert_id = FALSE)
    {
        $insert = $this->db->insert(static::getTable(), $data);

        if($insert_id)
        {
            return $this->db->insert_id();
        }
        else
        {
            return $insert;
        }        
    }

    function update($data, $id, $controller = null, $redirect = TRUE)
    {
        $where = array(static::getKey() => $id);

        $update = $this->db->update(static::getTable(), $data, $where);
       
        $info = 'success';
        $saved = info('saved');
        $page = 'detail';

        if($update !== true)
        {
            $info = 'danger';
            $saved = info('not_saved');
            $page = 'edit';
        }

        if($redirect)
        {
            
            $this->session->set_flashdata($info, $saved);
            redirect($controller.'/'.$page.'/'.$id);
        }
                
    }

    function delete($id, $return = FALSE)
    {
        $where = array(static::getKey() => $id);

        $ok = $this->db->delete(static::getTable(), $where);
        
        if(!$ok)
        {
            $error = $this->db->error();
            return array(FALSE, $error);
    
        }

        return TRUE;
    }

    function get_select($select_column = '*')
    {
        $table = $this->getTable();

        $this->db->select($select_column);
        $this->db->from($table);

    }

    function get_where($where = array())
    {
        //$array = array('name' => $name, 'title' => $title, 'status' => $status);
        $this->db->where($where);
    }

    function make_query($select_column = '*', $order_column = null)
    {
        $this->get_select($select_column);

        if(isset($_POST["search"]["value"]))
        {
            $search_value = $_POST["search"]["value"];

            $this->db->like("country_code", $search_value);
            $this->db->or_like("country_name", $search_value);
        }
        if(isset($_POST["order"]))
        {
            $order_column = $_POST['order']['0']['column'];
            $this->db->order_by($this->order_column[$order_column], $_POST['order']['0']['dir']);
        }
        else{
            $this->db->order_by(static::KEY,"DESC");
        }
    }

    function make_datatables($select_column = '*', $order_column = null)
    {
        $this->make_query($select_column, $order_column);

        if($_POST["length"] != -1)
        {
            $this->db->limit($_POST["length"], $_POST["start"]);
        }

        $query = $this->get();

        
        return $query->result();
    }

    function get()
    {
        return $this->db->get();
    }

    function get_result()
    {
        $query = $this->get();
        return $query->result();
    }

    function get_row()
    {
        $query = $this->get();
        return $query->row();
    }

    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->get();
        return $query->num_rows();
    }

    function get_count_all_results($select_column = '*')
    {

        $this->get_select($select_column);
        return $this->db->count_all_results();
    }

    function get_num_rows()
    {
        $this->get_select($select_column);
        $query = $this->get();
        return $query->num_rows();
    }

}