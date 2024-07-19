
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Jadwal Pertandingan</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Jadwal Pertandingan</h3>
        </div>
        <div class="panel-body">
          <form style="margin-bottom: 2rem;" action="<?php echo base_url('master/jadwal_pertandingan/cetak/') ?>" method="post" target="_blank">
            <div class="row" style="display: flex;">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Kompetisi</label>
                  <select class="form-control" name="kompetisi">
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
                  <select class="form-control" name="gelanggang">
                    <option value="">Semua Gelanggang</option>
                    <?php foreach ($gelanggang as $key => $glg): ?>
                      <option value="<?php echo $glg['gelanggang'] ?>"><?php echo $glg['gelanggang'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Tanggal</label>
                  <input type="text" class="form-control bs-datepicker" name="tanggal" placeholder="Tanggal">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">No Partai Awal</label>
                  <input type="number" class="form-control" name="no_partai_awal" placeholder="No Partai Awal">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">No Partai Akhir</label>
                  <input type="number" class="form-control" name="no_partai_akhir" placeholder="No Partai Akhir">
                </div>
              </div>
              <div class="col-sm-3" style="display: flex !important; align-items: flex-end !important; gap: 6px;">
                <button type="submit" name="button" class="btn btn-primary"><i class="fa fa-print" style="margin-right: 6px;"></i> Cetak</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->
