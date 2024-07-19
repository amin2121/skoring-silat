
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Laporan Pesilat Terbaik</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Laporan Pesilat Terbaik</h3>
        </div>
        <div class="panel-body">
          <form style="margin-bottom: 2rem;" action="<?php echo base_url('laporan/laporan_pesilat_terbaik/cetak/') ?>" method="post" target="_blank">
            <div class="row" style="display: flex;">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Kompetisi</label>
                  <select class="form-control" name="kompetisi" onchange="kontingen_result(); ubah_kategori_by_kompetisi();" id="id-kompetisi">
                    <option value="">-- Pilih Kompetisi --</option>
                    <?php foreach ($kompetisi as $key => $k): ?>
                      <option value="<?php echo $k['id'] ?>" data-kategori="<?php echo $k['kategori'] ?>"><?php echo $k['kompetisi'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-2" id="form-golongan" style="display: none;">
                <div class="form-group">
                  <label for="">Golongan</label>
                  <select class="form-control" name="golongan" id="golongan">
                    <option value="semua">Semua</option>
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
                    <option value="semua">Semua</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="MAHASISWA">MAHASISWA</option>
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
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="semua">Semua</option>
                    <option value="Putra">Putra</option>
                    <option value="Putri">Putri</option>
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
  $(document).ready(function() {
      ubah_kategori_by_kompetisi()
  })

  function ubah_kategori_by_kompetisi() {
    let kategori = $(`#id-kompetisi option:selected`).data('kategori')
    if(kategori == 'kelas') {
      $(`#form-kelas`).show()
      $(`#form-golongan`).hide()
    } else if(kategori == 'umur') {
      $(`#form-kelas`).hide()
      $(`#form-golongan`).show()
    }
  }

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
      let golongan = $(`#golongan`).val()
      let kelas = $(`#kelas`).val()
      let jenis_kelamin = $(`#jenis_kelamin`).val()
      window.open(`<?= base_url('laporan/laporan_pesilat_terbaik/export_excel?kompetisi=') ?>${id_kompetisi}&kontingen=${kontingen}&gelanggang=${gelanggang}&golongan=${golongan}&kelas=${kelas}&jenis_kelamin=${jenis_kelamin}`, '_blank').focus();
  }
</script>
