<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('blogsmodel', 'blogsModel');
    }

    public function index()
    {
        $blogs = $this->blogsModel->getAll();
        $this->load->view('pages/v_pages_header');
        $this->load->view('pages/v_pages_index', array(
            'blogs' => $blogs
        ));
        $this->load->view('pages/v_pages_sidebar');
        $this->load->view('pages/v_pages_footer');
    }

    public function about()
    {

    }

    public function contact()
    {

    }
}
