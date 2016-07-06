<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class BlogsModel extends CI_Model
{

    private $table = 'blogs';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $query = $this->db->get('blogs');
        return $query->result();
    }

    public function getById($id)
    {
        $query = $this->db->get_where('blogs', array('id' => $id));
        return $query->result();
    }
}
