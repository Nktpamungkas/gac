<?php if ($user['name']) : ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> | PT. Indo Taichen Textile Industri</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link href="<?= base_url(); ?>dist/img/logoitti.png" rel="icon">
    
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/select2/dist/css/select2.min.css">  

    <script src="<?= base_url(); ?>bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?= base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/morris.js/morris.css">
    
    <style>
        .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
        }

        .example-modal .modal {
        background: transparent !important;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini"><b>M</b>J</span>
        <span class="logo-lg"><b>My</b>Job</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                <?php 
                    if ($user['ket'] == "DIT") {
                        $result_notif = $this->db->query("SELECT count( * ) AS jumlah_notif 
                                                            FROM notifikasi a 
                                                            LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas
                                                            WHERE a.hapus = 0 AND a.`status` = 0 
                                                            ORDER BY a.id DESC")->row(); 
                    } elseif($user['ket'] == "Programmer"){
                        $value = $user['id'];
                        $result_notif = $this->db->query("SELECT count( * ) AS jumlah_notif 
                                                            FROM notifikasi a 
                                                            LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas
                                                            WHERE a.hapus = 0 AND a.`status` = 0 AND b.penanggung_jawab = '$value' AND a.ket = 'Pemohon'
                                                            ORDER BY a.id DESC")->row(); 
                    } elseif($user['ket'] == "Pemohon"){
                        $value = $user['dept'];
                        $result_notif = $this->db->query("SELECT count( * ) AS jumlah_notif 
                                                            FROM notifikasi a 
                                                            LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas
                                                            WHERE a.hapus = 0 AND a.`status` = 0 AND b.dibuat_oleh = '$value' AND a.ket = 'Programmer'
                                                            ORDER BY a.id DESC")->row(); 
                    }
                ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <?php if($result_notif->jumlah_notif) : ?>
                            <span class="label label-warning"><?= $result_notif->jumlah_notif; ?></span>
                        <?php else : ?>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                        <?php if($result_notif->jumlah_notif) : ?>
                            Kamu mempunyai <?= $result_notif->jumlah_notif; ?> notifikasi
                        <?php else : ?>
                            <i>Kamu tidak memiliki notifikasi</i>                            
                        <?php endif; ?>
                        </li>
                        <li>
                            <?php 
                                if ($user['ket'] == "DIT") {
                                    $array_notif = $this->db->query("SELECT a.id, a.tanggal, a.pesan, b.judul, b.timer, b.dept, a.id_tugas, a.komentar, a.id_komentar,
                                                                            b.pengingat, a.id_daftarChecklist
                                                                        FROM notifikasi a 
                                                                        LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas WHERE a.`status` = 0 AND a.hapus = 0 ORDER BY id DESC")->result_array(); 
                                } elseif($user['ket'] == "Programmer"){
                                    $value = $user['id'];
                                    $array_notif = $this->db->query("SELECT a.id, a.tanggal, a.pesan, b.judul, b.timer, b.dept, a.id_tugas, a.komentar, a.id_komentar,                                            b.pengingat, a.id_daftarChecklist
                                                                        FROM notifikasi a 
                                                                        LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas WHERE a.`status` = 0 AND a.hapus = 0 AND b.penanggung_jawab = '$value' AND a.ket = 'Pemohon' ORDER BY id DESC")->result_array(); 
                                } elseif($user['ket'] == "Pemohon"){
                                    $value = $user['dept'];
                                    $array_notif = $this->db->query("SELECT a.id, a.tanggal, a.pesan, b.judul, b.timer, b.dept, a.id_tugas, a.komentar, a.id_komentar,                                            b.pengingat, a.id_daftarChecklist
                                                                        FROM notifikasi a 
                                                                        LEFT JOIN ( SELECT * FROM tbl_tugas b ) b ON b.id = a.id_tugas WHERE a.`status` = 0 AND a.hapus = 0 AND b.dibuat_oleh = '$value' AND a.ket = 'Programmer' ORDER BY id DESC")->result_array(); 
                                }
                            ?>
                            <?php foreach($array_notif AS $data_notif) : ?>
                            <ul class="menu">
                                <li>
                                    <a href="<?= base_url(); ?>tugas/view_notif/<?= $data_notif['id_tugas']; ?>/<?= $data_notif['id']; ?>">
                                    <div class="pull-left">
                                        <img src="<?= base_url(); ?>dist/img/Users-icon.png" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        <?= $data_notif['pesan']; ?>
                                        <h6><small><i class="fa fa-clock-o"></i> <?= $data_notif['timer']; ?> </small></h6>
                                    </h4>
                                    <?php if($data_notif['komentar'] == "Komentar") : ?>
                                        <?php $comment = $this->db->get_where('komentar', array('id' => $data_notif['id_komentar']))->row(); ?>
                                        <p>"<?php echo substr($comment->comment, 0, 35) ?>"</p>
                                    <?php elseif($data_notif['komentar'] == "Daftar Checklist") : ?>
                                        <?php $daftar_checklist = $this->db->get_where('daftar_checklist', array('id' => $data_notif['id_daftarChecklist']))->row(); ?>
                                        <p>"<?php echo substr($daftar_checklist->daftar_checklist, 0, 35) ?>"</p>
                                    <?php else : ?>
                                        <?php if($data_notif['pesan'] == "Pengingat untuk anda.") : ?>
                                            <p>"Diingatkan pada : <?= $data_notif['pengingat']; ?>..."</p>
                                        <?php else : ?>
                                            <p>"<?php echo substr($data_notif['judul'], 0, 35) ?>..."</p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                            <?php endforeach; ?>
                        </li>
                        <li class="footer"><a href="<?= base_url(); ?>tugas/show_notifikasi">Lihat semua notifikasi</a></li>
                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php 
                                if ($user['image'] = "profile1.png") {
                                    echo base_url()."dist/img/profile1.png";
                                } elseif ($user['image'] = "profile2.png") {
                                    echo base_url()."dist/img/profile2.png";
                                } else {
                                    echo base_url()."dist/img/logoitti.png";
                                }
                            ?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?= $user['name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?php 
                                    if ($user['image'] = "profile1.png") {
                                        echo base_url()."dist/img/profile1.png";
                                    } elseif ($user['image'] = "profile2.png") {
                                        echo base_url()."dist/img/profile2.png";
                                    } else {
                                        echo base_url()."dist/img/logoitti.png";
                                    }
                                ?>" class="img-circle" alt="User Image">

                        <p>
                        <?= $user['name']; ?> - <?php if ($user['role_id'] == 1) {
                                                        echo "Administrator";
                                                    } elseif ($user['role_id'] == 2) {
                                                        echo "Manager";
                                                    } elseif ($user['role_id'] == 3) {
                                                        echo "Ast. Manager";
                                                    } elseif ($user['role_id'] == 4) {
                                                        echo "Staf";
                                                    } elseif ($user['role_id'] == 5) {
                                                        echo "Staf Master";
                                                    } else {
                                                        echo "Admin Department";
                                                    } ?>
                        <small><?= $user['email']; ?></small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                        <a href="<?= base_url('auth/out/').$user['name']; ?>" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php 
                            if ($user['image'] = "profile1.png") {
                                echo base_url()."dist/img/profile1.png";
                            } elseif ($user['image'] = "profile2.png") {
                                echo base_url()."dist/img/profile2.png";
                            } else {
                                echo base_url()."dist/img/logoitti.png";
                            }
                        ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $user['name']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU (<i><?= $title; ?></i>)</li>
            <li class="<?php if($title == "Halaman Utama"){ echo "active"; } ?>">
                <a href="<?= base_url(); ?>home">
                    <i class="fa fa-dashboard"></i><span>Halaman Utama</span>
                </a>
            </li>
            <li class="<?php if($title == "Permintaan Aplikasi"){ echo "active"; } ?>">
                <a href="<?= base_url(); ?>tugas">
                    <i class="fa fa-openid"></i><span>Tugas</span>
                </a>
            </li>
            </li>
            <!-- <li class="<?php if($title == "Kalender"){ echo "active"; } ?>">
                <a href="<?= base_url(); ?>tugas/kalender">
                    <i class="fa fa-calendar-minus-o"></i><span>Kalender</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Pengaturan</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li><a href="<?= base_url(); ?>notifikasi"><i class="fa fa-circle-o"></i> Notifkasi</a></li>
                </ul>
            </li> -->
        </ul>
    </section>
</aside>

<?php else : ?>
<?php redirect('auth/out'); ?>
<?php endif; ?>