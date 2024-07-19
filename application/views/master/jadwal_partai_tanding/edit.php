<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>jadwal_partai_tanding">Jadwal Partai Tanding</a></li>
        <li class="active">Edit</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Jadwal Partai Tanding</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>master/jadwal_partai_tanding/edit" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kompetisi" id="select-kompetisi" onchange="ubah_kategori_by_kompetisi(); kontingen_result();">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>" <?php echo $k['id'] == $row['id_kompetisi'] ? 'selected' : '' ?> data-kategori="<?php echo $k['kategori'] ?>"><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal</label>
                <div class="col-md-4">
                    <input type="text" class="form-control bs-datepicker" name="tanggal" placeholder="Tanggal" value="<?php echo str_replace('-', '/', $row['tanggal']) ?>">
                </div>
                <label class="col-md-2 control-label">Gelanggang</label>
                <div class="col-md-4">
                  <select class="form-control" name="gelanggang">
                    <?php foreach ($gelanggang as $key => $glg): ?>
                      <option value="<?php echo $glg['gelanggang'] ?>" <?php echo $glg['gelanggang'] == $row['gelanggang'] ? 'selected' : '' ?>><?php echo $glg['gelanggang'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kelas Tanding</label>
                <div class="col-md-4">
                  <select class="form-control" name="id_kelas_tanding">
                    <?php foreach ($kelas_tanding as $kt): ?>
                      <option value="<?php echo $kt['id']; ?>" <?php echo $kt['id'] == $row['id_kelas_tanding'] ? 'selected' : '' ?>><?php echo $kt['kelas_tanding']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div id="form-golongan">
                  <label class="col-md-2 control-label">Golongan</label>
                  <div class="col-md-4">
                    <select class="form-control" name="golongan">
                      <option value="">-- Pilih Golongan --</option>
                      <option value="Pra Usia Dini" <?php echo 'Pra Usia Dini' == $row['golongan'] ? 'selected' : '' ?>>Pra Usia Dini</option>
                      <option value="Usia Dini" <?php echo 'Usia Dini' == $row['golongan'] ? 'selected' : '' ?>>Usia Dini</option>
                      <option value="Pra Remaja" <?php echo 'Pra Remaja' == $row['golongan'] ? 'selected' : '' ?>>Pra Remaja</option>
                      <option value="Remaja" <?php echo 'Remaja' == $row['golongan'] ? 'selected' : '' ?>>Remaja</option>
                      <option value="Dewasa" <?php echo 'Dewasa' == $row['golongan'] ? 'selected' : '' ?>>Dewasa</option>
                    </select>
                  </div>
                </div>
                <div style="display: none;" id="form-kelas">
                  <label class="col-md-2 control-label">Kelas</label>
                  <div class="col-md-4">
                    <select class="form-control" name="kelas">
                      <option value="">-- Pilih Kelas --</option>
                      <option value="TK" <?php echo 'TK' == $row['kelas'] ? 'selected' : '' ?>>TK</option>
                      <option value="SD" <?php echo 'SD' == $row['kelas'] ? 'selected' : '' ?>>SD</option>
                      <option value="SMP" <?php echo 'SMP' == $row['kelas'] ? 'selected' : '' ?>>SMP</option>
                      <option value="SMA" <?php echo 'SMA' == $row['kelas'] ? 'selected' : '' ?>>SMA</option>
                      <option value="MAHASISWA" <?php echo 'MAHASISWA' == $row['kelas'] ? 'selected' : '' ?>>MAHASISWA</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Partai</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="no_partai" placeholder="1/2/3" value="<?php echo $row['no_partai'] ?>">
                </div>
                <label class="col-md-2 control-label">Babak</label>
                <div class="col-md-4">
                  <select class="form-control" name="babak">
                    <option value="PENYISIHAN" <?php echo 'PENYISIHAN' == $row['babak'] ? 'selected' : '' ?>>PENYISIHAN</option>
                    <option value="SEMIFINAL" <?php echo 'SEMIFINAL' == $row['babak'] ? 'selected' : '' ?>>SEMIFINAL</option>
                    <option value="FINAL" <?php echo 'FINAL' == $row['babak'] ? 'selected' : '' ?>>FINAL</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat Merah</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_pesilat_merah" placeholder="Nama Pesilat Merah" value="<?php echo $row['nama_pesilat_merah'] ?>">
                </div>
                <label class="col-md-2 control-label">Kontingen Merah</label>
                <div class="col-md-4">
                  <select class="form-control" name="kontingen_merah" id="kontingen-merah"></select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat Biru</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_pesilat_biru" placeholder="Nama Pesilat Biru" value="<?php echo $row['nama_pesilat_biru'] ?>">
                </div>
                <label class="col-md-2 control-label">Kontingen Biru</label>
                <div class="col-md-4">
                  <select class="form-control" name="kontingen_biru" id="kontingen-biru"></select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jenis Kelamin</label>
                <div class="col-md-4">
                  <select class="form-control" name="jenis_kelamin">
                    <option value="Putra" <?php echo 'Putra' == $row['jenis_kelamin'] ? 'selected' : '' ?>>Putra</option>
                    <option value="Putri" <?php echo 'Putri' == $row['jenis_kelamin'] ? 'selected' : '' ?>>Putri</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Status Aktif</label>
                <div class="col-md-4">
                  <select class="form-control" name="status">
                    <option value="0" <?php echo '0' == $row['status'] ? 'selected' : '' ?>>Tidak Aktif</option>
                    <option value="1" <?php echo '1' == $row['status'] ? 'selected' : '' ?>>Aktif</option>
                  </select>
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Edit</button>
                  <a href="<?php echo base_url(); ?>master/jadwal_partai_tanding"><button class="btn btn-warning btn-sm" type="button">Kembali</button></a>
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
  $(document).ready(function() {
      kontingen_result()
      ubah_kategori_by_kompetisi()
  })

  function ubah_kategori_by_kompetisi() {
    let kategori = $(`#select-kompetisi option:selected`).data('kategori')
    if(kategori == 'kelas') {
      $(`#form-kelas`).show()
      $(`#form-golongan`).hide()
    } else if(kategori == 'umur') {
      $(`#form-kelas`).hide()
      $(`#form-golongan`).show()
    }
  }

  function kontingen_result() {
      let id_kompetisi = $(`#select-kompetisi`).val()
      let id_kontingen_biru = '<?php echo $row['id_kontingen_biru'] ?>'
      let id_kontingen_merah = '<?php echo $row['id_kontingen_merah'] ?>'

      $.ajax({
          url: '<?= base_url('master/jadwal_partai_tanding/kontingen_result') ?>',
          method: 'POST',
          data: {id_kompetisi},
          dataType: 'json',
          success: function (res) {
            let option_biru = ''
            let option_merah = ''
            if(res.length > 0) {
              for(const item of res) {
                option_biru += `<option value="${item.id}" ${item.id == id_kontingen_biru ? 'selected' : ''}>${item.nama}</option>`
                option_merah += `<option value="${item.id}" ${item.id == id_kontingen_merah ? 'selected' : ''}>${item.nama}</option>`
              }
            }

            $(`#kontingen-biru`).html(option_biru)
            $(`#kontingen-merah`).html(option_merah)
          }
      })
  }


</script>
