<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laporan Pesilat Terbaik</title>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
  </head>
  <style type="text/css" media="print">
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
    <center><h2>Laporan Pesilat Terbaik</h2></center>
    <div class="clear:both;"></div>
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td style="width: 15%;">Kompetisi</td>
          <td style="width: 2%;">:</td>
          <td><?php echo $kompetisi['kompetisi']; ?></td>
        </tr>
        <tr>
          <td style="width: 15%;">Gelanggang</td>
          <td style="width: 2%;">:</td>
          <td><?php echo ucfirst($gelanggang); ?></td>
        </tr>
        <tr>
          <td style="width: 15%;">Kontingen</td>
          <td style="width: 2%;">:</td>
          <td><?php echo ucfirst($kontingen); ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <div class="clear:both;"></div>
    <table style="width: 100%;" class="grid">
      <thead>
        <tr>
          <th style="text-align: center;">Rank</th>
          <th style="text-align: center;">Pesilat</th>
          <th style="text-align: center;">Kontingen</th>
          <th style="text-align: center;">Hukuman</th>
          <th style="text-align: center;">Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        foreach ($result as $res):
        $no++;
        ?>
        <tr>
          <td style="text-align:center;"><?php echo $no ?></td>
          <td><b style="text-transform: uppercase;"><?php echo $res['nama_pesilat'] ?></b></td>
          <td style="text-align:center;"><?php echo $res['kontingen']; ?></td>
          <td style="text-align:center;"><?php echo $res['hukuman']; ?></td>
          <td style="text-align:center;"><?php echo $res['nilai']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      window.print();
      window.onfocus = function () { window.close(); }
    </script>
  </body>
</html>
