<!DOCTYPE html>
<html lang="en">
<head>
<title>Skoring Silat</title>

<!-- META SECTION -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- END META SECTION -->
<!-- CSS INCLUDE -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
<!-- EOF CSS INCLUDE -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
</head>
<body>

<!-- APP WRAPPER -->
<div class="app">

<!-- START APP CONTAINER -->
<div class="app-container">

<div class="app-login-box">
    <div class="app-login-box-user"><img src="<?php echo base_url(); ?>assets/img/user/no-image.png" alt="John Doe"></div>
    <div class="app-login-box-title">
        <div class="title">Skoring Silat</div>
        <div class="subtitle">Login Admin</div>
    </div>
    <div class="app-login-box-container">
      <form action="<?php echo base_url(); ?>pertandingan/login_tanding/masuk" method="post">
          <div class="form-group">
              <input type="text" class="form-control" placeholder="Username" name="username">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="password">
          </div>
          <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <button class="btn btn-success btn-block">Masuk</button>
                </div>
            </div>
          </div>
      </form>
    </div>
    <div class="app-login-box-footer">
        &copy; Boooya 2016. All rights reserved.
    </div>
</div>

</div>
<!-- END APP CONTAINER -->

</div>
<!-- END APP WRAPPER -->
<!-- IMPORTANT SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js"></script>
<!-- END IMPORTANT SCRIPTS -->
<!-- THIS PAGE SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jvectormap/jquery-jvectormap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/rickshaw/rickshaw.min.js"></script>
<!-- END THIS PAGE SCRIPTS -->
<!-- APP SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app_plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app_demo.js"></script>
<!-- END APP SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app_demo_dashboard.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/canvasjs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/js-form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pagination.js"></script>
</body>
</html>
