
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Laporan Pertandingan</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Laporan Pertandingan</h3>
        </div>
        <div class="panel-body">
          <form style="margin-bottom: 2rem;" action="<?php echo base_url('laporan/laporan_pertandingan/cetak/') ?>" method="post" target="_blank">
            <div class="row" style="display: flex;">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Kompetisi</label>
                  <select class="form-control" name="kompetisi" id="id-kompetisi">
                    <option value="">-- Pilih Kompetisi --</option>
                    <?php foreach ($kompetisi as $key => $k): ?>
                      <option value="<?php echo $k['id'] ?>"><?php echo $k['kompetisi'] ?></option>
                    <?php endforeach; ?>
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
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Babak</label>
                  <select class="form-control" name="babak" id="babak">
                    <option value="semua">Semua</option>
                    <option value="PENYISIHAN">PENYISIHAN</option>
                    <option value="SEMIFINAL">SEMIFINAL</option>
                    <option value="FINAL">FINAL</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Status Pertandingan</label>
                  <select class="form-control" name="status_pertandingan" id="status-pertandingan">
                    <option value="1">Selesai</option>
                    <option value="0">Belum Selesai</option>
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

<script>
  function export_excel() {
      let id_kompetisi = $(`#id-kompetisi`).val()
      let gelanggang = $(`#gelanggang`).val()
      let status_pertandingan = $(`#status-pertandingan`).val()
      let babak = $(`#babak`).val()
      
      window.open(`<?= base_url('laporan/laporan_pertandingan/export_excel?id_kompetisi=') ?>${id_kompetisi}&gelanggang=${gelanggang}&status_pertandingan=${status_pertandingan}&babak=${babak}`, '_blank').focus();
  }
</script>
