<script language="javascript">
    function tambahNama() {
        var idf = document.getElementById("idf").value;
        var stre = "<div class='form-group'><p id='srow" + idf + "'><input class='form-control input-sm' name='daftar_checklist[]' placeholder='Hal yang harus dilakukan:'><a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'><i class='fa fa-close red'></i> Hapus</a></p></div>";
        $("#divSite").append(stre);
        idf = (idf - 1) + 2;
        
        document.getElementById("idf").value = idf;
    }

    function hapusElemen(idf) {
        $(idf).remove();
    }
</script>
<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#durasi').change(function(){
            var duration = document.getElementById('durasi').value;
            var hariKedepan = new Date(new Date(document.getElementById('datepicker2').value).getTime()+(duration*24*60*60*1000));
            let formatted_date = (hariKedepan.getMonth() + 1) + "/" + hariKedepan.getDate() + "/" + hariKedepan.getFullYear()

            document.getElementById('tgl_selesai').value = formatted_date;
        });
        
        $('#datepicker2').change(function(){
            var duration = document.getElementById('durasi').value;
            var hariKedepan = new Date(new Date(document.getElementById('datepicker2').value).getTime()+(duration*24*60*60*1000));
            let formatted_date = (hariKedepan.getMonth() + 1) + "/" + hariKedepan.getDate() + "/" + hariKedepan.getFullYear()

            document.getElementById('tgl_selesai').value = formatted_date;
        });
    });
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
</style>
<style> 
    .div1 {
    width: 300px;
    height: 100px;
    border: 0px solid blue;
    background: #F0F8FF;
    }
