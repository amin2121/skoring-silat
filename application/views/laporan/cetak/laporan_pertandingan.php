<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laporan Pertandingan</title>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
  </head>
  <style type="text/css">
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
      background: #ffdd00 !important;
    }

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
      height: 20px;
      padding-left: 5px;
      padding-right: 5px;
     }

    .grid {
    	background: black;
      border-collapse: collapse;
    	border: 1px solid black;
      border-spacing: 0;
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


  </style>
  <body class="body">
    <center><h2>Laporan Pertandingan</h2></center>
    <div class="clear:both;"></div>
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td style="width: 15%;">Kompetisi</td>
          <td style="width: 2%;">:</td>
          <td><?php echo $kompetisi['kompetisi']; ?></td>
        </tr>
        <tr>
          <td style="width: 15%;">Babak</td>
          <td style="width: 2%;">:</td>
          <td><?php echo strtoupper($babak); ?></td>
        </tr>
        <tr>
          <td style="width: 15%;">Gelanggang</td>
          <td style="width: 2%;">:</td>
          <td><?php echo strtoupper($gelanggang); ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <div class="clear:both;"></div>
    <table style="width: 100%;" class="grid">
      <thead>
        <tr>
          <th style="text-align: center;">No</th>
          <th style="text-align: center;">Gel</th>
          <th style="text-align: center;">Partai</th>
          <th style="text-align: center;" class="th-biru">Sudut Biru</th>
          <th style="text-align: center;" class="th-merah">Sudut Merah</th>
          <th style="text-align: center;" class="th-kuning">Nilai Sudut Biru</th>
          <th style="text-align: center;" class="th-kuning">Nilai Sudut Merah</th>
          <th style="text-align: center;">Pemenang</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        foreach ($result as $res):
        $no++;
        ?>
        <tr>
          <td style="text-align:center;" rowspan="2"><?php echo $no ?></td>
          <td style="text-align:center;" rowspan="2"><?php echo $res['gelanggang']; ?></td>
          <td style="text-align:center;" rowspan="2"><?php echo $res['no_partai']; ?></td>
          <td><b style="text-transform: uppercase;" class="td-biru"><?php echo $res['nama_pesilat_biru'] ?></b></td>
          <td><b style="text-transform: uppercase;" class="td-merah"><?php echo $res['nama_pesilat_merah'] ?></b></td>
          <td style="text-align:center;" rowspan="2"><?php echo $res['nilai_sudut_biru']; ?></td>
          <td style="text-align:center;" rowspan="2"><?php echo $res['nilai_sudut_merah']; ?></td>
          <td style="text-align:center; text-transform: uppercase;" rowspan="2"><?php echo $res['pemenang']; ?></td>
        </tr>
        <tr>
          <td class="td-biru"><?php echo $res['kontingen_biru'] ?></td>
          <td class="td-merah"><?php echo $res['kontingen_merah'] ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      window.print();
      // window.onfocus = function () { window.close(); }
    </script>
  </body>
</html>
