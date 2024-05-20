<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputLimbah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model yang dibutuhkan
        $this->load->model('InputLimbah_model'); // Load model InputLimbah_model
        $this->load->library('upload');
        $this->load->helper('url');
    }

    public function viewtiket($id)
    {
        $data['tiket'] = $this->InputLimbah_model->getTiketById($id);
        $this->load->view('viewtiketlimbah', $data);
    }

    public function getDelayedTickets()
    {
        $query = $this->db->query("SELECT * FROM input_limbah");
        return $query->result_array();
    }

    public function getTicketById($id)
    {
        $query = $this->db->get_where('input_limbah', array('id' => $id));
        return $query->row_array();
    }
    public function hapus($id)
    {
        $InputLimbah      = $this->db->get_where('input_limbah', array('id' => $id))->row();
        unlink("./file/$InputLimbah->lampiran1");
        unlink("./file/$InputLimbah->lampiran2");
        unlink("./file/$InputLimbah->lampiran_selesai1");
        unlink("./file/$InputLimbah->lampiran_selesai2");

        $this->db->where('id', $id);
        $hapus = $this->db->delete('input_limbah');
        $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>File berhasil di hapus.</b></center>');
        redirect($this->agent->referrer());
    }
}
