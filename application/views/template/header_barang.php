<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="<?= base_url(); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="<?= base_url(); ?>index2.html" class="logo">
                <span class="logo-mini"><b>GA</b>C</span>
                <span class="logo-lg"><b>GA</b>C</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Admin</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">DAFTAR MENU</li>
                    <li <?php if($title == "Daftar Limbah Padat") { echo 'class="active"'; } ?>>
                        <a href="<?= base_url(); ?>tugas/index_limbahpadat">
                            <i class="fa fa-database"></i> <span>Daftar Limbah Padat </span>
                            <span class="pull-right-container">
                                <!-- <small class="label pull-right bg-green">new</small> -->
                            </span>
                        </a>
                    </li>
                    <li <?php if($title == "Transaksi") { echo 'class="active"'; } ?>>
                        <a href="<?= base_url(); ?>tugas/transaksi_limbahpadat">
                            <i class="fa fa-exchange"></i> <span>Transaksi </span>
                            <span class="pull-right-container">
                                <!-- <small class="label pull-right bg-green">new</small> -->
                            </span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>