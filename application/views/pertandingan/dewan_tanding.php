<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" type="image/x-icon">
    <title>Halaman Dewan</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_pertandingan/css/style.css">

    <link rel="stylesheet" href="<?php echo base_url('assets_pertandingan/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets_pertandingan/bootstrap-icons/font/bootstrap-icons.css'); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets_pertandingan/js/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/sweetalert2/sweetalert2.min.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url(); ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets_pertandingan/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body style="background-color: #000;">
<style>
  .content {
    /* background-color: #ADBC9F; */
    background-color: #000;
  }

  .judul, .gelanggang, .pesilat-merah p, .pesilat-biru p {
    color: #ffffff;
  }

  .partai-selanjutnya, .wrap-score-peringatan, .wrap-score-teguran, .wrap-score-binaan, .wrap-score-jatuhan, .score-tendangan, .judull-round, .judul-round {
    background-color: #ffffff;
  }

  .selected-btn {
      background-color: yellow;
      border-color: yellow;
      color: black;
      font-weight: bold;
    }
  </style>
    <div class="dewan">
        <header class="header-nav">
            <div class="container-logo"><img src="<?php echo base_url('assets_pertandingan/image/ipsi.png') ?>" alt="IPSI" class="logo-ipsi"/></div>
            <div class="header-nav__content">
              <h3><?php echo $j_tanding['kompetisi'] ?></h3>
              <div class="informasi-pertandingan">
                <h5>Gel <?php echo $j_tanding['gelanggang']; ?> - Partai <?php echo $j_tanding['no_partai']; ?></h5>
                <h5><?php echo $j_tanding['babak']; ?></h5>
                <h5>Tanding - <?php echo $j_tanding['kelas_tanding']; ?></h5>
              </div>
            </div>
            <div class="container-logo"><img src="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" alt="TAPAK SUCI" class="logo-tapak-suci"/></div>
        </header>
        <div class="content" style="padding-top: 1rem; padding-bottom: 1rem; padding-right: 6px; padding-left: 6px;">
            <a href="<?php echo base_url() ?>pertandingan/jadwal_pertandingan_tanding" class="btn btn-kembali">Kembali</a>
            <h1 class="judul" style="text-align: center;">Dewan Pertandingan</h1>
            <h3 class="gelanggang">Gelanggan <?php echo $j_tanding['gelanggang'] ?></h3>
            <div class="info-pesilat">
                <div class="pesilat-biru">
                    <h5><?php echo $j_tanding['nama_pesilat_biru'] ?></h5>
                    <p><?php echo $j_tanding['kontingen_biru'] ?></p>
                </div>
                <div class="pesilat-merah">
                    <h5><?php echo $j_tanding['nama_pesilat_merah'] ?></h5>
                    <p><?php echo $j_tanding['kontingen_merah'] ?></p>
                </div>
            </div>

            <div class="content-dewan">
                <div class="pesilat-biru">
                    <div class="wrap-judul-score-biru">
                        <p class="judul-score-biru">
                            Peringatan
                        </p>
                        <p class="judul-score-biru">
                            Teguran
                        </p>
                        <p class="judul-score-biru">
                            Binaan
                        </p>
                        <p class="judul-score-biru">
                            Jatuhan
                        </p>
                    </div>
                    <div class="wrap-nilai-score-biru">
                        <div class="nilai-score-biru" id="ronde-1-biru">
                            <div class="wrap-score-peringatan">

                            </div>
                            <div class="wrap-score-teguran">

                            </div>
                            <div class="wrap-score-binaan">
                              <span>0</span>
                            </div>
                            <div class="wrap-score-jatuhan">

                            </div>
                        </div>
                        <div class="nilai-score-biru" id="ronde-2-biru">
                            <div class="wrap-score-peringatan">

                            </div>
                            <div class="wrap-score-teguran">

                            </div>
                            <div class="wrap-score-binaan">
                              <span>0</span>
                            </div>
                            <div class="wrap-score-jatuhan">

                            </div>
                        </div>
                        <div class="nilai-score-biru" id="ronde-3-biru">
                            <div class="wrap-score-peringatan">

                            </div>
                            <div class="wrap-score-teguran">

                            </div>
                            <div class="wrap-score-binaan">
                              <span>0</span>
                            </div>
                            <div class="wrap-score-jatuhan">

                            </div>
                        </div>
                    </div>

                    <div class="aksi-tombol-biru">
                        <div class="tombol-kiri">
                            <button class="btn btn-pukul" id="btn-jatuhan-biru" style="cursor: pointer; width:150px;" onclick="klik_jatuhan('Biru')">Jatuhan <img src="<?php echo base_url(); ?>assets_pertandingan/image/jatuhan.png" alt="jatuhan" style="width: 35px;"></button>
                            <button class="btn btn-tendang" id="btn-binaan-biru" style="cursor: pointer; width:150px; margin-top:10px;" onclick="klik_binaan('Biru')">Binaan &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/binaan-1.svg" alt="binaan-1" style="width: 25px;"></button>
                        </div>
                        <div class="tombol-kiri">
                            <button class="btn btn-pukul" id="btn-teguran-biru" style="cursor: pointer; width:150px;" onclick="klik_teguran('Biru')">Teguran &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/teguran-1.svg" alt="teguran-1" style="width: 15px;"></button>
                            <button class="btn btn-tendang" id="btn-peringatan-biru" style="cursor: pointer; width:150px; margin-top:10px;" onclick="klik_peringatan('Biru')">Peringatan <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal2.png" alt="peringatan" style="width: 25px;"></button>
                        </div>
                        <div class="tombol-kanan">
                            <button class="btn btn-hapus-score" id="btn-hapus-nilai-biru" style="cursor: pointer;" onclick="klik_hapus_nilai('Biru')">Hapus Nilai Terakhir</button>
                        </div>
                    </div>
                </div>
                <div class="round">
                    <p class="judul-round">Ronde</p>
                    <div class="judull-round">
                        <div class="item-round" id="round-1">I</div>
                        <div class="item-round" id="round-2">II</div>
                        <div class="item-round" id="round-3">III</div>
                    </div>
                    <div class="aksi-tombol-tengah">
                      <button class="btn btn-verifikasi" id="btn-verifikasi" style="cursor: pointer;" onclick="klik_verifikasi_juri()">Verifikasi Juri</button>
                      <button class="btn btn-partai-selanjutnya" id="btn-partai-selanjutnya" style="cursor: pointer;" onclick="selesai_pertandingan()">Partai Selanjutnya</button>
                      <button class="btn btn-undur-diri" id="btn-undur-diri" style="cursor: pointer;" onclick="show_modal_undur_diri()">Undur Diri</button>
                    </div>
                </div>
                <div class="pesilat-merah">

                    <div class="wrap-judul-score-merah">
                        <p class="judul-score-merah">
                            Peringatan
                        </p>
                        <p class="judul-score-merah">
                            Teguran
                        </p>
                        <p class="judul-score-merah">
                            Binaan
                        </p>
                        <p class="judul-score-merah">
                            Jatuhan
                        </p>
                    </div>
                    <div class="wrap-nilai-score-merah">
                        <div class="nilai-score-merah" id="ronde-1-merah">
                            <div class="wrap-score-peringatan">

                            </div>
                            <div class="wrap-score-teguran">

                            </div>
                            <div class="wrap-score-binaan">
                              <span>0</span>
                            </div>
                            <div class="wrap-score-jatuhan">

                            </div>
                        </div>
                        <div class="nilai-score-merah" id="ronde-2-merah">
                            <div class="wrap-score-peringatan">

                            </div>
                            <div class="wrap-score-teguran">

                            </div>
                            <div class="wrap-score-binaan">
                              <span>0</span>
                            </div>
                            <div class="wrap-score-jatuhan">

                            </div>
                        </div>
                        <div class="nilai-score-merah" id="ronde-3-merah">
                            <div class="wrap-score-peringatan">

                            </div>
                            <div class="wrap-score-teguran">

                            </div>
                            <div class="wrap-score-binaan">
                              <span>0</span>
                            </div>
                            <div class="wrap-score-jatuhan">

                            </div>
                        </div>
                    </div>

                    <div class="aksi-tombol-merah">
                        <div class="tombol-kiri">
                            <button class="btn btn-hapus-score" id="btn-hapus-nilai-merah" style="cursor: pointer;" onclick="klik_hapus_nilai('Merah')">Hapus Nilai Terakhir</button>
                        </div>
                        <div class="tombol-kanan">
                            <button class="btn btn-pukul" id="btn-teguran-merah" style="cursor: pointer; width:150px;" onclick="klik_teguran('Merah')">Teguran &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/teguran-1.svg" alt="teguran-1" style="width: 15px;"></button>
                            <button class="btn btn-tendang" id="btn-peringatan-merah" style="cursor: pointer; width:150px; margin-top:10px;" onclick="klik_peringatan('Merah')">Peringatan &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/signal2.png" alt="peringatan" style="width: 25px;"></button>
                        </div>
                        <div class="tombol-kanan">
                            <button class="btn btn-pukul" id="btn-jatuhan-merah" style="cursor: pointer; width:150px;" onclick="klik_jatuhan('Merah')">Jatuhan <img src="<?php echo base_url(); ?>assets_pertandingan/image/jatuhan.png" alt="jatuhan" style="width: 35px;"></button>
                            <button class="btn btn-tendang" id="btn-binaan-merah" style="cursor: pointer; width:150px; margin-top:10px;" onclick="klik_binaan('Merah')">Binaan &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/binaan-1.svg" alt="binaan-1" style="width: 25px;"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="input-jadwal-pertandingan" value="<?php echo $j_tanding['id']; ?>">
    <input type="hidden" id="input-gelanggang" value="<?php echo $j_tanding['gelanggang']; ?>">
    <input type="hidden" id="input-no-partai" value="<?php echo $j_tanding['no_partai']; ?>">
    <input type="hidden" id="input-status-selesai-pertandingan" value="<?php echo $j_tanding['status_selesai_pertandingan']; ?>">
    <input type="hidden" id="input-round">

    <!-- Modal Pilih Verifikasi Juri -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pilih-verifikasi" id="btn-show-modal-pilih-verifikasi" style="display: none;">
      Click
    </button>

    <div class="modal fade" id="pilih-verifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Verifikasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-pilih-verifikasi">
            <div class="modal-body text-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilih_verifikasi" id="pilih-jatuhan" value="jatuhan" checked>
                <label class="form-check-label" for="pilih-jatuhan" style="cursor: pointer;">
                  Jatuhan
                </label>
              </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilih_verifikasi" id="pilih-hukuman" value="hukuman">
                <label class="form-check-label" for="pilih-hukuman" style="cursor: pointer;">
                  Hukuman
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Pilih Verifikasi Juri -->

    <!-- Modal Hasil Verifikasi Juri -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hasil-verifikasi" id="btn-show-modal-hasil-verifikasi" style="display: none;">
      Click
    </button>

    <div class="modal fade" id="hasil-verifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hasil Verifikasi Juri</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-hasil-verifikasi">
            <div class="modal-body">
              <ul class="list-group" id="list-group-hasil-verifikasi"></ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Hasil Verifikasi Juri -->

    <!-- Modal Hasil Verifikasi Juri -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#partai-selanjutnya" id="btn-show-modal-partai-selanjutnya" style="display: none;">
      Click
    </button>

    <div class="modal fade" id="partai-selanjutnya" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Partai Selanjutnya</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered" id="table-partai">
              <thead>
                <tr>
                  <th class="text-center">No Partai</th>
                  <th class="text-center">Gelanggang</th>
                  <th class="th-biru">Sudut Biru</th>
                  <th class="th-merah">Sudut Merah</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Hasil Verifikasi Juri -->

    <!-- Modal Undur Diri -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#undur-diri" id="btn-show-undur-diri" style="display: none;">
      Click
    </button>

    <div class="modal fade" id="undur-diri" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Undur Diri Pesilat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-undur-diri-pesilat">
            <div class="modal-body">
              <div class="form-group mb-3">
                  <label for="">PESILAT</label>
                  <div class="">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input radio-sudut-biru" type="radio" name="pesilat_mundur" id="input-sudut-biru" value="Biru" checked>
                      <label class="form-check-label" for="input-sudut-biru" style="cursor: pointer;">
                        <span class="span-label-sudut-biru">SUDUT BIRU</span>
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input radio-sudut-merah" type="radio" name="pesilat_mundur" id="input-sudut-merah" value="Merah">
                      <label class="form-check-label" for="input-sudut-merah" style="cursor: pointer;">
                        <span class="span-label-sudut-merah">SUDUT MERAH</span>
                      </label>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="input-alasan mb-3">ALASAN</label>
                <button type="button" class="btn btn-secondary d-block w-100 mb-2" onclick="selectRadio('WMP', this)">WMP</button>
                <button type="button" class="btn btn-secondary d-block w-100 mb-2" onclick="selectRadio('MENANG MUTLAK', this)">MENANG MUTLAK</button>
                <button type="button" class="btn btn-secondary d-block w-100 mb-2" onclick="selectRadio('MENANG TEKNIK', this)">MENANG TEKNIK</button>
                <button type="button" class="btn btn-secondary d-block w-100 mb-2" onclick="selectRadio('DIDISKUALIFIKASI', this)">DIDISKUALIFIKASI</button>
              </div>
              <div class="form-group" style="display:none;s">
                <!-- <textarea name="alasan" id="input-alasan" rows="2" class="form-control"></textarea> -->
                <div class="form-check" style="margin-top:5px;">
                  <input class="form-check-input" type="radio" name="alasan" id="flexRadioDefault1" style="cursor: pointer;" value="WMP">
                </div>
                <div class="form-check" style="margin-top:5px;">
                  <input class="form-check-input" type="radio" name="alasan" id="flexRadioDefault2" style="cursor: pointer;" value="MENANG MUTLAK">
                </div>
                <div class="form-check" style="margin-top:5px;">
                  <input class="form-check-input" type="radio" name="alasan" id="flexRadioDefault3" style="cursor: pointer;" value="MENANG TEKNIK">
                </div>
                <div class="form-check" style="margin-top:5px;">
                  <input class="form-check-input" type="radio" name="alasan" id="flexRadioDefault4" style="cursor: pointer;" value="DIDISKUALIFIKASI">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Undur Diri -->

    <script src="<?php echo base_url(); ?>assets/js/cleave-js/dist/cleave.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_pertandingan/js/toastr/build/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

        $(document).ready(function() {
          get_ronde()
          get_jatuhan()
          get_peringatan()
          get_binaan()
          get_teguran()

          let round =  $(`#input-round`).val()
          let status_selesai_pertandingan = $(`#input-status-selesai-pertandingan`).val()

          if(round == 0 || status_selesai_pertandingan == 1) {
            $(`#btn-jatuhan-biru`).prop('disabled', true).addClass('disabled')
            $(`#btn-binaan-biru`).prop('disabled', true).addClass('disabled')
            $(`#btn-teguran-biru`).prop('disabled', true).addClass('disabled')
            $(`#btn-peringatan-biru`).prop('disabled', true).addClass('disabled')
            $(`#btn-hapus-nilai-biru`).prop('disabled', true).addClass('disabled')

            $(`#btn-verifikasi`).prop('disabled', true).addClass('disabled')
            $(`#btn-partai-selanjutnya`).prop('disabled', true).addClass('disabled')
            $(`#btn-undur-diri`).prop('disabled', true).addClass('disabled')

            $(`#btn-jatuhan-merah`).prop('disabled', true).addClass('disabled')
            $(`#btn-binaan-merah`).prop('disabled', true).addClass('disabled')
            $(`#btn-teguran-merah`).prop('disabled', true).addClass('disabled')
            $(`#btn-peringatan-merah`).prop('disabled', true).addClass('disabled')
            $(`#btn-hapus-nilai-merah`).prop('disabled', true).addClass('disabled')
          }

          setInterval(function() {
            $('#ronde-1-biru .wrap-score-jatuhan').scrollLeft($('#ronde-1-biru .wrap-score-jatuhan').width());
            $('#ronde-2-biru .wrap-score-jatuhan').scrollLeft($('#ronde-2-biru .wrap-score-jatuhan').width());
            $('#ronde-3-biru .wrap-score-jatuhan').scrollLeft($('#ronde-3-biru .wrap-score-jatuhan').width());

            $('#ronde-1-biru .wrap-score-peringatan').scrollLeft($('#ronde-1-biru .wrap-score-peringatan').width());
            $('#ronde-2-biru .wrap-score-peringatan').scrollLeft($('#ronde-2-biru .wrap-score-peringatan').width());
            $('#ronde-3-biru .wrap-score-peringatan').scrollLeft($('#ronde-3-biru .wrap-score-peringatan').width());

            $('#ronde-1-biru .wrap-score-teguran').scrollLeft($('#ronde-1-biru .wrap-score-teguran').width());
            $('#ronde-2-biru .wrap-score-teguran').scrollLeft($('#ronde-2-biru .wrap-score-teguran').width());
            $('#ronde-3-biru .wrap-score-teguran').scrollLeft($('#ronde-3-biru .wrap-score-teguran').width());

            $('#ronde-1-merah .wrap-score-jatuhan').scrollLeft($('#ronde-1-merah .wrap-score-jatuhan').width());
            $('#ronde-2-merah .wrap-score-jatuhan').scrollLeft($('#ronde-2-merah .wrap-score-jatuhan').width());
            $('#ronde-3-merah .wrap-score-jatuhan').scrollLeft($('#ronde-3-merah .wrap-score-jatuhan').width());

            $('#ronde-1-merah .wrap-score-peringatan').scrollLeft($('#ronde-1-merah .wrap-score-peringatan').width());
            $('#ronde-2-merah .wrap-score-peringatan').scrollLeft($('#ronde-2-merah .wrap-score-peringatan').width());
            $('#ronde-3-merah .wrap-score-peringatan').scrollLeft($('#ronde-3-merah .wrap-score-peringatan').width());

            $('#ronde-1-merah .wrap-score-teguran').scrollLeft($('#ronde-1-merah .wrap-score-teguran').width());
            $('#ronde-2-merah .wrap-score-teguran').scrollLeft($('#ronde-2-merah .wrap-score-teguran').width());
            $('#ronde-3-merah .wrap-score-teguran').scrollLeft($('#ronde-3-merah .wrap-score-teguran').width());
          }, 500)
        })

        function selectRadio(value, button) {
          document.querySelectorAll('input[type=radio][name="alasan"]').forEach(radio => {
            radio.checked = false;
          });
          
          document.querySelector(`input[type=radio][value="${value}"]`).checked = true;

          document.querySelectorAll('.btn').forEach(btn => {
            btn.classList.remove('selected-btn');
          });
          
          button.classList.add('selected-btn');
        }

        // 192.168.55.126
        var socket = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');

        socket.onopen = function(e) {
            console.log("WebSocket connection established!");
        };

        socket.onmessage = function(event) {
            console.log("Message received from server:", event.data);
            let data = JSON.parse(event.data);
            console.log(data);
            if(data.status_verifikasii == '1'){
              handleWebsocketMessageVerifikasi(data);
            } else if(data.status_nilaii == '1'){
              handleWebsocketMessageNilai(data);
            } else if(data.status_roundd == '1'){
              handleWebsocketMessageRound(data);
            }
        };

        socket.onerror = function(e) {
            console.error("WebSocket error: ", e);
        };

        // WEBSOCKET ROUND
        function handleWebsocketMessageRound(data){
          let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
              get_ronde()
          }
        }

        function get_ronde() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let status_selesai_pertandingan = $(`#input-status-selesai-pertandingan`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/get_ronde') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan: id_jadwal_pertandingan},
              dataType : 'json',
              async: false,
              success: function (res){
                if(res.ronde_berjalan != 0) {
                  $(`.item-round`).removeClass('active')
                  $(`#round-${res.ronde_berjalan}`).addClass('active')
                  $(`#input-round`).val(res.ronde_berjalan)

                  if(status_selesai_pertandingan == 0) {
                    $(`#btn-jatuhan-biru`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-binaan-biru`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-teguran-biru`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-peringatan-biru`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-hapus-nilai-biru`).prop('disabled', false).removeClass('disabled')

                    $(`#btn-verifikasi`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-partai-selanjutnya`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-undur-diri`).prop('disabled', false).removeClass('disabled')

                    $(`#btn-jatuhan-merah`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-binaan-merah`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-teguran-merah`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-peringatan-merah`).prop('disabled', false).removeClass('disabled')
                    $(`#btn-hapus-nilai-merah`).prop('disabled', false).removeClass('disabled')
                  }
                }
              }
          })
        }
        // END WEBSOCKET ROUND

        // WEBSOCKET REFRESH NILAI
        function handleWebsocketMessageNilai(data){
          let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            if(data.refresh_monitor) {
              get_ronde()
            }
          }
        }
        // WEBSOCKET END REFRESH NILAI

        // PUSHER HASIL VERIFIKASI
        function handleWebsocketMessageVerifikasi(data){
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let gelanggang = $(`#input-gelanggang`).val()
          let no_partai = $(`#input-no-partai`).val()

          if(data.gelanggang == gelanggang && data.partai == no_partai && data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            let hasil_verifikasi = '';
            for(const item of data.hasil_verifikasi) {
              hasil_verifikasi += `
                <li class="list-group-item hasil-verifikasi hasil-verifikasi-${item.sudut.toLowerCase()}">
                    <p>${item.nama_juri.toUpperCase()}</p>
                    <p>${item.sudut == 'Invalid' ? 'Invalid' : 'Sudut ' + item.sudut}</p>
                </li>
              `
            }

            $(`#list-group-hasil-verifikasi`).html(hasil_verifikasi)
            $(`#btn-show-modal-hasil-verifikasi`).click()
          }
        }
        // PUSHER END HASIL VERIFIKASI

        function selesai_pertandingan() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let partai = $(`#input-no-partai`).val()

          let confirm_selesai_pertandingan = confirm('Apakah Anda Ingin Menyelesaikan Pertandingan Ini?')
          if(confirm_selesai_pertandingan) {
            $.ajax({
                url : '<?php echo base_url('pertandingan/dewan_tanding/selesai_pertandingan') ?>',
                method : 'POST',
                data: {id_jadwal_pertandingan},
                dataType : 'json',
                async: false,
                success: function (res) {
                  if(res.result) {
                    toastr.success(`Pertandingan Partai ${partai} Telah Selesai`)
                    ambil_partai_selanjutnya()
                    localStorage.removeItem('statusNilaiSudutBiru')
                    localStorage.removeItem('statusNilaiSudutMerah')
                  }
                }
            })
          }
        }

        function show_modal_undur_diri() {
          $(`#btn-show-undur-diri`).click()
        }

        $('#form-undur-diri-pesilat').submit(function(e) {
            e.preventDefault(); // Pastikan prevent default dipanggil di awal
            
            let id_jadwal_pertandingan = $('#input-jadwal-pertandingan').val();
            let pesilat_mundur = $('input[name="pesilat_mundur"]:checked').val();
            let alasan = $('input[name="alasan"]:checked').val();
            let partai = $('#input-no-partai').val();

            Swal.fire({
                title: 'Apakah benar?',
                text: `Apakah benar ini bahwa sudut ${pesilat_mundur} mengundurkan diri?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, benar!',
                cancelButtonText: 'Tidak, batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('pertandingan/dewan_tanding/undur_diri') ?>',
                        method: 'POST',
                        data: { id_jadwal_pertandingan, pesilat_mundur, alasan },
                        dataType: 'json',
                        success: function (res) {
                            toastr.success(`Pertandingan Partai ${partai} Telah Selesai`);
                            $('#btn-show-undur-diri').click();
                            ambil_partai_selanjutnya();
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                }
            });
        });


        function ambil_partai_selanjutnya() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let count_col = $(`#table-partai thead tr td`).length

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/ambil_partai_selanjutnya') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan},
              dataType : 'json',
              async: false,
              success: function (res) {
                  let td = ''
                  if(res.data.length > 0) {
                    for(const item of res.data) {
                      td += `
                        <tr>
                          <td class="text-center" style="vertical-align: middle;">${item.no_partai}</td>
                          <td class="text-center" style="vertical-align: middle;">${item.gelanggang}</td>
                          <td class="td-pesilat-biru">
                            <p>${item.nama_pesilat_biru}</p>
                            <span>${item.kontingen_biru}</span>
                          </td>
                          <td class="td-pesilat-merah">
                            <p>${item.nama_pesilat_merah}</p>
                            <span>${item.kontingen_merah}</span>
                          </td>
                          <td class="text-center">
                            <div class="d-grid">
                              <button class="btn btn-success" type="button" onclick="klik_pilih_partai(${item.id})">Pilih</button>
                            </div>
                          </td>
                        </tr>
                      `
                    }
                  } else {
                    td += `<tr><td colspan="${count_col}" class="text-center">Partai Kosong</td></tr>`
                  }

                  $(`#table-partai tbody`).html(td)
                  $(`#btn-show-modal-partai-selanjutnya`).click()
              }
          })
        }

        function klik_pilih_partai(id_jadwal_pertandingan) {
          let id_jadwal_pertandingan_sebelumnya = $(`#input-jadwal-pertandingan`).val()
          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/pilih_partai') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan, id_jadwal_pertandingan_sebelumnya},
              dataType : 'json',
              async: false,
              success: function (res){
                // 192.168.55.126
                var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                var status_partaii = 1;
                var result = res.result;
                var data = res.data;
                var id_jadwal_pertandingan = res.id_jadwal_pertandingan;
                var data = {
                  data: data,
                  result: result,
                  id_jadwal_pertandingan: id_jadwal_pertandingan,
                  status_partaii: status_partaii
                };

                conn.onopen = function() {
                    console.log("WebSocket connection established!");
                    conn.send(JSON.stringify(data));
                };

                conn.onerror = function(error) {
                    console.error("WebSocket error: ", error);
                };
                window.location.href = `<?php echo base_url() ?>pertandingan/dewan_tanding/index/${res.id_jadwal_pertandingan_selanjutnya}`
              }
          })
        }

        function get_jatuhan() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/get_jatuhan') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan: id_jadwal_pertandingan, ronde: round},
              dataType : 'json',
              async: false,
              success: function (res){
                if(res.result) {
                  let html_jatuhan_biru_ronde_1 = ''
                  let html_jatuhan_merah_ronde_1 = ''

                  let html_jatuhan_biru_ronde_2 = ''
                  let html_jatuhan_merah_ronde_2 = ''

                  let html_jatuhan_biru_ronde_3 = ''
                  let html_jatuhan_merah_ronde_3 = ''

                  for(const item_ronde_1 of res.data_ronde_1) {
                    if(item_ronde_1.sudut == 'Biru') {
                      html_jatuhan_biru_ronde_1 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_1.nilai}</p>`
                    } else {
                      html_jatuhan_merah_ronde_1 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_1.nilai}</p>`
                    }

                  }

                  for(const item_ronde_2 of res.data_ronde_2) {
                    if(item_ronde_2.sudut == 'Biru') {
                      html_jatuhan_biru_ronde_2 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_2.nilai}</p>`
                    } else {
                      html_jatuhan_merah_ronde_2 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_2.nilai}</p>`
                    }

                  }

                  for(const item_ronde_3 of res.data_ronde_3) {
                    if(item_ronde_3.sudut == 'Biru') {
                      html_jatuhan_biru_ronde_3 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_3.nilai}</p>`
                    } else {
                      html_jatuhan_merah_ronde_3 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_3.nilai}</p>`
                    }

                  }

                  $(`.nilai-score-biru#ronde-1-biru .wrap-score-jatuhan`).html(html_jatuhan_biru_ronde_1)
                  $(`.nilai-score-merah#ronde-1-merah .wrap-score-jatuhan`).html(html_jatuhan_merah_ronde_1)

                  $(`.nilai-score-biru#ronde-2-biru .wrap-score-jatuhan`).html(html_jatuhan_biru_ronde_2)
                  $(`.nilai-score-merah#ronde-2-merah .wrap-score-jatuhan`).html(html_jatuhan_merah_ronde_2)

                  $(`.nilai-score-biru#ronde-3-biru .wrap-score-jatuhan`).html(html_jatuhan_biru_ronde_3)
                  $(`.nilai-score-merah#ronde-3-merah .wrap-score-jatuhan`).html(html_jatuhan_merah_ronde_3)

                }
              }
          })
        }

        function get_binaan() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/get_binaan') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan: id_jadwal_pertandingan, ronde: round},
              dataType : 'json',
              async: false,
              success: function (res) {
                if(res.result) {

                  if(res.sudut_biru.length == 0) {
                    $(`.nilai-score-biru#ronde-${round}-biru .wrap-score-binaan span`).html(`<span>0</span>`)
                  }

                  if(res.sudut_merah.length == 0) {
                    $(`.nilai-score-merah#ronde-${round}-merah .wrap-score-binaan span`).html(`<span>0</span>`)
                  }

                  if(res.sudut_biru.length != 0 || res.sudut_merah.length != 0) {
                    for(const binaan_sudut_biru of res.sudut_biru) {
                      if(binaan_sudut_biru.ronde == 1) {
                        $(`.nilai-score-biru#ronde-1-biru .wrap-score-binaan span`).html(`<span>${binaan_sudut_biru.total_binaan_sudut_biru}</span>`)
                      } else if(binaan_sudut_biru.ronde == 2) {
                        $(`.nilai-score-biru#ronde-2-biru .wrap-score-binaan span`).html(`<span>${binaan_sudut_biru.total_binaan_sudut_biru}</span>`)
                      } else if(binaan_sudut_biru.ronde == 3) {
                        $(`.nilai-score-biru#ronde-3-biru .wrap-score-binaan span`).html(`<span>${binaan_sudut_biru.total_binaan_sudut_biru}</span>`)
                      }
                    }

                    for(const binaan_sudut_merah of res.sudut_merah) {
                      if(binaan_sudut_merah.ronde == 1) {
                        $(`.nilai-score-merah#ronde-1-merah .wrap-score-binaan span`).html(`<span>${binaan_sudut_merah.total_binaan_sudut_merah}</span>`)
                      } else if(binaan_sudut_merah.ronde == 2) {
                        $(`.nilai-score-merah#ronde-2-merah .wrap-score-binaan span`).html(`<span>${binaan_sudut_merah.total_binaan_sudut_merah}</span>`)
                      } else if(binaan_sudut_merah.ronde == 3) {
                        $(`.nilai-score-merah#ronde-3-merah .wrap-score-binaan span`).html(`<span>${binaan_sudut_merah.total_binaan_sudut_merah}</span>`)
                      }

                    }

                  }

                }
              }
          })
        }

        function get_peringatan() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/get_peringatan') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan: id_jadwal_pertandingan, ronde: round},
              dataType : 'json',
              async: false,
              success: function (res){
                if(res.result) {
                  let html_peringatan_biru_ronde_1 = ''
                  let html_peringatan_merah_ronde_1 = ''

                  let html_peringatan_biru_ronde_2 = ''
                  let html_peringatan_merah_ronde_2 = ''

                  let html_peringatan_biru_ronde_3 = ''
                  let html_peringatan_merah_ronde_3 = ''

                  for(const item_ronde_1 of res.data_ronde_1) {
                    if(item_ronde_1.sudut == 'Biru') {
                      html_peringatan_biru_ronde_1 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_1.nilai}</p>`
                    } else {
                      html_peringatan_merah_ronde_1 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_1.nilai}</p>`
                    }
                  }

                  for(const item_ronde_2 of res.data_ronde_2) {
                    if(item_ronde_2.sudut == 'Biru') {
                      html_peringatan_biru_ronde_2 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_2.nilai}</p>`
                    } else {
                      html_peringatan_merah_ronde_2 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_2.nilai}</p>`
                    }
                  }

                  for(const item_ronde_3 of res.data_ronde_3) {
                    if(item_ronde_3.sudut == 'Biru') {
                      html_peringatan_biru_ronde_3 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_3.nilai}</p>`
                    } else {
                      html_peringatan_merah_ronde_3 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_3.nilai}</p>`
                    }
                  }

                  $(`.nilai-score-biru#ronde-1-biru .wrap-score-peringatan`).html(html_peringatan_biru_ronde_1)
                  $(`.nilai-score-merah#ronde-1-merah .wrap-score-peringatan`).html(html_peringatan_merah_ronde_1)

                  $(`.nilai-score-biru#ronde-2-biru .wrap-score-peringatan`).html(html_peringatan_biru_ronde_2)
                  $(`.nilai-score-merah#ronde-2-merah .wrap-score-peringatan`).html(html_peringatan_merah_ronde_2)

                  $(`.nilai-score-biru#ronde-3-biru .wrap-score-peringatan`).html(html_peringatan_biru_ronde_3)
                  $(`.nilai-score-merah#ronde-3-merah .wrap-score-peringatan`).html(html_peringatan_merah_ronde_3)
                }
              }
          })
        }

        function get_teguran() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/get_teguran') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan: id_jadwal_pertandingan, ronde: round},
              dataType : 'json',
              async: false,
              success: function (res){
                if(res.result) {
                  let html_teguran_biru_ronde_1 = ''
                  let html_teguran_merah_ronde_1 = ''

                  let html_teguran_biru_ronde_2 = ''
                  let html_teguran_merah_ronde_2 = ''

                  let html_teguran_biru_ronde_3 = ''
                  let html_teguran_merah_ronde_3 = ''

                  for(const item_ronde_1 of res.data_ronde_1) {
                    if(item_ronde_1.sudut == 'Biru') {
                      html_teguran_biru_ronde_1 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_1.nilai}</p>`
                    } else {
                      html_teguran_merah_ronde_1 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_1.nilai}</p>`
                    }

                  }

                  for(const item_ronde_2 of res.data_ronde_2) {
                    if(item_ronde_2.sudut == 'Biru') {
                      html_teguran_biru_ronde_2 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_2.nilai}</p>`
                    } else {
                      html_teguran_merah_ronde_2 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_2.nilai}</p>`
                    }

                  }

                  for(const item_ronde_3 of res.data_ronde_3) {
                    if(item_ronde_3.sudut == 'Biru') {
                      html_teguran_biru_ronde_3 += `<p class="score-biru" style="margin-right: 4px;">${item_ronde_3.nilai}</p>`
                    } else {
                      html_teguran_merah_ronde_3 += `<p class="score-merah" style="margin-left: 4px;">${item_ronde_3.nilai}</p>`
                    }

                  }

                  $(`.nilai-score-biru#ronde-1-biru .wrap-score-teguran`).html(html_teguran_biru_ronde_1)
                  $(`.nilai-score-merah#ronde-1-merah .wrap-score-teguran`).html(html_teguran_merah_ronde_1)

                  $(`.nilai-score-biru#ronde-2-biru .wrap-score-teguran`).html(html_teguran_biru_ronde_2)
                  $(`.nilai-score-merah#ronde-2-merah .wrap-score-teguran`).html(html_teguran_merah_ronde_2)

                  $(`.nilai-score-biru#ronde-3-biru .wrap-score-teguran`).html(html_teguran_biru_ronde_3)
                  $(`.nilai-score-merah#ronde-3-merah .wrap-score-teguran`).html(html_teguran_merah_ronde_3)
                }
              }
          })
        }

        function klik_verifikasi_juri(sudut) {
          let ronde = $(`#input-round`).val()
          let id_jadwal_pertandingan = '<?php echo $j_tanding['id']; ?>'
          $(`#btn-show-modal-pilih-verifikasi`).click()
        }

        $(`#form-pilih-verifikasi`).submit(function(e) {
            let ronde = $(`#input-round`).val()
            let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
            let pilih_verifikasi = $(`input[name="pilih_verifikasi"]:checked`).val()

            $.ajax({
                url : '<?php echo base_url('pertandingan/dewan_tanding/verifikasi_juri') ?>',
                method : 'POST',
                data: {ronde, id_jadwal_pertandingan, pilih_verifikasi},
                dataType : 'json',
                success: function (res) {
                  $(`#btn-show-modal-pilih-verifikasi`).click();
                  // 192.168.55.126
                  var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                  var status_verifikasiii = 1;
                  var data = {
                    ronde: ronde,
                    pilih_verifikasi: pilih_verifikasi,
                    id_jadwal_pertandingan: id_jadwal_pertandingan,
                    status_verifikasiii: status_verifikasiii
                  };

                  conn.onopen = function() {
                      console.log("WebSocket connection established!");
                      conn.send(JSON.stringify(data));
                  };

                  conn.onerror = function(error) {
                      console.error("WebSocket error: ", error);
                  };
                }
            });

            e.preventDefault()
        })

        function klik_hapus_nilai(sudut) {
          let ronde = $(`#input-round`).val()
          let id_jadwal_pertandingan = '<?php echo $j_tanding['id']; ?>'
          let status_nilai_sudut = []
          if(sudut == 'Biru') {
            status_nilai_sudut = JSON.parse(localStorage.getItem('statusNilaiSudutBiru'))
          } else {
            status_nilai_sudut = JSON.parse(localStorage.getItem('statusNilaiSudutMerah'))
          }

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/hapus_nilai') ?>',
              method : 'POST',
              data: {sudut, ronde, id_jadwal_pertandingan, status_nilai_sudut: status_nilai_sudut},
              dataType : 'json',
              success: function (res) {
                if(res.result) {
                  // toastr.success(res.message)

                  if(res.status_nilai == 'teguran') {
                    get_teguran()
                  } else if(res.status_nilai == 'jatuhan') {
                    get_jatuhan()
                  } else if(res.status_nilai == 'peringatan') {
                    get_peringatan()
                  } else if(res.status_nilai == 'binaan') {
                    get_binaan()
                  }

                  if(sudut == 'Biru') {
                    localStorage.setItem('statusNilaiSudutBiru', JSON.stringify(res.array_status_nilai))
                  } else {
                    localStorage.setItem('statusNilaiSudutMerah', JSON.stringify(res.array_status_nilai))
                  }

                  // 192.168.55.126
                  var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                  var status_monitorr = 1;
                  var aksi = res.status_nilai;
                  var data = {
                    sudut: sudut,
                    aksi: aksi,
                    id_jadwal_pertandingan: id_jadwal_pertandingan,
                    status_monitorr: status_monitorr
                  };

                  conn.onopen = function() {
                      console.log("WebSocket connection established!");
                      conn.send(JSON.stringify(data));
                  };

                  conn.onerror = function(error) {
                      console.error("WebSocket error: ", error);
                  };

                } else {
                  toastr.error(res.message)
                }

              }
          });
        }

        function input_status_nilai(sudut, status) {
          if(sudut == 'Biru') {
            let status_nilai_sudut_biru = JSON.parse(localStorage.getItem('statusNilaiSudutBiru'))
            if(status_nilai_sudut_biru == undefined) {
              localStorage.setItem("statusNilaiSudutBiru", JSON.stringify([status]));
            } else {
              status_nilai_sudut_biru.push(status)
              localStorage.setItem("statusNilaiSudutBiru", JSON.stringify(status_nilai_sudut_biru));
            }
          } else {
            let status_nilai_sudut_merah = JSON.parse(localStorage.getItem('statusNilaiSudutMerah'))
            if(status_nilai_sudut_merah == undefined) {
              localStorage.setItem("statusNilaiSudutMerah", JSON.stringify([status]));
            } else {
              status_nilai_sudut_merah.push(status)
              localStorage.setItem("statusNilaiSudutMerah", JSON.stringify(status_nilai_sudut_merah));
            }
          }
        }

        function klik_teguran(sudut) {
          let ronde = $(`#input-round`).val()
          let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/tambah_teguran') ?>',
              method : 'POST',
              data: {sudut, ronde, id_jadwal_pertandingan},
              dataType : 'json',
              success: function (res){
                get_teguran()
                input_status_nilai(sudut, 'teguran')
                // toastr.success('Nilai Teguran Berhasil Ditambahkan')
                // 192.168.55.126
                var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                var status_monitorr = 1;
                var aksi = 'teguran';
                var nilai = res.nilai;
                var data = {
                  sudut: sudut,
                  nilai: nilai,
                  aksi: aksi,
                  ronde: ronde,
                  id_jadwal_pertandingan: id_jadwal_pertandingan,
                  status_monitorr: status_monitorr
                };

                conn.onopen = function() {
                    console.log("WebSocket connection established!");
                    conn.send(JSON.stringify(data));
                };

                conn.onerror = function(error) {
                    console.error("WebSocket error: ", error);
                };
              }
          });
        }

        function klik_jatuhan(sudut) {
          let nilai = 3
          let ronde = $(`#input-round`).val()
          let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/tambah_jatuhan') ?>',
              method : 'POST',
              data: {nilai, sudut, ronde, id_jadwal_pertandingan},
              dataType : 'json',
              success: function (res) {
                get_jatuhan()
                input_status_nilai(sudut, 'jatuhan')
                // toastr.success('Nilai Jatuhan Berhasil Ditambahkan')
                // 192.168.55.126
                var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                var status_monitorr = 1;
                var aksi = 'jatuhan';
                var data = {
                  sudut: sudut,
                  nilai: nilai,
                  aksi: aksi,
                  ronde: ronde,
                  id_jadwal_pertandingan: id_jadwal_pertandingan,
                  status_monitorr: status_monitorr
                };

                conn.onopen = function() {
                    console.log("WebSocket connection established!");
                    conn.send(JSON.stringify(data));
                };

                conn.onerror = function(error) {
                    console.error("WebSocket error: ", error);
                };
              }
          });
        }

        function klik_peringatan(sudut) {
          let ronde = $(`#input-round`).val()
          let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/tambah_peringatan') ?>',
              method : 'POST',
              data: {sudut, ronde, id_jadwal_pertandingan},
              dataType : 'json',
              success: function (res) {
                get_peringatan()
                input_status_nilai(sudut, 'peringatan')
                // toastr.success('Nilai Peringatan Berhasil Ditambahkan')
                // 192.168.55.126
                var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                var status_monitorr = 1;
                var aksi = 'peringatan';
                var nilai = res.nilai;
                var data = {
                  sudut: sudut,
                  nilai: nilai,
                  aksi: aksi,
                  ronde: ronde,
                  id_jadwal_pertandingan: id_jadwal_pertandingan,
                  status_monitorr: status_monitorr
                };

                conn.onopen = function() {
                    console.log("WebSocket connection established!");
                    conn.send(JSON.stringify(data));
                };

                conn.onerror = function(error) {
                    console.error("WebSocket error: ", error);
                };
              }
          });
        }

        function klik_binaan(sudut) {
          let nilai = 0
          let ronde = $(`#input-round`).val()
          let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

          $.ajax({
              url : '<?php echo base_url('pertandingan/dewan_tanding/tambah_binaan') ?>',
              method : 'POST',
              data: {nilai, sudut, ronde, id_jadwal_pertandingan},
              dataType : 'json',
              success: function (res) {
                get_binaan()
                input_status_nilai(sudut, 'binaan')
                // toastr.success('Nilai Binaan Berhasil Ditambahkan')
                // 192.168.55.126
                var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
                var status_monitorr = 1;
                var aksi = 'binaan';
                var nilai = res.nilai;
                var data = {
                  sudut: sudut,
                  nilai: nilai,
                  aksi: aksi,
                  ronde: ronde,
                  id_jadwal_pertandingan: id_jadwal_pertandingan,
                  status_monitorr: status_monitorr
                };

                conn.onopen = function() {
                    console.log("WebSocket connection established!");
                    conn.send(JSON.stringify(data));
                };

                conn.onerror = function(error) {
                    console.error("WebSocket error: ", error);
                };
              }
          });
        }

    </script>
</body>
</html>
