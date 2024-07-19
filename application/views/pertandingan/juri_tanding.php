<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Halaman Juri</title>
<link rel="icon" href="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" type="image/x-icon">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_pertandingan/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_pertandingan/icon/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets_pertandingan/js/toastr/build/toastr.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets_pertandingan/bootstrap/css/bootstrap.min.css'); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body style="background-color: #000;">
<style>
  .juri {
    /* background-color: #ADBC9F; */
    background-color: #000;
  }

  .info-pesilat-kiri, .detik, .info-header, .info-pesilat-kanan {
    color: #ffffff;
  }

  .nilai-score-biru, .item-round, .nilai-score-merah {
    background-color: #ffffff;
  }

  .partai-selanjutnya, .wrap-score-peringatan, .wrap-score-teguran, .wrap-score-binaan, .wrap-score-jatuhan, .score-tendangan, .judull-round, .judul-round {
    background-color: #ffffff;
  }

  #popup_load {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: none; 
        }

        .logo-ipsi-load {
          width: 325px;
          height: 325px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -65%);
            margin-bottom: 5px; 
        }

        .window_load {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .loading-text {
          font-size: 30px;
          font-weight: bold;
          color: #000; /* Ubah warna teks sesuai keinginan */
          margin-top: 300px; /* Sesuaikan margin atas untuk menempatkan teks di bawah gambar */
      }
</style>
<div id="popup_load">
      <div class="window_load">
      <img src="<?php echo base_url('assets_pertandingan/image/ipsi.png') ?>" alt="IPSI" class="logo-ipsi-load"/>
          <!-- <img src="<?=base_url()?>assets/Ellipsis.gif" height="120" width="120"> -->
          <div class="loading-text">Loading...</div>
      </div>
  </div>
<div class="juri">
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
    <div class="container">
        <div class="" style="display: flex; justify-content: flex-end; margin-bottom: 12px;">
          <button type="button" class="btn btn-logout" style="margin-left: auto;" name="button" onclick="logout()">Keluar</button>
        </div>
        <br>
        <header>
            <div class="info-pesilat-kiri">
                <p class="nama-pesilat-biru" style="font-size: 28px;"><?php echo $j_tanding['nama_pesilat_biru']; ?></p>
                <p class="asal-pesilat"><?php echo $j_tanding['kontingen_biru']; ?></p>
            </div>
            <div class="info-header">
                <h1><?php echo $this->session->userdata('pr_nama_juri') ?></h1>
                <p>Gelanggang <?php echo $j_tanding['gelanggang']; ?></p>
            </div>
            <div class="info-pesilat-kanan">
              <p class="nama-pesilat-merah" style="font-size: 28px;"><?php echo $j_tanding['nama_pesilat_merah']; ?></p>
              <p class="asal-pesilat"><?php echo $j_tanding['kontingen_merah']; ?></p>
            </div>
        </header>
        <div class="content" style="margin-top: 20px;">
            <div class="content-juri">
                <div class="pesilat-biru">
                    <p class="judul-score-biru">
                        Nilai
                    </p>
                    <div class="wrap-nilai-score-biru">
                        <div class="nilai-score-biru nilai-score-round-1" id="ronde-1-biru"></div>
                        <div class="nilai-score-biru nilai-score-round-2" id="ronde-2-biru"></div>
                        <div class="nilai-score-biru nilai-score-round-3" id="ronde-3-biru"></div>
                    </div>
                    <br>
                    <div class="aksi-tombol-biru">
                        <div class="tombol-kiri">
                          <button class="btn btn-pukul" id="btn-pukulan-biru" onclick="klik_aksi('Biru', 1)">Pukulan  &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/pukulan.svg" alt="binaan-1" style="width: 8%;"></button>
                          <button class="btn btn-tendang" id="btn-tendangan-biru" onclick="klik_aksi('Biru', 2)">Tendangan  &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/tendangan.svg" alt="binaan-1" style="width: 10%;"></button>
                        </div>
                        <div class="tombol-kanan">
                            <button class="btn btn-hapus-score" id="btn-hapus-nilai-biru" onclick="hapus_last_score('Biru')">Hapus Nilai Terakhir</button>
                        </div>
                    </div>
                </div>
                <div class="ronde round">
                    <p class="judul-ronde judul-round">Ronde</p>
                    <div>
                        <div class="item-round" id="round-1">I</div>
                        <div class="item-round" id="round-2">II</div>
                        <div class="item-round" id="round-3">III</div>
                    </div>
                </div>
                <div class="pesilat-merah">
                    <p class="judul-score-merah">
                        Nilai
                    </p>
                    <div class="wrap-nilai-score-merah">
                        <div class="nilai-score-merah" id="ronde-1-merah"></div>
                        <div class="nilai-score-merah" id="ronde-2-merah"></div>
                        <div class="nilai-score-merah" id="ronde-3-merah"></div>
                    </div>
                    <br>
                    <div class="aksi-tombol-merah">
                        <div class="tombol-kiri">
                            <button class="btn btn-hapus-score" id="btn-hapus-nilai-merah" onclick="hapus_last_score('Merah')">Hapus Nilai Terakhir</button>
                        </div>
                        <div class="tombol-kanan">
                          <button class="btn btn-pukul" id="btn-pukulan-merah" onclick="klik_aksi('Merah', 1)">Pukulan  &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/pukulan.svg" alt="binaan-1" style="width: 8%;"></button>
                          <button class="btn btn-tendang" id="btn-tendangan-merah" onclick="klik_aksi('Merah', 2)">Tendangan  &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets_pertandingan/image/tendangan.svg" alt="binaan-1" style="width: 10%;"></button>
                        </div>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="input-id-juri" value="<?php echo $this->session->userdata('pr_id_juri'); ?>">
<input type="hidden" id="input-nama-juri" value="<?php echo $this->session->userdata('pr_nama_juri'); ?>">
<input type="hidden" id="input-round" value="0">
<input type="hidden" id="input-verifikasi" value="0">
<input type="hidden" id="input-gelanggang" value="<?php echo $j_tanding['gelanggang']; ?>">
<input type="hidden" id="input-partai" value="<?php echo $j_tanding['no_partai']; ?>">
<input type="hidden" id="input-jadwal-pertandingan" value="<?php echo $j_tanding['id']; ?>">
<input type="hidden" id="input-status-selesai-pertandingan" value="<?php echo $j_tanding['status_selesai_pertandingan']; ?>">

<input type="hidden" id="input-id-nilai-biru">
<input type="hidden" id="input-id-nilai-merah">

<div class="container-modal-verifikasi animate__animated" style="display: none;">
    <div class="modal-verifikasi-juri animate__animated animate__zoomIn animate__faster animate__delay-1s">
        <div class="modal-content">
            <div class="modal-header">
                <h5>VERIFIKASI JURI</h5>
                <i class="bi bi-x btn-close" onclick="keluar_modal()"></i>
            </div>
            <div class="modal-body">
                <p class="status-verifikasi">Verifikasi Jatuhan</p>
                <p class="pernyataan-juri">Putusan 3 Juri</p>
                <p class="jawaban-juri">Proses</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-pesilat-biru" onclick="jawaban_juri('Biru')">Sudut Biru</button>
            <button class="btn btn-pesilat-merah" onclick="jawaban_juri('Merah')">Sudut Merah</button>
            <button class="btn btn-invalid" onclick="jawaban_juri('Invalid')">Tidak Valid</button>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets_pertandingan/js/toastr/build/toastr.min.js"></script>
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
    $('#popup_load').show();
    let round =  $(`#input-round`).val()
    let status_selesai_pertandingan = $(`#input-status-selesai-pertandingan`).val()

    if(round == 0 || status_selesai_pertandingan == 1) {
      $(`#btn-pukulan-biru`).prop('disabled', true).addClass('disabled')
      $(`#btn-tendangan-biru`).prop('disabled', true).addClass('disabled')
      $(`#btn-hapus-nilai-biru`).prop('disabled', true).addClass('disabled')

      $(`#btn-pukulan-merah`).prop('disabled', true).addClass('disabled')
      $(`#btn-tendangan-merah`).prop('disabled', true).addClass('disabled')
      $(`#btn-hapus-nilai-merah`).prop('disabled', true).addClass('disabled')
    }

    get_ronde()
    get_nilai_juri()

    setInterval(function() {
      $(`#ronde-1-biru`).scrollLeft($(`#ronde-1-biru`).width());
      $(`#ronde-2-biru`).scrollLeft($(`#ronde-2-biru`).width());
      $(`#ronde-3-biru`).scrollLeft($(`#ronde-3-biru`).width());

      $(`#ronde-1-merah`).scrollLeft($(`#ronde-1-merah`).width());
      $(`#ronde-2-merah`).scrollLeft($(`#ronde-2-merah`).width());
      $(`#ronde-3-merah`).scrollLeft($(`#ronde-3-merah`).width());
    }, 500)
  })

  // 192.168.55.126
  var socket = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');

  socket.onopen = function(e) {
      console.log("WebSocket connection established!");
  };

  socket.onmessage = function(event) {
      console.log("Message received from server:", event.data);
      let data = JSON.parse(event.data);
      if(data.status_timerr == '1'){
        handleWebsocketMessageTimer(data);
      } else if(data.status_partaii == '1'){
        handleWebsocketMessagePartai(data);
      } else if(data.status_verifikasiii == '1'){
        handleWebSocketMessageVerifikasi(data);
      } else if(data.status_nilaii == '1'){
        handleWebsocketMessageNilai(data);
      } else if(data.status_roundd == '1'){
        handleWebsocketMessageRound(data);
      }
  };

  socket.onerror = function(e) {
      console.error("WebSocket error: ", e);
  };

  // WEBSOCKET VERIFIKASI JURI
  function handleWebSocketMessageVerifikasi(data) {
      let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
      if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
        if(data.pilih_verifikasi == 'jatuhan') {
          $(`.status-verifikasi`).text('Verifikasi Jatuhan')
        } else {
          $(`.status-verifikasi`).text('Verifikasi Hukuman')
        }

        $(`#input-verifikasi`).val(data.pilih_verifikasi)
        $(`.container-modal-verifikasi`).show()
      }
  }
  // WEBSOCKET END VERIFIKASI JURI

  // PUSHER REFRESH NILAI
  function handleWebsocketMessageNilai(data) {
    if(data.refresh_monitor) {
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
      if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
        localStorage.removeItem('nilai_sudut_sementara_biru')
        localStorage.removeItem('nilai_sudut_sementara_merah')
        get_nilai_juri()
        $(`.container-modal-verifikasi`).hide()
        $(`.status-verifikasi`).html('')
        $(`.jawaban-juri`).html('Proses')
        $(`.jawaban-juri`).removeClass('pesilat-biru')
        $(`.jawaban-juri`).removeClass('pesilat-merah')
        $(`.jawaban-juri`).removeClass('invalid')
      }
    }
  }
  // PUSHER END REFRESH NILAI

  // PUSHER GANTI PARTAI
  function handleWebsocketMessagePartai(data) {
    // if(data.refresh_monitor) {
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
      if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
        if(data.result) {
        alert(`Pertandingan Akan Diganti ke Partai ${data.data.no_partai}`)
        window.location.href = `<?php echo base_url() ?>pertandingan/juri_tanding/ganti_partai/${data.data.no_partai}/${data.data.gelanggang}`
      } else {
        alert('Tidak Ada Pertandingan Selanjutnya, Anda Akan Diarahkan ke Halaman Login Juri')
        window.location.href = `<?php echo base_url() ?>pertandingan/logout`
      }
      }
    // }
  }
  // PUSHER END GANTI PARTAI

  // PUSHER ROUND
  function handleWebsocketMessageRound(data) {
    // if(data.refresh_monitor) {
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
      if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
        get_ronde()
      }
    // }
  }

  function get_ronde() {
    let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
    let status_selesai_pertandingan = $(`#input-status-selesai-pertandingan`).val()

    $.ajax({
        url : '<?php echo base_url('pertandingan/juri_tanding/get_ronde') ?>',
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
              $(`#btn-pukulan-biru`).prop('disabled', false).removeClass('disabled')
              $(`#btn-tendangan-biru`).prop('disabled', false).removeClass('disabled')
              $(`#btn-hapus-nilai-biru`).prop('disabled', false).removeClass('disabled')

              $(`#btn-pukulan-merah`).prop('disabled', false).removeClass('disabled')
              $(`#btn-tendangan-merah`).prop('disabled', false).removeClass('disabled')
              $(`#btn-hapus-nilai-merah`).prop('disabled', false).removeClass('disabled')
            }
          }
        }
    })
  }
  // END PUSHER ROUND

  // WEBSOCKET TIMER
  function handleWebsocketMessageTimer(data){
    let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
    if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
      let status_waktu = data.status_waktu
        if(status_waktu == 'start') {
          start()
        } else {
          stop()
        }
    }
  }

  function start() {
      $('#popup_load').hide();
  }

  function stop() {
      clearInterval(intervals);

      intervals = null;
  }
  // END WEBSOCKET TIMER

  function hapus_last_score(sudut) {
    let id_nilai = 0
    if(sudut == 'Biru') {
      id_nilai = $(`#input-id-nilai-biru`).val()
    } else if(sudut == 'Merah') {
      id_nilai = $(`#input-id-nilai-merah`).val()
    }


    let ronde = $(`#input-round`).val()
    let id_juri = $(`#input-id-juri`).val()
    let id_jadwal_pertandingan = '<?php echo $j_tanding['id']; ?>'
    let nilai_sudut_sementara = []

    if(sudut == 'Biru') {
      nilai_sudut_sementara = JSON.parse(localStorage.getItem('nilai_sudut_sementara_biru'))
    } else if(sudut == 'Merah') {
      nilai_sudut_sementara = JSON.parse(localStorage.getItem('nilai_sudut_sementara_merah'))
    }

    console.log(nilai_sudut_sementara);

    $.ajax({
        url : '<?php echo base_url('pertandingan/juri_tanding/hapus_nilai') ?>',
        method : 'POST',
        data: {id_nilai, id_jadwal_pertandingan, id_juri, ronde, nilai_sudut_sementara: nilai_sudut_sementara},
        dataType : 'json',
        success: function (res) {
          if(sudut == 'Biru') {
            localStorage.setItem('nilai_sudut_sementara_biru', JSON.stringify(res.nilai_sudut_sementara))
          } else if(sudut == 'Merah') {
            localStorage.setItem('nilai_sudut_sementara_merah', JSON.stringify(res.nilai_sudut_sementara))
          }

          get_nilai_juri()
        }
    })
  }

  // PUSHER NILAI
  function get_nilai_juri() {
    let id_juri = $(`#input-id-juri`).val()
    let nama_juri = $(`#input-nama-juri`).val()
    let gelanggang = $(`#input-gelanggang`).val()
    let ronde = $(`#input-round`).val()
    let id_jadwal_pertandingan = '<?php echo $j_tanding['id']; ?>'
    let nilai_sudut_sementara_biru = JSON.parse(localStorage.getItem('nilai_sudut_sementara_biru'))
    let nilai_sudut_sementara_merah = JSON.parse(localStorage.getItem('nilai_sudut_sementara_merah'))

    $.ajax({
        url : '<?php echo base_url('pertandingan/juri_tanding/get_nilai_juri') ?>',
        method : 'POST',
        data: {id_juri, nama_juri, gelanggang, ronde, id_jadwal_pertandingan},
        dataType : 'json',
        async: false,
        success: function (res) {
          if(res.result) {
            var nilai_sudut_biru = ''
            var nilai_sudut_merah = ''

            for(const item of res.data) {
              if(item.sudut == 'Biru') {
                nilai_sudut_biru += `
                  <p class="score-biru ${item.status_nilai == 'valid' ? 'disetujui' : 'tidak-disetujui'}">${item.nilai}</p>
                `
              } else {
                nilai_sudut_merah += `
                  <p class="score-merah ${item.status_nilai == 'valid' ? 'disetujui' : 'tidak-disetujui'}">${item.nilai}</p>
                `
              }
            }

            if(nilai_sudut_sementara_biru != undefined || nilai_sudut_sementara_biru != null) {
              for(const item of nilai_sudut_sementara_biru) {
                if(item.sudut == 'Biru') {
                  nilai_sudut_biru += `
                    <p class="score-biru">${item.nilai}</p>
                  `
                } else {
                  nilai_sudut_merah += `
                    <p class="score-merah">${item.nilai}</p>
                  `
                }
              }
            }

            if(nilai_sudut_sementara_merah != undefined || nilai_sudut_sementara_merah != null) {
              for(const item of nilai_sudut_sementara_merah) {
                if(item.sudut == 'Biru') {
                  nilai_sudut_biru += `
                    <p class="score-biru">${item.nilai}</p>
                  `
                } else {
                  nilai_sudut_merah += `
                    <p class="score-merah">${item.nilai}</p>
                  `
                }
              }
            }

            $(`.nilai-score-biru#ronde-${ronde}-biru`).html(nilai_sudut_biru)
            $(`.nilai-score-merah#ronde-${ronde}-merah`).html(nilai_sudut_merah)
          }
        }
    });
  }

  function logout() {
    let confirmed = confirm('Apakah Anda Ingin Logout?')
    if(confirmed) {
      window.location.href = '<?php echo base_url('pertandingan/login_tanding/logout') ?>'
    }
  }

  function klik_aksi(sudut, nilai) {
    let id_juri = $(`#input-id-juri`).val()
    let nama_juri = $(`#input-nama-juri`).val()
    let gelanggang = $(`#input-gelanggang`).val()
    let ronde = $(`#input-round`).val()
    let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

    if (!ronde == '0') {
      $.ajax({
          url : '<?php echo base_url('pertandingan/juri_tanding/tambah_nilai') ?>',
          method : 'POST',
          data: {nilai, id_juri, nama_juri, sudut, gelanggang, ronde, id_jadwal_pertandingan},
          dataType : 'json',
          success: function (res) {
            let nilai_sudut = `
              <p class="score-${sudut.toLowerCase()}">${nilai}</p>
            `

            if(sudut == 'Biru') {
              $(`#input-id-nilai-biru`).val(res.id)
            } else if(sudut == 'Merah') {
              $(`#input-id-nilai-merah`).val(res.id)
            }

            $(`.nilai-score-${sudut.toLowerCase()}#ronde-${ronde}-${sudut.toLowerCase()}`).append(nilai_sudut)

            if(sudut == 'Biru') {
              let nilai_sudut_sementara_biru = JSON.parse(localStorage.getItem('nilai_sudut_sementara_biru'))
              let objectNilaiSementara = {sudut: sudut, nilai: nilai}
              if(nilai_sudut_sementara_biru == undefined) {
                localStorage.setItem("nilai_sudut_sementara_biru", JSON.stringify([objectNilaiSementara]));
              } else {
                nilai_sudut_sementara_biru.push(objectNilaiSementara)
                localStorage.setItem("nilai_sudut_sementara_biru", JSON.stringify(nilai_sudut_sementara_biru));
              }
            } else if(sudut == 'Merah') {
              let nilai_sudut_sementara_merah = JSON.parse(localStorage.getItem('nilai_sudut_sementara_merah'))
              let objectNilaiSementara = {sudut: sudut, nilai: nilai}
              if(nilai_sudut_sementara_merah == undefined) {
                localStorage.setItem("nilai_sudut_sementara_merah", JSON.stringify([objectNilaiSementara]));
              } else {
                nilai_sudut_sementara_merah.push(objectNilaiSementara)
                localStorage.setItem("nilai_sudut_sementara_merah", JSON.stringify(nilai_sudut_sementara_merah));
              }
            }

            if(res.status_delay == true) {

              setTimeout(function() {
                input_nilai(sudut, nilai)
              }, 5000)

            }

            // 192.168.55.126
            var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
            var status_jurii = 1;
            var data = {
              sudut: sudut,
              nilai: nilai,
              ronde: ronde,
              gelanggang: gelanggang,
              id_jadwal_pertandingan: id_jadwal_pertandingan,
              juri: id_juri,
              status_jurii: status_jurii
            };

            conn.onopen = function() {
                console.log("WebSocket connection established!");
                conn.send(JSON.stringify(data));
            };

            conn.onerror = function(error) {
                console.error("WebSocket error: ", error);
            };
          }
      })
    }
  }

  function input_nilai(sudut, nilai) {
    let nama_juri = $(`#input-nama-juri`).val()
    let id_juri = $(`#input-id-juri`).val()
    let gelanggang = $(`#input-gelanggang`).val()
    let partai = $(`#input-partai`).val()
    let ronde = $(`#input-round`).val()
    let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

    $.ajax({
        url : '<?php echo base_url('pertandingan/juri_tanding/input_nilai') ?>',
        method : 'POST',
        data: {nilai, id_juri, nama_juri, sudut, gelanggang, partai, ronde, id_jadwal_pertandingan},
        dataType : 'json',
        success: function (res){
          get_nilai_juri()

          // 192.168.55.126
          var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
          var status_nilaii = 1;
          var refresh_monitor = true;
          var juri = res.id_juri;
          var data = {
            juri: juri,
            sudut: sudut,
            nilai: nilai,
            ronde: ronde,
            gelanggang: gelanggang,
            id_jadwal_pertandingan: id_jadwal_pertandingan,
            refresh_monitor: refresh_monitor,
            status_nilaii: status_nilaii
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

  function keluar_modal() {
      setTimeout(function() {
        $(`.container-modal-verifikasi`).hide()
      }, 1000)

      setTimeout(function() {
        $(`.status-verifikasi`).html('')
        $(`.jawaban-juri`).html('Proses')
        $(`.jawaban-juri`).removeClass('pesilat-biru')
        $(`.jawaban-juri`).removeClass('pesilat-merah')
        $(`.jawaban-juri`).removeClass('invalid')
      }, 1400)
  }

  function jawaban_juri(sudut) {
      if(sudut == 'Biru') {
          $(`.jawaban-juri`).html('Sudut Biru')
          $(`.jawaban-juri`).addClass('pesilat-biru')
          $(`.jawaban-juri`).removeClass('pesilat-merah')
          $(`.jawaban-juri`).removeClass('invalid')
      } else if(sudut == 'Merah') {
          $(`.jawaban-juri`).html('Sudut Merah')
          $(`.jawaban-juri`).addClass('pesilat-merah')
          $(`.jawaban-juri`).removeClass('pesilat-biru')
          $(`.jawaban-juri`).removeClass('invalid')
      } else if(sudut == 'Invalid') {
          $(`.jawaban-juri`).html('Tidak Valid')
          $(`.jawaban-juri`).addClass('invalid')
          $(`.jawaban-juri`).removeClass('pesilat-merah')
          $(`.jawaban-juri`).removeClass('pesilat-biru')
      }

      let id_juri = $(`#input-id-juri`).val()
      let nama_juri = $(`#input-nama-juri`).val()
      let gelanggang = $(`#input-gelanggang`).val()
      let ronde = $(`#input-round`).val()
      let verifikasi = $(`#input-verifikasi`).val()
      let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

      keluar_modal()

      if (!ronde == '0') {
        $.ajax({
            url : '<?php echo base_url('pertandingan/juri_tanding/tambah_verifikasi') ?>',
            method : 'POST',
            data: {id_juri, nama_juri, sudut, gelanggang, ronde, id_jadwal_pertandingan, verifikasi},
            dataType : 'json',
            success: function (res){
              toastr.success(`Verifikasi ${nama_juri} Berhasil Dikirm`)
              console.log(res)
              if(res.status_delay == true) {
                setTimeout(function() {
                  kirim_hasil_verifikasi(sudut)
                }, 5000)
              }
            }
        })
      }
  }

  function kirim_hasil_verifikasi(sudut) {
    let nama_juri = $(`#input-nama-juri`).val()
    let id_juri = $(`#input-id-juri`).val()
    let gelanggang = $(`#input-gelanggang`).val()
    let partai = $(`#input-partai`).val()
    let ronde = $(`#input-round`).val()
    let verifikasi = $(`#input-verifikasi`).val()
    let id_jadwal_pertandingan = <?php echo $j_tanding['id']; ?>

    $.ajax({
        url : '<?php echo base_url('pertandingan/juri_tanding/kirim_hasil_verifikasi') ?>',
        method : 'POST',
        data: {id_juri, verifikasi, nama_juri, sudut, gelanggang, partai, ronde, id_jadwal_pertandingan},
        dataType : 'json',
        success: function (res) {
          console.log(res);
          if(res.result == true){
            // 192.168.55.126
            var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
            var status_verifikasii = 1;
            var juri = res.id_juri;
            var hasil_verifikasi = res.hasil_verifikasi;
            var nilai = res.nilai;
            var data = {
              juri: juri,
              sudut: sudut,
              nilai: nilai,
              ronde: ronde,
              partai: partai,
              verifikasi: verifikasi,
              hasil_verifikasi: hasil_verifikasi,
              gelanggang: gelanggang,
              id_jadwal_pertandingan: id_jadwal_pertandingan,
              status_verifikasii: status_verifikasii
            };

            conn.onopen = function() {
                console.log("WebSocket connection established!");
                conn.send(JSON.stringify(data));
            };

            conn.onerror = function(error) {
                console.error("WebSocket error: ", error);
            };
          }
          
        }
    });
  }
  // END PUSHER NILAI

</script>
</body>
</html>
