<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Pemberitahuan
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <ul class="timeline">
                    <li class="time-label">
                        <span class="bg-red">
                            <i>Pemberitahuan terbaru</i>
                        </span>
                    </li>
                    <?php 
                        if ($user['ket'] == "DIT") {
                            $array_notifikasi = $this->db->query("SELECT a.id, a.tanggal, b.judul, b.deskripsi, b.timer, b.dept, a.status, a.id_tugas, a.komentar, a.id_komentar
                                                                    FROM notifikasi a 
                                                                    LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas
                                                                    WHERE a.hapus = 0 
                                                                    ORDER BY a.id DESC")->result_array(); 
                        } elseif($user['ket'] == "Programmer"){
                            $value = $user['id'];
                            $array_notifikasi = $this->db->query("SELECT a.id, a.tanggal, b.judul, b.deskripsi, b.timer, b.dept, a.status, a.id_tugas, a.komentar, a.id_komentar
                                                                FROM notifikasi a 
                                                                LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas
                                                                WHERE a.hapus = 0 AND b.penanggung_jawab = '$value' AND a.ket = 'Pemohon'
                                                                ORDER BY a.id DESC")->result_array(); 
                        } elseif($user['ket'] == "Pemohon"){
                            $value = $user['dept'];
                            $array_notifikasi = $this->db->query("SELECT a.id, a.tanggal, b.judul, b.deskripsi, b.timer, b.dept, a.status, a.id_tugas, a.komentar, a.id_komentar
                                                                FROM notifikasi a 
                                                                LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas
                                                                WHERE a.hapus = 0 AND b.dibuat_oleh = '$value' AND a.ket = 'Programmer'
                                                                ORDER BY a.id DESC")->result_array(); 
                        }
                    ?>
                    <?php foreach($array_notifikasi AS $data_notifikasi) : ?>
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item" <?php if($data_notifikasi['status'] == 0) : ?> style="background-color: #FAFAD2;" <?php endif; ?>>
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("H:i",strtotime($data_notifikasi['timer'])); ?></span>
                            
                            <h3 class="timeline-header">
                                <a href="<?= base_url(); ?>tugas/show_notifikasi/<?= $data_notifikasi['id']; ?>"><?= $data_notifikasi['dept']; ?></a>. 
                                <?php if($data_notifikasi['komentar'] == "Komentar") : ?>
                                    <i>mengirimi kamu pesan</i>
                                <?php endif; ?>
                            </h3>

                            <div class="timeline-body">
                            <?php if($data_notifikasi['komentar'] == "Komentar") : ?>
                                <?php $comment = $this->db->get_where('komentar', array('id' => $data_notifikasi['id_komentar']))->row(); ?>
                                "<?php echo substr($comment->comment, 0, 50) ?>..."
                            <?php else : ?>
                                <?= $data_notifikasi['deskripsi']; ?>
                            <?php endif; ?>
                            </div>
                            <div class="timeline-footer">
                                <a href="<?= base_url(); ?>tugas/view_notif/<?= $data_notifikasi['id_tugas']; ?>/<?= $data_notifikasi['id']; ?>" class="btn btn-primary btn-xs">Read more</a>
                                <a href="<?= base_url(); ?>tugas/hapus_notifkasi/<?= $data_notifikasi['id']; ?>" class="btn btn-danger btn-xs">Delete</a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
        </div>
    </section>  
</div>