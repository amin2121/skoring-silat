
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Kontingen</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Kontingen</h3>
            <div class="panel-elements pull-right">
              <a href="<?php echo base_url(); ?>master/kontingen/view_tambah"><button class="btn btn-sm btn-primary"><i class=""></i>Tambah</button></a>
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
            <div class="col-md-3">
                <select class="bs-select" id="select-kompetisi"  data-live-search="true" onchange="get_data()">
                    <?php foreach ($kompetisi as $key => $kmp): ?>
                      <option <?php echo ($kmp['status'] == 1) ? 'selected' : '' ?> value="<?php echo $kmp['id'] ?>"><?php echo $kmp['kompetisi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
          </div>
          <table class="table table-hover table-bordered" id="table-data">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Kontingen</th>
                      <th>Kompetisi</th>
                      <th>Pelatih</th>
                      <th>Jumlah Bayar</th>
                      <th>No Telepon</th>
                      <th class="text-center">Aksi</th>
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

<!-- MODAL BUKTI PEMBAYARAN -->
<button type="button" data-toggle="modal" data-target="#modal-info-data" style="display: none;" id="btn-show-modal-info-data"></button>
<div class="modal fade" id="modal-info-data" tabindex="-1" role="dialog" aria-labelledby="modal-warning-header">
  <div class="modal-dialog modal-warning" role="document">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="modal-warning-header">Bukti Pembayaran</h4>
          </div>
          <div class="modal-body">
              <div id="row_bukti_pembayaran">

              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-link" id="btn-tutup-modal-info-data" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>
<!-- MODAL BUKTI PEMBAYARAN -->

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
        let kompetisi = $(`#select-kompetisi`).val()
        let count_col = $(`#table-data thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/kontingen/get_data') ?>',
            method: 'GET',
            data: {search, kompetisi},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {
                    let metode_pembayaran = '<span class="badge badge-success">Tunai</span>'
                    let btn_lihat_bukti_pembayaran = ''
                    if(item.metode_pembayaran == 'transfer') {
                      metode_pembayaran = '<span class="badge badge-info">Transfer</span>'
                      btn_lihat_bukti_pembayaran = `<button class="btn btn-warning btn-sm" type="button" onclick="info_data('${item.bukti_pembayaran}')" data-toggle="tooltip" data-original-title="Info"><i class="fa fa-eye"></i></button>`
                    }

                    tr += `
                      <tr>
                          <th class="text-center" scope="row">${++no}</th>
                          <td>${item.nama}</td>
                          <td>${item.kompetisi}</td>
                          <td>${item.pelatih}</td>
                          <td>
                            Rp. ${NumberToMoney(item.jumlah_bayar)}  <br>
                            ${metode_pembayaran}
                          </td>
                          <td>${item.no_telepon}</td>
                          <td class="text-center">
                              <div class="btn-group">
                                  ${btn_lihat_bukti_pembayaran}
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

    function info_data(bukti_pembayaran) {
      $(`#btn-show-modal-info-data`).click()
      let html_bukti_pembayaran = `<div class="col-ms-12 grid-element">
                                     <div class="tile-basic">
                                         <a href="#" class="tile-image tile-image-padding tile-image-hover-grayscale preview" data-preview-image="<?php echo base_url(); ?>storage/bukti_pembayaran/${bukti_pembayaran}" data-preview-size="modal-lg">
                                             <img src="<?php echo base_url(); ?>storage/bukti_pembayaran/${bukti_pembayaran}" alt="${bukti_pembayaran}">
                                         </a>
                                         <div class="tile-content tile-content-condensed-bottom text-center">
                                             <h5 class="tile-title">Bukti Pembayaran</h5>
                                         </div>
                                     </div>
                                 </div>`

      $(`#row_bukti_pembayaran`).html(html_bukti_pembayaran)
    }

    function edit_data(id) {
      window.location.href = '<?php echo base_url(); ?>master/kontingen/view_edit/'+id
    }

    function hapus_data(id) {
      $(`#btn-show-modal-hapus-data`).click()
      $('#id_hapus_data').val(id)
    }

    function hapus(){
      let id = $('#id_hapus_data').val()
      $.ajax({
        url: '<?php echo base_url('master/kontingen/hapus') ?>',
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
