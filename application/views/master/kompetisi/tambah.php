<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>kompetisi">Kompetisi</a></li>
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
            <h3 class="panel-title">Tambah Kompetisi</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>master/kompetisi/tambah" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <input type="text" name="kompetisi" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kategori</label>
                <div class="col-md-10">
                    <select class="form-control" name="kategori">
                      <option value="">-- Pilih Kategori --</option>
                      <option value="kelas">Kelas</option>
                      <option value="umur">Umur</option>
                    </select>
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
