<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ryo Toko Online</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    <link rel="icon" href="<?= base_url('') ?>/assets/img/RDP.png" type="image/x-icon">

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--icon css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/themify.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/slick-theme.css">

    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/animate.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/style_user.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/owlcarousel.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/color3.css" media="screen" id="color">

    <!-- datepicker css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/bootstrap-datepicker/css/datepicker.css" media="screen" id="color">

    <!-- stepper -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/stepper/stepper.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@2.33.0/dist/full.css" rel="stylesheet" type="text/css" /> -->

    <!-- latest jquery-->
    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
    <!-- cookie js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <!-- Placeholder -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/placeholder.min.css">
    <!--  -->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/cleave/cleave.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-5LAs31De2I6Ojphp"></script>
    <!-- production -->
    <!-- <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="production" data-client-key="Mid-client-VEFe_63eZp2fpUrG"></script> -->
    <!-- <script type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js"></script> -->

    <!-- sandbox -->
    <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="sandbox" data-client-key="SB-Mid-client-5LAs31De2I6Ojphp"></script>
    <script type="text/javascript" src="https://api.sandbox.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js"></script>

    <!-- latest jquery-->
    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
    <!-- Pico JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/picomodal/3.0.0/picoModal.js"></script>

    <!-- cookie js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- stepper js-->
    <script src="<?= base_url('') ?>/assets/vendors/stepper/stepper.min.js"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
          width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #555;
        }
    </style>

</head>
<body>

<!-- loader start -->
<div class="loader-wrapper" style="z-index: 999 !important;">
    <div>
        <img src="<?= base_url('assets/img/loading.gif') ?>" alt="<?= base_url('assets/img/loading.gif') ?>" class="ryo__img-loading">
    </div>
</div>
<!-- loader end -->

