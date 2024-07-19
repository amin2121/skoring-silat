<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Pengundian Tanding</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pengundian Nomor Kelas Tanding</h3>
        </div>
        <div class="panel-body">
          <div class="form-group row">
            <div class="col-sm-2">
              <select class="form-control" name="id_kompetisi" id="id_kompetisi" onchange="ubah_kategori_by_kompetisi()">
                <option value="Kosong">-- Pilih Kompetisi --</option>
                <?php foreach ($kompetisi as $km): ?>
                  <option value="<?php echo $km['id']; ?>" data-kategori="<?php echo $km['kategori'] ?>"><?php echo $km['kompetisi']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-2" id="form-golongan" style="display: none;">
              <select class="form-control" name="golongan" id="golongan">
                <option value="Kosong">-- Pilih Golongan --</option>
                <option value="Pra Usia Dini">Pra Usia Dini</option>
                <option value="Usia Dini">Usia Dini</option>
                <option value="Pra Remaja">Pra Remaja</option>
                <option value="Remaja">Remaja</option>
                <option value="Dewasa">Dewasa</option>
              </select>
            </div>
            <div class="col-sm-2" id="form-kelas" style="display: none;">
              <select class="form-control" name="kelas" id="kelas">
                <option value="Kosong">-- Pilih Kelas --</option>
                <option value="TK">TK</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="MAHASISWA">MAHASISWA</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                <option value="Kosong">-- Pilih Putra / Putri --</option>
                <option value="Putra">Putra</option>
                <option value="Putri">Putri</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="id_kelas_tanding" id="id_kelas_tanding">
                <option value="Kosong">-- Pilih Kelas Tanding --</option>
                <?php foreach ($kelas_tanding as $kt): ?>
                  <option value="<?php echo $kt['id']; ?>"><?php echo $kt['kelas_tanding']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-4">
              <button class="btn btn-success btn-sm" onclick="undi()" type="button">Undi</button>
              <button class="btn btn-primary btn-sm" onclick="get_data()" type="button">Cari</button>
              <button class="btn btn-danger btn-sm" onclick="hapus_data_semua_undian()" type="button">Hapus Undian</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Hasil Pengundian Kelas Tanding</h3>
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
          <table class="table table-hover table-bordered" id="table-data-peserta-undian">
              <thead>
                  <tr>
                      <th class="text-center">No Undian</th>
                      <th>Nama Peserta</th>
                      <th class="text-center">Golongan/Kelas</th>
                      <th class="text-center">Kelas Tanding</th>
                      <th class="text-center">Jenis Kelamin</th>
                      <th class="text-center">Kontingen</th>
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
<button type="button" data-toggle="modal" data-target="#modal-hapus-data-semua-undian" style="display: none;" id="btn-show-modal-hapus-data-semua-undian"></button>
<div class="modal fade" id="modal-hapus-data-semua-undian" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
  <div class="modal-dialog modal-danger" role="document">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="modal-danger-header">Hapus Semua Data Undian</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" name="id_undian_tanding" id="id_undian_tanding" value="">
              <div class="alert alert-default" role="alert">
                  <strong>Warning!</strong> Apakah Anda Yakin Ingin Menghapus Semua Data Undian?
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-link" id="btn-tutup-modal-hapus-data-semua-undian" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-danger" onclick="hapus_semua_undian()">Hapus</button>
          </div>
      </div>
  </div>
</div>
<!-- MODAL HAPUS -->

