<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Halaman Utama
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
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
                            $sedangberlangsung = $this->db->query("SELECT Count(*) as count FROM tbl_tugas WHERE `status` = 'OnProses'")->row(); 
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
                            $terlambat = $this->db->query("SELECT Count( * ) AS count FROM `tbl_tugas` WHERE tenggat_waktu BETWEEN DATE_SUB( NOW( ), INTERVAL '2' MONTH ) AND DATE_SUB( timer, INTERVAL '1' DAY ) AND hapus = 0 AND `status` = 'Selesai'")->row(); 
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
    </section>

  </div>