</style>
<script>
	function uploadFile() {
        // membaca data file yg akan diupload, dari komponen 'fileku'
        var file = document.getElementById("fileku").files[0];
        var formdata = new FormData();
        formdata.append("datafile", file);
        
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
<div class="content-wrapper">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="<?php if($title == "Tugas Saya"){ echo 'active'; } ?>">
                    <a href="<?= base_url(); ?>tugas">Semua 
                        <?php 
                            $penanggungJwb = $user['id'];
                            $telat = $this->db->query("SELECT Count( * ) AS Telat FROM `tbl_tugas` WHERE tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) AND DATE_SUB( NOW( ), INTERVAL '1' DAY ) AND hapus = 0 AND NOT `status` = 'Selesai' AND penanggung_jawab = '$penanggungJwb'")->row();
                            if ($telat->Telat) {
                                echo '<span class="badge bg-red" title="Tugas Terlambat">'.$telat->Telat.'</span>'; 
                            }                       
                        ?>
                    </a>
                </li>
                <li class="<?php if($title == "Tempat Sampah"){ echo 'active'; } ?>"><a href="<?= base_url(); ?>tugas/tempat_sampah">Tempat Sampah</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Selengkapnya
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Pengaturan</a></li>
                        <li><a href="#">Laporan</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <section class="content">
        <!-- START TUGAS BARU -->
            <button type="button" class="btn bg-blue btn-app" title="Buat tugas baru" data-toggle="collapse" data-target="#Tugas-Baru">
                    <i class="fa fa-inbox"></i>Tugas Baru
            </button>
        <!-- END TUGAS BARU -->

        <!-- START TUGAS BARU CEPAT-->
            <button type="button" class="btn bg-orange btn-app" title="Buat tugas cepat" data-toggle="collapse" data-target="#Tugas-Baru-Cepat">
                <i class="fa fa-bolt"></i>Tugas Cepat
            </button>
        <!-- END TUGAS BARU CEPAT-->

        <?= $this->session->flashdata('message'); ?>

        <!-- START MODAL TUGAS BARU -->
            <div id="Tugas-Baru" class="collapse">
                <div class="box">
                    <div class="box box-primary">
                        <form action="<?= base_url(); ?>tugas/addNew/<?= $user['dept']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="box-header with-border">
                                <h3 class="box-title">Tugas baru</h3>
                                <div class="pull-right box-tools">
                                    <label>
                                        <input type="checkbox" name="prioritas" value="prioritas" class="minimal-red">
                                        Prioritas tinggi <i class="fa fa-fire" style="color: red;"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="judul" placeholder="Hal yang harus dilakukan:">
                                    <input type="hidden" name="tugas_cepat" value="0">
                                </div>
                                <div class="form-group">
                                    <textarea id="editor1" name="deskripsi" rows="10" cols="80"></textarea>
                                </div>
                                <script>
                                    $(function () {
                                        CKEDITOR.replace('editor1')
                                        $('.textarea').wysihtml5()
                                    })
                                </script>
                                <div class="form-group">
                                    <div class="btn btn-default">
                                        <input type="file" name="lampiran" id="fileku">
                                    </div>
                                    
                                    <input type="button" value="Upload File" class="btn btn-success" onclick="uploadFile()">
                                    <i style="font-size: 12px;">Max. 10MB (*.pdf, *.xlsx, *.xls, *.doc, *.docs, *.jpeg, *.png)</i>

                                    <progress id="progressBar" value="0" max="100" style="width:100px;" hidden></progress>
                                    <span id="status" style="font-size: 12px; color: red; font-weight: bold;"></span>
                                </div>
                                <div class="form-group">
                                    <button class="btn bg-navy btn-flat margin" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Daftar Cheklist
                                    </button>
                                    <div class="box-body">
                                        <div class="collapse" id="collapseExample">
                                            <p><u><h5>Daftar Periksa</h5></u></p>
                                            
                                            <div class="col-lg-12" id="divSite" class="form-group">
                                                <input id="idf" value="1" type="hidden">
                                            </div>
                                            
                                            <a href="#" class="fa fa-plus" onclick="tambahNama(); return false;"> Tambah Daftar Periksa</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Penanggung Jawab</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" name="penanggung_jawab" required>
                                            <?php $return = $this->db->get_where('user', array('ket' => 'Programmer'))->result_array(); ?>
                                                <option value="" disabled selected>Penanggung Jawab</option>
                                            <?php foreach($return AS $data) : ?>
                                                <option value="<?= $data['id']; ?>"><?= $data['email']; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Dibuat Oleh</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-sm" name="dibuat_oleh" value="<?= $user['name']; ?>" placeholder="Dibuat Oleh" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Tenggat Waktu</label>
                                        <div class="col-sm-4">
                                            <input type="text" id="datepicker" name="tenggat_waktu" class="form-control input-sm" size="5">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#Perencanaan-Waktu">Perencanaan Waktu</button>
                                        <div class="col-sm-12">
                                            <div id="Perencanaan-Waktu" class="collapse">
                                                <div class="box-body">
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-9">
                                                            <label class="col-sm-3 control-label">Mulai Tugas Pada</label>
                                                            <label><input type="text" id="datepicker2" name="tgl_mulai" class="form-control input-sm"></label>
                                                        </div>
                                                        <label class="col-sm-2 control-label"> </label>
                                                        <div class="col-sm-9">
                                                            <label class="col-sm-3 control-label">Durasi</label>
                                                            <label><input type="text" onkeypress="myFunction()" id="durasi" name="durasi" class="form-control input-sm" size="5"></label> / Hari <i style="font-size: 10px">(To change, please press "Tab")</i>
                                                        </div>
                                                        <label class="col-sm-2 control-label"> </label>
                                                        <div class="col-sm-9">
                                                            <label class="col-sm-3 control-label">Selesaikan</label>
                                                            <label><input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control input-sm" readonly></label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <button type="submit" name="submit" class="btn bg-green btn-flat" style="font-size: 12px;">TAMBAHKAN TUGAS</button>
                                    <button type="button" class="btn btn-link btn-flat" data-toggle="collapse" data-target="#Tugas-Baru" style="font-size: 12px;">BATAL</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- END MODAL TUGAS BARU -->
        
        <!-- START MODAL TUGAS BARU CEPAT-->
            <div id="Tugas-Baru-Cepat" class="collapse">
                <div class="box">
                    <form action="<?= base_url(); ?>tugas/addNewCepat/<?= $user['dept']; ?>" method="POST">
                        <div class="box box-warning">
                            <div class="box-body">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" name="judul" placeholder="Hal yang harus dilakukan:">
                                    <input type="hidden" name="tugas_cepat" value="1">
                                </div>
                                <div class="form-group col-sm-2">
                                    <input type="text" id="datepicker3" name="tenggat_waktu" placeholder="Tenggat Waktu" class="form-control" size="5">
                                </div>
                                <div class="form-group col-sm-2">
                                    <select class="form-control select2" style="width: 100%;" name="penanggung_jawab" required>
                                    <?php $return = $this->db->get_where('user', array('ket' => 'Programmer'))->result_array(); ?>
                                    <option value="" disabled selected>Penanggung Jawab</option>
                                    <?php foreach($return AS $data) : ?>
                                        <option value="<?= $data['id']; ?>"><?= $data['email']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <input type="text" class="form-control input-sm" name="dibuat_oleh" value="<?= $user['name']; ?>" placeholder="Dibuat Oleh:" readonly>
                                </div>
                                <div class="form-group col-sm-12">
                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#Deskripsi-Tugas-Baru-Cepat">
                                        <u>Deskripsi</u>
                                    </button>
                                    <div id="Deskripsi-Tugas-Baru-Cepat" class="collapse">
                                        <div class="form-group">
                                            <textarea id="editor2" name="deskripsi" rows="10" cols="80"></textarea>
                                        </div>
                                        <script>
                                            $(function () {
                                                CKEDITOR.replace('editor2')
                                                $('.textarea').wysihtml5()
                                            })
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="pull-left">
                                    <button type="submit" name="submit" class="btn bg-green btn-flat">Simpan</button>
                                    <button type="button" class="btn btn-link btn-flat" data-toggle="collapse" data-target="#Tugas-Baru-Cepat">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- END MODAL TUGAS BARU CEPAT-->

        <!-- START HALAMAN INDEX -->
            <div class="box">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-th"></i> Tugas Saya
                            <?php
                                 if ($telat->Telat) {
                                     echo '<span class="badge bg-red" title="Tugas Terlambat">'.$telat->Telat.' terlambat</span> '; 
                                 } else {
                                     echo '<span style="font-size: 13px; font-style: italic;">Tidak ada tugas yang memerlukan perhatian segera</span>';
                                 }
                            ?>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="10"><i class="fa fa-gear"></i></th>
                                        <th width="400">Nama</th>
                                        <th width="200">Tenggat Waktu</th>
                                        <th width="50">Dept</th>
                                        <th width="200">Dibuat Oleh</th>
                                        <th width="200">Penanggung Jawab</th>
                                        <th width="200">Status </th>
                                    </tr>
                                </thead>
                                <!-- AKUN DIT -->
                                <?php if($user['ket'] == "DIT") : ?>
                                    <tbody>
                                        <?php 
                                            $return = $this->db->query("SELECT a.id, a.prioritas, a.judul, DATE_FORMAT( a.tenggat_waktu, '%d %b %Y' ) AS tenggat_waktu,
                                                                                a.`status`, a.dept, a.dibuat_oleh, a.penanggung_jawab, b.email,
                                                                            IF ( a.tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) 
                                                                                AND DATE_SUB( NOW( ), INTERVAL '1' DAY ), 1, 0 ) AS Telat_row 
                                                                            FROM
                                                                                `tbl_tugas` a
                                                                                LEFT JOIN ( SELECT * FROM user b ) b ON b.id = a.penanggung_jawab 
                                                                            WHERE
                                                                                a.hapus = 0
                                                                            ORDER BY
                                                                                a.tenggat_waktu DESC")->result_array(); 
                                        ?>
                                        
                                        <?php foreach($return AS $data) : ?>
                                        <tr <?php if($data['status'] == "Jeda"){ echo 'bgcolor="#FFE4B5"'; } ?>>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tugas/view/<?= $data['id']; ?>">Tampilkan</a></li>
                                                        <li><a href="<?= base_url(); ?>tugas/view_edit/<?= $data['id']; ?>">Edit</a></li>
                                                        <?php if ($data['status'] == 'Selesai') : ?>
                                                            <li><a href="<?= base_url(); ?>tugas/lanjut/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/Jeda">Lanjut</a></li>
                                                        <?php else : ?>

                                                            <?php if($data['status'] == "OnProses") : ?>
                                                                <li><a href="<?= base_url(); ?>tugas/set_timerTugas/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/Jeda">Jeda</a></li>
                                                            <?php else : ?>
                                                                <li><a href="<?= base_url(); ?>tugas/set_timerTugas/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/OnProses">Mulai</a></li>
                                                            <?php endif; ?>

                                                            <!-- <li><a href="<?= base_url(); ?>tugas/ditangguhkan/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/Ditangguhkan">Undur</a></li> -->
                                                        <?php endif; ?>

                                                        <!-- <li><a href="#">Tambah Keperencana Harian</a></li> -->
                                                        <li><a href="<?= base_url(); ?>tugas/tempatsampah/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tugas/view/<?= $data['id']; ?>" style="<?php if($data['status'] == 'Open'){ 
                                                                                                        echo 'color: black;';
                                                                                                    } elseif($data['status'] == 'Selesai') {
                                                                                                        echo 'color: grey; text-decoration: line-through;';
                                                                                                    } ?>
                                                                                            <?php
                                                                                                if($data['Telat_row'] == 1){
                                                                                                    echo 'color: red;';
                                                                                                }
                                                                                            ?>">
                                                    <?= $data['judul']; ?> 
                                                    
                                                </a>
                                                    <?php
                                                        $id = $data['id']; 
                                                        $search = $this->db->query("SELECT count(*) AS summary FROM komentar WHERE id_tugas = '$id' ")->row(); 
                                                        if($search->summary){ // Komentar
                                                            echo ' <i class="fa fa-commenting" style="color: grey;" font-size: 13px;> '.$search->summary.'</i>'; 
                                                        } 
                                                    ?>
                                                <?php if($data['prioritas'] == 1){ echo ' <i class="fa fa-fire" style="color: red;"></i>'; } ?>
                                            </td>
                                            <td><?php if ($data['tenggat_waktu'] == "01 Jan 1970") {
                                                    echo '<a href="#"><span style="border-bottom: 1px black dashed;">Tidak ada</span></a>';
                                                } else {
                                                    echo $data['tenggat_waktu'];
                                                }
                                                ?> 
                                            </td>
                                            <td><?= $data['dept']; ?> </td>
                                            <td><i class="fa fa-user" style="color: grey;"> <?= $data['dibuat_oleh']; ?></i> </td>
                                            <td><i class="fa fa-user" style="color: grey;"> <?= $data['email']; ?></i> </td>
                                            <td class="<?php if($data['status'] == "OnProses") { echo "blinking"; } ?>" style="
                                                        <?php if($data['status'] == 'Selesai') {
                                                            echo 'color: grey;';
                                                        } elseif($data['status'] == 'Open'){
                                                            echo 'font-weight: bold;';
                                                        } ?>"> 
                                                        <?= $data['status']; ?> </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                <!-- AKUN PROGRAMMER -->
                                <?php elseif($user['ket'] == "Programmer") : ?>
                                    <tbody>
                                        <?php 
                                            $user_id = $user['id'];
                                            $return = $this->db->query("SELECT a.id, a.prioritas, a.judul, DATE_FORMAT( a.tenggat_waktu, '%d %b %Y' ) AS tenggat_waktu,
                                                                                a.`status`, a.dept, a.dibuat_oleh, a.penanggung_jawab, b.email,
                                                                            IF ( a.tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) 
                                                                                AND DATE_SUB( NOW( ), INTERVAL '1' DAY ), 1, 0 ) AS Telat_row 
                                                                            FROM
                                                                                `tbl_tugas` a
                                                                                LEFT JOIN ( SELECT * FROM user b ) b ON b.id = a.penanggung_jawab 
                                                                            WHERE
                                                                                a.hapus = 0 AND a.penanggung_jawab = $user_id
                                                                            ORDER BY
                                                                                a.tenggat_waktu DESC")->result_array(); 
                                        ?>
                                        <?php foreach($return AS $data) : ?>
                                        <tr <?php if($data['status'] == "Jeda"){ echo 'bgcolor="#FFE4B5"'; } ?>>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tugas/view/<?= $data['id']; ?>">Tampilkan</a></li>
                                                        <?php if ($data['status'] == 'Selesai') : ?>
                                                            <li><a href="<?= base_url(); ?>tugas/lanjut/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/Jeda">Lanjut</a></li>
                                                        <?php else : ?>
                                                                <?php if($data['status'] == "OnProses") : ?>
                                                                    <li><a href="<?= base_url(); ?>tugas/set_timerTugas/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/Jeda">Jeda</a></li>
                                                                <?php else : ?>
                                                                    <li><a href="<?= base_url(); ?>tugas/set_timerTugas/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>/OnProses">Mulai</a></li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                        <!-- <li><a href="#">Tambah Keperencana Harian</a></li> -->
                                                        <li><a href="<?= base_url(); ?>tugas/tempatsampah/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tugas/view/<?= $data['id']; ?>" style="<?php if($data['status'] == 'Open'){ 
                                                                                                        echo 'color: black;';
                                                                                                    } elseif($data['status'] == 'Selesai') {
                                                                                                        echo 'color: grey; text-decoration: line-through;';
                                                                                                    } ?>
                                                                                            <?php
                                                                                                if($data['Telat_row'] == 1){
                                                                                                    echo 'color: red;';
                                                                                                }
                                                                                            ?>">
                                                    <?= $data['judul']; ?> 
                                                    
                                                </a>
                                                    <?php
                                                        $id = $data['id']; 
                                                        $search = $this->db->query("SELECT count(*) AS summary FROM komentar WHERE id_tugas = '$id' ")->row(); 
                                                        if($search->summary){ // Komentar
                                                            echo ' <i class="fa fa-commenting" style="color: grey;" font-size: 13px;> '.$search->summary.'</i>'; 
                                                        } 
                                                    ?>
                                                <?php if($data['prioritas'] == 1){ echo ' <i class="fa fa-fire" style="color: red;"></i>'; } ?>
                                            </td>
                                            <td><?php if ($data['tenggat_waktu'] == "01 Jan 1970") {
                                                    echo '<a href="#"><span style="border-bottom: 1px black dashed;">Tidak ada</span></a>';
                                                } else {
                                                    echo $data['tenggat_waktu'];
                                                }
                                                ?> 
                                            </td>
                                            <td><?= $data['dept']; ?> </td>
                                            <td><i class="fa fa-user" style="color: grey;"> <?= $data['dibuat_oleh']; ?></i> </td>
                                            <td><i class="fa fa-user" style="color: grey;"> <?= $data['email']; ?></i> </td>
                                            <td class="<?php if($data['status'] == "OnProses") { echo "blinking"; } ?>" style="
                                                        <?php if($data['status'] == 'Selesai') {
                                                            echo 'color: grey;';
                                                        } elseif($data['status'] == 'Open'){
                                                            echo 'font-weight: bold;';
                                                        } ?>"> 
                                                        <?= $data['status']; ?> </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                <!-- AKUN PEMOHON -->
                                <?php elseif($user['ket'] == "Pemohon") : ?>
                                    <tbody>
                                        <?php 
                                            $user_name = $user['name'];
                                            $return = $this->db->query("SELECT a.id, a.prioritas, a.judul, DATE_FORMAT( a.tenggat_waktu, '%d %b %Y' ) AS tenggat_waktu,
                                                                                a.`status`, a.dept, a.dibuat_oleh, a.penanggung_jawab, b.email,
                                                                            IF ( a.tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) 
                                                                                AND DATE_SUB( NOW( ), INTERVAL '1' DAY ), 1, 0 ) AS Telat_row 
                                                                            FROM
                                                                                `tbl_tugas` a
                                                                                LEFT JOIN ( SELECT * FROM user b ) b ON b.id = a.penanggung_jawab 
                                                                            WHERE
                                                                                a.hapus = 0 AND a.dibuat_oleh = '$user_name'
                                                                            ORDER BY
                                                                                a.tenggat_waktu DESC")->result_array(); 
                                        ?>
                                        <?php foreach($return AS $data) : ?>
                                        <tr <?php if($data['status'] == "Jeda"){ echo 'bgcolor="#FFE4B5"'; } ?>>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tugas/view/<?= $data['id']; ?>">Tampilkan</a></li>
                                                        <li><a href="<?= base_url(); ?>tugas/view_edit/<?= $data['id']; ?>">Edit</a></li>
                                                        <li><a href="<?= base_url(); ?>tugas/tempatsampah/<?= $data['dibuat_oleh']; ?>/<?= $data['id']; ?>">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tugas/view/<?= $data['id']; ?>" style="<?php if($data['status'] == 'Open'){ 
                                                                                                        echo 'color: black;';
                                                                                                    } elseif($data['status'] == 'Selesai') {
                                                                                                        echo 'color: grey; text-decoration: line-through;';
                                                                                                    } ?>
                                                                                            <?php
                                                                                                if($data['Telat_row'] == 1){
                                                                                                    echo 'color: red;';
                                                                                                }
                                                                                            ?>">
                                                    <?= $data['judul']; ?> 
                                                    
                                                </a>
                                                    <?php
                                                        $id = $data['id']; 
                                                        $search = $this->db->query("SELECT count(*) AS summary FROM komentar WHERE id_tugas = '$id' ")->row(); 
                                                        if($search->summary){ // Komentar
                                                            echo ' <i class="fa fa-commenting" style="color: grey;" font-size: 13px;> '.$search->summary.'</i>'; 
                                                        } 
                                                    ?>
                                                <?php if($data['prioritas'] == 1){ echo ' <i class="fa fa-fire" style="color: red;"></i>'; } ?>
                                            </td>
                                            <td><?php if ($data['tenggat_waktu'] == "01 Jan 1970") {
                                                    echo '<a href="#"><span style="border-bottom: 1px black dashed;">Tidak ada</span></a>';
                                                } else {
                                                    echo $data['tenggat_waktu'];
                                                }
                                                ?> 
                                            </td>
                                            <td><?= $data['dept']; ?> </td>
                                            <td><i class="fa fa-user" style="color: grey;"> <?= $data['dibuat_oleh']; ?></i> </td>
                                            <td><i class="fa fa-user" style="color: grey;"> <?= $data['email']; ?></i> </td>
                                            <td class="<?php if($data['status'] == "OnProses") { echo "blinking"; } ?>" style="
                                                        <?php if($data['status'] == 'Selesai') {
                                                            echo 'color: grey;';
                                                        } elseif($data['status'] == 'Open'){
                                                            echo 'font-weight: bold;';
                                                        } ?>"> 
                                                        <?php  ?><?= $data['status']; ?> </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END HALAMAN INDEX -->
    </section>
</div>