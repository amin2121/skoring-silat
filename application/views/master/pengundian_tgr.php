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
              <select class="form-control" name="id_kompetisi" id="id_kompetisi">
                <option value="Kosong">-- Pilih Kompetisi --</option>
                <?php foreach ($kompetisi as $km): ?>
                  <option value="<?php echo $km['id']; ?>"><?php echo $km['kompetisi']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="golongan" id="golongan">
                <option value="Kosong">-- Pilih Golongan --</option>
                <option value="Usia Dini">Usia Dini</option>
                <option value="Pra Remaja">Pra Remaja</option>
                <option value="Remaja">Remaja</option>
                <option value="Dewasa">Dewasa</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                <option value="Kosong">-- Pilih Putra / Putri --</option>
                <option value="Laki - Laki">Putra</option>
                <option value="Perempuan">Putri</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="kategori_tanding" id="kategori_tanding">
                <option value="Kosong">-- Pilih Kategori --</option>
                <option value="Tunggal">Tunggal</option>
                <option value="Ganda">Ganda</option>
                <option value="Regu">Regu</option>
              </select>
            </div>
            <div class="col-sm-2">
              <button class="btn btn-success" onclick="undi()" type="button">Undi</button>
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
                      <th>No</th>
                      <th>Nama Peserta</th>
                      <th>Golongan</th>
                      <th>Kategori</th>
                      <th>Kontingen</th>
                      <th>No Undian</th>
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

<script>
    $(document).ready(function() {
        get_data()
    })

    function get_data() {
        let search = $(`#search`).val()
        let count_col = $(`#table-data-peserta-undian thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/pengundian_tgr/get_data') ?>',
            method: 'GET',
            data: {search},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data-peserta-undian tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {
                    tr += `
                    <tr>
                        <th class="text-center" scope="row">${++no}</th>
                        <td>${item.nama_lengkap}</td>
                        <td>${item.golongan}</td>
                        <td>${item.kategori_tanding}</td>
                        <td>${item.kontingen}</td>
                        <td>${item.no_undian}</td>
                        <td class="text-center">
                            <div class="btn-group">
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
      let jenis_kelamin = $('#jenis_kelamin').val()
      let kategori_tanding = $('#kategori_tanding').val()
      let id_kompetisi = $('#id_kompetisi').val()
      let count_col = $(`#table-data-peserta-undian thead tr th`).length

      $.ajax({
          url: '<?= base_url('master/pengundian_tgr/undi') ?>',
          method: 'GET',
          data: {golongan, jenis_kelamin, kategori_tanding, id_kompetisi},
          dataType: 'json',
          beforeSend: function() { show_loading_table('#table-data-peserta-undian tbody', count_col); },
          success: function (res) {
            console.log(res)
            if (res.status == 'Berhasil') {
              get_data()
            }
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
      window.location.href = '<?php echo base_url(); ?>master/pengundian_tgr/view_edit/'+id
    }

    function hapus_data(id) {
      $(`#btn-show-modal-hapus-data`).click()
      $('#id_hapus_data').val(id)
    }

    function hapus(){
      let id = $('#id_hapus_data').val()
      $.ajax({
        url: '<?php echo base_url('master/pengundian_tgr/hapus') ?>',
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
