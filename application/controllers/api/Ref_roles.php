<?php

ini_set("display_errors", 1);

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

const table  = 'ref_roles';

class Ref_roles extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('role_id');
        if ($id == '') {
            $kontak = $this->db->get('ref_roles')->result();
        } else {
            $this->db->where('role_id', $id);
            $kontak = $this->db->get('ref_roles')->result();
        }
        $this->response($kontak, 200);
    }

    //Mengirim atau menambah data kontak baru
	function index_post() {
        $data = array(
                    'role_id'     => $this->post('role_id'),
                    'role_name'     => $this->post('role_name'),
                    'isactive'      => $this->post('isactive'));
        $insert = $this->db->insert('ref_roles', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

	}

	//Memperbarui data kontak yang telah ada
	function index_put() {
        $id = $this->put('role_id');
        $data = array(
                    'role_id'       => $this->put('role_id'),
                    'role_name'          => $this->put('role_name'),
                    'isactive'    => $this->put('isactive'));
        $this->db->where('role_id', $id);
        $update = $this->db->update('ref_roles', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data kontak
	function index_delete() {
        $id = $this->delete('role_id');
        $this->db->where('role_id', $id);
        $delete = $this->db->delete('ref_roles');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini
}
?>