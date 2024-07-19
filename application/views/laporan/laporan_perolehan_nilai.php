
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Laporan Perolehan Nilai</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Laporan Perolehan Nilai</h3>
        </div>
        <div class="panel-body">
          <form style="margin-bottom: 2rem;" action="<?php echo base_url('laporan/laporan_perolehan_nilai/cetak/') ?>" method="post" target="_blank">
            <div class="row" style="display: flex;">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Kompetisi</label>
                  <select class="form-control" name="kompetisi" onchange="kontingen_result()" id="id-kompetisi">
                    <option value="">-- Pilih Kompetisi --</option>
                    <?php foreach ($kompetisi as $key => $k): ?>
                      <option value="<?php echo $k['id'] ?>"><?php echo $k['kompetisi'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Kontingen</label>
                  <select class="form-control" name="kontingen" id="kontingen">
                    <option value="semua">Semua</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Gelanggang</label>
                  <select class="form-control" name="gelanggang" id="gelanggang">
                    <option value="semua">Semua</option>
                    <?php foreach ($gelanggang as $key => $glg): ?>
                      <option value="<?php echo $glg['gelanggang'] ?>"><?php echo $glg['gelanggang'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-3" style="display: flex !important; align-items: flex-end !important; gap: 6px;">
                <button type="submit" name="button" class="btn btn-primary"><i class="fa fa-print" style="margin-right: 6px;"></i> Cetak</button>
                <button type="button" name="button" class="btn btn-info" onclick="export_excel()"><i class="fa fa-file-excel-o" style="margin-right: 6px;"></i> Export Excel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->

<script type="text/javascript">
  function kontingen_result() {
    let id_kompetisi = $(`#id-kompetisi`).val()

    $.ajax({
        url : '<?php echo base_url('laporan/laporan_perolehan_nilai/kontingen_result') ?>',
        method : 'POST',
        data: {id_kompetisi},
        dataType : 'json',
        async: false,
        success: function (res) {
          let option = '<option value="semua">Semua</option>'

          if(res.data.length > 0) {
            for(const item of res.data) {
              option += `<option value="${item.nama}">${item.nama}</option>`
            }
          }

          $(`#kontingen`).html(option)
        }
    })
  }

  function export_excel() {
      let id_kompetisi = $(`#id-kompetisi`).val()
      let kontingen = $(`#kontingen`).val()
      let gelanggang = $(`#gelanggang`).val()
      window.open(`<?= base_url('laporan/laporan_perolehan_nilai/export_excel?id_kompetisi=') ?>${id_kompetisi}&kontingen=${kontingen}&gelanggang=${gelanggang}`, '_blank').focus();
  }
</script>
