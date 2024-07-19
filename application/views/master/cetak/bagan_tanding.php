<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bagan Tanding</title>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/bracket/dist/assets/styles/jquery.bracket-world.css">
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
    <center><h2>Bagan Tanding</h2></center>
    <div class="clear:both;"></div>
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td style="width: 15%;"><?php echo $kompetisi['kategori'] == 'umur' ? 'Golongan' : 'Kelas' ?></td>
          <td style="width: 2%;">:</td>
          <td><?php echo strtoupper($kompetisi['kategori'] == 'umur' ? $golongan : $kelas); ?></td>
        </tr>
        <tr>
          <td style="width: 15%;">Jenis Kelamin</td>
          <td style="width: 2%;">:</td>
          <td><?php echo ucfirst($jenis_kelamin); ?></td>
        </tr>
        <tr>
          <td style="width: 15%;">Kelas Tanding</td>
          <td style="width: 2%;">:</td>
          <td><?php echo strtoupper($kelas_tanding['kelas_tanding']); ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <div class="clear:both;"></div>
    <div class="bagan">

    </div>
    <script src="<?php echo base_url() ?>assets/js/plugins/bracket/dist/assets/scripts/jquery.bracket-world.min.js"></script>
    <script>
      $(document).ready(function () {
        data_undian()
      })

      function data_undian() {
        let id_kompetisi = '<?php echo $id_kompetisi ?>'
        let golongan = '<?php echo $golongan ?>'
        let kelas = '<?php echo $kelas ?>'
        let jenis_kelamin = '<?php echo $jenis_kelamin ?>'
        let id_kelas_tanding = '<?php echo $id_kelas_tanding ?>'

        $.ajax({
            url : '<?php echo base_url('master/bagan_tanding/data_undian') ?>',
            method : 'POST',
            data: {id_kompetisi, golongan, kelas, jenis_kelamin, id_kelas_tanding},
            dataType : 'json',
            async: false,
            success: function (res){
              console.log(res)
              $('.bagan').bracket({
                teams: res.teams,
                scale:0.50,
                // teamWidth:340,
                scaleDelta:0.40,
                horizontal:0,
                height:'1000px',
                icons:true,
                bgcolor: '#ffffff',
                teamNames:res.team_names
              });

              // window.print()
              // window.onfocus = function () { window.close(); }
          }
        })
      }
    </script>
  </body>
</html>
