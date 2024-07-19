<script type="text/javascript">
  $(document).ready(function() {
    $(`select[name="metode_pembayaran"]`).change(function() {
      let metode_pembayaran = $(this).val()
      if(metode_pembayaran == 'transfer') {
        $(`.form-bukti-transfer`).show()
      } else {
        $(`.form-bukti-transfer`).hide()
      }
    })
  })
</script>
<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>master/kontingen">Kontingen</a></li>
        <li class="active">Tambah</li>
    </ul>
</div>
<!-- END PAGE HEADING -->

<!-- START PAGE CONTAINER -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Kontingen</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>master/kontingen/tambah" enctype="multipart/form-data">
            <h2 style="font-weight: 600; border-bottom: 1px solid #ccc; margin-bottom: 30px; padding-bottom: 5px;">Data Kontingen</h2>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama</label>
                <div class="col-md-10">
                    <input type="text" name="nama" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Pelatih</label>
                <div class="col-md-10">
                    <input type="text" name="pelatih" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Telepon</label>
                <div class="col-md-10">
                    <input type="text" name="no_telepon" class="form-control">
                </div>
            </div>
            <h2 style="font-weight: 600; border-bottom: 1px solid #ccc; margin-bottom: 30px; margin-top: 20px; padding-bottom: 5px;">Data Pembayaran</h2>
            <div class="form-group">
                <label class="col-md-2 control-label">Status Pembayaran</label>
                <div class="col-md-10">
                    <div class="app-radio round inline">
                        <label><input type="radio" name="status_pembayaran" value="0" checked> Belum Lunas</label>
                    </div>
                    <div class="app-radio round inline">
                        <label><input type="radio" name="status_pembayaran" value="1"> Lunas</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jumlah Bayar</label>
                <div class="col-md-10">
                    <input type="text" name="jumlah_bayar" class="form-control" onkeyup="FormatCurrency(this);">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Metode Pembayaran</label>
                <div class="col-md-10">
                    <select class="form-control" name="metode_pembayaran">
                      <option value="">-- Pilih Metode Pembayaran --</option>
                      <option value="tunai">Tunai</option>
                      <option value="transfer">Transfer</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-bukti-transfer" style="display: none;">
                <label class="col-md-2 control-label">Bukti Pembayaran</label>
                <div class="col-md-10">
                  <input type="file" name="bukti_pembayaran" class="form-control">
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Tambah</button>
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
