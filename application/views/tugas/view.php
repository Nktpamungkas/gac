<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    function Function_pengingat() {
        var Pengingat = document.getElementById("pengingat").value;
        window.open("<?= base_url(); ?>tugas/pengingat/<?= $tugas->id; ?>/" + Pengingat, "_top");
    }
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $tugas->judul; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tugas #<?= $tugas->id; ?> - <?php if($tugas->status == "diteruskan ke programmer"){ echo "ditunda"; } else { echo $tugas->status; } ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <?= $tugas->deskripsi; ?>
                        </div>

                        <hr style="border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);">

                        <div class="form-group">
                            <u><b>DAFTAR TUGAS</b></u>
                        </div>

                        <div class="form-group">
                            <?php $this->db->order_by('id', 'asc'); $select_daftarChecklist = $this->db->get_where('daftar_checklist', array('id_tugas' => $tugas->id))->result_array(); ?>
                            <?php foreach($select_daftarChecklist AS $data_checklist) : ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" onclick="myFunction<?= $data_checklist['id']; ?>()" value="<?= $data_checklist['id']; ?>" id="id<?= $data_checklist['id']; ?>" <?php if($data_checklist['check'] == 1){ echo "checked"; } ?>><?= $data_checklist['daftar_checklist']; ?>
                                    
                                    <script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
                                    <script type="text/javascript">
                                        function myFunction<?= $data_checklist['id']; ?>() {
                                            var id<?= $data_checklist['id']; ?> = document.getElementById("id<?= $data_checklist['id']; ?>").value;
                                            window.open("<?= base_url(); ?>tugas/daftarCeklist_checked/<?= $tugas->dibuat_oleh ?>/" + id<?= $data_checklist['id']; ?> + "/<?= $tugas->id; ?>", "_top");
                                        }
                                    </script>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>

                    </div>

                    <div class="box">
                        <div class="box-body">
                            <div class="box-header with-border">
                                <h4 class="box-title">Lampiran</h4>
                            </div>
                            <div class="form-group">
                                <?php if($tugas->lampiran) : ?>
                                    <label>File : </label> <a href="<?= base_url(); ?>tugas/download/<?= $tugas->id; ?>" title="Download Now" style="font-size: 14px; font-family: microsoft sans serif;"><?= $tugas->lampiran; ?></a> 
                                <?php else : ?>
                                    <label><i>tidak ada lampiran dibuat</i></label> 
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($user['ket'] == "Pemohon") : ?>
                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="<?= base_url(); ?>tugas" class="btn btn-success btn-flat">KEMBALI</a>
                            </div>
                        </div>
                        <hr style="border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);">

                    <?php else : ?>
                        <div class="box-footer">
                            <div class="pull-left">
                                <?php if($tugas->status == "Selesai") : ?>
                                <?php else : ?>
                                    <!-- MULAI DAN JEDA -->
                                    <?php if($tugas->status == "OnProses") : ?>
                                        <a href="<?= base_url(); ?>tugas/set_timerTugas/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>/Jeda" class="btn bg-green btn-flat">JEDA</a>
                                    <?php else : ?>
                                        <a href="<?= base_url(); ?>tugas/set_timerTugas/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>/OnProses" class="btn bg-green btn-flat">MULAI</a>
                                    <?php endif; ?>

                                    <!-- SELESAIKAN -->
                                    <a href="<?= base_url(); ?>tugas/selesaikan/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>/Selesai" class="btn bg-green btn-flat">SELESAIKAN</a>
                                <?php endif; ?>

                                <div class="btn-group">
                                    <button type="button" class="btn bg-white btn-default">SELENGKAPNYA...</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <?php if($tugas->status == "Selesai") : ?>
                                                <a href="<?= base_url(); ?>tugas/lanjut/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>/Jeda"><i class="fa fa-play" style="color: green;"></i> Lanjut</a>
                                            <?php endif; ?>
                                        </li>
                                        <li><a href="<?= base_url(); ?>tugas/tempatsampah/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>"><i class="fa fa-times" style="color: red;"></i> Hapus</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= base_url(); ?>tugas/view_edit/<?= $tugas->id; ?>"><i class="fa fa-edit" style="color: green;"></i> Edit</a></li>
                                    </ul>
                                </div>
                                
                                <a href="<?= base_url(); ?>tugas" class="btn btn-link btn-flat">BATAL</a>
                            </div>
                        </div>
                        
                        <hr style="border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);">

                    <?php endif; ?>

                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-left">
                        <li class="active"><a href="#komentar" data-toggle="tab">Komentar &nbsp;<span class="label label-default pull-right">
                            <?php 
                                $jumlah_komentar = $this->db->query("SELECT COUNT(*) AS COUNT FROM komentar WHERE id_tugas='$tugas->id'")->row(); 
                                echo $jumlah_komentar->COUNT;
                            ?>
                        </span></a></li>
                        <li><a href="#riwayat" data-toggle="tab">Riwayat &nbsp;<span class="label label-default pull-right">
                            <?php 
                                $jumlah_riwayat = $this->db->query("SELECT COUNT(*) AS COUNT FROM riwayat WHERE id_tugas='$tugas->id'")->row(); 
                                echo $jumlah_riwayat->COUNT;
                            ?>
                        </span></a></li>
                        <li><a href="#waktuterpakai" data-toggle="tab">Waktu Terpakai &nbsp;<span class="label label-default pull-right"> 0 </span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="komentar">
                            <br><br>
                            <?php $this->db->order_by('id', 'asc'); $select_komentar = $this->db->get_where('komentar', array('id_tugas' => $tugas->id))->result_array(); ?>
                            <?php foreach($select_komentar AS $data_komentar) : ?>
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= base_url(); ?>dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">
                                                <?= $data_komentar['nama']; ?>
                                            </a>
                                        </span>
                                    <span class="description"><?= date("d F Y, H:i:s",strtotime($data_komentar['time'])); ?></span>
                                </div>
                                <p>
                                    <?= $data_komentar['comment']; ?>
                                </p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="<?= base_url(); ?>tugas/hapuskomentar/<?= $tugas->dibuat_oleh; ?>/<?= $data_komentar['id'] ?>/<?= $tugas->id; ?>" style="color: red;" class="link-black text-sm"><i class="fa fa-trash margin-r-5" ></i> Hapus komentar</a>
                                    </li>
                                </ul>
                            </div>
                            <?php endforeach; ?>
                            <b>Tambahkan komentar:</b>
                            <p>
                            <?php $programmer = $this->db->get_where('user', array('id' => $tugas->penanggung_jawab))->row(); ?>
                                <form action="<?= base_url(); ?>tugas/tambahkomentar/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>/<?= $user['ket']; ?>/<?php if ($user['ket'] == "Programmer") { echo $programmer->name; } elseif ($user['ket'] == "Pemohon") { echo $tugas->dibuat_oleh; } ?>" method="POST">
                                    <textarea class="form-control input-sm" name="komentar" rows="1" placeholder="Tulis komentar..." data-toggle="collapse" data-target="#Komentar"></textarea>
                                    <br>
                                    <div id="Komentar" class="collapse">
                                        <button type="submit" name="submit" class="btn btn-info">Kirim</button>
                                        <button type="button" name="submit" data-toggle="collapse" data-target="#Komentar" class="btn btn-link">Batal</button>
                                    </div>
                                    
                                </form>
                            </p>
                        </div>
                        <div class="tab-pane" id="riwayat">
                            <table class="table table-hover">
                                <tr>
                                    <th width="150">Tanggal</th>
                                    <th width="100">Dibuat Oleh</th>
                                    <th width="150">Perbarui Disposisi</th>
                                    <th width="">Perbarui</th>
                                </tr>
                                <?php $this->db->order_by('tanggal', 'desc'); $select_riwayat = $this->db->get_where('riwayat', array('id_tugas' => $tugas->id))->result_array(); ?>
                                <?php foreach($select_riwayat AS $data_riwayat) : ?>
                                <tr>
                                    <td><?= $data_riwayat['tanggal']; ?></td>
                                    <td><a href="#"><?= $data_riwayat['dibuat_oleh']; ?></a></td>
                                    <td><?= $data_riwayat['perbarui_disposisi']; ?></td>
                                    <td><?= $data_riwayat['perbarui']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="waktuterpakai">
                        <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box box-default">
                    
                    <div class="box-header with-border" style="background-color: #87CEEB">
                        <span class="box-title" style="font-size: 14px; font-weight: normal; color: white; font-family: microsoft sans serif;">
                            <?php if($tugas->status == "OnProses") : ?> 
                                <b>Sedang Berlangsung</b>
                            <?php elseif($tugas->status == "Jeda") : ?>
                                <b>Ditunda</b>
                            <?php endif; ?>
                            sejak <?= date("d M Y, H:i:s",strtotime($tugas->timer)); ?>
                        </span>
                    </div>
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                <dt>Tenggat Waktu: </dt>
                                <dd>
                                    <?php if ($tugas->tenggat_waktu == 1970-01-01) : ?>
                                        <?= date("d F Y",strtotime($tugas->tenggat_waktu)); ?>
                                    <?php else : ?>
                                        <a href="#">
                                            <span style="border-bottom: 1px black dashed;">
                                                Tidak ada
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </dd>
                                <br>
                                <dt>Pengingat:</dt>
                                <dd>
                                    <?php if ($user['ket'] == "DIT") : ?>
                                        <?php if($tugas->pengingat == "0000-00-00") : ?>
                                            <span class="fa fa-bell">
                                                <label style="border-bottom: 1px black dashed;" id=""> 
                                                Ingatkan
                                            </span>
                                        <?php else : ?>
                                            <span class="fa fa-bell">
                                                <label style="border-bottom: 1px black dashed;" id=""><?= date("d M Y",strtotime($tugas->pengingat)); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php elseif($user['ket'] == "Programmer") : ?>
                                        <?php if($tugas->pengingat == "0000-00-00") : ?>
                                            <span class="fa fa-bell">
                                                <label style="border-bottom: 1px black dashed;" id=""> 
                                                Ingatkan
                                            </span>
                                        <?php else : ?>
                                            <span class="fa fa-bell">
                                                <label style="border-bottom: 1px black dashed;" id=""><?= date("d M Y",strtotime($tugas->pengingat)); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php elseif($user['ket'] == "Pemohon") : ?>
                                        <?php if($tugas->pengingat == "0000-00-00") : ?>
                                            <span class="fa fa-bell">
                                                <label style="border-bottom: 1px black dashed;" id="pengingat_datepicker"> 
                                                Ingatkan
                                            </span>
                                        <?php else : ?>
                                            <span class="fa fa-bell">
                                                <label style="border-bottom: 1px black dashed;" id="pengingat_datepicker"><?= date("d M Y",strtotime($tugas->pengingat)); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <input style="opacity: 0; width: 0" id="pengingat" onchange="Function_pengingat()">
                                </dd>
                                <br>
                                <dt>Dibuat pada:</dt>
                                <dd><?= date("d M Y, H:i:s",strtotime($tugas->dibuat_pada)); ?></dd>

                                <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));">

                                <dt>Dibuat oleh:</dt>
                                <dd>
                                    <a href="#">
                                        <span style="border-bottom: 1px black dashed;"><?= $tugas->dibuat_oleh; ?></span>
                                    </a>
                                </dd>
                                
                                <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));">

                                <dt>Penanggung jawab:</dt>
                                <dd>
                                    <a href="#">
                                        <span style="border-bottom: 1px black dashed; font-size: 13px;">
                                            <?= $programmer->name; ?>
                                        </span>
                                    </a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>