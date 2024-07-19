<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jadwal Pertandingan</title>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
  </head>
  <style type="text/css">
    @page {
       /*size: landscape;*/
      margin: 1cm;
    }

    .body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .grid th {
      background: white;
      vertical-align: middle;
      border: 1px solid black;
      color : black;
      text-align: center;
      height: 30px;
      font-size: 13px;
     }

    .grid td {
      background: #FFFFFF;
      vertical-align: middle;
      border: 1px solid black;
      font: 11px/15px sans-serif;
      font-size: 11px;
      height: 15px;
      padding-left: 3px;
      padding-right: 3px;
     }

    .grid {
    	background: black;
      border-collapse: collapse;
    	border: 1px solid black;
      border-spacing: 0;
      text-transform: uppercase;
     }

    .grid tfoot td{
    	background: white;
    	vertical-align: middle;
    	color : black;
      text-align: center;
      height: 20px;
     }

    .footer{
      position:absolute;
      /* right:0; */
      bottom:0;
     }

    .signature {
		  display: flex;
		  justify-content: space-between;
		  padding: 0 30px;
	   }

     .text-center {
      text-align: center;
     }

     .th-biru {
      background: #0b71e0 !important;
      color: white !important;
    }
    
     .th-merah {
      background: #e74131 !important;
      color: white !important;
    }

    .td-biru {
      color: #0b71e0;
    }

    .td-merah {
      color: #e74131;
    }

    .th-kuning {
      background: #fffc7f !important;
    }

    h2 {
      margin: 0;
      padding: 0;
    }

    .kompetisi {
      margin-bottom: 10px;
      font-size: 20px;
      text-transform: uppercase;
    }

    .text-bold {
      font-weight: bold !important;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 5px double black;
      padding-bottom: 4px;
    }
  </style>
  <body class="body">
    <header>
      <img src="<?php echo base_url('assets_pertandingan/image/ipsi.png') ?>" alt="ipsi" style="width: 80px;">
      <h2 class="text-center kompetisi">Jadwal Pertandingan <br> <?php echo $kompetisi['kompetisi'] ?></h2>
      <img src="<?php echo base_url('assets_pertandingan/image/tapak-suci.webp') ?>" alt="ipsi" style="width: 120px;">
    </header>
    <div class="clear:both;"></div>
    <br>
    <table class="grid" style="width: 100%;">
      <thead>
        <tr>
          <th colspan="3" class="text-center th-kuning"><p id="tanggal"></p></th>
          <th colspan="4" class="text-center th-kuning"><?php echo $gelanggang == '' ? 'SEMUA GELANGGANG' : 'GELANGGANG ' . $gelanggang ?></th>
          <th colspan="2" class="text-center th-kuning"></th>
        </tr>
        <tr>
          <th class="text-center th-kuning" rowspan="2" style="width: 50px;">NO</th>
          <th class="text-center th-kuning" rowspan="2" style="width: 80px;">PARTAI</th>
          <th class="text-center th-kuning" rowspan="2" style="width: 120px;">KELAS</th>
          <th colspan="2" class="text-center th-biru" style="width: 25%;">BIRU</th>
          <th colspan="2" class="text-center th-merah" style="width: 25%;">MERAH</th>
          <th class="text-center th-kuning" colspan="2" rowspan="2">REMARKS</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 0;
          foreach ($result as $res):
          $no++;
          ?>
          <tr>
            <td rowspan="2" class="text-center text-bold"><?php echo $no ?></td>
            <td rowspan="2" class="text-center text-bold"><?php echo $res['no_partai']; ?></td>
            <td rowspan="2" class="text-center text-bold"><?php echo $res['kelas_tanding'] ?> / <?php echo $res['kategori'] == 'umur' ? $res['golongan'] : $res['kelas'] ?></td>
            <td colspan="2" class="text-center">
              <p class="nama-pesilat-biru"><?php echo $res['nama_pesilat_biru'] ?></p>
            </td>
            <td colspan="2" class="text-center">
              <p class="nama-pesilat-merah"><?php echo $res['nama_pesilat_merah'] ?></p>
            </td>
            <td rowspan="2" class="text-center"></td>
            <td rowspan="2" class="text-center"></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center text-bold">
              <p><?php echo $res['kontingen_biru'] ?></p>
            </td>
            <td colspan="2" class="text-center text-bold">
              <p><?php echo $res['kontingen_merah'] ?></p>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      window.print();
      window.onfocus = function () { window.close(); }

      ubah_tanggal()
      function ubah_tanggal() {
        var date = new Date('<?php echo $tanggal ?>');
        var tahun = date.getFullYear();
        var bulan = date.getMonth();
        var tanggal = date.getDate();
        var hari = date.getDay();
        var jam = date.getHours();
        var menit = date.getMinutes();
        var detik = date.getSeconds();

        switch(hari) {
          case 0: hari = "Minggu"; break;
          case 1: hari = "Senin"; break;
          case 2: hari = "Selasa"; break;
          case 3: hari = "Rabu"; break;
          case 4: hari = "Kamis"; break;
          case 5: hari = "Jum'at"; break;
          case 6: hari = "Sabtu"; break;
        }

        switch(bulan) {
          case 0: bulan = "Januari"; break;
          case 1: bulan = "Februari"; break;
          case 2: bulan = "Maret"; break;
          case 3: bulan = "April"; break;
          case 4: bulan = "Mei"; break;
          case 5: bulan = "Juni"; break;
          case 6: bulan = "Juli"; break;
          case 7: bulan = "Agustus"; break;
          case 8: bulan = "September"; break;
          case 9: bulan = "Oktober"; break;
          case 10: bulan = "November"; break;
          case 11: bulan = "Desember"; break;
        }

        var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
        var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;
        
        document.getElementById('tanggal').innerHTML = tampilTanggal
      }
    </script>
  </body>
</html>
