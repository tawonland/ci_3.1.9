<?php
class Conn_Model extends CI_Model
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


    function getLimit()
    {
        return static::LIMIT;
    }


}