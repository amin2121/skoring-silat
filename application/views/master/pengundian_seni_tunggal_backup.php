<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li class="active">Pengundian Pool Peserta Seni</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pengundian Pool Peserta Seni</h3>
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
            <div class="col-sm-2 mr-3">
              <!-- <label for=""></label> -->
              <input type="text" style="margin-top:7px;" placeholder="Peserta Perpool" id="peserta_perpool" name="peserta_perpool">
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
            <h3 class="panel-title">Hasil Pengundian Pool Peserta Seni</h3>
        </div>
        <div class="panel-body">
            <div id="card_undi">
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
    let search = $(`#search`).val();
    let golongan = $('#golongan').val();
    let kelas = $('#kelas').val();
    let jenis_kelamin = $('#jenis_kelamin').val();
    let id_kelas_tanding = $('#id_kelas_tanding').val();
    let id_kompetisi = $('#id_kompetisi').val();

    $.ajax({
        url: '<?= base_url('master/pengundian_seni_tunggal/get_data') ?>',
        method: 'GET',
        data: { search, golongan, kelas, jenis_kelamin, id_kelas_tanding, id_kompetisi },
        dataType: 'json',
        success: function (res) {
            console.log(res);  // Debug: log the response to console
            let cards = '';
            if (Object.keys(res).length > 0) {
                let id_undian_tanding = [];
                
                for (let pool in res) {
                    cards += `<div class="card" style="width: 18rem; margin-bottom: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title">Pool ${pool}</h5>
                                    <ul class="list-group">`;
                    
                    res[pool].forEach(item => {
                        cards += `<li class="list-group-item">${item.nama_lengkap}</li>`;
                        id_undian_tanding.push(item.id_peserta);
                    });
                    
                    cards += `</ul></div></div>`;
                }

                $(`#id_undian_tanding`).val(id_undian_tanding.toString());
            } else {
                cards = '<div class="text-center text-muted"><span style="display: block; padding: 12px;">Data Belum Ada, Tambahkan Data</span></div>';
            }
            cards += `</ul></div></div>`;
        

                // $(`#id_undian_tanding`).val(id_undian_tanding.toString());
            // } else {
            //     cards = '<div class="text-center text-muted"><span style="display: block; padding: 12px;">Data Belum Ada, Tambahkan Data</span></div>';
            // }

            $('#card_undi').html(cards);
        }
    });

    $('#search').off('keyup').keyup(function () {
        get_data();
    });
}



    function undi(){
      let golongan = $('#golongan').val()
      let peserta_perpool = $('#peserta_perpool').val()
      let kelas = $('#kelas').val()
      let jenis_kelamin = $('#jenis_kelamin').val()
      let id_kelas_tanding = $('#id_kelas_tanding').val()
      let id_kompetisi = $('#id_kompetisi').val()
      let count_col = $(`#table-data-peserta-undian thead tr th`).length

      $.ajax({
          url: '<?= base_url('master/pengundian_seni_tunggal/undi') ?>',
          method: 'GET',
          data: {golongan, peserta_perpool, kelas, jenis_kelamin, id_kelas_tanding, id_kompetisi},
          dataType: 'json',
          success: function (res) {
            alert(res.message)
            // get_data()
          }
      })
    }

    function edit_data(id) {
      window.location.href = '<?php echo base_url(); ?>master/pengundian_seni_tunggal/view_edit/'+id
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
        url: '<?php echo base_url('master/pengundian_seni_tunggal/hapus_semua_undian') ?>',
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
