<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Peserta</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Peserta</h3>
            <div class="panel-elements pull-right">
              <a href="<?php echo base_url(); ?>master/peserta/view_tambah"><button class="btn btn-sm btn-primary"><i class=""></i>Tambah</button></a>
              <button class="btn btn-sm btn-info" onclick="show_modal_import()" style="margin-left: 4px;"><i class=""></i>Import Excel</button>
            </div>
        </div>
        <div class="panel-body">
          <div class="form-group row">
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" name="search" id="search" class="form-control">
                </div>
              </div>
            <div class="col-sm-2">
              <select class="form-control" name="id_kompetisi" id="id_kompetisi" onchange="ubah_kategori_by_kompetisi()">
                <?php foreach ($kompetisi as $km): ?>
                  <option value="<?php echo $km['id']; ?>" <?php echo $km['status'] == 1 ? 'selected' : '' ?> data-kategori="<?php echo $km['kategori'] ?>"><?php echo $km['kompetisi']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-2" id="form-golongan">
              <select class="form-control" name="golongan" id="golongan">
                <option value="semua">-- Pilih Golongan --</option>
                <option value="semua">Semua</option>
                <option value="Pra Usia Dini">Pra Usia Dini</option>
                <option value="Usia Dini">Usia Dini</option>
                <option value="Pra Remaja">Pra Remaja</option>
                <option value="Remaja">Remaja</option>
                <option value="Dewasa">Dewasa</option>
              </select>
            </div>
            <div class="col-sm-2" id="form-kelas" style="display: none;">
              <select class="form-control" name="kelas" id="kelas">
                <option value="semua">-- Pilih Kelas --</option>
                <option value="semua">Semua</option>
                <option value="TK">TK</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="MAHASISWA">MAHASISWA</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                <option value="semua">-- Pilih Jenis Kelamin --</option>
                <option value="semua">Semua</option>
                <option value="putra">Putra</option>
                <option value="putri">Putri</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="id_kelas_tanding" id="id_kelas_tanding">
                <option value="semua">-- Pilih Kelas Tanding --</option>
                <option value="semua">Semua</option>
                <?php foreach ($kelas_tanding as $kt): ?>
                  <option value="<?php echo $kt['id']; ?>"><?php echo $kt['kelas_tanding']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-2">
              <button class="btn btn-success" onclick="get_data()" type="button">Cari</button>
            </div>
          </div>
          <table class="table table-hover table-bordered" id="table-data">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Peserta</th>
                      <th class="text-center">Kelas Tanding</th>
                      <th class="text-center">Golongan/Kelas</th>
                      <th class="text-center">Kontingen</th>
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

  <!-- MODAL DETAIL -->
  <button type="button" data-toggle="modal" data-target="#modal-import-data" style="display: none;" id="btn-show-modal-import-data"></button>
  <div class="modal fade" id="modal-import-data" tabindex="-1" role="dialog" aria-labelledby="modal-warning-header">
    <div class="modal-dialog modal-info" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">Import Peserta</h4>
            </div>
            <form class="" action="<?php echo base_url('master/peserta/import_excel') ?>" id="form-import-excel" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="kompetisi">Kompetisi</label>
                  <select class="form-control" name="id_kompetisi" id="id_kompetisi_import">
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
                      <a class="btn btn-info" href="<?= base_url('storage/template/template-excel-peserta.xlsx') ?>" download="Template Excel Peserta.xlsx"><i class="fa fa-download"></i> Download Template Excel</a>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" id="btn-import-excel" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
              </div>
            </form>
        </div>
    </div>
  </div>
  <!-- MODAL DETAIL -->

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


    <!-- MODAL DETAIL -->
    <button type="button" data-toggle="modal" data-target="#modal-detail-data" style="display: none;" id="btn-show-modal-detail-data"></button>
    <div class="modal fade" id="modal-detail-data" tabindex="-1" role="dialog" aria-labelledby="modal-warning-header">
      <div class="modal-dialog modal-warning modal-lg" role="document">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="modal-success-header">Detail</h4>
              </div>
              <div class="modal-body">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#data-detail" data-toggle="tab">Data</a></li>
                    <li><a href="#gambar-detail" data-toggle="tab">Gambar</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="data-detail">
                      <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kategori</label>
                            <div class="col-md-4">
                                <input type="text" name="kategori_tanding" id="kategori_tanding" readonly class="form-control">
                            </div>
                            <label class="col-md-2 control-label">Golongan</label>
                            <div class="col-md-4">
                                <input type="text" name="golongan" id="detail_golongan" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nama Lengkap</label>
                            <div class="col-md-4">
                                <input type="text" name="nama_lengkap" id="nama_lengkap" readonly class="form-control">
                            </div>
                            <label class="col-md-2 control-label">Tanggal Lahir</label>
                            <div class="col-md-4">
                                <input type="text" name="tanggal_lahir" id="tanggal_lahir" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Jenis Kelamin</label>
                            <div class="col-md-4">
                                <input type="text" name="jenis_kelamin" id="detail_jenis_kelamin" readonly class="form-control">
                            </div>
                            <label class="col-md-2 control-label">Tinggi Badan</label>
                            <div class="col-md-4">
                                <input type="text" name="tinggi_badan" id="tinggi_badan" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Berat Badan</label>
                            <div class="col-md-4">
                                <input type="text" name="berat_badan" id="berat_badan" readonly class="form-control">
                            </div>
                            <label class="col-md-2 control-label">Asal Sekolah</label>
                            <div class="col-md-4">
                                <input type="text" name="asal_sekolah" id="asal_sekolah" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kelas</label>
                            <div class="col-md-4">
                                <input type="text" name="kelas" id="detail_kelas" readonly class="form-control">
                            </div>
                            <label class="col-md-2 control-label">Kelas Tanding</label>
                            <div class="col-md-4">
                                <input type="text" name="kelas_tanding" id="kelas_tanding" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kontingen</label>
                            <div class="col-md-10">
                                <input type="text" name="kontingen" id="kontingen" readonly class="form-control">
                            </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="gambar-detail">
                      <div class="row" id="detail-data-gambar">
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>
    <!-- MODAL DETAIL -->