<!--header start-->
<!--header start-->
<header>
    <div class="mobile-fix-option"></div>
    <div class="top-header bg-primary">
        <div class="custom-container">
            <div class="row">
                <div class="col-xl-5 col-md-7 col-sm-6">
                    <div class="top-header-left d-flex align-items-center">
                        <div class="app-link">
                            <h6>
                              Ikuti Kami
                            </h6>
                            <ul>
                              <li><a href="https://www.facebook.com/ryo.dgprint"><i class="fa fa-facebook" ></i></a></li>
                              <li><a href="https://www.instagram.com/ryo_percetakan_lumajang/"><i class="fa fa-instagram" ></i></a></li>
                              <li><a href="mailto:ryoadvertising@gmail.com"><i class="fa fa-envelope-o" ></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-5 col-sm-6">
                    <div class="top-header-right">
                        <div class="language-block">
                            <?php if (get_cookie('id_user') == null): ?>
                                <div class="language-dropdown mr-2">
                                    <div class="language-dropdown-click d-flex align-items-center">
                                        <span onclick="window.location.href = '<?= base_url('auth/login') ?>'" style="cursor: pointer">
                                            <span style="font-size: 14px !important;">Login</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="language-dropdown">
                                    <div class="language-dropdown-click d-flex align-items-center">
                                        <span onclick="window.location.href = '<?= base_url('auth/register') ?>'" style="cursor: pointer">
                                            <span style="font-size: 14px !important;">Register</span>
                                        </span>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php
                                $id_user = get_cookie('id_user');
                                $get_user = $this->db->get_where('user', ['id' => $id_user])->row_array();
                            ?>
                            <?php if ($id_user): ?>
                                <div class="language-dropdown" style="cursor: pointer;">
                                    <div class="language-dropdown-click d-flex align-items-center">
                                        <?php if($get_user['gambar'] == '') : ?>
                                            <img src="<?= base_url('assets/images/dashboard/boy-2.png') ?>" alt="<?= base_url('assets/images/dashboard/boy-2.png') ?>" class="rounded-circle mr-2" style="width: 20px; height: 20px; object-fit: fill; border-radius: 50%;" id="gambar-profile">
                                        <?php else : ?>
                                            <img src="<?= base_url('storage/user/'. $get_user['gambar']) ?>" alt="<?= base_url('storage/user/'. $get_user['gambar']) ?>" style="width: 20px; height: 20px; object-fit: fill; border-radius: 50%;" class="mr-2">
                                        <?php endif; ?>
                                        <span>
                                            <span style="font-size: 14px !important; font-weight: 300 !important;"><?= $get_user['username'] ?></span> <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <ul class="language-dropdown-open" style="font-size: 13px !important; width: auto !important;">
                                        <li><a href="<?= base_url('profile') ?>">Akun Anda</a></li>
                                        <li><a href="<?= base_url('profile#pesanan-content') ?>">Pesanan Anda</a></li>
                                        <li>
                                            <a href="#" onclick="logout_user()">Log Out</a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout-header4">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="contact-block">
                        <div class="sm-nav-block">
                            <span class="sm-nav-btn"><i class="fa fa-bars"></i></span>
                            <ul class="nav-slide">
                                <li>
                                    <div class="nav-sm-back">
                                        back <i class="fa fa-angle-right pl-2"></i>
                                    </div>
                                </li>
                                <?php $kategori_jasa = $this->db->get('admin_kategori_jasa')->result_array() ?>
                                <?php foreach ($kategori_jasa as $kj): ?>
                                    <li><a href="<?= base_url('shop?search_jasa=&kategori_jasa='. $kj['nama']) ?>"><?= $kj['nama'] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div class="desc-nav-block">
                            <i class="fa fa-volume-control-phone tell color-secondary" aria-hidden="true"></i>
                            <span class="contact-item">
                            Hubungi Kami
                            <span>081 359 395 123</span>
                        </span>
                        <div class="onhover-dropdown">
                            <?php if (get_cookie('id_user') != null): ?>
                            <a href="<?= base_url('profile') ?>" class="text-center">
                                <i class="icon-user mobile-user"></i><br>
                            </a>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="logo-block">
                        <a href="<?= base_url('home') ?>">
                            <img src="<?= base_url('assets/img/RDP.png') ?>" alt="<?= base_url('assets/img/RDP.png') ?>" class="img-fluid" style="height: 70px !important; object-fit: contain; object-position: center;">
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="icon-block">
                        <ul>
                            <li onclick="openAccount()" class="mobile-user onhover-dropdown"><a href="#"><i class="icon-user"></i></a>
                            </li>
                            <li class="mobile-search"><a href="#"><i class="icon-search"></i></a>
                                <div class="search-overlay">
                                    <div>
                                        <span class="close-mobile-search">×</span>
                                        <div class="overlay-content">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form>
                                                            <div class="form-group"><input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search a Product"></div>
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="mobile-wishlist">
                                <?php if (get_cookie('id_user') != null): ?>
                                <a href="<?= base_url('profile#wishlist') ?>"><i class="icon-heart"></i></a>
                                <?php endif; ?>
                            </li>
                            <li class="mobile-setting mobile-setting-hover" onclick="openSetting()">
                                <?php if (get_cookie('id_user') == null): ?>
                                <a href="<?= base_url('auth/login') ?>"><i class="icon-settings"></i></a>
                                <?php else : ?>
                                <a href="<?= base_url('profile') ?>"><i class="icon-settings"></i></a>
                                <?php endif; ?>
                            </li>
                            <li class="mobile-cart cart-hover-div" onclick="openCart()">
                                <a href="#"><i class="icon-shopping-cart color-secondary" onclick="openCart()"></i>
                                <span class="cart-item">cart</span>
                        <!-- </div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div> -->
                               </a>
                            </li>
                        </ul>
                        <span class="toggle-nav">
                            <i class="fa fa-bars"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="category-header-4 bg-primary">
        <div class="custom-container">
            <div class="row">
                <div class="col">
                    <div class="navbar-menu">
                        <div class="category-left">
                            <div class=" nav-block">
                                <div class="nav-left" style="z-index: 50 !important;">
                                    <nav class="navbar bg-secondary" data-toggle="collapse" data-target="#navbarToggleExternalContent" style="cursor: pointer !important;">
                                        <button class="navbar-toggler" type="button">
                                            <span class="navbar-icon"><i class="fa fa-arrow-down"></i></span>
                                        </button>
                                        <h5 class="mb-0 text-white title-font">Shop by category</h5>
                                    </nav>
                                    <div class="collapse nav-desk" id="navbarToggleExternalContent">
                                        <ul class="nav-cat title-font">
                                            <?php $kategori_jasa = $this->db->get('admin_kategori_jasa')->result_array() ?>
                                            <?php foreach ($kategori_jasa as $kj): ?>
                                                <li><a href="<?= base_url('shop?search_jasa=&kategori_jasa='. urlencode($kj['nama'])) ?>"><?= $kj['nama'] ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-block">
                                <nav id="main-nav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                                        </li>
                                        <!--HOME-->
                                        <li>
                                            <a href="<?= base_url('home') ?>" class="light-menu-item">Home</a>
                                        </li>

                                        <li>
                                            <a href="<?= base_url('shop/all') ?>" class="light-menu-item">Shop</a>
                                        </li>

                                        <li>
                                            <a href="<?= base_url('faq') ?>" class="light-menu-item">Faq</a>
                                        </li>
                                        <!--HOME-END-->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="category-right">
                            <div class="input-block">
                                <form class="big-deal-form" action="<?= base_url('shop') ?>" method="GET">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="search"><i class="fa fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Cari Jasa..." onkeyup="submit_form_search_jasa_enter()" name="search_jasa">
                                        <div class="input-group-prepend">
                                            <select name="kategori_jasa" onchange="submit_form_search_jasa_change()">
                                                <option value="semua">Semua</option>
                                                <?php foreach ($kategori_jasa as $kj): ?>
                                                    <option value="<?= $kj['nama'] ?>"><?= $kj['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="sm-nav-block">
                                <span class="sm-nav-btn"><i class="fa fa-bars"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header end-->
<!--header end-->

<script>
    $(document).ready(function() {
        setTimeOut()
    })
    function submit_form_search_jasa_enter(event) {
        if(event.keyCode == 13) {
          $(`#form-search-jasa`).submit();
        }
    }

    function submit_form_search_jasa_mobile_enter(event) {
        if(event.keyCode == 13) {
          $(`#form-search-jasa-mobile`).submit();
        }
    }

    function submit_form_search_jasa_change() {
        $(`#form-search-jasa`).submit();
    }

    function logout_user(e) {
        // e.preventDefault();
        swal({
          title: "Apakah Anda Yakin?",
          text: "Ingin Logout Dari Akun Anda?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willLogout) => {
          if (willLogout) {
            window.location.href = '<?= base_url('auth/logout') ?>';
          } else {
            // swal("Jasa Batal Dihapus");
          }
        });
    }
</script>
