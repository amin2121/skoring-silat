<?php
class Laporan_penjualan_area extends CI_Controller{
  function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    header('Access-Control-Allow-Origin: *');
  }

  public function print_laporan(){
    $json = file_get_contents('php://input');
    $ambil = json_decode($json, true);

    $filter = $ambil['filter'];
    $area = $ambil['area'];
    $row_a = $this->db->get_where('tk_area', array('id' => $area))->row_array();
    if ($filter == 'tanggal') {
      $tanggal_dari_fix = $ambil['tanggal_dari'];
      $tanggal_sampai_fix = $ambil['tanggal_sampai'];

      $tanggal_sql = $this->db->query("SELECT
                                       a.id AS id_toko,
                                       a.nama_toko,
                                       a.alamat,
                                       IFNULL(b.total_harga_laku,0) AS total_harga_laku,
                                       IFNULL(b.diskon,0) AS diskon
                                       FROM tk_master_toko a
                                       LEFT JOIN (
                                        	SELECT
                                        	a.id_toko,
                                        	SUM(a.total_harga_laku) AS total_harga_laku,
                                        	SUM(a.diskon) AS diskon
                                        	FROM pj_penjualan_konsinyasi a
                                        	WHERE STR_TO_DATE(a.tanggal_titip,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                        	AND STR_TO_DATE(a.tanggal_titip,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                        	GROUP BY a.id_toko
                                       ) b ON a.id = b.id_toko
                                      ");
      $res_tanggal = $tanggal_sql->result_array();

      $res_barang = $this->db->query("SELECT
                                      a.*,
                                      b.kode_barang,
                                      b.nama_barang
                                      FROM gd_stok a
                                      INNER JOIN gd_master_barang b ON a.id_barang = b.id")->result_array();

      $data['judul'] = $tanggal_dari_fix.' s/d '.$tanggal_sampai_fix;
      $data['result'] = $res_tanggal;
      $data['barang'] = $res_barang;
      $data['area'] = $row_a['area'];
      $data['title'] = 'Hari';
      $this->load->view('report/laporan_penjualan_area', $data);
    }

  }
}