</div>
<!-- END PAGE CONTAINER -->

<script>
    $(document).ready(function() {
        get_data()
        ubah_kategori_by_kompetisi()

        $(`#btn-import-excel`).on('click', function() {
          let id_kompetisi = $(`#id_kompetisi_import`).val()
          if(id_kompetisi == '') {
            alert('Pilih Kompetisi Terlebih Dahulu')
          } else {
            $(`#form-import-excel`).submit()
          }
        })
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

    function show_modal_import() {
      $(`#btn-show-modal-import-data`).click()
    }

    function get_data() {
        let search = $(`#search`).val()
        let id_kompetisi = $(`#id_kompetisi`).val()
        let golongan = $(`#golongan`).val()
        let kelas = $(`#kelas`).val()
        let jenis_kelamin = $(`#jenis_kelamin`).val()
        let id_kelas_tanding = $(`#id_kelas_tanding`).val()
        let count_col = $(`#table-data thead tr th`).length

        $.ajax({
            url: '<?= base_url('master/peserta/get_data') ?>',
            method: 'GET',
            data: {search, id_kompetisi, golongan, kelas, jenis_kelamin, id_kelas_tanding},
            dataType: 'json',
            beforeSend: function() { show_loading_table('#table-data tbody', count_col); },
            success: function (res) {
                let tr = ''
                if(res.length > 0) {
                  let no = 0
                  for(const item of res) {

                    let jenis_kelamin = '<span class="badge badge-info">Putra</span>'
                    if(item.jenis_kelamin == 'putri') {
                      jenis_kelamin = '<span class="badge badge-danger">Putri</span>'
                    }

                    tr += `
                      <tr>
                          <th class="text-center" scope="row">${++no}</th>
                          <td>
                            ${item.nama_lengkap} <br>
                            ${jenis_kelamin}
                          </td>
                          <td class="text-center">${item.kelas_tanding}</td>
                          <td class="text-center">${item.kategori == 'kelas' ? item.kelas : item.golongan}</td>
                          <td class="text-center">${item.kontingen}</td>
                          <td class="text-center">
                              <div class="btn-group" style="display: flex; gap: 6px; justify-content: center;">
                                  <button class="btn btn-warning btn-sm" type="button" onclick="detail_data(${item.id})" data-toggle="tooltip" data-original-title="Detail"><i class="fa fa-eye"></i></button>
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

        // $('#search').off('keyup').keyup(function(){
        //     get_data()
      	// })
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
      window.location.href = '<?php echo base_url(); ?>master/peserta/view_edit/'+id
    }

    function hapus_data(id) {
      $(`#btn-show-modal-hapus-data`).click()
      $('#id_hapus_data').val(id)
    }

    function hapus(){
      let id = $('#id_hapus_data').val()
      $.ajax({
        url: '<?php echo base_url('master/peserta/hapus') ?>',
        method: 'GET',
        data: {id},
        dataType: 'json',
        success: function (res) {
          $('#btn-tutup-modal-hapus-data').click()
          get_data()
        }
      })
    }

    function detail_data(id){
      $(`#btn-show-modal-detail-data`).click()
      $.ajax({
          url: '<?= base_url('master/peserta/detail_data') ?>',
          method: 'GET',
          data: {id},
          dataType: 'json',
          success: function (data) {
            $('#kategori_tanding').val(data.kategori_tanding)
            $('#detail_golongan').val(data.golongan)
            $('#nama_lengkap').val(data.nama_lengkap)
            $('#tanggal_lahir').val(data.tanggal_lahir)
            $('#detail_jenis_kelamin').val(data.jenis_kelamin)
            $('#tinggi_badan').val(data.tinggi_badan)
            $('#berat_badan').val(data.berat_badan)
            $('#asal_sekolah').val(data.asal_sekolah)
            $('#detail_kelas').val(data.kelas)
            $('#kelas_tanding').val(data.kelas_tanding)
            $('#kontingen').val(data.kontingen)

            let gambar_foto_peserta = `<div class="col-md-4 col-ms-4">
                                           <div class="tile-basic">
                                               <a href="#" class="tile-image tile-image-padding tile-image-hover-grayscale preview" data-preview-image="<?php echo base_url(); ?>storage/peserta/${data.foto_peserta}" data-preview-size="modal-lg">
                                                   <img src="<?php echo base_url(); ?>storage/peserta/${data.foto_peserta}" alt="">
                                               </a>
                                               <div class="tile-content tile-content-condensed-bottom text-center">
                                                   <h5 class="tile-title">Foto Peserta</h5>
                                               </div>
                                           </div>
                                       </div>`
            let gambar_scan_akta_kelahiran = `<div class="col-md-4 col-ms-4">
                                                 <div class="tile-basic">
                                                     <a href="#" class="tile-image tile-image-padding tile-image-hover-grayscale preview" data-preview-image="<?php echo base_url(); ?>storage/akta_kelahiran/${data.foto_akta_kelahiran}" data-preview-size="modal-lg">
                                                         <img src="<?php echo base_url(); ?>storage/akta_kelahiran/${data.akta_kelahiran}" alt="">
                                                     </a>
                                                     <div class="tile-content tile-content-condensed-bottom text-center">
                                                         <h5 class="tile-title">Akta Kelahiran</h5>
                                                     </div>
                                                 </div>
                                             </div>`
            let gambar_scan_ijazah = `<div class="col-md-4 col-ms-4">
                                         <div class="tile-basic">
                                             <a href="#" class="tile-image tile-image-padding tile-image-hover-grayscale preview" data-preview-image="<?php echo base_url(); ?>storage/ijazah/${data.foto_ijazah}" data-preview-size="modal-lg">
                                                 <img src="<?php echo base_url(); ?>storage/ijazah/${data.ijazah}" alt="">
                                             </a>
                                             <div class="tile-content tile-content-condensed-bottom text-center">
                                                 <h5 class="tile-title">Ijazah</h5>
                                             </div>
                                         </div>
                                     </div>`

            $(`#detail-data-gambar`).empty()
            if(data.foto_peserta != 'default.jpg' && data.foto_peserta != null) {
              $('#detail-data-gambar').append(gambar_foto_peserta)
            }

            if(data.akta_kelahiran != 'default.jpg' && data.akta_kelahiran != null) {
              $('#detail-data-gambar').append(gambar_scan_akta_kelahiran)
            }

            if(data.ijazah != 'default.jpg' && data.ijazah != null) {
              $('#detail-data-gambar').append(gambar_scan_ijazah)
            }

          }
      })
    }
</script>
