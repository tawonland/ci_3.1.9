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
        $create_session[$index]['auth']['username'] = $user->uname;
        $create_session[$index]['auth']['level']    = $user->level;


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

        //cek, apakah user?
        $this->load->model('Users_model');

        $user_name = $getUserInfo['email'];

        //cek apakah email sudah ada di database
        //$user = $this->Users_model->get_where($user_name);

        // if($user == false)
        // {
            
        //     $data['google_id']          = $getUserInfo['id'];
        //     $data['user_name']          = $getUserInfo['email'];
        //     $data['user_email']         = $getUserInfo['email'];
        //     $data['user_emailnotif']    = $getUserInfo['email'];
        //     $data['user_fullname']      = $getUserInfo['name'];
        //     $data['user_gender']        = $getUserInfo['gender'];
        //     $data['user_firstname']     = $getUserInfo['givenName'];
        //     $data['user_lastname']      = $getUserInfo['family_name'];
        //     $data['user_password']      = password_hash('hmvcci318', PASSWORD_BCRYPT);

        //     $id = $this->M_Users->insert($data);


        //     if(!$id)
        //     {
        //         $this->session->set_flashdata('error', 'Pendaftaran Gagal');
        //         redirect('login');
        //     }


        //     $user = $this->M_Users->get_login($user_name);
            
        //     // $this->session->set_flashdata('error', 'Maaf, email anda belum terdaftar');
        //     // return redirect('login');
        // }

        
        // ambil user
        
        $ip_address = $this->input->ip_address();
        
        //google session
        $session_user['loginwith']      = 'google';
        $session_user['access_token']   = $access_token;
        $session_user['picture']        = $getUserInfo['picture'];

        $session_user['loged_in']       = TRUE;
        $session_user['user_id']        = $user->user_id;
        $session_user['ip_address']     = $ip_address;
        $session_user['user_name']      = $user->user_name;
        $session_user['user_email']     = $user->user_email;
        $session_user['user_firstname'] = $user->user_firstname;
        $session_user['user_lastname']  = $user->user_lastname;

        $this->session->set_userdata($session_user);

        return redirect('admin');

    }

}
