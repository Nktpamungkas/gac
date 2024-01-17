<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function tambahMaster()
    {
        $result_save = array( // Simpan tugas
            "dept"              => $this->input->post('dept', true),
            "no_mesin"          => $this->input->post('no_mesin', true),
            "jenis"             => $this->input->post('jenis', true),
            "merk"              => $this->input->post('merk', true),
            "capacity"          => $this->input->post('capacity', true),
            "freon"             => $this->input->post('freon', true),
            "lokasi"            => $this->input->post('lokasi', true),
            "status"            => $this->input->post('status', true),
            "kategori"          => $this->input->post('kategori', true),
            "pemasangan"        => $this->input->post('pemasangan', true),
            "note"              => $this->input->post('note', true),
            "keterangan"        => $this->input->post('keterangan', true)
        );
        $save = $this->db->insert('mesin', $result_save);

        if($save){
            $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Data Master berhasil dibuat.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function HapusDataMaster($id)
    {
        $this->db->where('id', $id);
        $hapus = $this->db->delete('mesin');
        if($hapus){
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>File berhasil di hapus.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function addNew()
    {
        // lakukan upload file
        $config['upload_path']          = './file/';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['max_size']             = '8100'; // 8 MB
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->do_upload('lampiran1');
        $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        $nama_lampiran1 = $return['file']['file_name'];
        $ukuran_file1   = $return['file']['file_size'];
        $type_file1     = $return['file']['file_type'];

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->do_upload('lampiran2');
        $return2 = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        $nama_lampiran2 = $return2['file']['file_name'];
        $ukuran_file2   = $return2['file']['file_size'];
        $type_file2     = $return2['file']['file_type'];

        // Get name computer untuk menampilkan tiket berdasarkan nama departemen dikomputernya
        $get_nameComp   = substr(gethostbyaddr($_SERVER['REMOTE_ADDR']), 2,3); 

        // if($return['file']['file_name'] && $return2['file']['file_name']){ //Jika file upload tersedia
            if($return['result'] == "success" && $return2['result'] == "success"){ // Jika proses upload sukses
                $tanggal_mulau = $this->input->post('tgl_mulai', true);
                $value = "$tanggal_mulau";
                $convert_tanggalmulai = date("Y-m-d", strtotime($value));

                if ($this->input->post('prioritas', true) == "prioritas") {
                    $prioritas = 1;
                } else {
                    $prioritas = 0;
                }
                $id_mesin = $this->input->post('id_mesin', true).$this->input->post('id_mesinmanual', true);
                $tglopentiket = $this->input->post('tgl_openticket', true);
                if(!empty($tglopentiket)){
                    $tgl_openticket = $this->input->post('tgl_openticket', true);
                }else{
                    $tgl_openticket = date('Y-m-d H:i:s');
                }
                $result_save = array( // Simpan tugas
                    'prioritas'         => $prioritas,
                    'tgl_mulai'         => $tgl_openticket,
                    'kategori'          => $this->input->post('kategori', true),
                    'dept'              => $this->input->post('dept', true),
                    'nama_pelapor'      => $this->input->post('nama_pelapor', true),
                    'dept_pelapor'      => $this->input->post('dept_pelapor', true),
                    'email'             => $this->input->post('email', true),
                    'id_mesin'          => $id_mesin,
                    'lokasi'            => $this->input->post('lokasi', true),
                    'permasalahan'      => $this->input->post('permasalahan', true),
                    'lampiran1'         => $nama_lampiran1,
                    'ukuran_file1'      => $ukuran_file1,
                    'tipe_file1'        => $type_file1,
                    'lampiran2'         => $nama_lampiran2,
                    'ukuran_file2'      => $ukuran_file2,
                    'tipe_file2'        => $type_file2,
                    'status'            => "Open"
                );
                $q_cekIdMesin   = $this->db->query("SELECT * FROM mesin WHERE id = '$id_mesin'")->row();
                $q_cek_tiket    = $this->db->query("SELECT count(*) AS tiket FROM tbl_tugas WHERE (`status` = 'Open' OR `status` = 'Progress') AND id_mesin = '$q_cekIdMesin->id'")->row(); 

                if($q_cek_tiket->tiket == 0){
                    $save = $this->db->insert('tbl_tugas', $result_save);
                    $last_id =  $this->db->insert_id();
    
                    if ($save) {
                        // RIWAYAT TUGAS BARU
                        $dataRiwayat    = array(
                            'id_tugas'              => $last_id,
                            'tanggal'               => mdate('%Y-%m-%d %H:%i:%s %A'),
                            'dibuat_oleh'           => $this->input->post('dept', true),
                            'perbarui_disposisi'    => "Tugas Dibuat oleh ".$this->input->post('nama_pelapor', true)
                        );
                        $this->db->insert('riwayat', $dataRiwayat);
    
                        $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Tugas berhasil dibuat.</b></center>');
    
                        //Jika proses tugas berhasil dirubah
                        $data['nomortiket'] = $last_id;
    
                        $data['title'] = 'Detail Tiket';
                        $this->load->view('template/header_Auth', $data);
                        $this->load->view('auth/statustiket');
                        $this->load->view('template/footer_Auth');
                    } else {
                        $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
                        redirect($this->agent->referrer()); 
                    }
                }else{
                    $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>MESIN SEDANG DIKERJAKAN.<br> SILAHKAN CEK STATUS TIKET ANDA SECARA BERKALA.</b></center>');
                    redirect($this->agent->referrer());
                }
                
            } else { // Jika proses upload gagal
                $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
                redirect($this->agent->referrer());  
            }
        // } else { //Jika file upload tidak tersedia
        //         $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Tiket anda tidak berhasil di upload. Silahkan refresh halaman dan ulangi kembali.</b></center>');
        //         redirect($this->agent->referrer()); 
        // }
    }

    public function edit()
    {
        if ($this->input->post('prioritas', true) == "prioritas") {
            $prioritas = 1;
        } else {
            $prioritas = 0;
        }
        $result_save = array( // Simpan tugas
            'prioritas'         => $prioritas,
            'nama_pelapor'      => $this->input->post('nama_pelapor', true),
            'email'             => $this->input->post('email', true),
            'lokasi'            => $this->input->post('lokasi', true),
            'permasalahan'      => $this->input->post('permasalahan', true),
        );

        $this->db->where('id', $this->input->post('id', true)); 
        $edit = $this->db->update('tbl_tugas', $result_save);
        if ($edit) {
            $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Tugas berhasil diubah.</b></center>');
            redirect($this->agent->referrer()); 
        } else {
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function edittiket()
    {
         // Get name computer untuk menampilkan tiket berdasarkan nama departemen dikomputernya
         $get_nameComp   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
         
        // RIWAYAT TUGAS BARU
        $dataRiwayat    = array(
            'id_tugas'              => $this->input->post('id', true),
            'tanggal'               => mdate('%Y-%m-%d %H:%i:%s %A'),
            'dibuat_oleh'           => $get_nameComp,
            'perbarui_disposisi'    => "Status",
            'perbarui'              => "Perubahan pada status : ".$this->input->post('status', true).", Tgl FlwUp : ".$this->input->post('tgl_follow_up', true).", Solusi : ".$this->input->post('solusi', true)
        );
        $this->db->insert('riwayat', $dataRiwayat);

        // lakukan upload file
        $config['upload_path']          = './file/';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['max_size']             = '8100'; // 8 MB
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->do_upload('lampiran1');
        $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        $nama_lampiran1 = $return['file']['file_name'];
        $ukuran_file1   = $return['file']['file_size'];
        $type_file1     = $return['file']['file_type'];

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->do_upload('lampiran2');
        $return2 = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        $nama_lampiran2 = $return2['file']['file_name'];
        $ukuran_file2   = $return2['file']['file_size'];
        $type_file2     = $return2['file']['file_type'];

        if($return['file']['file_name'] && $return2['file']['file_name']){ //Jika file upload tersedia
            if($return['result'] == "success" && $return2['result'] == "success"){ // Jika proses upload sukses
                $result_save = array( // Simpan tugas
                    'status'                => $this->input->post('status', true),
                    'tgl_follow_up'         => $this->input->post('tgl_follow_up', true),
                    'pelaksana'             => $this->input->post('pelaksana', true),
                    'solusi'                => $this->input->post('solusi', true),
                    'tgl_close'             => $this->input->post('tgl_close', true),
                    'harga'                 => $this->input->post('harga', true),
                    'lampiran_selesai1'     => $nama_lampiran1,
                    'ukuran_file_selesai1'  => $ukuran_file1,
                    'tipe_file_selesai1'    => $type_file1,
                    'lampiran_selesai2'     => $nama_lampiran2,
                    'ukuran_file_selesai2'  => $ukuran_file2,
                    'tipe_file_selesai2'    => $type_file2
                );
                $this->db->where('id', $this->input->post('id', true)); 
                $this->db->update('tbl_tugas', $result_save);
                $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Tiket berhasil di update</b></center>');
                redirect($this->agent->referrer()); 
            } else { // Jika proses upload gagal
                $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
                redirect($this->agent->referrer());
            }
        } else { //Jika file upload tidak tersedia
            $result_save = array( // Simpan tugas
                'status'                => $this->input->post('status', true),
                'tgl_follow_up'         => $this->input->post('tgl_follow_up', true),
                'pelaksana'             => $this->input->post('pelaksana', true),
                'solusi'                => $this->input->post('solusi', true),
                'tgl_close'             => $this->input->post('tgl_close', true),
                'harga'                 => $this->input->post('harga', true)
            );
            $this->db->where('id', $this->input->post('id', true)); 
            $this->db->update('tbl_tugas', $result_save);
            $this->session->set_flashdata('message', '<center class="alert alert-warning" role="alert"><b>Tiket berhasil di simpan</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function tiket()
    {
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 
        $data['title'] = 'Halaman Utama';
        $this->load->view('template/header_Auth', $data);
        $this->load->view('auth/tiket');
        $this->load->view('template/footer_Auth');
    }
    
    public function index_limbahpadat(){
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 
        $data['title'] = 'Daftar Limbah Padat';
        $data['menu'] = 'class="active"';
        $this->load->view('template/header_barang', $data);
        $this->load->view('auth/barang');
    }

    public function tambah_limbahpadat(){
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 
        $data['title'] = 'Tambah data Daftar Limbah Padat';
        $data['menu'] = 'class="active"';
        $this->load->view('template/header_barang', $data);
        $this->load->view('auth/tambah_limbahpadat');
    }

    public function tambahDaftarLimbahPadat(){
        $nama_muatan            = $this->input->post('nama_muatan', true);
        $kategori               = $this->input->post('kategori', true);
        $satuan                 = $this->input->post('satuan', true);
        $satuan_timbang         = $this->input->post('satuan_timbang', true);
        $kontraktor             = $this->input->post('kontraktor', true);
        $pic                    = $this->input->post('pic', true);
        $harga                  = $this->input->post('harga', true);
        $keterangan             = $this->input->post('keterangan', true);
        $createdatetime         = date('Y-m-d H:i:s');
        $ipaddress              = $_SERVER['REMOTE_ADDR'];

        $result = $this->db->query("INSERT INTO tbl_daftarlimbahpadat (nama_muatan,
                                                                        kategori,
                                                                        satuan,
                                                                        satuan_timbang,
                                                                        kontraktor,
                                                                        pic,
                                                                        harga,
                                                                        keterangan,
                                                                        createdatetime,
                                                                        ipaddress)
                                                            VALUES ('$nama_muatan',
                                                                    '$kategori',
                                                                    '$satuan',
                                                                    '$satuan_timbang',
                                                                    '$kontraktor',
                                                                    '$pic',
                                                                    '$harga',
                                                                    '$keterangan',
                                                                    '$createdatetime',
                                                                    '$ipaddress')");
        if($result){
            $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Data Limbah Padat berhasil dibuat.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$result['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
        
    }

    public function edit_limbahpadat($id){
        $data['id'] = $id; 
        $data['title'] = 'Edit data Daftar Limbah Padat';
        $data['menu'] = 'class="active"';
        $this->load->view('template/header_barang', $data);
        $this->load->view('auth/edit_limbahpadat');
    }

    public function editDaftarLimbahPadat($id){
        $nama_muatan            = $this->input->post('nama_muatan', true);
        $kategori               = $this->input->post('kategori', true);
        $satuan                 = $this->input->post('satuan', true);
        $satuan_timbang         = $this->input->post('satuan_timbang', true);
        $kontraktor             = $this->input->post('kontraktor', true);
        $pic                    = $this->input->post('pic', true);
        $harga                  = $this->input->post('harga', true);
        $keterangan             = $this->input->post('keterangan', true);
        $lastupdatedatetime     = date('Y-m-d H:i:s');
        $ipaddress              = $_SERVER['REMOTE_ADDR'];

        $result = $this->db->query("UPDATE tbl_daftarlimbahpadat SET nama_muatan = '$nama_muatan',
                                                                    kategori = '$kategori',
                                                                    satuan = '$satuan',
                                                                    satuan_timbang = '$satuan_timbang',
                                                                    kontraktor = '$kontraktor',
                                                                    pic = '$pic',
                                                                    harga = '$harga',
                                                                    keterangan = '$keterangan',
                                                                    lastupdatedatetime = '$lastupdatedatetime',
                                                                    ipaddress = '$ipaddress'
                                                                WHERE id = '$id'");
        if($result){
            $this->session->set_flashdata('message', '<center class="alert alert-warning" role="alert"><b>Data Limbah Padat berhasil di ubah.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$result['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
        
    }

    public function hapus_limbahpadat($id){
        $this->db->where('id', $id);
        $hapus = $this->db->delete('tbl_daftarlimbahpadat');
        if($hapus){
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>Data berhasil di hapus.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$return['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function transaksi_limbahpadat(){
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 
        $data['title'] = 'Transaksi';
        $data['menuTransaksi'] = 'class="active"';
        $this->load->view('template/header_barang', $data);
        $this->load->view('auth/transaksi');
    }

    public function tambah_transaksi(){
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 
        $data['title'] = 'Tambah data Transaksi';
        $data['menu'] = 'class="active"';
        $this->load->view('template/header_barang', $data);
        $this->load->view('auth/tambah_transaksi');
    }
    
    public function edit_transaksi($no_sj){
        $data['no_sj'] = $no_sj; 
        $data['title'] = 'Edit data Transaksi';
        $this->load->view('template/header_barang', $data);
        $this->load->view('auth/edit_transaksi');
    }

    public function edittransaksi(){
        $result1    = $this->db->query("UPDATE tbl_transaksi SET tgl = '$tgl', 
                                                                nama_hj = '$nama_hj'
                                                            WHERE 
                                                                no_sj = '$no_sj'");
        $this->db->trans_start();
            $id             = $this->input->post('id', true);
            $no_sj          = $this->input->post('no_sj', true);
            $tgl            = $this->input->post('tgl', true);
            $nama_hj        = $this->input->post('nama_hj', true);
            $nama_barang    = $this->input->post('nama_barang', true);
            $qty            = $this->input->post('qty', true);
            $value          = array();
            $index          = 0;
            foreach ($id as $key) {
                array_push($value, array(
                    'id'            => $key,
                    'no_sj'         => $no_sj,
                    'tgl'           => $tgl,
                    'nama_hj'       => $nama_hj,
                    'nama_barang'   => $nama_barang[$index],
                    'qty'           => $qty[$index]
                ));
                $index++;
            }
            $result2 = $this->db->update_batch('tbl_transaksi', $value, 'id');
        $this->db->trans_complete();

        if($result1 && $result2){
            $this->session->set_flashdata('message', '<center class="alert alert-warning" role="alert"><b>Data Limbah Padat berhasil di ubah.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$result1['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }
    
    public function hapus_transaksi($no_sj){
        $this->db->where('no_sj', $no_sj);
        $hapus = $this->db->delete('tbl_transaksi');
        if($hapus){
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>Data berhasil di hapus.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$hapus['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function tambahtransaksi(){
        $this->db->trans_start();
            $data_namabarang    = $this->input->post('nama_barang', true);
            $data_qty           = $this->input->post('qty', true);
            $value              = array();
            $index              = 0; 
            foreach ($data_namabarang as $key) {
                array_push($value, array(
                    'no_sj'         => $this->input->post('no_sj', true),
                    'tgl'           => $this->input->post('tgl', true),
                    'nama_hj'       => $this->input->post('nama_hj', true),
                    'nama_barang'   => $key,
                    'qty'           => $data_qty[$index],
                    'status'        => '1'
                ));
                $index++;
            }
            $result = $this->db->insert_batch('tbl_transaksi', $value);
        $this->db->trans_complete();

        if($result){
            $this->session->set_flashdata('message', '<center class="alert alert-success" role="alert"><b>Transaksi Berhasil.</b></center>');
            redirect($this->agent->referrer()); 
        }else{
            $this->session->set_flashdata('message', '<center class="alert alert-danger" role="alert"><b>'.$result['error'].'</b></center>');
            redirect($this->agent->referrer()); 
        }
    }

    public function print_transaksi($no_sj){
        $data['no_sj'] = $no_sj; 
        $data['title'] = 'Print Surat Pengantar';
        // $this->load->view('template/header_barang');
        $this->load->view('auth/print_transaksi', $data);
    }

    public function cektiket()
    {
        $data['user'] = $this->db->get_where('user', array('name' => $this->session->userdata('name')))->row_array(); 
        $data['nomortiket'] = $this->input->post('nomortiket', true);

        $data['title'] = 'Cek tiket anda disini';
        $this->load->view('template/header_Auth', $data);
        $this->load->view('auth/statustiket');
        $this->load->view('template/footer_Auth');
    }

    public function updatemesin_dept()
    {
        $pk     = $this->input->post('pk', true);
        $dept   = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET dept = '$dept' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_nomesin()
    {
        $pk         = $this->input->post('pk', true);
        $nomesin    = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET no_mesin = '$nomesin' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_jenis()
    {
        $pk         = $this->input->post('pk', true);
        $jenis      = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET jenis = '$jenis' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_merk()
    {
        $pk         = $this->input->post('pk', true);
        $merk       = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET merk = '$merk' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_capacity()
    {
        $pk         = $this->input->post('pk', true);
        $capacity   = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET capacity = '$capacity' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_freon()
    {
        $pk     = $this->input->post('pk', true);
        $freon  = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET freon = '$freon' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_lokasi()
    {
        $pk      = $this->input->post('pk', true);
        $lokasi  = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET lokasi = '$lokasi' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_kategori()
    {
        $pk         = $this->input->post('pk', true);
        $kategori   = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET kategori = '$kategori' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_pemasangan()
    {
        $pk         = $this->input->post('pk', true);
        $pemasangan = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET pemasangan = '$pemasangan' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_status()
    {
        $pk         = $this->input->post('pk', true);
        $status     = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET `status` = '$status' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_note()
    {
        $pk         = $this->input->post('pk', true);
        $note       = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET note = '$note' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
    
    public function updatemesin_keterangan()
    {
        $pk         = $this->input->post('pk', true);
        $keterangan = $this->input->post('value', true);
        $result = $this->db->query("UPDATE mesin SET keterangan = '$keterangan' where id = '$pk'");
        if ($result->num_rows > 0) {
            json_encode('success');
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
}