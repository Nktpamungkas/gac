<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputLimbah_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library Database di constructor
    }
    public function simpanDataLimbah($data)
    { {
            $this->db->insert('input_limbah', $data);
            return $this->db->insert_id(); // Mengembalikan ID dari data yang baru disimpan
            return $this->db->insert('files', $data);
            
        }
        return true;
    }
    public function getTiketById($id)
    {
        $query = $this->db->get_where('input_limbah', array('id' => $id));
        return $query->row_array();
    }
}
