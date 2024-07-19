<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Halaman Pencatat Waktu</title>
<link rel="icon" href="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" type="image/x-icon">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_pertandingan/css/style.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery/jquery.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body style="background-color: #000;">
<style>
  .container {
    /* background-color: #ADBC9F; */
    background-color: #000;
  }

  .input, .arena-dan-round {
    color: #ffffff;
  }

  .partai-selanjutnya, .wrap-score-peringatan, .wrap-score-teguran, .wrap-score-binaan, .wrap-score-jatuhan, .score-tendangan, .judull-round, .judul-round {
    background-color: #ffffff;
  }
</style>
<div class="pencatat-waktu">
    <header>
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
    <div class="container">
        <a href="<?php echo base_url() ?>pertandingan/jadwal_pertandingan_tanding" class="btn btn-kembali">Kembali</a>
        <br>
        <br>
        <div class="info-pertandingan">
            <div class="setting-waktu">
                <label for="input-waktu" class="input">Setting Waktu (Menit) : </label>
                <input type="number" placeholder="1" id="input-waktu" class="input-waktu" value="1">
            </div>
            <p class="arena-dan-round">Round <span id="round-sekarang">1</span></p>
        </div>
        <br>
        <br>
        <div class="table-konfigurasi-waktu">
            <div class="table-header">
                <p>Time : </p>
                <p class="live-waktu">
                    <span class="menit">00</span>:<span class="detik">00</span>
                </p>
            </div>
            <div class="table-content">
                <button class="btn btn-waktu-mulai" id="btn-waktu-mulai">Start Clock</button>
                <button class="btn btn-gong" id="btn-gong">Gong</button>
                <button class="btn btn-waktu-berhenti" id="btn-waktu-berhenti">Stop Clock</button>
            </div>
        </div>
        <br>
        <div class="table-peserta">
            <div class="table-content">
                <div class="table-item">
                    <div>
                        <h5 class="nama-peserta-biru"><?php echo $tanding['nama_pesilat_biru']; ?></h5>
                        <p class="peserta-asal"><?php echo $tanding['kontingen_biru']; ?></p>
                    </div>
                    <div>
                        <h5 class="nama-peserta-merah"><?php echo $tanding['nama_pesilat_merah']; ?></h5>
                        <p class="peserta-asal"><?php echo $tanding['kontingen_merah']; ?></p>
                    </div>
                    <div>
                        <p>Partai <?php echo $tanding['no_partai']; ?></p>
                    </div>
                    <div>
                        <p><?php echo $tanding['kelas_tanding']; ?> <?php echo $tanding['golongan']; ?></p>
                    </div>
                    <div>
                        <p><?php echo $tanding['babak']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="table-konfigurasi-round">
            <div class="table-content">
              <button class="btn btn-round round-1" id="btn-ronde-1" onclick="set_round(1)">Round 1</button>
              <button class="btn btn-round round-2" id="btn-ronde-2" onclick="set_round(2)">Round 2</button>
              <button class="btn btn-round round-3" id="btn-ronde-3" onclick="set_round(3)">Round 3</button>
            </div>
        </div>
        <br><br><br><br><br><br>
    </div>
</div>

<input type="hidden" id="input-jadwal-pertandingan" name="id_jadwal_pertandingan" value="<?php echo $tanding['id'] ?>">
<input type="hidden" id="input-status-selesai-pertandingan" value="<?php echo $tanding['status_selesai_pertandingan']; ?>">

