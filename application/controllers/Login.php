<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller
{

    // data for view, we do this so we can set value in __construct
    // and pass to other functions if needed
    private $data = array();
    
    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->model('usersmodel', 'usersModel');
        $this->load->library('form_validation');
    }

    // route /login
    public function index()
    {
        if ($this->usersModel->isLoggedIn()) {
            redirect('blogs/index');
        }
    
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
        
            if ($user = $this->usersModel->getByUsername($username)) {
                if ($this->usersModel->checkPassword($password, $user['password'])) {
                    $this->usersModel->allowPassword($user);
                    redirect('blogs/index');
                } else {
                    $this->data['login_error'] = 'Invalid username or password';
                }
            } else {
                $this->data['login_error'] = 'Username not found';
            }
        }
        $this->load->view('login/v_login', $this->data);
    }
    
    // route /register -- check settings in /application/config/routes.php
    public function register()
    {
        if ($this->usersModel->is_logged_in()) {
            redirect('users');
        }

        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Password', 'required|matches[password]');
        
        if ($this->form_validation->run()) {
            $user = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'fullname' => $this->input->post('fullname'),
                'password' => $this->usersModel->hash_password($this->input->post('password'))
            );
            if ($this->usersModel->save($user)) {
                $this->data['register_success'] = 'Registration successful. <a href="'.site_url('login').'">Click here to login</a>.';
            } else {
                $this->data['register_error'] = 'Saving data failed. Contact administrator.';
            }
        }
        $this->load->view('login/v_register', $this->data);
    }
    
    // route /logout -- check settings in /application/config/routes.php
    public function logout()
    {
        $this->usersModel->remove_pass();
        $this->data['login_success'] = 'You have been logged out. Thank you.';
        $this->load->view('login/v_login', $this->data);
    }
    
    // noaccess to show no access message
    public function noaccess()
    {
        $this->data['login_error'] = 'You do not have access or your login has expired.';
        $this->load->view('login/v_login', $this->data);
    }
}
