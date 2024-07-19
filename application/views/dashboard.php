
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Dashboard</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
        </div>
        <div class="panel-body">
          <div class="form-group row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label">Kompetisi</label>
                    <?php $kompetisi = $this->db->get('ms_kompetisi')->result_array(); ?>
                    <select class="form-control" name="id_kompetisi" id="select-kompetisi" onchange="get_data();">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>" <?php echo $k['status'] == 1 ? 'selected' : '' ?>><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
          </div>
          <div class="row">

            <div class="col-sm-6">
              <div class="app-widget-tile app-widget-tile-primary">
                  <div class="row">
                      <div class="col-md-5">
                          <div class="icon icon-lg">
                              <span class="icon-user"></span>
                          </div>
                      </div>
                      <div class="col-md-7">
                          <div class="line">
                              <div class="title">Total Peserta</div>
                              <div class="subtitle pull-right text-success"><span class="fa fa-arrow-up"></span></div>
                          </div>
                          <div class="intval text-left total-peserta">0</div>
                          <div class="line">
                              <!-- <div class="subtitle">Total Peserta</div> -->
                          </div>

                      </div>
                  </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="app-widget-tile app-widget-tile-primary">
                  <div class="row">
                      <div class="col-md-5">
                          <div class="icon icon-lg">
                              <span class="icon-flag"></span>
                          </div>
                      </div>
                      <div class="col-md-7">
                          <div class="line">
                              <div class="title">Total Kontingen</div>
                              <div class="subtitle pull-right text-success"><span class="fa fa-arrow-up"></span></div>
                          </div>
                          <div class="intval text-left total-kontingen">0</div>
                          <div class="line">
                              <!-- <div class="subtitle">Total Kontingen </div> -->
                          </div>

                      </div>
                  </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->

<script>
    $(document).ready(function() {
        get_data()
    })

    function get_data() {
        let search = $(`#search`).val()
        let kompetisi = $(`#select-kompetisi`).val()
        let count_col = $(`#table-data thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/dashboard/get_data') ?>',
            method: 'GET',
            data: {kompetisi},
            dataType: 'json',
            success: function (res) {
                $(`.total-peserta`).html(res.total_peserta)
                $(`.total-kontingen`).html(res.total_kontingen)
            }
        })
    }
</script>