<script>
    $(document).ready(function() {
        get_data()
        ubah_kategori_by_kompetisi()
    })

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

    function get_data() {
        let search = $(`#search`).val()
        let golongan = $('#golongan').val()
        let kelas = $('#kelas').val()
        let jenis_kelamin = $('#jenis_kelamin').val()
        let id_kelas_tanding = $('#id_kelas_tanding').val()
        let id_kompetisi = $('#id_kompetisi').val()
        let count_col = $(`#table-data-peserta-undian thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/pengundian_tanding/get_data') ?>',
            method: 'GET',
            data: {search, golongan, kelas, jenis_kelamin, id_kelas_tanding, id_kompetisi},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data-peserta-undian tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  let id_undian_tanding = []
                  for(const item of res) {
                    tr += `
                    <tr>
                        <th class="text-center" scope="row">${item.no_undian}</th>
                        <td>${item.nama_lengkap}</td>
                        <td class="text-center">${item.kategori == 'kelas' ? item.kelas : item.golongan}</td>
                        <td class="text-center">${item.kelas_tanding}</td>
                        <td class="text-center">${item.jenis_kelamin == 'Putra' ? 'Putra' : 'Putri'}</td>
                        <td class="text-center">${item.kontingen}</td>
                    </tr>
                    `

                    id_undian_tanding.push(item.id)
                  }

                  $(`#id_undian_tanding`).val(id_undian_tanding.toString())
                } else {
                  tr = `
                    <tr>
                      <td colspan="${count_col}" class="text-center text-muted" ><span style="display: block; padding: 12px;">Data Belum Ada, Tambahkan Data</span></td>
                    </tr>
                  `
                }

                $(`#table-data-peserta-undian tbody`).html(tr)
                pagination()
            }
        })

        $('#search').off('keyup').keyup(function(){
            get_data()
      	})
    }

    function undi(){
      let golongan = $('#golongan').val()
      let kelas = $('#kelas').val()
      let jenis_kelamin = $('#jenis_kelamin').val()
      let id_kelas_tanding = $('#id_kelas_tanding').val()
      let id_kompetisi = $('#id_kompetisi').val()
      let count_col = $(`#table-data-peserta-undian thead tr th`).length

      $.ajax({
          url: '<?= base_url('master/pengundian_tanding/undi') ?>',
          method: 'GET',
          data: {golongan, kelas, jenis_kelamin, id_kelas_tanding, id_kompetisi},
          dataType: 'json',
          beforeSend: function() { show_loading_table('#table-data-peserta-undian tbody', count_col); },
          success: function (res) {
            alert(res.message)
            get_data()
          }
      })
    }

    function pagination() {
        var jumlah_tampil = $(`#select-show-data`).val() || 5;
        if(typeof $selector == 'undefined')
        {
            $selector = $("#table-data-peserta-undian tbody tr");
        }
        window.tp = new Pagination('#pagination', {
            itemsCount:$("#table-data-peserta-undian tbody tr").length,
            pageSize : parseInt(jumlah_tampil),
            onPageSizeChange: function (ps) {
            },
            onPageChange: function (paging) {
                var start = paging.pageSize * (paging.currentPage - 1),
                    end = start + paging.pageSize,
                    $rows = $("#table-data-peserta-undian tbody tr");
                $rows.hide();
                for (var i = start; i < end; i++) {
                    $rows.eq(i).show();
                }
            }
        });
    }

    function edit_data(id) {
      window.location.href = '<?php echo base_url(); ?>master/pengundian_tanding/view_edit/'+id
    }

    function hapus_data_semua_undian() {
      $(`#btn-show-modal-hapus-data-semua-undian`).click()
    }

    function hapus_semua_undian() {
      let golongan = $('#golongan').val()
      let kelas = $('#kelas').val()
      let jenis_kelamin = $('#jenis_kelamin').val()
      let id_kelas_tanding = $('#id_kelas_tanding').val()
      let id_kompetisi = $('#id_kompetisi').val()

      $.ajax({
        url: '<?php echo base_url('master/pengundian_tanding/hapus_semua_undian') ?>',
        method: 'GET',
        data: {golongan, kelas, jenis_kelamin, id_kelas_tanding, id_kompetisi},
        dataType: 'json',
        success: function (res) {
          $('#btn-tutup-modal-hapus-data-semua-undian').click()
          get_data()
        }
      })
    }
</script>
