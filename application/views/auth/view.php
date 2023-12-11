<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script>
	function uploadFile() {
        // membaca data file yg akan diupload, dari komponen 'fileku'
        var file1 = document.getElementById("fileku1").files[0];
        var file2 = document.getElementById("fileku2").files[0];
        var formdata = new FormData();
        formdata.append("datafile", file1);
        formdata.append("datafile", file2);
        
        // proses upload via AJAX disubmit ke 'upload.php'
        // selama proses upload, akan menjalankan progressHandler()
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.open("POST", "upload.php", true);
        ajax.send(formdata);
    }
    
    function progressHandler(event){
        // hitung prosentase
        var percent = (event.loaded / event.total) * 100;
        // menampilkan prosentase ke komponen id 'progressBar'
        document.getElementById("progressBar").value = Math.round(percent);
        // menampilkan prosentase ke komponen id 'status'
        document.getElementById("status").innerHTML = Math.round(percent)+"% telah terupload";
        // menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
        document.getElementById("total").innerHTML = "Telah terupload "+event.loaded+" bytes dari "+event.total;
    }
</script>
<style>
    .blinking{
        animation:blinkingText 0.8s infinite;
    }
    @keyframes blinkingText{
        0%{     color: #00000;    }
        100%{    color: transparent; }
        100%{   color: #00000;    }
    }

    .wrapper {
        width: 100%;
        margin: 0 auto;
    }
    
    .zoom-effect {  
        position: relative;
        width: 100%;
        height: 360px;
        margin: 0 auto;
        overflow: hidden;  
    }
    
    .kotak {
        position: absolute;
        top: 0;
        left: 0;
    }
    
    .kotak img {
        -webkit-transition: 0.4s ease;
        transition: 0.4s ease;
        width: 100%;
    }
    
    .zoom-effect:hover .kotak img {
        -webkit-transform: scale(1.08);
        transform: scale(1.08);
    }
</style>
<div class="container">
    <div class="login-logo">
        <a href="<?= base_url(); ?>"><b>Tiket</b> Baru</a>
    </div>
    <?= $this->session->flashdata('message'); ?>
    
    <div class="login-box-body">
        <a href="<?= base_url(); ?>Auth/tiketbaru" class="btn btn-link btn-flat">Kembali</a>
        <h2>NOMOR TIKET ANDA : <?= $tugas->id; ?></h2>
        <section class="content">
            <?php if($tugas->status != "Open") : ?>
            <div class="box">
                <div class="box box-success">
                    <table class="table table-striped" width="100%">
                        <tr>
                            <th style="width: 25px">#</th>
                            <th style="width: 25px"></th>
                        </tr>
                        <tr>
                            <td><b>Status Tiket</b></td>
                            <td><?= $tugas->status; ?></td>
                        </tr>
                        <tr>
                            <td><b>Sedang dikerjakan oleh</b></td>
                            <td><?= $tugas->pelaksana; ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Follow Up</b></td>
                            <td><?= $tugas->tgl_follow_up; ?></td>
                        </tr>
                        <tr>
                            <td><b>Solusi</b></td>
                            <td><?= $tugas->solusi; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            <div class="box">
                <div class="box box-primary">
                    <form action="<?= base_url(); ?>tugas/edit" method="POST" enctype="multipart/form-data">
                        <div class="box-header with-border col-sm-12">
                            <h3 class="box-title">Tiket baru</h3>
                            <div class="pull-right box-tools">
                                <label>
                                    <input type="checkbox" name="prioritas" value="prioritas" class="minimal-red" <?php if($tugas->prioritas == 1)echo "checked"; ?>>
                                    Prioritas tinggi <i class="fa fa-fire" style="color: red;"></i>
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $tugas->id; ?>">
                        <div class="box-body">
                            <div class="form-group col-sm-12" id="select_box">
                                <select class="form-control" style="width: 100%;" name="kategori" id="kategori" disabled>
                                    <option value="" disabled selected><?= $tugas->kategori; ?></option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="Text" class="form-control input-sm" value="<?= $tugas->dept; ?>" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control input-sm" name="nama_pelapor" value="<?= $tugas->nama_pelapor; ?>" placeholder="Nama pelapor:" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control input-sm" name="email" value="<?= $tugas->email; ?>" placeholder="Email pelapor:">
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control input-sm" name="lokasi" value="<?= $tugas->lokasi; ?>" placeholder="Lokasi:" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control input-sm" value='<?php 
                                            $dataKategori   = $this->db->query("SELECT * FROM mesin WHERE id='$tugas->id_mesin'")->row();
                                            if ($dataKategori) {
                                                echo $dataKategori->kategori.' '.$dataKategori->merk.' '.$dataKategori->jenis;
                                            } else {
                                                echo $tugas->id_mesin;
                                            }
                                        ?>' readonly>
                            </div>
                            <div class="form-group col-sm-12">
                                <textarea id="editor1" name="permasalahan" rows="5" style="width: 100%;" placeholder="Permasalahan:" required><?= $tugas->permasalahan; ?></textarea>
                            </div>
                            <script>
                                $(function () {
                                    CKEDITOR.replace('editor1')
                                    $('.textarea').wysihtml5()
                                })
                            </script>
                            <div class="form-group col-sm-6">
                                <div class="wrapper">
                                    <div class="zoom-effect">
                                        <div class="kotak">
                                            <a href="" target="popup" onclick="window.open('<?= base_url(); ?>file/<?= $tugas->lampiran1; ?>','popup','width=100%'); return false;">
                                                <img src="<?= base_url(); ?>file/<?= $tugas->lampiran1; ?>">
                                            </a>
                                        </div>
                                    </div>		
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="wrapper">
                                    <div class="zoom-effect">
                                        <div class="kotak">
                                            <a href="" target="popup" onclick="window.open('<?= base_url(); ?>file/<?= $tugas->lampiran2; ?>','popup','width=600px, height=600px'); return false;">
                                                <img src="<?= base_url(); ?>file/<?= $tugas->lampiran2; ?>">
                                            </a>
                                        </div>
                                    </div>		
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-left">
                                <button type="submit" name="submit" class="btn bg-red btn-flat" style="font-size: 12px;">UBAH TIKET</button>
                                <a href="<?= base_url(); ?>Auth/tiketbaru" class="btn btn-link btn-flat" style="font-size: 12px;">BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

