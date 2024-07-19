
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Bagan Tanding</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Bagan Tanding</h3>
        </div>
        <div class="panel-body">
          <form style="margin-bottom: 2rem;" action="<?php echo base_url('master/bagan_tanding/cetak/') ?>" method="post" target="_blank">
            <div class="row" style="display: flex;">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="">Kompetisi</label>
                  <select class="form-control" name="id_kompetisi" id="id_kompetisi" onchange="ubah_kategori_by_kompetisi()">
                    <option value="Kosong">-- Pilih Kompetisi --</option>
                    <?php foreach ($kompetisi as $km): ?>
                      <option value="<?php echo $km['id']; ?>" data-kategori="<?php echo $km['kategori'] ?>"><?php echo $km['kompetisi']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-2" id="form-golongan" style="display: none;">
                <div class="form-group">
                  <label for="">Golongan</label>
                  <select class="form-control" name="golongan" id="golongan">
                    <option value="Kosong">-- Pilih Golongan --</option>
                    <option value="Pra Usia Dini">Pra Usia Dini</option>
                    <option value="Usia Dini">Usia Dini</option>
                    <option value="Pra Remaja">Pra Remaja</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-2" id="form-kelas" style="display: none;">
                <div class="form-group">
                  <label for="">Kelas</label>
                  <select class="form-control" name="kelas" id="kelas">
                    <option value="Kosong">-- Pilih Kelas --</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="MAHASISWA">MAHASISWA</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="Kosong">-- Pilih Putra / Putri --</option>
                    <option value="Putra">Putra</option>
                    <option value="Putri">Putri</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="">Kelas Tanding</label>
                  <select class="form-control" name="id_kelas_tanding" id="id_kelas_tanding">
                    <option value="Kosong">-- Pilih Kelas Tanding --</option>
                    <?php foreach ($kelas_tanding as $kt): ?>
                      <option value="<?php echo $kt['id']; ?>"><?php echo $kt['kelas_tanding']; ?></option>
                    <?php endforeach; ?>
                  </select>
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

<script type="text/javascript">
  function ubah_kategori_by_kompetisi() {
    let kategori = $(`#id_kompetisi option:selected`).data('kategori')
    if(kategori == 'kelas') {
      $(`#form-kelas`).show()
      $(`#form-golongan`).hide()
    } else if(kategori == 'umur') {
      $(`#form-kelas`).hide()
      $(`#form-golongan`).show()
    }
  }
</script>
