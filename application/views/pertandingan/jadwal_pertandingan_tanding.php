<style media="screen">
  :root {
    --merah: #e74131;
    --merah-tua: #cd1f18;
    --biru: #0b71e0;
    --biru-tua: #185bc3;
    --kuning: #ffdd00;
    --kuning-tua: #ccb100;
    --warna-border: #9e9e9e;
    --background-table-header : #eeeeee;
    --border-table-header : #cdcdcd;
    --hijau-button: #27a63d;
    --hijau-button-tua: #147425;
    --abu-abu-header: #9aafc4;
    --navi: #42526b;
    --orange: #f4ae40;
    --putih-tulang: #F9F6EE;
    --hijau-total-nilai: #539165;
  }

  .th-biru {
    background: var(--biru) !important;
    color: white !important;
  }

  .th-merah {
    background: var(--merah) !important;
    color: white !important;
  }

  .td-biru {
    color: var(--biru);
  }

  .td-merah {
    color: var(--merah);
  }

  .td-kuning,
  .th-kuning {
    background: var(--kuning);
  }
</style>
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Jadwal Pertandingan Tanding</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Jadwal Pertandingan Tanding</h3>
        </div>
        <div class="panel-body">
          <div>
              <ul class="nav nav-pills nav-pills">
                  <li class="active"><a href="#jadwal-pertandingan-sekarang" data-toggle="tab">Jadwal Pertandingan Sekarang</a></li>
                  <li><a href="#jadwal-pertandingan-selesai" data-toggle="tab">Jadwal Pertandingan Selesai</a></li>
              </ul>
              <div class="tab-content">
                  <div class="tab-pane active" id="jadwal-pertandingan-sekarang">
                      <div class="form-group row">
                        <div class="col-sm-3">
                            <div class="input-group" style="margin-bottom: 6px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Nama Pesilat">
                            </div>
                        </div>
                        <div class="col-sm-2">
                          <select class="form-control" name="gelanggang" id="gelanggang" style="margin-bottom: 6px;">
                            <option value="">-- Pilih Gelanggang --</option>
                            <option value="">Semua</option>
                            <?php foreach ($gelanggang as $key => $glg): ?>
                              <option value="<?php echo $glg['gelanggang'] ?>"><?php echo $glg['gelanggang'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <button type="button" style="margin-bottom: 12px;" name="button" class="btn btn-primary" onclick="get_data()"><i class="fa fa-search" style="margin-right: 4px;"></i> Cari</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="table-data">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gelanggang</th>
                                        <th>Partai</th>
                                        <th>Kelompok</th>
                                        <th class="th-biru">Sudut Biru</th>
                                        <th class="th-merah">Sudut Merah</th>
                                        <th class="th-kuning">Skor Sudut Biru</th>
                                        <th class="th-kuning">Skor Sudut Merah</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-10">
                            <div id="pagination"></div>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="select-show-data" onchange="pagination()">
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane" id="jadwal-pertandingan-selesai">
                      <div class="form-group row">
                        <div class="col-sm-3">
                            <div class="input-group" style="margin-bottom: 6px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search" id="search-tanding-selesai" class="form-control" placeholder="Cari Nama Pesilat">
                            </div>
                        </div>
                        <div class="col-sm-2">
                          <select class="form-control" name="gelanggang" id="gelanggang-tanding-selesai" style="margin-bottom: 6px;">
                            <option value="">-- Pilih Gelanggang --</option>
                            <option value="">Semua</option>
                            <?php foreach ($gelanggang as $key => $glg): ?>
                              <option value="<?php echo $glg['gelanggang'] ?>"><?php echo $glg['gelanggang'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <button type="button" style="margin-bottom: 12px;" name="button" class="btn btn-primary" onclick="get_data_tanding_selesai()"><i class="fa fa-search" style="margin-right: 4px;"></i> Cari</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="table-data-tanding-selesai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gelanggang</th>
                                        <th>Partai</th>
                                        <th>Kelompok</th>
                                        <th class="th-biru">Sudut Biru</th>
                                        <th class="th-merah">Sudut Merah</th>
                                        <th class="th-kuning">Skor Sudut Biru</th>
                                        <th class="th-kuning">Skor Sudut Merah</th>
                                        <th>Pemenang</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-10">
                            <div id="pagination-tanding-selesai"></div>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="select-show-data-tanding-selesai" onchange="pagination_tanding_selesai()">
                              <option value="20">20</option>
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
    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->

<script>
    $(document).ready(function() {
        get_data()
        get_data_tanding_selesai()
    })

    // jadwal pertandingan sekarang
    function get_data() {
        let search = $(`#search`).val()
        let gelanggang = $(`#gelanggang`).val()
        let count_col = $(`#table-data thead tr th`).length

        $.ajax({
            url: '<?= base_url('pertandingan/jadwal_pertandingan_tanding/get_data') ?>',
            method: 'GET',
            data: {search, gelanggang},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {

                    tr += `
                      <tr>
                          <td class="text-center" scope="row" rowspan="2">${++no}</td>
                          <td rowspan="2" class="text-center">${item.gelanggang}</td>
                          <td rowspan="2" class="text-center">${item.no_partai}</td>
                          <td rowspan="2" class="text-center">${item.kelas_tanding} ${item.kategori == 'kelas' ? item.kelas : item.golongan}</td>
                          <td class="td-biru">${item.nama_pesilat_biru}</td>
                          <td class="td-merah">${item.nama_pesilat_merah}</td>
                          <td rowspan="2" class="text-center">${item.nilai_sudut_biru}</td>
                          <td rowspan="2" class="text-center">${item.nilai_sudut_merah}</td>
                          <td class="text-center" rowspan="2">
                              <div class="btn-group">
                                  <button class="btn btn-warning btn-sm" style="margin-right: 5px;" type="button" onclick="pencatat_waktu_data(${item.id})" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-clock-o"></i> Pencatat Waktu</button>
                                  <button class="btn btn-info btn-sm" style="margin-right: 5px;" type="button" onclick="monitor_data(${item.id})" data-toggle="tooltip" data-original-title="Monitor"><i class="fa fa-area-chart"></i> Nilai Tanding</button>
                                  <button class="btn btn-success btn-sm" style="margin-right: 5px;" type="button" onclick="dewan_data(${item.id})" data-toggle="tooltip" data-original-title="Monitor"><i class="fa fa-odnoklassniki"></i> Dewan</button>
                                  <button class="btn btn-danger btn-sm" style="margin-right: 5px;" type="button" onclick="monitoring_nilai(${item.id})" data-toggle="tooltip" data-original-title="Monitor"><i class="fa fa-tv"></i> Monitoring Nilai</button>
                              </div>
                          </td>
                      </tr>
                      <tr>
                        <td style="border-right: 1px solid #DBE0E4;" class="td-biru">${item.kontingen_biru}</td>
                        <td style="border-right: 1px solid #DBE0E4;" class="td-merah">${item.kontingen_merah}</td>
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
        var jumlah_tampil = $(`#select-show-data`).val() || 20;
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

    // jadwal pertandingan selesai
    function get_data_tanding_selesai() {
        let search = $(`#search-tanding-selesai`).val()
        let gelanggang = $(`#gelanggang-tanding-selesai`).val()
        let count_col = $(`#table-data-tanding-selesai thead tr th`).length

        $.ajax({
            url: '<?= base_url('pertandingan/jadwal_pertandingan_tanding/get_data_tanding_selesai') ?>',
            method: 'GET',
            data: {search, gelanggang},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data-selesai tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {

                    status_undur_diri_biru = ''
                    status_undur_diri_merah = ''

                    if(item.sudut_undur_diri == 'Biru') {
                      status_undur_diri_biru = '<br> <span class="badge badge-danger">Undur Diri</span>'
                    } else if(item.sudut_undur_diri == 'Merah') {
                      status_undur_diri_merah = '<br> <span class="badge badge-danger">Undur Diri</span>'
                    }

                    tr += `
                      <tr>
                          <td class="text-center" scope="row" rowspan="2">${++no}</td>
                          <td rowspan="2" class="text-center" >${item.gelanggang}</td>
                          <td rowspan="2" class="text-center" >${item.no_partai}</td>
                          <td rowspan="2" class="text-center" >${item.kelas_tanding} ${item.kategori == 'kelas' ? item.kelas : item.golongan}</td>
                          <td class="td-biru">
                            ${item.nama_pesilat_biru}
                            ${status_undur_diri_biru}
                          </td>
                          <td class="td-merah">
                            ${item.nama_pesilat_merah}
                            ${status_undur_diri_merah}
                          </td>
                          <td rowspan="2" class="text-center">${item.nilai_sudut_biru}</td>
                          <td rowspan="2" class="text-center">${item.nilai_sudut_merah}</td>
                          <td rowspan="2" class="text-center">${item.pemenang}</td>
                          <td class="text-center" rowspan="2">
                              <div class="btn-group">
                                  <button class="btn btn-warning btn-sm" style="margin-right: 5px;" type="button" onclick="pencatat_waktu_data(${item.id})" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-clock-o"></i> Pencatat Waktu</button>
                                  <button class="btn btn-info btn-sm" style="margin-right: 5px;" type="button" onclick="monitor_data(${item.id})" data-toggle="tooltip" data-original-title="Monitor"><i class="fa fa-area-chart"></i> Nilai Tanding</button>
                                  <button class="btn btn-success btn-sm" style="margin-right: 5px;" type="button" onclick="dewan_data(${item.id})" data-toggle="tooltip" data-original-title="Monitor"><i class="fa fa-odnoklassniki"></i> Ketua</button>
                                  <button class="btn btn-danger btn-sm" style="margin-right: 5px;" type="button" onclick="monitoring_nilai(${item.id})" data-toggle="tooltip" data-original-title="Monitor"><i class="fa fa-tv"></i> Monitoring Nilai</button>
                              </div>
                          </td>
                      </tr>
                      <tr>
                        <td style="border-right: 1px solid #DBE0E4;" class="td-biru">${item.kontingen_biru}</td>
                        <td style="border-right: 1px solid #DBE0E4;" class="td-merah">${item.kontingen_merah}</td>
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

                $(`#table-data-tanding-selesai tbody`).html(tr)
                pagination_tanding_selesai()
            }
        })

        $('#search-tanding-selesai').off('keyup').keyup(function(){
            get_data_tanding_selesai()
      	})
    }

    function pagination_tanding_selesai() {
        var jumlah_tampil = $(`#select-show-data-tanding-selesai`).val() || 20;
        if(typeof $selector == 'undefined')
        {
            $selector = $("#table-data-tanding-selesai tbody tr");
        }
        window.tp = new Pagination('#pagination-tanding-selesai', {
            itemsCount:$("#table-data-selesai tbody tr").length,
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

    function pencatat_waktu_data(id) {
      window.open('<?php echo base_url(); ?>pertandingan/pencatat_waktu/index/'+id, '_blank')
    }

    function monitor_data(id) {
      window.open('<?php echo base_url(); ?>pertandingan/monitor_tanding/index/'+id, '_blank')
    }

    function dewan_data(id) {
      window.open('<?php echo base_url(); ?>pertandingan/dewan_tanding/index/'+id, '_blank')
    }

    function monitoring_nilai(id) {
      window.open('<?php echo base_url(); ?>pertandingan/monitoring_nilai/index/'+id, '_blank')
    }
</script>
