<?php
ini_set("display_errors", 1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_roles extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->API= base_url() . "ws_server/ref_roles";
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
        
        $role_id = 'T';
        $role_name = 'Tes Input';
        $isactive = '1';

        $data = array(
                'role_id'       =>  $role_id,
                'role_name'     =>  $role_name,
                'isactive'      =>  $isactive);

        $insert =  $this->curl->simple_post($this->API, $data, array(CURLOPT_BUFFERSIZE => 10));

        var_dump($insert);
            
    }

    function update()
    {
        
        $role_id = 'T';
        $role_name = 'Tes Update';
        $isactive = '1';

        $data = array(
                'role_id'       =>  $role_id,
                'role_name'     =>  $role_name,
                'isactive'      =>  $isactive);

        $update =  $this->curl->simple_put($this->API, $data, array(CURLOPT_BUFFERSIZE => 10)); 

        var_dump($update);
            
    }

    function delete($id){
        if(empty($id)){
            echo 'id = ';
        }else{
            $delete =  $this->curl->simple_delete($this->API, array('role_id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            var_dump($delete);

        }
    }
}
?>