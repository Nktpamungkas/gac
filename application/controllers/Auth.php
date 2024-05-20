<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('InputLimbah_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Request Application';
            $this->load->view('template/header_Auth', $data);
            $this->load->view('auth/login');
            $this->load->view('template/footer_Auth');
        } else {
            // validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $name       = $this->input->post('name');
        $password   = $this->input->post('password');
        // $ip         = $_SERVER['REMOTE_ADDR'];

        // if($name == 'ari' OR $name == 'nilo'){
        // $user = $this->db->query("SELECT * FROM user WHERE `name` = '$name' AND ip = '$ip'")->row_array();
        // }else{
        $user = $this->db->query("SELECT * FROM user WHERE `name` = '$name'")->row_array();
        // }
        // Script logged
        $dataLogged = array(
            'logged'    => '1'
        );
        $this->db->where('name', $this->input->post('name', true));
        $this->db->update('user', $dataLogged);

        // usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                if ($password == $user['password']) {
                    $data = array(
                        'name' => $user['name'],
                        'role_id' => $user['role_id'],
                        'situs' => $user['situs']
                    );
                    $this->session->set_userdata($data);

                    if ($user['situs'] == 'JualBarang') {
                        redirect('tugas/index_limbahpadat', $data);
                    } elseif ($user['situs'] == 'Tiket') {
                        redirect('tugas/tiket', $data);
                    }
                } else {
                    $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert">Password Salah!</center>');
                    redirect('auth');
                }
                // jika usernya belum aktif
            } else {
                $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert">Akun Belum di aktifasi!</center>');
                redirect('auth');
            }
        } else {
            // user tidak ada
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert">Akun tidak ditemukan!</center>');
            redirect('auth');
        }
    }

    public function out()
    {
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert">Your have been logged out!</center>');
        redirect('auth');
    }

    public function tiketbaru()
    {
        $data['title'] = 'Tiket Baru';
        $this->load->view('template/header_Auth', $data);
        $this->load->view('auth/tiketbaru');
        $this->load->view('template/footer_Auth');
    }
    public function tiketbarulimbah()
    {
        $data['title'] = 'Tiket Baru';
        $this->load->view('template/header_Auth', $data);
        $this->load->view('auth/tiketbarulimbah');
        $this->load->view('template/footer_Auth');
    }

    public function view($id)
    {
        $data['tugas']      = $this->db->get_where('tbl_tugas', array('id' => $id))->row();

        $data['title'] = 'Tiket Saya';
        $this->load->view('template/header_Auth', $data);
        $this->load->view('auth/view');
        $this->load->view('template/footer_Auth');
    }

    public function viewtiket($id)
    {
        $data['tugas']      = $this->db->get_where('tbl_tugas', array('id' => $id))->row();

        $data['title'] = 'Tiket Saya';
        $this->load->view('template/header_Auth', $data);
        $this->load->view('auth/viewtiket');
        $this->load->view('template/footer_Auth');
    }

    public function hapus($id)
    {
        $tugas      = $this->db->get_where('tbl_tugas', array('id' => $id))->row();
        unlink("./file/$tugas->lampiran1");
        unlink("./file/$tugas->lampiran2");
        unlink("./file/$tugas->lampiran_selesai1");
        unlink("./file/$tugas->lampiran_selesai2");

        $this->db->where('id', $id);
        $hapus = $this->db->delete('tbl_tugas');
        $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>File berhasil di hapus.</b></center>');
        redirect($this->agent->referrer());
    }

    public function data_mesin()
    {
        $kategori = $this->input->post('kategori');
        $dept = $this->input->post('dept');
        $data   = $this->db->query("SELECT * FROM mesin WHERE dept = '$dept' AND kategori = '$kategori'")->result_array();
        echo json_encode($data);
    }

    public function pilihandept()
    {
        $kategori = $this->input->post('kategori');
        $data   = $this->db->query("SELECT * FROM mesin WHERE kategori = '$kategori' GROUP BY dept")->result_array();
        echo json_encode($data);
    }
     // tampilan viewlimbah 
     public function viewlimbah($id)
     {$data['tugas'] = $this->db->get_where('input_limbah', array('id' => $id))->row();
    
     if (!$data['tugas']) {
         // Jika tidak ada data ditemukan, munculkan pesan error atau lakukan tindakan yang sesuai
         echo "Data tidak ditemukan";
         return;
     }
         $data['title'] = 'Tiket Saya';
         $this->load->view('template/header_Auth', $data);
         $this->load->view('viewlimbah');
         $this->load->view('template/footer_Auth');
     }
    //  hapus tiket limbah
     public function hapustiketlimbah($id)
    {
        $tugas      = $this->db->get_where('input_limbah', array('id' => $id))->row();
        unlink("./file/$tugas->lampiran1");
        unlink("./file/$tugas->lampiran2");
        unlink("./file/$tugas->lampiran_selesai1");
        unlink("./file/$tugas->lampiran_selesai2");

        $this->db->where('id', $id);
        $tugas = $this->db->delete('input_limbah');
        $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>File berhasil di hapus.</b></center>');
        redirect($this->agent->referrer());
    }
    public function inputlimbah()
    {
        // Tampilkan halaman input limbah
        {
            // Tampilkan halaman input limbah
            $data['title'] = 'input limbah';
            $this->load->view('template/header_Auth', $data); // Ganti 'input_limbah' dengan nama view yang sesuai
            $this->load->view('inputlimbah'); // Ganti 'input_limbah' dengan nama view yang sesuai
            $this->load->view('template/footer_Auth'); // Ganti 'input_limbah' dengan nama view yang sesuai

        }
    }
}
