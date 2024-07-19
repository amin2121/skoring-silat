<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor</title>
    <link rel="icon" href="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_pertandingan/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body>
<style>
  .content {
    background-color: #ADBC9F;
  }

  .binaan, .teguran, .peringatan, .score_pukulan, .score-pukulan, .score-tendangan, .icon-scoree, .judul-round {
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
    width: 150px;
    height: 150px;
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
    font-size: 20px;
    font-weight: bold;
    color: #000; /* Ubah warna teks sesuai keinginan */
    margin-top: 170px; /* Sesuaikan margin atas untuk menempatkan teks di bawah gambar */
  }
</style>
  
  <div id="popup_load">
      <div class="window_load">
      <img src="<?php echo base_url('assets_pertandingan/image/ipsi.png') ?>" alt="IPSI" class="logo-ipsi-load"/>
          <!-- <img src="<?=base_url()?>assets/Ellipsis.gif" height="120" width="120"> -->
          <div class="loading-text">Loading...</div>
      </div>
  </div>
    <div class="monitor">
      <div class="dewan">
        <header class="header-nav" style="padding-bottom:18px;">
            <div class="container-logo"><img src="<?php echo base_url('assets_pertandingan/image/ipsi.png') ?>" alt="IPSI" class="logo-ipsi"/></div>
            <div class="header-nav__content">
              <h3 style="margin-bottom: 8px;"><?php echo $tanding['kompetisi'] ?></h3>
              <div class="informasi-pertandingan">
                <h4>Gel <?php echo $tanding['gelanggang']; ?> - Partai <?php echo $tanding['no_partai']; ?></h4>
                <h4><?php echo $tanding['babak']; ?></h4>
                <h4>Tanding - <?php echo $tanding['kelas_tanding']; ?></h4>
              </div>
            </div>
            <div class="container-logo"><img src="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" alt="TAPAK SUCI" class="logo-tapak-suci"/></div>
        </header>
      </div>
        <div class="content">
            <div class="data-pesilat">
                <div class="informasi-pesilat-biru col-sm-3">
                    <h2 class="nama-pesilat-biru"><?php echo $tanding['nama_pesilat_biru'] ?></h2>
                    <h3 class="asal-pesilat"><?php echo $tanding['kontingen_biru'] ?></h3>
                </div>
                <div class="waktu-pertandingan col-sm-6" style="justify-content:center;">
                  <p class="live-waktu">
                      <span class="menit">00</span>:<span class="detik">00</span>
                  </p>
                </div>
                <div class="informasi-pesilat-merah col-sm-3">
                    <h2 class="nama-pesilat-merah"><?php echo $tanding['nama_pesilat_merah'] ?></h2>
                    <h3 class="asal-pesilat"><?php echo $tanding['kontingen_merah'] ?></h3>
                </div>
            </div>
            <div class="content-monitor">
                <div class="monitor-kiri">
                    <div class="info-peringatan">
                        <div class="binaan">
                            <div id="binaan-pertama-biru">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/binaan-1.svg" alt="binaan-1" style="width: 80%;">
                            </div>
                            <div id="binaan-kedua-biru">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/binaan-2.svg" alt="binaan-2" style="width: 80%;">
                            </div>
                        </div>
                        <div class="teguran">
                            <div id="teguran-pertama-biru">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/teguran-1.svg" alt="teguran-1" style="width: 50%;">
                            </div>
                            <div id="teguran-kedua-biru">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/teguran-2.svg" alt="teguran-2" style="width: 50%;">
                            </div>
                        </div>
                        <div class="peringatan">
                            <div id="peringatan-pertama-biru">
                                <span class="content-peringatan">1</span>
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal.png" alt="peringatan" style="width: 90%;">
                            </div>
                            <div id="peringatan-kedua-biru">
                                <span class="content-peringatan">2</span>
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal.png" alt="peringatan" style="width: 90%;">
                            </div>
                            <div id="peringatan-ketiga-biru">
                                <span class="content-peringatan">3</span>
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal.png" alt="peringatan" style="width: 90%;">
                            </div>
                        </div>
                    </div>
                    <div class="info-score-pesilat-biru">
                        <p>0</p>
                    </div>
                </div>
                <div class="monitor-tengah">
                    <div class="item-round" id="round-3">
                        <span></span>
                    </div>
                    <div class="item-round" id="round-2">
                        <span></span>
                    </div>
                    <div class="item-round" id="round-1">
                        <span></span>
                    </div>
                    <div class="judul-round">Ronde</div>
                </div>
                <div class="monitor-kanan">
                    <div class="info-score-pesilat-merah">
                        <p>0</p>
                    </div>
                    <div class="info-peringatan">
                        <div class="binaan">
                            <div id="binaan-pertama-merah">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/binaan-1.svg" alt="binaan-1" style="width: 80%;">
                            </div>
                            <div id="binaan-kedua-merah">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/binaan-2.svg" alt="binaan-2" style="width: 80%;">
                            </div>
                        </div>
                        <div class="teguran">
                            <div id="teguran-pertama-merah">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/teguran-1.svg" alt="teguran-1" style="width: 50%;">
                            </div>
                            <div id="teguran-kedua-merah">
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/teguran-2.svg" alt="teguran-2" style="width: 50%;">
                            </div>
                        </div>
                        <div class="peringatan">
                            <div id="peringatan-pertama-merah">
                                <span class="content-peringatan">1</span>
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal.png" alt="peringatan" style="width: 90%;">
                            </div>
                            <div id="peringatan-kedua-merah">
                                <span class="content-peringatan">2</span>
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal.png" alt="peringatan" style="width: 90%;">
                            </div>
                            <div id="peringatan-ketiga-merah">
                                <span class="content-peringatan">3</span>
                                <img src="<?php echo base_url(); ?>assets_pertandingan/image/signal.png" alt="peringatan" style="width: 90%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="live-score-pesilat">
                <div class="score-pesilat-biru">
                    <div class="score-pukulan">
                        <div class="juri-1">
                            J1
                        </div>
                        <div class="juri-2">
                            J2
                        </div>
                        <div class="juri-3">
                            J3
                        </div>
                    </div>
                    <div class="score-tendangan">
                        <div class="juri-1">
                            J1
                        </div>
                        <div class="juri-2">
                            J2
                        </div>
                        <div class="juri-3">
                            J3
                        </div>
                    </div>
                </div>
                <div class="score-icon">
                    <div class="icon-scoree">
                        <img src="<?php echo base_url(); ?>assets_pertandingan/image/pukulan.svg" alt="binaan-1" style="width: 20%;">
                    </div>
                    <div class="icon-scoree">
                        <img src="<?php echo base_url(); ?>assets_pertandingan/image/tendangan.svg" alt="binaan-1" style="width: 25%;">
                    </div>
                </div>
                <div class="score-pesilat-merah">
                    <div class="score-pukulan">
                        <div class="juri-1">
                            J1
                        </div>
                        <div class="juri-2">
                            J2
                        </div>
                        <div class="juri-3">
                            J3
                        </div>
                    </div>
                    <div class="score-tendangan">
                        <div class="juri-1">
                            J1
                        </div>
                        <div class="juri-2">
                            J2
                        </div>
                        <div class="juri-3">
                            J3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="input-jadwal-pertandingan" value="<?php echo $tanding['id']; ?>">
    <input type="hidden" id="input-round">
    <script>
        $(document).ready(function() {
          // $('#popup_load').show();
          // setTimeout(function() {
          //       $('#popup_load').hide();
          //   }, 10000);

          get_ronde()
          get_nilai_juri()
          get_binaan('biru')
          get_teguran('biru')
          get_peringatan('biru')
          get_binaan('merah')
          get_teguran('merah')
          get_peringatan('merah')
        })

        let intervals = null
        let remainingSeconds = 0
        let waktu = 0

        // PUSHER WAKTU
        var pusher_waktu_monitor = new Pusher('e636cb98a16cc38f57fe', {
            cluster: 'ap1'
        });

        var channel_waktu_monitor = pusher_waktu_monitor.subscribe('waktu-monitor');
        channel_waktu_monitor.bind('setting-waktu-monitor', function(data) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            let status_waktu = data.status_waktu
            if(remainingSeconds == 0) {
                remainingSeconds = data.waktu * 60 * 100 - 1;
            }

            if(status_waktu == 'start') {
              start()
            } else {
              stop()
            }
          }
        });

        // PUSHER GANTI PARTAI
        let pusher_ganti_partai = new Pusher('e636cb98a16cc38f57fe', {
            cluster: 'ap1'
        })

        let channel_ganti_partai = pusher_ganti_partai.subscribe('ganti-partai')
        channel_ganti_partai.bind('action-ganti-partai', function(data) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            if(data.result) {
              alert(`Pertandingan Akan Diganti ke Partai ${data.data.no_partai}`)
              window.location.href = `<?php echo base_url() ?>pertandingan/monitor_tanding/index/${data.data.id}`
            } else {
              alert('Tidak Ada Pertandingan Selanjutnya, Anda Akan Diarahkan ke Halaman Jadwal Pertandingan')
              window.location.href = `<?php echo base_url() ?>pertandingan/jadwal_pertandingan_tanding`
            }
          }
        })
        // PUSHER END GANTI PARTAI

        function updateInterfaceTime() {

            let usedTime = Math.floor((+new Date() - +new Date()) / 10);
            let totalTime = remainingSeconds - usedTime
            var mi = Math.floor(totalTime / (60 * 100));
            var ss = Math.floor((totalTime - mi * 60 * 100) / 100);

            $(`.live-waktu .menit`).html(mi.toString().padStart(2, "0"))
            $(`.live-waktu .detik`).html(ss.toString().padStart(2, "0"))
        }

        function start() {
            if (remainingSeconds === 0) return;

            intervals = setInterval(() => {
                remainingSeconds--;
                updateInterfaceTime();

                if (remainingSeconds === 0) {
                    stop();
                }
            }, 10);

            $('#popup_load').hide();
        }

        function stop() {
            clearInterval(intervals);

            intervals = null;
        }

        let pusher_waktu_awal = new Pusher('e636cb98a16cc38f57fe', {
            cluster: 'ap1'
        })

        let channel_waktu_awal = pusher_waktu_awal.subscribe('waktu-awal')
        channel_waktu_awal.bind('setting-waktu-awal', function(data) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            if(data.waktu_awal == null || data.waktu_awal == '') {
                remainingSeconds = 0 * 60;
            } else {
                remainingSeconds = data.waktu_awal * 60 * 100;
            }

            updateInterfaceTime()
          }
        })
        // END PUSHER WAKTU

        // PUSHER ROUND
        let pusher_ronde = new Pusher('e636cb98a16cc38f57fe', {
            cluster: 'ap1'
        })

        let channel_ronde = pusher_ronde.subscribe('round')
        channel_ronde.bind('setting-round', function(data) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            get_ronde()
            remainingSeconds = data.reset_waktu * 60 * 100;
            updateInterfaceTime()

            get_binaan('biru')
            get_teguran('biru')
            get_peringatan('biru')
            get_binaan('merah')
            get_teguran('merah')
            get_peringatan('merah')
          }
        })

        function get_ronde() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitor_tanding/get_ronde') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan},
              dataType : 'json',
              async: false,
              success: function (res){
                if(res.ronde_berjalan != 0) {
                  $(`.item-round`).removeClass('active')
                  $(`#round-${res.ronde_berjalan}`).addClass('active')

                  if(res.ronde_berjalan == 1) {
                    $(`.item-round#round-2 span`).text('')
                    $(`.item-round#round-3 span`).text('')
                  } else if(res.ronde_berjalan == 2) {
                    $(`.item-round#round-1 span`).text('')
                    $(`.item-round#round-3 span`).text('')
                  } else if(res.ronde_berjalan == 3) {
                    $(`.item-round#round-1 span`).text('')
                    $(`.item-round#round-2 span`).text('')
                  }

                  $(`.item-round#round-${res.ronde_berjalan} span`).text(res.ronde_berjalan)
                  $(`#input-round`).val(res.ronde_berjalan)
                }
              }
          })
        }
        // END PUSHER ROUND

        // PUSHER ACTIVE JURI
        var pusher_active_juri = new Pusher('e636cb98a16cc38f57fe', {
            cluster: 'ap1'
        });

        var channel_active_juri = pusher_active_juri.subscribe('active-juri');
        channel_active_juri.bind('action-active-juri', function(data) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            if(data.nilai == 1) {

              if(data.sudut == 'Biru') {

                $(`.score-pesilat-biru .score-pukulan .juri-${data.juri}`).addClass('active')
                setTimeout(function() {
                  $(`.score-pesilat-biru .score-pukulan .juri-${data.juri}`).removeClass('active')
                }, 3000)

              } else if(data.sudut == 'Merah') {

                $(`.score-pesilat-merah .score-pukulan .juri-${data.juri}`).addClass('active')
                setTimeout(function() {
                  $(`.score-pesilat-merah .score-pukulan .juri-${data.juri}`).removeClass('active')
                }, 3000)

              }
            } else if(data.nilai == 2) {

              if(data.sudut == 'Biru') {

                $(`.score-pesilat-biru .score-tendangan .juri-${data.juri}`).addClass('active')
                setTimeout(function() {
                  $(`.score-pesilat-biru .score-tendangan .juri-${data.juri}`).removeClass('active')
                }, 3000)

              } else if(data.sudut == 'Merah') {

                $(`.score-pesilat-merah .score-tendangan .juri-${data.juri}`).addClass('active')
                setTimeout(function() {
                  $(`.score-pesilat-merah .score-tendangan .juri-${data.juri}`).removeClass('active')
                }, 3000)

              }
            }
          }
        });
        // END ACTIVE JURI

        // PUSHER REFRESH MONITOR
        let pusher_refresh_monitor = new Pusher('e636cb98a16cc38f57fe', {
            cluster: 'ap1'
        })

        let channel_refresh_monitor = pusher_refresh_monitor.subscribe('refresh-monitor')
        channel_refresh_monitor.bind('action-refresh-monitor', function(data) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          if(data.id_jadwal_pertandingan == id_jadwal_pertandingan) {
            if(data.refresh_monitor == true) {
                if(data.aksi == 'binaan') {
                  get_binaan(data.sudut)
                } else if(data.aksi == 'teguran') {
                  get_teguran(data.sudut)
                } else if(data.aksi == 'peringatan') {
                  get_peringatan(data.sudut)
                }

                get_nilai_juri()
            }
          }
        })

        function get_nilai_juri() {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let id_round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitor_tanding/get_nilai_juri') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan, id_round},
              dataType : 'json',
              async: false,
              success: function (res){

                let hasil_sudut_biru = res.hasil_akhir_sudut_biru + res.hasil_tanding_jatuhan_biru + res.hasil_tanding_teguran_biru + res.hasil_tanding_peringatan_biru
                let hasil_sudut_merah = res.hasil_akhir_sudut_merah + res.hasil_tanding_jatuhan_merah + res.hasil_tanding_teguran_merah + res.hasil_tanding_peringatan_merah

                $(`.info-score-pesilat-biru p`).text(hasil_sudut_biru)
                $(`.info-score-pesilat-merah p`).text(hasil_sudut_merah)
              },
          })
        }

        function get_binaan(sudut) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let id_round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitor_tanding/get_binaan') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan, id_round, sudut},
              dataType : 'json',
              async: false,
              success: function (res){
                sudut = sudut.toLowerCase()

                if(res.total_data == 1) {
                  $(`#binaan-pertama-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/binaan-1-active.svg')
                } else if(res.total_data > 1) {
                  $(`#binaan-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/binaan-2-active.svg')
                } else {
                  $(`#binaan-pertama-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/binaan-1.svg')
                  $(`#binaan-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/binaan-2.svg')
                }

              },
          })
        }

        function get_teguran(sudut) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let id_round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitor_tanding/get_teguran') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan, id_round, sudut},
              dataType : 'json',
              async: false,
              success: function (res){
                sudut = sudut.toLowerCase()

                if(res.total_data == 1) {
                  $(`#teguran-pertama-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/teguran-1-active.svg')
                } else if(res.total_data > 1) {
                  $(`#teguran-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/teguran-2-active.svg')
                } else {
                  $(`#teguran-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/teguran-1.svg')
                  $(`#teguran-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/teguran-2.svg')
                }

              },
          })
        }

        function get_peringatan(sudut) {
          let id_jadwal_pertandingan = $(`#input-jadwal-pertandingan`).val()
          let id_round = $(`#input-round`).val()

          $.ajax({
              url : '<?php echo base_url('pertandingan/monitor_tanding/get_peringatan') ?>',
              method : 'POST',
              data: {id_jadwal_pertandingan, id_round, sudut},
              dataType : 'json',
              async: false,
              success: function (res){
                sudut = sudut.toLowerCase()

                if(res.total_data == 1) {
                  $(`#peringatan-pertama-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/signal-kuning.png')
                } else if(res.total_data == 2) {
                  $(`#peringatan-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/signal-kuning.png')
                } else if(res.total_data > 2) {
                  $(`#peringatan-ketiga-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/signal-kuning.png')
                } else {
                  $(`#peringatan-pertama-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/signal.png')
                  $(`#peringatan-kedua-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/signal.png')
                  $(`#peringatan-ketiga-${sudut} img`).attr('src', '<?php echo base_url(); ?>assets_pertandingan/image/signal.png')
                }

              },
          })
        }
        // END REFRESH MONITOR
    </script>
</body>
</html>
