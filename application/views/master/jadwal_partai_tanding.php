<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Jadwal Partai Tanding</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Jadwal Partai Tanding</h3>
            <div class="panel-elements pull-right">
              <button class="btn btn-sm btn-info" onclick="show_modal_import()" style="margin-left: 4px;"><i class=""></i>Import Excel</button>
            </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>master/jadwal_partai_tanding/tambah" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kompetisi" id="select-kompetisi" onchange="ubah_kategori_by_kompetisi(); kontingen_result();">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>" data-kategori="<?php echo $k['kategori'] ?>"><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal</label>
                <div class="col-md-4">
                    <input type="text" class="form-control bs-datepicker" name="tanggal" placeholder="Tanggal">
                </div>
                <label class="col-md-2 control-label">Gelanggang</label>
                <div class="col-md-4">
                  <select class="form-control" name="gelanggang">
                    <?php foreach ($gelanggang as $key => $glg): ?>
                      <option value="<?php echo $glg['gelanggang'] ?>"><?php echo $glg['gelanggang'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kelas Tanding</label>
                <div class="col-md-4">
                  <select class="form-control" name="id_kelas_tanding">
                    <?php foreach ($kelas_tanding as $kt): ?>
                      <option value="<?php echo $kt['id']; ?>"><?php echo $kt['kelas_tanding']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div id="form-golongan">
                  <label class="col-md-2 control-label">Golongan</label>
                  <div class="col-md-4">
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
                <div style="display: none;" id="form-kelas">
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
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Partai</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="no_partai" placeholder="1/2/3">
                </div>
                <label class="col-md-2 control-label">Babak</label>
                <div class="col-md-4">
                  <select class="form-control" name="babak">
                    <option value="PENYISIHAN">PENYISIHAN</option>
                    <option value="SEMIFINAL">SEMIFINAL</option>
                    <option value="FINAL">FINAL</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat Merah</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_pesilat_merah" placeholder="Nama Pesilat Merah">
                </div>
                <label class="col-md-2 control-label">Kontingen Merah</label>
                <div class="col-md-4">
                  <select class="form-control" name="kontingen_merah" id="kontingen-merah"></select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat Biru</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_pesilat_biru" placeholder="Nama Pesilat Biru">
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
                    <option value="Putra">Putra</option>
                    <option value="Putri">Putri</option>
                  </select>
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Tambah</button>
                </div>
            </div>
          </form>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Jadwal Partai Tanding</h3>
        </div>
        <div class="panel-body">
          <div class="form-group row">
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" name="search" id="search" class="form-control">
                </div>
              </div>
          </div>
          <table class="table table-hover table-bordered" id="table-data">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Gel.</th>
                      <th>Partai</th>
                      <th>Babak</th>
                      <th>Kelompok</th>
                      <th>Sudut Merah</th>
                      <th>Sudut Biru</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
          <div class="row">
            <div class="col-sm-10">
                <div id="pagination"></div>
            </div>
            <div class="col-sm-2">
                <select class="form-control" id="select-show-data" onchange="pagination()">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->

<!-- MODAL HAPUS -->
<button type="button" data-toggle="modal" data-target="#modal-hapus-data" style="display: none;" id="btn-show-modal-hapus-data"></button>
<div class="modal fade" id="modal-hapus-data" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
  <div class="modal-dialog modal-danger" role="document">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="modal-danger-header">Hapus</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" id="id_hapus_data" value="">
              <div class="alert alert-default" role="alert">
                  <strong>Warning!</strong> Apakah Anda Yakin Ingin Menghapus Data Tersebut?
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-link" id="btn-tutup-modal-hapus-data" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-danger" onclick="hapus()">Hapus</button>
          </div>
      </div>
  </div>
</div>
<!-- MODAL HAPUS -->

<!-- MODAL IMPORT EXCEL -->
<button type="button" data-toggle="modal" data-target="#modal-import-data" style="display: none;" id="btn-show-modal-import-data"></button>
<div class="modal fade" id="modal-import-data" tabindex="-1" role="dialog" aria-labelledby="modal-warning-header">
  <div class="modal-dialog modal-info" role="document">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="modal-success-header">Import Peserta</h4>
          </div>
          <form class="" action="<?php echo base_url('master/jadwal_partai_tanding/import_excel') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="kompetisi">Kompetisi</label>
                <select class="form-control" name="id_kompetisi" id="id_kompetisi">
                  <option value="">-- Pilih Kompetisi --</option>
                  <?php foreach ($kompetisi as $key => $kpt): ?>
                    <option value="<?php echo $kpt['id'] ?>"><?php echo $kpt['kompetisi'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="file_excel">File Excel</label>
                <input type="file" name="file_excel" id="file_excel" class="form-control">
              </div>
              <div class="form-group">
                <label for="download_template">Download Template</label>
                <div>
                    <a class="btn btn-info" href="<?= base_url('storage/template/template-excel-jadwal-partai-tanding.xlsx') ?>" download="Template Excel Jadwal Partai Tanding.xlsx"><i class="fa fa-download"></i> Download Template Excel</a>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
  </div>
</div>
<!-- MODAL IMPORT EXCEL -->

<script>
    $(document).ready(function() {
        get_data()
        ubah_kategori_by_kompetisi()
        kontingen_result()
    })

    function show_modal_import() {
      $(`#btn-show-modal-import-data`).click()
    }

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

        $.ajax({
            url: '<?= base_url('master/jadwal_partai_tanding/kontingen_result') ?>',
            method: 'POST',
            data: {id_kompetisi},
            dataType: 'json',
            success: function (res) {
                let option = ''
                if(res.length > 0) {
                  for(const item of res) {
                    option += `<option value="${item.id}">${item.nama}</option>`
                  }
                }

                $(`#kontingen-biru`).html(option)
                $(`#kontingen-merah`).html(option)
            }
        })
    }

    function get_data() {
        let search = $(`#search`).val()
        let count_col = $(`#table-data thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/jadwal_partai_tanding/get_data') ?>',
            method: 'GET',
            data: {search},
            dataType: 'json',
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {
                    let status_aktif = 'Tidak'
                    if (item.status == '1') {
                      status_aktif = 'Ya'
                    }

                    tr += `
                      <tr>
                          <th class="text-center" scope="row">${++no}</th>
                          <td>${item.gelanggang}</td>
                          <td>${item.no_partai}</td>
                          <td>${item.babak}</td>
                          <td>${item.kompetisi} - ${item.kategori == 'kelas' ? item.kelas : item.golongan}</td>
                          <td>${item.nama_pesilat_merah} - ${item.kontingen_merah}</td>
                          <td>${item.nama_pesilat_biru} - ${item.kontingen_biru}</td>
                          <td>${status_aktif}</td>
                          <td class="text-center">
                              <div class="btn-group">
                                  <button class="btn btn-info btn-sm" style="margin-right: 4px;" type="button" onclick="edit_data(${item.id})" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i></button>
                                  <button class="btn btn-danger btn-sm" type="button" onclick="hapus_data(${item.id})" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-trash"></i></button>
                              </div>
                          </td>
                      </tr>
                    `
                  }
                } else {
                  tr = `
                    <tr>
                      <td colspan="${count_col}" class="text-center text-muted" ><span style="display: block; padding: 12px;">Data Belum Ada, Tambahkan Data</span></td>
                    </tr>
                  `
                }

                $(`#table-data tbody`).html(tr)
                pagination()
            }
        })

        $('#search').off('keyup').keyup(function(){
            get_data()
      	})
    }

    function pagination() {
        var jumlah_tampil = $(`#select-show-data`).val() || 5;
        if(typeof $selector == 'undefined')
        {
            $selector = $("#table-data tbody tr");
        }
        window.tp = new Pagination('#pagination', {
            itemsCount:$("#table-data tbody tr").length,
            pageSize : parseInt(jumlah_tampil),
            onPageSizeChange: function (ps) {
            },
            onPageChange: function (paging) {
                var start = paging.pageSize * (paging.currentPage - 1),
                    end = start + paging.pageSize,
                    $rows = $("#table-data tbody tr");
                $rows.hide();
                for (var i = start; i < end; i++) {
                    $rows.eq(i).show();
                }
            }
        });
    }

    function edit_data(id) {
      window.location.href = '<?php echo base_url(); ?>master/jadwal_partai_tanding/view_edit/'+id
    }

    function hapus_data(id) {
      $(`#btn-show-modal-hapus-data`).click()
      $('#id_hapus_data').val(id)
    }

    function hapus(){
      let id = $('#id_hapus_data').val()
      $.ajax({
        url: '<?php echo base_url('master/jadwal_partai_tanding/hapus') ?>',
        method: 'GET',
        data: {id},
        dataType: 'json',
        success: function (res) {
          $('#btn-tutup-modal-hapus-data').click()
          get_data()
        }
      })
    }
</script>
