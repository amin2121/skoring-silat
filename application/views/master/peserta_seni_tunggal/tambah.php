<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>master/peserta_seni_tunggal">Peserta</a></li>
        <li class="active">Tambah</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Peserta</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>master/peserta_seni_tunggal/tambah" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <select class="form-control" id="id-kompetisi" name="id_kompetisi" onchange="ubah_kategori_by_kompetisi(); get_kontingen();">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>" data-kategori="<?php echo $k['kategori'] ?>"><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Foto Peserta</label>
                <div class="col-md-10">
                    <input type="file" name="foto_peserta" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kategori</label>
                <div class="col-md-10">
                    <select class="form-control" name="kategori_tanding">
                      <option value="Tanding">Tanding</option>
                      <option value="Tunggal">Tunggal</option>
                      <option value="Ganda">Ganda</option>
                      <option value="Regu">Regu</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-golongan">
                <label class="col-md-2 control-label">Golongan</label>
                <div class="col-md-10">
                    <select class="form-control" name="golongan">
                      <option value="">-- Pilih Golongan --</option>
                      <option value="Pra Usia Dini">Pra Usia Dini</option>
                      <option value="Usia Dini">Usia Dini</option>
                      <option value="Pra Remaja">Pra Remaja</option>
                      <option value="Remaja">Remaja</option>
                      <option value="Dewasa">Dewasa</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Lengkap</label>
                <div class="col-md-10">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal Lahir</label>
                <div class="col-md-4">
                    <input type="text" class="form-control bs-datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir">
                </div>
                <label class="col-md-2 control-label">Jenis Kelamin</label>
                <div class="col-md-4">
                    <select class="form-control" name="jenis_kelamin">
                      <option value="Putra">Putra</option>
                      <option value="Putri">Putri</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tinggi Badan</label>
                <div class="col-md-4">
                  <div class="input-group">
                      <input type="text" name="tinggi_badan" class="form-control" placeholder="Tinggi Badan">
                      <span class="input-group-addon">cm</span>
                  </div>
                </div>
                <label class="col-md-2 control-label">Berat Badan</label>
                <div class="col-md-4">
                  <div class="input-group">
                      <input type="text" name="berat_badan" class="form-control" placeholder="Berat Badan">
                      <span class="input-group-addon">kg</span>
                  </div>
                </div>
            </div>
            <div class="form-group form-sekolah">
                <label class="col-md-2 control-label">Kelas</label>
                <div class="col-md-4">
                    <select class="form-control" name="kelas">
                      <option value="">-- Pilih Kelas --</option>
                      <option value="TK">TK</option>
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMA">SMA</option>
                      <option value="MAHASISWA">MAHASISWA</option>
                    </select>
                </div>
                <label class="col-md-2 control-label">Asal Sekolah/Asal Kuliah</label>
                <div class="col-md-4">
                  <input type="text" name="asal_sekolah" class="form-control" placeholder="Asal Sekolah/Asal Kuliah">
                </div>
            </div>
            <div class="form-group form-file-sekolah">
                <label class="col-md-2 control-label">Scan Akta Kelahiran</label>
                <div class="col-md-4">
                    <input type="file" name="akta_kelahiran" class="form-control">
                </div>
                <label class="col-md-2 control-label">Scan Ijazah</label>
                <div class="col-md-4">
                    <input type="file" name="ijazah" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kelas Tanding</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kelas_tanding">
                      <?php foreach ($kelas_tanding as $kt): ?>
                        <option value="<?php echo $kt['id']; ?>"><?php echo $kt['kelas_tanding']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kontingen</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kontingen" id="id-kontingen">

                    </select>
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Tambah</button>
                  <a href="<?php echo base_url(); ?>master/peserta_seni_tunggal"><button class="btn btn-warning btn-sm" type="button">Kembali</button></a>
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
  $(document).ready(function functionName() {
    ubah_kategori_by_kompetisi()
    get_kontingen()
  })

  function ubah_kategori_by_kompetisi() {
    let kategori = $(`#id-kompetisi option:selected`).data('kategori')
    console.log(kategori == 'kelas', kategori)
    if(kategori == 'kelas') {
      $(`.form-sekolah`).show()
      $(`.form-file-sekolah`).show()
      $(`.form-golongan`).hide()
    } else if(kategori == 'umur') {
      $(`.form-sekolah`).hide()
      $(`.form-file-sekolah`).hide()
      $(`.form-golongan`).show()
    }
  }

  function get_kontingen() {
      let id_kompetisi = $(`#id-kompetisi`).val()

      $.ajax({
          url: '<?= base_url('master/peserta_seni_tunggal/get_kontingen') ?>',
          method: 'GET',
          data: {id_kompetisi},
          dataType: 'json',
          success: function (res) {
              let option = '<option value="Kosong">-- Pilih Kontingen --</option>'
              if(res.length > 0) {
                let no = 0
                for(const item of res) {

                  option += `<option value="${item.id}">${item.nama}</option>`
                }
              } else {
                tr = `<option value="Kosong">Kosong</option>`
              }

              $(`#id-kontingen`).html(option)
          }
      })
  }
</script>
