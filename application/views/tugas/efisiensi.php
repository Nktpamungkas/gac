<div class="content-wrapper">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="<?php if($title == "Tugas Saya"){ echo 'active'; } ?>">
                    <a href="<?= base_url(); ?>tugas">Semua 
                        <?php 
                            $telat = $this->db->query("SELECT Count( * ) AS Telat FROM `tbl_tugas` WHERE tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) AND DATE_SUB( NOW( ), INTERVAL '1' DAY ) AND hapus = 0 AND NOT `status` = 'selesai'")->row();
                            if ($telat->Telat) {
                                echo '<span class="badge bg-red" title="Tugas Terlambat">'.$telat->Telat.'</span>'; 
                            }                       
                        ?>
                    </a>
                </li>
                <li class="<?php if($title == "Efisiensi"){ echo 'active'; } ?>"><a href="<?= base_url(); ?>tugas/efisiensi">Efisiensi</a></li>
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
    <div class="content">
        <div class="col-lg-6 col-xs-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Department Data & Informatika</h3>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">Bintoro.dy@indotaichen.com </a>
                        </li>
                        <li>
                            <a href="#">Mamik.agung@indotaichen.com </a>
                        </li>
                        <li>
                            <a href="#">Usman.as@indotaichen.com </a>
                        </li>
                        <li>
                            <a href="#">Nilo.pamungkas@indotaichen.com </a>
                        </li>
                        <li>
                            <a href="#">Zaelani </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php 
                            $sedangberlangsung = $this->db->query("SELECT Count(*) as count FROM tbl_tugas WHERE `status` = 'Mulai'")->row(); 
                            echo $sedangberlangsung->count;
                        ?>
                    </h3>

                    <p>Total sedang berlangsung</p>
                </div>
                <div class="icon">

            </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php 
                            $selesai = $this->db->query("SELECT Count(*) as count FROM tbl_tugas WHERE `status` = 'Selesai'")->row(); 
                            echo $selesai->count;
                        ?>
                    </h3>

                    <p>Tugas selesai</p>
                </div>
                <div class="icon">
                </div>
                <a href="#" class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php 
                            $terlambat = $this->db->query("SELECT Count( * ) AS count FROM `tbl_tugas` WHERE tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) AND DATE_SUB( NOW( ), INTERVAL '1' DAY ) AND hapus = 0 AND `status` = 'Selesai'")->row(); 
                            echo $terlambat->count;
                        ?>
                    </h3>

                    <p>Tugas dengan kekurangan</p>
                </div>
                <div class="icon">
                </div>
                <a href="#" class="small-box-footer">
                    Detail <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>