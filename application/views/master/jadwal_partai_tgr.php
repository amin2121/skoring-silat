<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Jadwal Partai TGR</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Jadwal Partai TGR</h3>
            <div class="panel-elements pull-right">
              <a href="<?php echo base_url(); ?>master/jadwal_partai_tgr/view_tambah"><button class="btn btn-sm btn-primary"><i class=""></i>Tambah</button></a>
            </div>
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
                    <option>5</option>
                    <option>10</option>
                    <option>50</option>
                    <option>100</option>
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

<script>
    $(document).ready(function() {
        get_data()
    })

    function get_data() {
        let search = $(`#search`).val()
        let count_col = $(`#table-data thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/jadwal_partai_tgr/get_data') ?>',
            method: 'GET',
            data: {search},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {
                    tr += `
                      <tr>
                          <th class="text-center" scope="row">${++no}</th>
                          <td>${item.gelanggang}</td>
                          <td>${item.no_partai}</td>
                          <td>${item.babak}</td>
                          <td>${item.kelas}/${item.golongan}</td>
                          <td>${item.nama_pesilat_merah} - ${item.kontingen_merah}</td>
                          <td>${item.nama_pesilat_biru} - ${item.kontingen_biru}</td>
                          <td></td>
                          <td class="text-center">
                              <div class="btn-group">
                                  <button class="btn btn-info btn-sm" type="button" onclick="edit_data(${item.id})" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i></button>
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
      window.location.href = '<?php echo base_url(); ?>master/jadwal_partai_tgr/view_edit/'+id
    }

    function hapus_data(id) {
      $(`#btn-show-modal-hapus-data`).click()
      $('#id_hapus_data').val(id)
    }

    function hapus(){
      let id = $('#id_hapus_data').val()
      $.ajax({
        url: '<?php echo base_url('master/jadwal_partai_tgr/hapus') ?>',
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
