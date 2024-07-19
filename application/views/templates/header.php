<!DOCTYPE html>
<html lang="en">
<head>
  <title>Skoring Silat</title>
  <!-- META SECTION -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" type="image/x-icon">
  <!-- END META SECTION -->
  <!-- CSS INCLUDE -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/sweetalert2/sweetalert2.min.css"> -->
  <!-- EOF CSS INCLUDE -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
</head>
<body>

<!-- APP WRAPPER -->
<div class="app">

<!-- START APP CONTAINER -->
<div class="app-container">
<!-- START SIDEBAR -->

<div class="app-sidebar app-navigation app-navigation-fixed scroll app-navigation-style-default app-navigation-open-hover dir-left" data-type="close-other">
  <div class="app-navigation-logo"><a href="<?php echo base_url() ?>">Skoring Silat</a></div>
  <nav>
    <ul>
      <li class="title">PERTANDINGAN</li>
      <li><a href="<?php echo base_url(); ?>pertandingan/jadwal_pertandingan_tanding" target="_blank"><span class="nav-icon-hexa text-bloody-100">Jpt</span> Jadwal Pertandingan Tanding</a></li>
      <li><a href="<?php echo base_url(); ?>pertandingan/login_tanding" target="_blank"><span class="nav-icon-hexa text-bloody-100">Lj</span> Login Juri</a></li>
    </ul>
    <ul>
      <li class="title">MAIN</li>
      <li><a href="<?php echo base_url(); ?>master/dashboard"><span class="nav-icon-hexa text-bloody-100">Ds</span> Dashboard</a></li>
      <li><a href="<?php echo base_url(); ?>master/kompetisi"><span class="nav-icon-hexa text-bloody-100">Km</span> Kompetisi</a></li>
      <li><a href="<?php echo base_url(); ?>master/kontingen"><span class="nav-icon-hexa text-bloody-100">Kn</span> Kontigen</a></li>
      <li><a href="<?php echo base_url(); ?>master/gelanggang"><span class="nav-icon-hexa text-bloody-100">Gl</span> Gelanggang</a></li>
      <li>
          <a href="#"><span class="nav-icon-hexa text-orange-100">Ps</span> Peserta</a>
          <ul>
          <li><a href="<?php echo base_url(); ?>master/peserta"><span class="nav-icon-hexa text-bloody-100">Ps</span> Peserta</a></li>
          <li><a href="<?php echo base_url(); ?>master/peserta_seni_tunggal"><span class="nav-icon-hexa text-bloody-100">Ps</span> Peserta Seni Tunggal</a></li>
          </ul>
      </li>
      <li>
          <a href="#"><span class="nav-icon-hexa text-orange-100">Pg</span> Pengundian</a>
          <ul>
              <li><a href="<?php echo base_url(); ?>master/pengundian_tanding"><span class="nav-icon-hexa">Jpt</span> Jadwal Partai Tanding</a></li>
              <li><a href="<?php echo base_url(); ?>master/pengundian_tgr"><span class="nav-icon-hexa">Tgr</span> Jadwal Partai TGR</a></li>
              <li><a href="<?php echo base_url(); ?>master/pengundian_seni_tunggal"><span class="nav-icon-hexa">Jst</span> Jadwal Seni Tunggal</a></li>
          </ul>
      </li>
      <li><a href="<?php echo base_url(); ?>master/bagan_tanding"><span class="nav-icon-hexa">Bt</span> Bagan Tanding</a></li>
      <li>
          <a href="#"><span class="nav-icon-hexa text-orange-100">Jp</span> Jadwal Partai</a>
          <ul>
              <li><a href="<?php echo base_url(); ?>master/jadwal_partai_tanding"><span class="nav-icon-hexa">Jpt</span> Jadwal Partai Tanding</a></li>
              <li><a href="<?php echo base_url(); ?>master/jadwal_partai_tgr"><span class="nav-icon-hexa">Tgr</span> Jadwal Partai TGR</a></li>
          </ul>
      </li>
      <li><a href="<?php echo base_url(); ?>master/jadwal_pertandingan"><span class="nav-icon-hexa">Jp</span> Jadwal Pertandingan</a></li>
      <li>
          <a href="#"><span class="nav-icon-hexa text-orange-100">Lp</span> Laporan</a>
          <ul>
              <li><a href="<?php echo base_url(); ?>laporan/laporan_pertandingan"><span class="nav-icon-hexa">Lp</span> Laporan Pertandingan</a></li>
              <li><a href="<?php echo base_url(); ?>laporan/laporan_perolehan_nilai"><span class="nav-icon-hexa">Lpn</span> Laporan Perolehan Nilai</a></li>
              <li><a href="<?php echo base_url(); ?>laporan/laporan_pesilat_terbaik"><span class="nav-icon-hexa">Lpt</span> Laporan Pesilat Terbaik</a></li>
          </ul>
      </li>
      <li>
          <a href="#"><span class="nav-icon-hexa text-orange-100">St</span> Setting</a>
          <ul>
              <li><a href="<?php echo base_url(); ?>setting/user"><span class="nav-icon-hexa">Ul</span> User Login</a></li>
          </ul>
      </li>
      <li>
    </ul>
  </nav>
</div>
<!-- END SIDEBAR -->

<!-- START APP CONTENT -->
<div class="app-content app-sidebar-left">
<!-- START APP HEADER -->
<div class="app-header">
  <ul class="app-header-buttons">
      <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
      <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
  </ul>
  <ul class="app-header-buttons pull-right">
    <li>
      <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls">
        <img src="<?php echo base_url(); ?>assets/img/user.png" alt="User">
        <div class="contact-container">
            <a href="#"><?php echo ucfirst($this->session->userdata('username')) ?></a>
            <span>Admin</span>
        </div>
        <div class="contact-controls">
          <div class="dropdown">
            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span class="icon-cog"></span></button>
            <ul class="dropdown-menu dropdown-left">
                <li><a href="<?php echo base_url('login/logout/')  ?>" onclick="return confirm('Apakah Anda Ingin Keluar dari Akun Anda?')"><span class="icon-exit"></span> Log Out</a></li>
            </ul>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
<!-- END APP HEADER  -->
