<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
        $this->load->model('usersmodel', 'usersModel');
        
        if ($this->usersModel->isLoggedIn() === false) {
            $this->usersModel->removePassword();
            redirect('login/noaccess');
        } else {
            // is_logged_in also put user data in session
            $this->data['user'] = $this->session->userdata('user');
        }

    }

    public function index()
    {
        $this->load->view('users/v_users_home', $this->data);
    }
}
