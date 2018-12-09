<?php

ini_set("display_errors", 1);

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Countries extends REST_Controller {

    var $table  = 'countries';

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('country_id');
        if ($id == '') {
            $result = $this->db->get($this->table)->result();
        } else {
            $this->db->where('country_id', $id);
            $result = $this->db->get($this->table)->result();
        }
        $this->response($result, 200);
    }

    //Mengirim atau menambah data kontak baru
	function index_post() {
        $data = array(
                    'country_code'     => $this->post('country_code'),
                    'country_name'     => $this->post('country_name'));
        $insert = $this->db->insert($this->table, $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

	}

	//Memperbarui data kontak yang telah ada
	function index_put() {
        $id = $this->put('country_id');
        $data = array(
                    'country_code'      => $this->put('country_code'),
                    'country_name'      => $this->put('country_name'));
        $this->db->where('country_id', $id);
        $update = $this->db->update($this->table, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data kontak
	function index_delete() {
        $id = $this->delete('country_id');
        $this->db->where('country_id', $id);
        $delete = $this->db->delete($this->table);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini
}
?>