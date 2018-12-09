<?php
ini_set("display_errors", 1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->API="http://localhost/ci_3.1.9_v_2/ws_server/countries";
        $this->load->library('curl');
    }

    function index()
    {
        
        $rs = json_decode($this->curl->simple_get($this->API));

        var_dump($rs);

        //echo 'a';
    }

    function insert()
    {
        $data = array(
                'country_code'      =>  $this->input->post('country_code'),
                'country_name'=>  $this->input->post('country_name'));
        $insert =  $this->curl->simple_post($this->API, $data, array(CURLOPT_BUFFERSIZE => 10)); 
            
    }
}
?>