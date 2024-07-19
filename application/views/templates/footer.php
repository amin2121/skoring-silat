</div>
<!-- END APP CONTENT -->
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
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/sweetalert2/sweetalert2.js"></script> -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/canvasjs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/js-form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pagination.js"></script>

<script type="text/javascript">
function show_loading_table(param, count_col) {
  let loading = `<tr id="loading-table">
        <td class="text-center" colspan="${count_col}">
          <img src="<?= base_url('assets/loading-table.gif') ?>" alt="<?= base_url('assets/loading-table.gif') ?>" width="70">
        </td>
  </tr>`

  $(`${param}`).html(loading)
}
</script>

</body>
</html>
