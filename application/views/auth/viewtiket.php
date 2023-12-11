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
        <a href="<?= base_url(); ?>"><b>Tiket</b> GAC</a>
    </div>
    
    <div class="login-box-body">
        <section class="content">
        <button type="button" class="btn btn-link btn-flat" title="Cek status tiket" data-toggle="collapse" data-target="#cek-status">
            <b>RIWAYAT</b>
        </button>
        <div id="cek-status" class="collapse">
            <div class="box">
                <form action="<?= base_url(); ?>" method="POST">
                    <div class="box box-warning">
                        <div class="box-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="400">Tanggal</th>
                                        <th width="200">Dibuat oleh</th>
                                        <th width="400">Perbarui Disposisi</th>
                                        <th width="200">Perbarui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $return = $this->db->query("SELECT * FROM riwayat WHERE id_tugas = '$tugas->id'")->result_array(); 
                                    ?>
                                    <?php foreach($return AS $data) : ?>
                                        <tr>
                                            <td><?= $data['tanggal']; ?></td>
                                            <td><?= $data['dibuat_oleh']; ?></td>
                                            <td><?= $data['perbarui_disposisi']; ?></td>
                                            <td><?= $data['perbarui']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="box">
            <form action="<?= base_url(); ?>tugas/edittiket" method="POST" enctype="multipart/form-data">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group col-sm-6">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 25px">#</th>
                                    <th style="width: 25px"></th>
                                </tr>
                                <tr>
                                    <td><b>Prioritas tinggi <i class="fa fa-fire" style="color: red;"></i></b></td>
                                    <td><<?php if($tugas->prioritas == 1){ echo 'span class="badge bg-red">Prioritas Tinggi</span>'; } else { echo 'span class="badge bg-green">Bukan Prioritas Tinggi</span>'; }?></td>
                                </tr>
                                <tr>
                                    <td><b>Nomor Tiket</td>
                                    <td><?= $tugas->id; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Departemen</td>
                                    <td><?= $tugas->dept; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Nama Pelapor</td>
                                    <td><?= $tugas->nama_pelapor; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Email</td>
                                    <td><?= $tugas->email; ?></td>
                                </tr>
                                <tr>
                                    <td><b><?= $tugas->kategori; ?></td>
                                    <td>
                                        <?php 
                                            $dataKategori   = $this->db->query("SELECT * FROM mesin WHERE id='$tugas->id_mesin'")->row();
                                            if($dataKategori){
                                                echo $dataKategori->no_mesin.' '.$dataKategori->kategori.' '.$dataKategori->merk.' '.$dataKategori->jenis;
                                            } else {
                                                echo $tugas->id_mesin;
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Lokasi</td>
                                    <td><?= $tugas->lokasi; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Permasalahan</td>
                                    <td><?= $tugas->permasalahan; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Foto</td>
                                    <td>
                                        <a href="" target="popup" onclick="window.open('<?= base_url(); ?>file/<?= $tugas->lampiran1; ?>','popup','width=100%'); return false;">
                                            <img src="<?= base_url(); ?>file/<?= $tugas->lampiran1; ?>" height="50px" weight="50px">
                                        </a>
                                        <a href="" target="popup" onclick="window.open('<?= base_url(); ?>file/<?= $tugas->lampiran2; ?>','popup','width=600px, height=600px'); return false;">
                                            <img src="<?= base_url(); ?>file/<?= $tugas->lampiran2; ?>" height="50px" weight="50px">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="hidden" name="id" value="<?= $tugas->id; ?>">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 25px">#</th>
                                    <th style="width: 25px"></th>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <td>
                                        <select class="form-control input-sm" style="width: 100%;" name="status" required>
                                            <option value="" disabled selected>Status</option>
                                            <option value="Progress" <?php if($tugas->status == "Progress"){ echo "SELECTED"; } ?>>Progress</option>
                                            <option value="Delay" <?php if($tugas->status == "Delay"){ echo "SELECTED"; } ?>>Delay</option>
                                            <option value="Close" <?php if($tugas->status == "Close"){ echo "SELECTED"; } ?>>Close</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Follow Up</b></td>
                                    <td><input type="date" class="form-control input-sm" name="tgl_follow_up" value="<?= $tugas->tgl_follow_up; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><b>Pelaksana</b></td>
                                    <td><input type="text" class="form-control input-sm" name="pelaksana" value="<?= $tugas->pelaksana; ?>" placeholder="Pelaksana" required></td>
                                </tr>
                                <?php

                                ?>
                                <tr>
                                    <td><b>Solusi</b></td>
                                    <td>
                                        <textarea id="editor1" name="solusi" rows="3" style="width: 100%;" required><?= $tugas->solusi; ?></textarea>
                                    </td>
                                    <script>
                                        $(function () {
                                            CKEDITOR.replace('editor1')
                                            $('.textarea').wysihtml5()
                                        })
                                    </script>
                                </tr>
                                <tr>
                                    <td><b>Foto</b><br></td>
                                    <td>
                                        <?php if($tugas->lampiran_selesai1 && $tugas->ukuran_file_selesai1 && $tugas->tipe_file_selesai1 && $tugas->lampiran_selesai2 && $tugas->ukuran_file_selesai2 && $tugas->tipe_file_selesai2) : ?>
                                            <a href="" target="popup" onclick="window.open('<?= base_url(); ?>file/<?= $tugas->lampiran_selesai1; ?>','popup','width=100%'); return false;">
                                                <img src="<?= base_url(); ?>file/<?= $tugas->lampiran_selesai1; ?>" height="50px" weight="50px">
                                            </a>
                                            <a href="" target="popup" onclick="window.open('<?= base_url(); ?>file/<?= $tugas->lampiran_selesai2; ?>','popup','width=600px, height=600px'); return false;">
                                                <img src="<?= base_url(); ?>file/<?= $tugas->lampiran_selesai2; ?>" height="50px" weight="50px">
                                            </a>
                                        <?php else : ?>
                                            <input type="file" name="lampiran1" ><br>
                                            <input type="file" name="lampiran2" >
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Close</b></td>
                                    <td><input type="date" class="form-control input-sm" name="tgl_close" value="<?= $tugas->tgl_close; ?>"></td>
                                </tr>
                                <?php if($tugas->kategori == "AC") : ?>
                                <tr>
                                    <td><b>Harga</b></td>
                                    <td><input type="number" class="form-control input-sm" name="harga" value="<?= $tugas->harga; ?>"></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div> 
                    </div>
                    <div class="box-footer">
                        <div class="pull-left">
                            <button type="submit" name="submit" class="btn bg-red btn-flat" style="font-size: 12px;">UPDATE TIKET</button>
                            <a href="<?= base_url(); ?>tugas/tiket" class="btn btn-link btn-flat" style="font-size: 12px;">BATAL</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </section>
    </div>
</div>

