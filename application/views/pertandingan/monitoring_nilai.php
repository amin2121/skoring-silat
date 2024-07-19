<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Monitoring Nilai</title>
    <link rel="icon" href="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_pertandingan/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets_pertandingan/bootstrap/css/bootstrap.min.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body style="background-color: #000;">
<style>
  .content {
    /* background-color: #ADBC9F; */
    background-color: #000;
  }

  .judul, .detik, .pesilat-biru p , .pesilat-merah p {
    color: #ffffff;
  }

  .binaan, .teguran, .peringatan, .score_pukulan, .score-pukulan, .score-tendangan, .icon-scoree, .judul-round {
    background-color: #ffffff;
  }
  </style>
    <div class="dewan" style="background-color:#000;">
        <header class="header-nav">
            <div class="container-logo"><img src="<?php echo base_url('assets_pertandingan/image/ipsi.png') ?>" alt="IPSI" class="logo-ipsi"/></div>
            <div class="header-nav__content">
              <h3><?php echo $tanding['kompetisi'] ?></h3>
              <div class="informasi-pertandingan">
                <h5>Gel <?php echo $tanding['gelanggang']; ?> - Partai <?php echo $tanding['no_partai']; ?></h5>
                <h5><?php echo $tanding['babak']; ?></h5>
                <h5>Tanding - <?php echo $tanding['kelas_tanding']; ?></h5>
              </div>
            </div>
            <div class="container-logo"><img src="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" alt="TAPAK SUCI" class="logo-tapak-suci"/></div>
        </header>
        <div class="container" style="padding:0rem;">
            <a href="<?php echo base_url() ?>pertandingan/jadwal_pertandingan_tanding" class="btn btn-kembali mt-3">Kembali</a>
            <h1 class="judul" style="text-align: center;">Monitoring Nilai</h1>
            <div class="info-pesilat">
                <div class="pesilat-biru">
                    <h5><?php echo $tanding['nama_pesilat_biru'] ?></h5>
                    <p><?php echo $tanding['kontingen_biru'] ?></p>
                </div>
                <div class="pesilat-merah">
                    <h5><?php echo $tanding['nama_pesilat_merah'] ?></h5>
                    <p><?php echo $tanding['kontingen_merah'] ?></p>
                </div>
            </div>
            <div class="content-monitoring-nilai">

              <table class="table table-bordered" id="table-monitoring-nilai-1">
                <tbody>
                    <tr>
                      <th colspan="4" class="text-center judul-sudut-biru">Sudut Biru</th>
                      <th rowspan="2" class="text-center judul-round">Ronde</th>
                      <th colspan="4" class="text-center judul-sudut-merah">Sudut Merah</th>
                    </tr>
                    <tr>
                      <th class="text-center judul-total-sudut-biru">Total</th>
                      <th colspan="3" class="text-center judul-nilai-sudut-biru">Detail Nilai</th>
                      <th colspan="3" class="text-center judul-nilai-sudut-merah">Detail Nilai</th>
                      <th class="text-center judul-total-sudut-merah">Total</th>
                    </tr>
                    <tr>
                      <td rowspan="7" class="total-nilai-semua-biru">0</td>
                      <td rowspan="4" class="total-nilai-juri-biru">0</td>
                      <td class="nilai-juri nilai-juri-1-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 1</td>
                      <td rowspan="7" class="round-sekarang round-1">1</td>
                      <td class="subjudul-kanan">JURI 1</td>
                      <td class="nilai-juri nilai-juri-1-merah">
                        <div></div>
                      </td>
                      <td rowspan="4" class="total-nilai-juri-merah">0</td>
                      <td rowspan="7" class="total-nilai-semua-merah">0</td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-juri-2-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 2</td>
                      <td class="subjudul-kanan">JURI 2</td>
                      <td class="nilai-juri nilai-juri-2-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-juri-3-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 3</td>
                      <td class="subjudul-kanan">JURI 3</td>
                      <td class="nilai-juri nilai-juri-3-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-valid-juri-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">NILAI</td>
                      <td class="subjudul-kanan">NILAI</td>
                      <td class="nilai-juri nilai-valid-juri-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="total-nilai-jatuhan-biru"></td>
                      <td class="nilai-juri nilai-jatuhan-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JATUHAN</td>
                      <td class="subjudul-kanan">JATUHAN</td>
                      <td class="nilai-juri nilai-jatuhan-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-jatuhan-merah"></td>
                    </tr>
                    <tr>
                      <td class="total-nilai-teguran-biru"></td>
                      <td class="nilai-juri nilai-teguran-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">Teguran</td>
                      <td class="subjudul-kanan">Teguran</td>
                      <td class="nilai-juri nilai-teguran-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-teguran-merah"></td>
                    </tr>
                    <tr>
                      <td class="total-nilai-peringatan-biru"></td>
                      <td class="nilai-juri nilai-peringatan-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">PERINGATAN</td>
                      <td class="subjudul-kanan">PERINGATAN</td>
                      <td class="nilai-juri nilai-peringatan-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-peringatan-merah"></td>
                    </tr>
                  </tbody>
              </table>

              <table class="table table-bordered" id="table-monitoring-nilai-2">
                <tbody>
                    <tr>
                      <th colspan="4" class="text-center judul-sudut-biru">Sudut Biru</th>
                      <th rowspan="2" class="text-center judul-round">Ronde</th>
                      <th colspan="4" class="text-center judul-sudut-merah">Sudut Merah</th>
                    </tr>
                    <tr>
                      <th class="text-center judul-total-sudut-biru">Total</th>
                      <th colspan="3" class="text-center judul-nilai-sudut-biru">Detail Nilai</th>
                      <th colspan="3" class="text-center judul-nilai-sudut-merah">Detail Nilai</th>
                      <th class="text-center judul-total-sudut-merah">Total</th>
                    </tr>
                    <tr>
                      <td rowspan="7" class="total-nilai-semua-biru">0</td>
                      <td rowspan="4" class="total-nilai-juri-biru">0</td>
                      <td class="nilai-juri nilai-juri-1-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 1</td>
                      <td rowspan="7" class="round-sekarang round-2">2</td>
                      <td class="subjudul-kanan">JURI 1</td>
                      <td class="nilai-juri nilai-juri-1-merah">
                        <div></div>
                      </td>
                      <td rowspan="4" class="total-nilai-juri-merah">0</td>
                      <td rowspan="7" class="total-nilai-semua-merah">0</td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-juri-2-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 2</td>
                      <td class="subjudul-kanan">JURI 2</td>
                      <td class="nilai-juri nilai-juri-2-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-juri-3-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 3</td>
                      <td class="subjudul-kanan">JURI 3</td>
                      <td class="nilai-juri nilai-juri-3-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-valid-juri-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">NILAI</td>
                      <td class="subjudul-kanan">NILAI</td>
                      <td class="nilai-juri nilai-valid-juri-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="total-nilai-jatuhan-biru"></td>
                      <td class="nilai-juri nilai-jatuhan-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JATUHAN</td>
                      <td class="subjudul-kanan">JATUHAN</td>
                      <td class="nilai-juri nilai-jatuhan-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-jatuhan-merah"></td>
                    </tr>
                    <tr>
                      <td class="total-nilai-teguran-biru"></td>
                      <td class="nilai-juri nilai-teguran-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">Teguran</td>
                      <td class="subjudul-kanan">Teguran</td>
                      <td class="nilai-juri nilai-teguran-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-teguran-merah"></td>
                    </tr>
                    <tr>
                      <td class="total-nilai-peringatan-biru"></td>
                      <td class="nilai-juri nilai-peringatan-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">PERINGATAN</td>
                      <td class="subjudul-kanan">PERINGATAN</td>
                      <td class="nilai-juri nilai-peringatan-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-peringatan-merah"></td>
                    </tr>
                  </tbody>
              </table>

              <table class="table table-bordered" id="table-monitoring-nilai-3">
                <tbody>
                    <tr>
                      <th colspan="4" class="text-center judul-sudut-biru">Sudut Biru</th>
                      <th rowspan="2" class="text-center judul-round">Ronde</th>
                      <th colspan="4" class="text-center judul-sudut-merah">Sudut Merah</th>
                    </tr>
                    <tr>
                      <th class="text-center judul-total-sudut-biru">Total</th>
                      <th colspan="3" class="text-center judul-nilai-sudut-biru">Detail Nilai</th>
                      <th colspan="3" class="text-center judul-nilai-sudut-merah">Detail Nilai</th>
                      <th class="text-center judul-total-sudut-merah">Total</th>
                    </tr>
                    <tr>
                      <td rowspan="7" class="total-nilai-semua-biru">0</td>
                      <td rowspan="4" class="total-nilai-juri-biru">0</td>
                      <td class="nilai-juri nilai-juri-1-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 1</td>
                      <td rowspan="7" class="round-sekarang round-3">3</td>
                      <td class="subjudul-kanan">JURI 1</td>
                      <td class="nilai-juri nilai-juri-1-merah">
                        <div></div>
                      </td>
                      <td rowspan="4" class="total-nilai-juri-merah">0</td>
                      <td rowspan="7" class="total-nilai-semua-merah">0</td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-juri-2-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 2</td>
                      <td class="subjudul-kanan">JURI 2</td>
                      <td class="nilai-juri nilai-juri-2-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-juri-3-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JURI 3</td>
                      <td class="subjudul-kanan">JURI 3</td>
                      <td class="nilai-juri nilai-juri-3-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="nilai-juri nilai-valid-juri-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">NILAI</td>
                      <td class="subjudul-kanan">NILAI</td>
                      <td class="nilai-juri nilai-valid-juri-merah">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="total-nilai-jatuhan-biru"></td>
                      <td class="nilai-juri nilai-jatuhan-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">JATUHAN</td>
                      <td class="subjudul-kanan">JATUHAN</td>
                      <td class="nilai-juri nilai-jatuhan-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-jatuhan-merah"></td>
                    </tr>
                    <tr>
                      <td class="total-nilai-teguran-biru"></td>
                      <td class="nilai-juri nilai-teguran-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">Teguran</td>
                      <td class="subjudul-kanan">Teguran</td>
                      <td class="nilai-juri nilai-teguran-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-teguran-merah"></td>
                    </tr>
                    <tr>
                      <td class="total-nilai-peringatan-biru"></td>
                      <td class="nilai-juri nilai-peringatan-biru">
                        <div></div>
                      </td>
                      <td class="subjudul-kiri">PERINGATAN</td>
                      <td class="subjudul-kanan">PERINGATAN</td>
                      <td class="nilai-juri nilai-peringatan-merah">
                        <div></div>
                      </td>
                      <td class="total-nilai-peringatan-merah"></td>
                    </tr>
                  </tbody>
              </table>
            </div>
        </div>
    </div>

    <input type="hidden" id="input-jadwal-pertandingan" value="<?php echo $tanding['id']; ?>">
    <input type="hidden" id="input-gelanggang" value="<?php echo $tanding['gelanggang']; ?>">
    <input type="hidden" id="input-no-partai" value="<?php echo $tanding['no_partai']; ?>">
    <input type="hidden" id="input-round">

    <script src="<?php echo base_url(); ?>assets/js/cleave-js/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function() {
          $('#popup_load').show();
          get_nilai_ronde()
          get_ronde()

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
              handleWebSocketMessagePartai(data);
            } else if(data.status_monitorr == '1'){
              handleWebsocketMessageNilai(data);
            } else if(data.status_nilaii == '1'){
              handleWebsocketMessageNilai(data);
            } else if(data.status_roundd == '1'){
              handleWebsocketMessageRound(data);
            }
        };

        socket.onerror = function(e) {
            console.error("WebSocket error: ", e);
        };

        // WEBSOCKET GANTI PARTAI
        function handleWebSocketMessagePartai(data) {
            let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
            if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
              if(data.result) {
                alert(`Pertandingan Akan Diganti ke Partai ${data.data.no_partai}`)
                window.location.href = `<?php echo base_url() ?>pertandingan/monitor_tanding/index/${data.data.id}`
              } else {
                alert('Tidak Ada Pertandingan Selanjutnya, Anda Akan Diarahkan ke Halaman Jadwal Pertandingan')
                window.location.href = `<?php echo base_url() ?>pertandingan/jadwal_pertandingan_tanding`
              }
            }
        }
        // WEBSOCKET END GANTI PARTAI

        // WEBSOCKET ROUND
        function handleWebsocketMessageRound(data){
          let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
              get_ronde();
              $('#popup_load').show();
          }
        }

        function get_ronde() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitoring_nilai/get_ronde') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan},
              dataType : 'json',
              async: false,
              success: function (res){
                if(res.ronde_berjalan != 0) {
                  $(`.round-sekarang`).removeClass('active')
                  $(`.round-${res.ronde_berjalan}`).addClass('active')
                }
              }
          })
        }
        // END WEBSOCKET ROUND

        // WEBSOCKET REFRESH NILAI
        function handleWebsocketMessageNilai(data){
          let id_jadwal_pertandingan = document.getElementById('input-jadwal-pertandingan').value;
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            // if(data.refresh_monitor) {
              get_nilai_ronde()
            // }
          }
        }
        // WEBSOCKET END REFRESH NILAI

        // WEBSOCKET REFRESH MONITOR
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
        // WEBSOCKET END REFRESH MONITOR

        function start() {
            $('#popup_load').hide();
        }

        function stop() {
            clearInterval(intervals);

            intervals = null;
        }

        function show_nilai_ronde(res, ronde) {
          let nilai_juri_1_biru = ''
          let nilai_juri_2_biru = ''
          let nilai_juri_3_biru = ''
          let nilai_juri_1_merah = ''
          let nilai_juri_2_merah = ''
          let nilai_juri_3_merah = ''
          let total_semua_biru = 0
          let total_semua_merah = 0

          if(res.data_nilai_juri.length > 0) {

            for(const item_nilai of res.data_nilai_juri) {
              if(item_nilai.ronde == ronde) {
                if(item_nilai.sudut == 'Biru' && item_nilai.id_juri == 1) {
                  nilai_juri_1_biru += `<p class="nilai-score-biru ${item_nilai.status_nilai == 'tidak_valid' ? 'tidak-valid' : 'valid'}">${item_nilai.nilai}</p>`
                } else if(item_nilai.sudut == 'Biru' && item_nilai.id_juri == 2) {
                  nilai_juri_2_biru += `<p class="nilai-score-biru ${item_nilai.status_nilai == 'tidak_valid' ? 'tidak-valid' : 'valid'}">${item_nilai.nilai}</p>`
                } else if(item_nilai.sudut == 'Biru' && item_nilai.id_juri == 3) {
                  nilai_juri_3_biru += `<p class="nilai-score-biru ${item_nilai.status_nilai == 'tidak_valid' ? 'tidak-valid' : 'valid'}">${item_nilai.nilai}</p>`
                } else if(item_nilai.sudut == 'Merah' && item_nilai.id_juri == 1) {
                  nilai_juri_1_merah += `<p class="nilai-score-merah ${item_nilai.status_nilai == 'tidak_valid' ? 'tidak-valid' : 'valid'}">${item_nilai.nilai}</p>`
                } else if(item_nilai.sudut == 'Merah' && item_nilai.id_juri == 2) {
                  nilai_juri_2_merah += `<p class="nilai-score-merah ${item_nilai.status_nilai == 'tidak_valid' ? 'tidak-valid' : 'valid'}">${item_nilai.nilai}</p>`
                } else if(item_nilai.sudut == 'Merah' && item_nilai.id_juri == 3) {
                  nilai_juri_3_merah += `<p class="nilai-score-merah ${item_nilai.status_nilai == 'tidak_valid' ? 'tidak-valid' : 'valid'}">${item_nilai.nilai}</p>`
                }
              }
            }

            $(`#table-monitoring-nilai-${ronde} .nilai-juri-1-biru div`).html(nilai_juri_1_biru)
            $(`#table-monitoring-nilai-${ronde} .nilai-juri-2-biru div`).html(nilai_juri_2_biru)
            $(`#table-monitoring-nilai-${ronde} .nilai-juri-3-biru div`).html(nilai_juri_3_biru)

            $(`#table-monitoring-nilai-${ronde} .nilai-juri-1-merah div`).html(nilai_juri_1_merah)
            $(`#table-monitoring-nilai-${ronde} .nilai-juri-2-merah div`).html(nilai_juri_2_merah)
            $(`#table-monitoring-nilai-${ronde} .nilai-juri-3-merah div`).html(nilai_juri_3_merah)
          }

          if(res.data_jatuhan.length > 0) {
            let nilai_jatuhan_biru = ''
            let nilai_jatuhan_merah = ''
            let total_nilai_jatuhan_biru = 0
            let total_nilai_jatuhan_merah = 0

            for(const item_jatuhan of res.data_jatuhan) {
              if(item_jatuhan.ronde == ronde) {
                if(item_jatuhan.sudut == 'Biru') {
                  nilai_jatuhan_biru += `<p class="nilai-score-biru">${item_jatuhan.nilai}</p>`
                  total_nilai_jatuhan_biru += parseInt(item_jatuhan.nilai)
                } else if(item_jatuhan.sudut == 'Merah') {
                  nilai_jatuhan_merah += `<p class="nilai-score-merah">${item_jatuhan.nilai}</p>`
                  total_nilai_jatuhan_merah += parseInt(item_jatuhan.nilai)
                }
              }
            }

            $(`#table-monitoring-nilai-${ronde} .nilai-jatuhan-biru div`).html(nilai_jatuhan_biru)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-jatuhan-biru`).html(total_nilai_jatuhan_biru)
            $(`#table-monitoring-nilai-${ronde} .nilai-jatuhan-merah div`).html(nilai_jatuhan_merah)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-jatuhan-merah`).html(total_nilai_jatuhan_merah)

            total_semua_biru += total_nilai_jatuhan_biru
            total_semua_merah += total_nilai_jatuhan_merah
          }

          if(res.data_teguran.length > 0) {
            let nilai_teguran_biru = ''
            let nilai_teguran_merah = ''
            let total_nilai_teguran_biru = 0
            let total_nilai_teguran_merah = 0

            for(const item_teguran of res.data_teguran) {
              if(item_teguran.ronde == ronde) {
                if(item_teguran.sudut == 'Biru') {
                  nilai_teguran_biru += `<p class="nilai-score-biru">${item_teguran.nilai}</p>`
                  total_nilai_teguran_biru += parseInt(item_teguran.nilai)
                } else if(item_teguran.sudut == 'Merah') {
                  nilai_teguran_merah += `<p class="nilai-score-merah">${item_teguran.nilai}</p>`
                  total_nilai_teguran_merah += parseInt(item_teguran.nilai)
                }
              }
            }

            $(`#table-monitoring-nilai-${ronde} .nilai-teguran-biru div`).html(nilai_teguran_biru)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-teguran-biru`).html(total_nilai_teguran_biru)
            $(`#table-monitoring-nilai-${ronde} .nilai-teguran-merah div`).html(nilai_teguran_merah)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-teguran-merah`).html(total_nilai_teguran_merah)

            total_semua_biru += total_nilai_teguran_biru
            total_semua_merah += total_nilai_teguran_merah
          }

          if(res.data_peringatan.length > 0) {
            let nilai_peringatan_biru = ''
            let nilai_peringatan_merah = ''
            let total_nilai_peringatan_biru = 0
            let total_nilai_peringatan_merah = 0

            for(const item_peringatan of res.data_peringatan) {
              if(item_peringatan.ronde == ronde) {
                if(item_peringatan.sudut == 'Biru') {
                  nilai_peringatan_biru += `<p class="nilai-score-biru">${item_peringatan.nilai}</p>`
                  total_nilai_peringatan_biru += parseInt(item_peringatan.nilai)
                } else if(item_peringatan.sudut == 'Merah') {
                  nilai_peringatan_merah += `<p class="nilai-score-merah">${item_peringatan.nilai}</p>`
                  total_nilai_peringatan_merah += parseInt(item_peringatan.nilai)
                }
              }
            }

            $(`#table-monitoring-nilai-${ronde} .nilai-peringatan-biru div`).html(nilai_peringatan_biru)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-peringatan-biru`).html(total_nilai_peringatan_biru)
            $(`#table-monitoring-nilai-${ronde} .nilai-peringatan-merah div`).html(nilai_peringatan_merah)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-peringatan-merah`).html(total_nilai_peringatan_merah)

            total_semua_biru += total_nilai_peringatan_biru
            total_semua_merah += total_nilai_peringatan_merah
          }

          if(res.data_valid_juri.length > 0) {
            let nilai_valid_biru = ''
            let nilai_valid_merah = ''
            let total_nilai_valid_biru = 0
            let total_nilai_valid_merah = 0
            let total_nilai_biru = 0
            let total_nilai_merah = 0
            for(const item_valid of res.data_valid_juri) {
              if(item_valid.ronde == ronde) {
                if(item_valid.sudut == 'Biru') {
                  nilai_valid_biru += `<p class="nilai-score-biru">${item_valid.nilai}</p>`
                  total_nilai_valid_biru += parseInt(item_valid.nilai)
                  total_nilai_biru += parseInt(item_valid.nilai)
                } else if(item_valid.sudut == 'Merah') {
                  nilai_valid_merah += `<p class="nilai-score-merah">${item_valid.nilai}</p>`
                  total_nilai_valid_merah += parseInt(item_valid.nilai)
                  total_nilai_merah += parseInt(item_valid.nilai)
                }
              }
            }

            $(`#table-monitoring-nilai-${ronde} .nilai-valid-juri-biru div`).html(nilai_valid_biru)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-valid-biru`).html(total_nilai_valid_biru)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-juri-biru`).html(total_nilai_biru)
            $(`#table-monitoring-nilai-${ronde} .nilai-valid-juri-merah div`).html(nilai_valid_merah)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-valid-merah`).html(total_nilai_valid_merah)
            $(`#table-monitoring-nilai-${ronde} .total-nilai-juri-merah`).html(total_nilai_merah)

            total_semua_biru += total_nilai_valid_biru
            total_semua_merah += total_nilai_valid_merah
          }

          // if(res.data_teguran.length > 0) {
          //   let total_teguran_biru = 0
          //   let total_teguran_merah = 0
          //   for(const item_teguran of res.data_teguran) {
          //     if(item_teguran.ronde == ronde) {
          //       if(item_teguran.sudut == 'Biru') {
          //         total_teguran_biru += parseInt(item_teguran.nilai)
          //       } else if(item_teguran.sudut == 'Merah') {
          //         total_teguran_merah += parseInt(item_teguran.nilai)
          //       }
          //     }
          //   }

          //   total_semua_biru += total_teguran_biru
          //   total_semua_merah += total_teguran_merah
          // }

          console.log(total_semua_biru, total_semua_merah)
          $(`#table-monitoring-nilai-${ronde} .total-nilai-semua-biru`).html(total_semua_biru)
          $(`#table-monitoring-nilai-${ronde} .total-nilai-semua-merah`).html(total_semua_merah)
        }

        function get_nilai_ronde() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitoring_nilai/get_nilai_ronde') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan},
              dataType : 'json',
              async: false,
              success: function (res) {
                show_nilai_ronde(res, 1)
                show_nilai_ronde(res, 2)
                show_nilai_ronde(res, 3)
              }
          })
        }
    </script>
</body>
</html>
