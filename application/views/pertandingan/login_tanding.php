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
<!-- EOF CSS INCLUDE -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
</head>
<body>

<!-- APP WRAPPER -->
<div class="app">

<!-- START APP CONTAINER -->
<div class="app-container">

<div class="app-login-box">
    <div class="" style="display: flex; justify-content: center; margin-top: 2rem; margin-bottom: 12px;">
      <img src="<?php echo base_url(); ?>assets_pertandingan/image/tapak-suci.webp" alt="John Doe" style="width: 30%;">
    </div>
    <div class="app-login-box-title">
        <div class="title">SKORING SILAT</div>
        <div class="subtitle">Login Tanding</div>
    </div>
    <div class="app-login-box-container">
      <form action="<?php echo base_url(); ?>pertandingan/login_tanding/masuk" method="post">
          <div class="form-group">
              <select class="bs-select" data-live-search="true" name="id_kompetisi" id="kompetisi">
                <option value="Kosong">-- Kompetisi --</option>
                <?php foreach ($kompetisi as $k): ?>
                  <option value="<?php echo $k['id']; ?>"><?php echo $k['kompetisi']; ?></option>
                <?php endforeach; ?>
              </select>
          </div>
          <div class="form-group">
              <select class="bs-select" data-live-search="true" name="partai" id="partai">
                <option value="Kosong">-- Partai --</option>
              </select>
          </div>
          <div class="form-group">
              <select class="bs-select" data-live-search="true" name="gelanggang" id="gelanggang">
                <option value="Kosong">-- Gelanggang --</option>
              </select>
          </div>
          <div class="form-group">
              <select class="bs-select" data-live-search="true" name="juri" id="juri">
                <option value="Kosong">-- Wasit Juri --</option>
              </select>
          </div>
          <!-- <div class="form-group">
              <input type="password" class="form-control" name="password" value="123321">
          </div> -->
          <div class="form-group" style="margin-top:10px;">
            <div class="row">
                <div class="col-md-12 col-xs-6">
                    <button class="btn btn-success btn-block">Masuk</button>
                </div>
            </div>
          </div>
      </form>
    </div>
    <div class="app-login-box-footer">
        &copy; Luisoft 2023. All rights reserved.
    </div>
</div>

</div>
<!-- END APP CONTAINER -->

</div>
<!-- END APP WRAPPER -->
<script type="text/javascript">
$(document).ready(function() {
    res_data_partai_tanding()
    res_data_gelanggang_tanding()
    res_data_juri_tanding()
})

function res_data_partai_tanding(){
  $.ajax({
      url : '<?php echo base_url(); ?>pertandingan/login_tanding/res_data_partai_tanding',
      type : "POST",
      dataType : 	"json",
      async : false,
      success : function(res){
        let option = `<option value="Kosong">-- Partai --</option>`

        if(res) {
          let i = 0;
          for(const item of res) {
            option += `<option value="${item.no_partai}">${item.no_partai}</option>`
          }
        }

        $('#partai').html(option)
      }
    });
}

function res_data_gelanggang_tanding(){
  $.ajax({
      url : '<?php echo base_url(); ?>pertandingan/login_tanding/res_data_gelanggang_tanding',
      type : "POST",
      dataType : 	"json",
      async : false,
      success : function(res){
        let option = `<option value="Kosong">-- Gelanggang --</option>`

        if(res) {
          let i = 0;
          for(const item of res) {
            option += `<option value="${item.gelanggang}">${item.gelanggang}</option>`
          }
        }

        $('#gelanggang').html(option)
      }
    });
}

function res_data_juri_tanding(){
  $.ajax({
      url : '<?php echo base_url(); ?>pertandingan/login_tanding/res_data_juri_tanding',
      type : "POST",
      dataType : 	"json",
      async : false,
      success : function(res){
        let option = `<option value="Kosong">-- Wasit Juri --</option>`

        if(res) {
          let i = 0;
          for(const item of res) {
            option += `<option value="${item.nama_juri}">${item.nama_juri}</option>`
          }
        }

        $('#juri').html(option)
      }
    });
}

</script>
<!-- IMPORTANT SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/select2/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js"></script>
<!-- END IMPORTANT SCRIPTS -->
<!-- THIS PAGE SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap-select/bootstrap-select.js"></script>

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
