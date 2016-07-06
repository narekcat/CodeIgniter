<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Blogs extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->model('blogsmodel', 'blogsModel');
    }

    public function index()
    {
        $blogs = $this->blogsModel->getAll();
        $this->load->view('blogs/v_blogs_header');
        $this->load->view('blogs/v_blogs_index', array(
            'blogs' => $blogs
        ));
        $this->load->view('blogs/v_blogs_sidebar');
        $this->load->view('blogs/v_blogs_footer');
    }

    public function view($id = null)
    {
        if (isset($id)) {
            $blog = $this->blogsModel->getById($id);
            if (!empty($blog)) {
                $data['blog'] = $blog[0];
            } else {
                $data['wrongId'] = 'There are not blog with id: ' . $id;
            }
        } else {
            $data['wrongId'] = 'Please provide id';
        }
        $this->load->view('blogs/v_blogs_header');
        $this->load->view('blogs/v_blogs_view', $data);
        $this->load->view('blogs/v_blogs_sidebar');
        $this->load->view('blogs/v_blogs_footer');
    }

    public function add()
    {
        
    }

    public function edit($id = null)
    {
        
    }
}
