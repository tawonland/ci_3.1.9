<?php
class MY_Model extends CI_Model
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

	function getSchema() {
        global $conf;

        $schema = static::SCHEMA;
        if (empty($schema) and ! empty($conf['db_dbschema']))
            $schema = $conf['db_dbschema'];

        return $schema;
    }

	function getTable($table = null) {
        if (empty($table))
            $table = static::TABLE;

        $schema = static::getSchema();
        if (empty($schema))
            return $table;
        else
            return $schema . '.' . $table;
    }

    function getField()
    {
        $fields = $this->db->field_data(static::getTable());
        
        return $fields;
    }

    function a_kolom()
    {
        return static::KOLOM;
    }

    private function getArray($key, $array = FALSE) {
        $a_key = explode(',', $key);

        foreach ($a_key as $k => $v)
            $a_key[$k] = trim($v);

        if (count($a_key) == 1) {
            if ($array)
                return array($key);
            else
                return $key;
        } else
            return $a_key;
    }

    function getKey($array = FALSE) {
        return self::getArray(static::KEY, $array);
    }


	function getList($offset = NULL){
		//$c = get_called_class();
		$query = $this->db->get(static::getTable(), static::getLimit(), $offset);

		return $query->result_array();
	}

    function get_where($where = NULL, $limit = NULL, $offset = NULL)
    {
        
        if($limit === NULL)
        {
            $limit = static::getLimit();
        }

        $query = $this->db->get_where(static::getTable(), $where, $limit, $offset);
        
        return $query;
    }

   function get_where_like($string, $offset = NULL){

        $fields = $this->a_kolom();
        
        foreach ($fields as $key => $value) {
            $field = $value['field'];

            if($field == 'no:') continue;

            $this->db->or_like($field, $string);
        }
        //$c = get_called_class();
        
        $query = $this->db->get(static::getTable(), static::getLimit(), $offset);

        return $query;
    }

    function getLimit()
    {
        return static::LIMIT;
    }

	// function getRowById($id)
	// {
	// 	$query = $this->db->where([static::getKey() => $id])->get('users');

	// 	$num = $query->num_rows();

	// 	if($num < 1)
	// 	{
	// 		return FALSE;
	// 	}

	// 	$row = $query->row();

	// 	$array = json_decode(json_encode($row), TRUE);

	// 	return $array;
	// }

    function getCount()
    {
        return $this->db->count_all_results(static::getTable());
    }

    function getCountSearch($search)
    {
        
        $fields = $this->a_kolom();
        
        foreach ($fields as $key => $value) {
            $field = $value['field'];

            if($field == 'no:') continue;

            $this->db->or_like($field, $search);
        }

        return $this->db->count_all_results(static::getTable());
       
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

    function update($data, $id, $return = FALSE)
    {
        $where = array(static::getKey() => $id);

        $ok = $this->db->update(static::getTable(), $data, $where);
        
        if(!$ok)
        {
            $error = $this->db->error();
        }

        if($return)
        {
            return TRUE;
        }

        list($dash, $ctl) = explode("_",strtolower(get_class($this)));

        $this->session->set_flashdata('success', info('not_saved'));
        redirect($ctl.'/detail/'.$id);
        
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



}