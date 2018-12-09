<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("display_errors", 1);

class Login extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('login_model');
    }
    
    public function index()
    {


        $this->load->library('SessionManager');
        $this->load->library('google');

        $this->check_session();

        $this->data['title'] = 'Login';
        $this->data['theme'] = 'theme1/login_v';
        $this->data['loginwithgoogle'] = $this->google->loginURL();
        $this->load->view('frontend/theme',$this->data);
    }

    function check_session()
    {
        //$sessions = $this->session->userdata();

        $isAuthenticated = SessionManager::isAuthenticated();
        $username = SessionManager::getUserName();
        
        if($isAuthenticated AND isset($username))
        {
            redirect('dashboard');
        }
    }

    function ceklogin()
    {
        

        if($this->validasi() === FALSE)
        {
            $this->session->set_flashdata('error', 'Login Gagal');
            redirect();
        }

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $resolve = $this->_resolve_user_login($username, $password);

        if($resolve === FALSE){
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect();
        }

        $this->load->library('SessionManager');
        $index = SessionManager::INDEX;

        $where = array('user_name' => $username);

        $this->getModel()->get_select();
        $this->getModel()->get_where($where);


        $user = $this->getModel()->get_row();

        $create_session = array();
        $create_session[$index]['auth']['isauthenticated'] = TRUE;
        $create_session[$index]['auth']['username'] = $user->user_name;
        $create_session[$index]['auth']['level']    = $user->level;
        $create_session[$index]['auth']['user_id']          = $user->user_id;
        $create_session[$index]['auth']['ip_address']       = $ip_address;
        $create_session[$index]['auth']['user_name']        = $user->user_name;
        $create_session[$index]['auth']['user_email']       = $user->user_email;
        $create_session[$index]['auth']['user_firstname']   = $user->user_firstname;
        $create_session[$index]['auth']['user_lastname']    = $user->user_lastname;

        $this->session->set_userdata($create_session);

        redirect('dashboard');


    }

    private function validasi($aneh = false)
    {
        
        $error = array(
            'required'      => 'Input %s tidak boleh kosong'
        );

        $this->form_validation->set_rules('username', 'Username', 'required', $error);
        $this->form_validation->set_rules('password', 'Password', 'required', $error);
        
        return $this->form_validation->run(); 
    }

    private function _resolve_user_login($username, $password)
    {
        
        $this->db->where('user_name', $username);
        $hash = $this->db->get('users')->row('user_password');

        return $this->_verify_password_hash($password,$hash);
    }

    private function _verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    function loginwithgoogle()
    {

        $this->load->library('google');

        if(isset($_GET['code']))
        {
            $this->google->getAuthenticate();

            $getToken =  $this->google->getAccessToken();

            $access_token = $getToken['access_token'];

        }

        $getUserInfo = $this->google->getUserInfo();

        echo '<pre>';
        print_r($getUserInfo);
        die();

        //cek, apakah user?
        $this->load->model('Users_model');

        $user_name = $getUserInfo['email'];

        //cek apakah email sudah ada di database
        $where = array('user_name' => $user_name);

        $this->getModel()->get_select();
        $this->getModel()->get_where($where);
        $this->db->or_where(array('user_email' => $user_name));

        $user = $this->getModel()->get_row();

        if(!$user)
        {
            
            $data['google_id']          = $getUserInfo['id'];
            $data['user_name']          = $getUserInfo['email'];
            $data['user_email']         = $getUserInfo['email'];
            $data['user_emailnotif']    = $getUserInfo['email'];
            $data['user_fullname']      = $getUserInfo['name'];
            $data['user_gender']        = $getUserInfo['gender'];
            $data['user_firstname']     = $getUserInfo['givenName'];
            $data['user_lastname']      = $getUserInfo['family_name'];
            $data['user_password']      = password_hash('admin', PASSWORD_BCRYPT);

            $id = $this->Users_model->insert($data);

            if(!$id)
            {
                $this->session->set_flashdata('error', 'Register Email Gagal');
                redirect('login');
            }
            
        }

        // ambil user
        
        $ip_address = $this->input->ip_address();
        
        $this->load->library('SessionManager');
        $index = SessionManager::INDEX;

        $create_session = array();
        $create_session[$index]['auth']['isauthenticated'] = TRUE;
        $create_session[$index]['auth']['username'] = $user->user_name;
        $create_session[$index]['auth']['level']    = $user->level;
        $create_session[$index]['auth']['user_id']          = $user->user_id;
        $create_session[$index]['auth']['ip_address']       = $ip_address;
        $create_session[$index]['auth']['user_name']        = $user->user_name;
        $create_session[$index]['auth']['user_email']       = $user->user_email;
        $create_session[$index]['auth']['user_firstname']   = $user->user_firstname;
        $create_session[$index]['auth']['user_lastname']    = $user->user_lastname;

        //google session
        $create_session[$index]['auth']['loginwith']        = 'google';
        $create_session[$index]['auth']['access_token']     = $access_token;
        $create_session[$index]['auth']['picture']          = $getUserInfo['picture'];

        $this->session->set_userdata($create_session);

        redirect('dashboard');

    }

}
