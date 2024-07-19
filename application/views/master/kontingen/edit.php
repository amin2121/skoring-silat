<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>kontingen">Kontingen</a></li>
        <li class="active">Edit</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Kontingen</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>master/kontingen/edit" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <h2 style="font-weight: 600; border-bottom: 1px solid #ccc; margin-bottom: 30px; padding-bottom: 5px;">Data Kontingen</h2>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama</label>
                <div class="col-md-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Pelatih</label>
                <div class="col-md-10">
                    <input type="text" name="pelatih" class="form-control" value="<?php echo $row['pelatih'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Telepon</label>
                <div class="col-md-10">
                    <input type="text" name="no_telepon" class="form-control" value="<?php echo $row['no_telepon'] ?>">
                </div>
            </div>
            <h2 style="font-weight: 600; border-bottom: 1px solid #ccc; margin-bottom: 30px; margin-top: 20px; padding-bottom: 5px;">Data Pembayaran</h2>
            <div class="form-group">
                <label class="col-md-2 control-label">Status Pembayaran</label>
                <div class="col-md-10">
                    <div class="app-radio round inline">
                        <label><input type="radio" name="status_pembayaran" value="0" <?php echo $row['status_pembayaran'] == 0 ? 'checked' : '' ?>> Belum Lunas</label>
                    </div>
                    <div class="app-radio round inline">
                        <label><input type="radio" name="status_pembayaran" value="1" <?php echo $row['status_pembayaran'] == 1 ? 'checked' : '' ?>> Lunas</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jumlah Bayar</label>
                <div class="col-md-10">
                    <input type="text" name="jumlah_bayar" class="form-control" onkeyup="FormatCurrency(this);"  value="<?php echo number_format($row['jumlah_bayar'] == '' || $row['jumlah_bayar'] == null ? 0 : $row['jumlah_bayar']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Metode Pembayaran</label>
                <div class="col-md-10">
                    <select class="form-control" name="metode_pembayaran">
                      <option value="">-- Pilih Metode Pembayaran --</option>
                      <option value="tunai" <?php echo ($row['metode_pembayaran'] == 'tunai') ? 'selected' : '' ?>>Tunai</option>
                      <option value="transfer" <?php echo ($row['metode_pembayaran'] == 'transfer') ? 'selected' : '' ?>>Transfer</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-bukti-transfer" style="display: <?php echo ($row['metode_pembayaran'] == 'transfer') ? 'block' : 'none' ?>;">
                <label class="col-md-2 control-label">Bukti Pembayaran</label>
                <div class="col-md-10">
                  <input type="file" name="bukti_pembayaran" class="form-control">
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Edit</button>
                  <a href="<?php echo base_url(); ?>master/kompetisi"><button class="btn btn-warning btn-sm" type="button">Kembali</button></a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->
