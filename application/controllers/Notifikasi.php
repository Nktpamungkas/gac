<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 

        $data['title'] = 'Semua Notifikasi';
        $this->load->view('template/header', $data);
        $this->load->view('notifikasi/index');
        $this->load->view('template/footer');
    }
}