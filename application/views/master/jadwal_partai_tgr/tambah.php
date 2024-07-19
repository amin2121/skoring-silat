<!-- START PAGE HEADING -->
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>jadwal_partai_tgr">Jadwal Partai TGR</a></li>
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
            <h3 class="panel-title">Tambah Jadwal Partai Tunggal</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>jadwal_partai_tgr/tambah" enctype="multipart/form-data">
            <input type="hidden" name="kategori_tanding" value="Tunggal">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kompetisi">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>"><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Golongan</label>
                <div class="col-md-10">
                  <select class="form-control" name="golongan">
                    <option value="Usia Dini">Usia Dini</option>
                    <option value="Pra Remaja">Pra Remaja</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Undian</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="no_undian" placeholder="No Undian">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat" placeholder="Nama Pesilat">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kontingen</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_biru" placeholder="Kontingen">
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Tambah</button>
                  <a href="<?php echo base_url(); ?>jadwal_partai_tgr"><button class="btn btn-warning btn-sm" type="button">Kembali</button></a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Jadwal Partai Ganda</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>jadwal_partai_tgr/tambah" enctype="multipart/form-data">
            <input type="hidden" name="kategori_tanding" value="Ganda">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kompetisi">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>"><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Golongan</label>
                <div class="col-md-10">
                  <select class="form-control" name="golongan">
                    <option value="Usia Dini">Usia Dini</option>
                    <option value="Pra Remaja">Pra Remaja</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Undian</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="no_undian" placeholder="No Undian">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat 1</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_1" placeholder="Nama Pesilat 1">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat 2</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_2" placeholder="Nama Pesilat 2">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kontingen</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_biru" placeholder="Kontingen">
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Tambah</button>
                  <a href="<?php echo base_url(); ?>jadwal_partai_tgr"><button class="btn btn-warning btn-sm" type="button">Kembali</button></a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Jadwal Partai Regu</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>jadwal_partai_tgr/tambah" enctype="multipart/form-data">
            <input type="hidden" name="kategori_tanding" value="Regu">
            <div class="form-group">
                <label class="col-md-2 control-label">Kompetisi</label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kompetisi">
                      <?php foreach ($kompetisi as $k): ?>
                        <option value="<?php echo $k['id']; ?>"><?php echo $k['kompetisi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Golongan</label>
                <div class="col-md-10">
                  <select class="form-control" name="golongan">
                    <option value="Usia Dini">Usia Dini</option>
                    <option value="Pra Remaja">Pra Remaja</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">No Undian</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="no_undian" placeholder="No Undian">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat 1</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_1" placeholder="Nama Pesilat 1">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat 2</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_2" placeholder="Nama Pesilat 2">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Pesilat 3</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_3" placeholder="Nama Pesilat 3">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kontingen</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nama_pesilat_biru" placeholder="Kontingen">
                </div>
            </div>
            <div class="form-group margin-top-10">
                <div class="col-md-12">
                  <button class="btn btn-success btn-sm" type="submit">Tambah</button>
                  <a href="<?php echo base_url(); ?>jadwal_partai_tgr"><button class="btn btn-warning btn-sm" type="button">Kembali</button></a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTAINER -->