<script src="<?php echo base_url(); ?>assets_pertandingan/js/cleave-js/dist/cleave.min.js"></script>
<script>

    $(document).ready(function() {
      let status_selesai_pertandingan = $(`#input-status-selesai-pertandingan`).val()
      if(status_selesai_pertandingan == 1) {
        $(`#btn-waktu-mulai`).prop('disabled', true).addClass('disabled')
        $(`#btn-gong`).prop('disabled', true).addClass('disabled')
        $(`#btn-waktu-berhenti`).prop('disabled', true).addClass('disabled')

        $(`#btn-ronde-1`).prop('disabled', true).addClass('disabled')
        $(`#btn-ronde-2`).prop('disabled', true).addClass('disabled')
        $(`#btn-ronde-3`).prop('disabled', true).addClass('disabled')
      }
    })

    // 192.168.55.126
    var socket = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');

    socket.onopen = function(e) {
        console.log("WebSocket connection established!");
    };

    // WEBSOCKET GANTI PARTAI
    socket.onmessage = function(event){
      let data = JSON.parse(event.data);
      if(data.status_partaii == '1'){
        let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
        if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
          if(data.result) {
            alert(`Pertandingan Akan Diganti ke Partai ${data.data.no_partai}`)
            window.location.href = `<?php echo base_url() ?>pertandingan/pencatat_waktu/index/${data.data.id}`
          } else {
            alert('Tidak Ada Pertandingan Selanjutnya, Anda Akan Diarahkan ke Halaman Jadwal Pertandingan')
            window.location.href = `<?php echo base_url() ?>pertandingan/jadwal_pertandingan_tanding`
          }
        }
      }
    }
    // WEBSOCKET END GANTI PARTAI

    let intervals = null;
    let remainingSeconds = 0;

    let menit = document.querySelector('.menit')
    let detik = document.querySelector('.detik')
    let milidetik = document.querySelector('.milidetik')
    let inputWaktu = document.querySelector('.input-waktu')
    let liveWaktu = document.querySelector('.live-waktu')
    let buttonGong = document.querySelector('.btn-gong')
    let buttonResetWaktu = document.querySelector('.btn-reset-waktu')
    let buttonSetWaktu = document.querySelector('.btn-set-waktu')
    let buttonWaktuMulai = document.querySelector('.btn-waktu-mulai')
    let buttonWaktuBerhenti = document.querySelector('.btn-waktu-berhenti')

    var mi = 0;
    var ss = 0;
    var ms = 0;

    if (inputWaktu.value < 60) {
        stop();
        if(inputWaktu.value == null || inputWaktu.value == '') {
            remainingSeconds = 0 * 60;
        } else {
            remainingSeconds = inputWaktu.value * 60 * 100;
        }

        updateInterfaceTime();
    }

    buttonGong.addEventListener('click', () => {
        let gong = '<?php echo $gelanggang['gong'] ?>'
        console.log(gong);
        new Audio('<?php echo base_url() ?>storage/gong/' + gong).play();
    })

    buttonWaktuMulai.addEventListener("click", () => {
        if (intervals === null) {
            setting_waktu_monitor('start')
        }
    });

    inputWaktu.addEventListener("keyup", () => {
        if (inputWaktu.value < 60) {
            stop();
            if(inputWaktu.value == null || inputWaktu.value == '') {
                remainingSeconds = 0 * 60;
            } else {
                remainingSeconds = inputWaktu.value * 60 * 100;
            }

            updateInterfaceTime();
            set_waktu_awal()
        }

    });

    buttonWaktuBerhenti.addEventListener("click", () => {
        setting_waktu_monitor('stop')
    });

    $(document).ready(function () {
      get_round()
      set_waktu_awal()
    })

    function set_waktu_awal() {
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

      $.ajax({
          url : '<?php echo base_url('pertandingan/pencatat_waktu/setting_waktu_awal') ?>',
          method : 'POST',
          data: {id_jadwal_pertandingan, waktu: inputWaktu.value},
          dataType : 'json',
          async: false,
          success: function (res){
              // 192.168.55.126
              var conn = new WebSocket('ws://<?php echo $ip['ip']; ?>:8080/ws');
              var status_awalwaktuu = 1;
              var waktu_awal = inputWaktu.value;
              var data = {
                waktu_awal: waktu_awal,
                id_jadwal_pertandingan: id_jadwal_pertandingan,
                status_awalwaktuu: status_awalwaktuu
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

    function get_round() {
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

      $.ajax({
          url : '<?php echo base_url('pertandingan/pencatat_waktu/get_round') ?>',
          method : 'POST',
          data: {id_jadwal_pertandingan},
          dataType : 'json',
          async: false,
          success: function (res){
            if(res.ronde_berjalan != 0) {
              $(`#round-sekarang`).html(res.ronde_berjalan)
              $(`.btn-round`).removeClass('active')
              $(`.btn-round.round-${res.ronde_berjalan}`).addClass('active')
            }
          }
      })
    }

    function set_round(round) {
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

      $.ajax({
          url : '<?php echo base_url('pertandingan/pencatat_waktu/setting_round') ?>',
          method : 'POST',
          data: {round, id_jadwal_pertandingan, waktu_awal: inputWaktu.value},
          dataType : 'json',
          success: function (res) {
            // 192.168.55.126
              var conn = new WebSocket('ws://localhost:8080/ws');
              var status_roundd = 1;
              var reset_waktuu = inputWaktu.value;
              var data = {
                round: round,
                reset_waktuu: reset_waktuu,
                id_jadwal_pertandingan: id_jadwal_pertandingan,
                status_roundd: status_roundd
              };

              conn.onopen = function() {
                  console.log("WebSocket connection established!");
                  conn.send(JSON.stringify(data));
              };

              conn.onerror = function(error) {
                  console.error("WebSocket error: ", error);
              };

              $(`#round-sekarang`).html(res.data.round)

              $(`.btn-round`).removeClass('active')
              $(`.btn-round.round-${round}`).addClass('active')

              reset_waktu()
          }
      });
    }

    function reset_waktu() {
      if (inputWaktu.value < 60) {
          stop();
          if(inputWaktu.value == null || inputWaktu.value == '') {
              remainingSeconds = 0 * 60;
          } else {
              remainingSeconds = inputWaktu.value * 60 * 100;
          }

          updateInterfaceTime();
      }

      setting_waktu_monitor('stop')
    }

    function setting_waktu_monitor(status_waktu) {
      let waktu = inputWaktu.value
      let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

      $.ajax({
          url : '<?php echo base_url('pertandingan/pencatat_waktu/setting_waktu_monitor') ?>',
          method : 'POST',
          data: {status_waktu, waktu, id_jadwal_pertandingan},
          dataType : 'json',
          success: function (res) {
            // 192.168.55.126
            var conn = new WebSocket('ws://localhost:8080/ws');
            var status_timerr = 1;
            var data = {
              status_waktu: status_waktu,
              waktu: waktu,
              id_jadwal_pertandingan: id_jadwal_pertandingan,
              status_timerr: status_timerr
            };

            conn.onopen = function() {
                console.log("WebSocket connection established!");
                conn.send(JSON.stringify(data));
            };

            conn.onerror = function(error) {
                console.error("WebSocket error: ", error);
            };

            if(status_waktu == 'start') {
              start()
            } else {
              stop();
            }
          }
      });
    }

    function updateInterfaceTime() {
      let usedTime = Math.floor((+new Date() - +new Date()) / 10)
      let totalTime = remainingSeconds - usedTime
      var mi = Math.floor(totalTime / (60 * 100))
      var ss = Math.floor((totalTime - mi * 60 * 100) / 100)
      // var ms = totalTime - Math.floor(totalTime / 100) * 100

      menit.innerHTML = mi.toString().padStart(2, "0")
      detik.innerHTML = ss.toString().padStart(2, "0")
      // milidetik.innerHTML = ms.toString().padStart(2, "0")
    }

    function start() {
      if (remainingSeconds === 0) return

      intervals = setInterval(() => {
          remainingSeconds--
          updateInterfaceTime()

          if (remainingSeconds === 0) {
              stop()
          }
      }, 10)
    }

    function stop() {
      clearInterval(intervals)

      intervals = null
    }
</script>
</body>
<!-- </html> -->
