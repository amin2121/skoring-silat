<?php
class Laporan_produk extends CI_Controller{
  function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    header('Access-Control-Allow-Origin: *');
  }

  public function print_laporan(){
    $json = file_get_contents('php://input');
    $ambil = json_decode($json, true);

    $filter = $ambil['filter'];

    if ($filter == 'tanggal') {
      $tanggal_dari_fix = $ambil['tanggal_dari'];
      $tanggal_sampai_fix = $ambil['tanggal_sampai'];

      $tanggal_sql = $this->db->query("SELECT
                                        a.*
                                        FROM
                                        (
                                         SELECT
                                         a.stok,
                                         b.nama_barang,
                                         IFNULL(c.qty,0) AS qty_motaris,
                                         IFNULL(d.qty,0) AS qty_konsinyasi
                                         FROM gd_stok a
                                         LEFT JOIN gd_master_barang b ON a.id_barang = b.id
                                         LEFT JOIN (
                                        						 SELECT
                                        						 a.id_barang,
                                        						 SUM(a.qty) AS qty
                                        						 FROM pj_penjualan_motoris_detail a
                                        						 INNER JOIN pj_penjualan_motoris b ON a.id_penjualan_motoris = b.id
                                        						 WHERE STR_TO_DATE(b.tanggal,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                        						 AND STR_TO_DATE(b.tanggal,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                        						 GROUP BY a.id_barang
                                        						) c ON a.id_barang = c.id_barang
                                         LEFT JOIN (
                                        						 SELECT
                                        						 a.id_barang,
                                        						 SUM(a.laku) AS qty
                                        						 FROM pj_penjualan_konsinyasi_detail a
                                        						 INNER JOIN pj_penjualan_konsinyasi b ON a.id_penjualan_konsinyasi = b.id
                                        						 WHERE STR_TO_DATE(b.tanggal_titip,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                        						 AND STR_TO_DATE(b.tanggal_titip,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                        						 GROUP BY a.id_barang
                                        					 ) d ON a.id_barang = d.id_barang
                                        ) a
                                      ");
      $res_tanggal = $tanggal_sql->result_array();

      $data['judul'] = $tanggal_dari_fix.' s/d '.$tanggal_sampai_fix;
      $data['result'] = $res_tanggal;
      $data['title'] = 'Hari';
      $this->load->view('report/laporan_produk', $data);
    }elseif ($filter == 'bulan') {
      $bulan = $ambil['filter_bulan'];
      $tahun = $ambil['filter_bulan_tahun'];

      $bulan_sql = $this->db->query("SELECT
                                      a.*
                                      FROM
                                      (
                                       SELECT
                                       a.stok,
                                       b.nama_barang,
                                       IFNULL(c.qty,0) AS qty_motaris,
                                       IFNULL(d.qty,0) AS qty_konsinyasi
                                       FROM gd_stok a
                                       LEFT JOIN gd_master_barang b ON a.id_barang = b.id
                                       LEFT JOIN (
                                      						 SELECT
                                      						 a.id_barang,
                                      						 SUM(a.qty) AS qty
                                      						 FROM pj_penjualan_motoris_detail a
                                      						 INNER JOIN pj_penjualan_motoris b ON a.id_penjualan_motoris = b.id
                                                   WHERE b.bulan = '$bulan'
                                                   AND b.tahun = '$tahun'
                                      						 GROUP BY a.id_barang
                                      						) c ON a.id_barang = c.id_barang
                                       LEFT JOIN (
                                      						 SELECT
                                      						 a.id_barang,
                                      						 SUM(a.laku) AS qty
                                      						 FROM pj_penjualan_konsinyasi_detail a
                                      						 INNER JOIN pj_penjualan_konsinyasi b ON a.id_penjualan_konsinyasi = b.id
                                                   WHERE b.bulan_titip = '$bulan'
                                                   AND b.tahun_titip = '$tahun'
                                      						 GROUP BY a.id_barang
                                      					 ) d ON a.id_barang = d.id_barang
                                      ) a
                                      ");
      $res_bulan = $bulan_sql->result_array();

      if ($bulan == '01') {
        $nama_bulan = 'Januari';
      }elseif ($bulan == '02') {
        $nama_bulan = 'Februari';
      }elseif ($bulan == '03') {
        $nama_bulan = 'Maret';
      }elseif ($bulan == '04') {
        $nama_bulan = 'April';
      }elseif ($bulan == '05') {
        $nama_bulan = 'Mei';
      }elseif ($bulan == '06') {
        $nama_bulan = 'Juni';
      }elseif ($bulan == '07') {
        $nama_bulan = 'Juli';
      }elseif ($bulan == '08') {
        $nama_bulan = 'Agustus';
      }elseif ($bulan == '09') {
        $nama_bulan = 'September';
      }elseif ($bulan == '10') {
        $nama_bulan = 'Oktober';
      }elseif ($bulan == '11') {
        $nama_bulan = 'November';
      }elseif ($bulan == '12') {
        $nama_bulan = 'Desember';
      }

      $data['judul'] = $nama_bulan.' '.$tahun;
      $data['result'] = $res_bulan;
      $data['title'] = 'Bulan';
      $this->load->view('report/laporan_produk', $data);
    }elseif ($filter == 'tahun') {
      $tahun = $ambil['filter_tahun'];
      $sql_tahun = $this->db->query("SELECT
                                     a.*
                                     FROM
                                     (
                                      SELECT
                                      a.stok,
                                      b.nama_barang,
                                      IFNULL(c.qty,0) AS qty_motaris,
                                      IFNULL(d.qty,0) AS qty_konsinyasi
                                      FROM gd_stok a
                                      LEFT JOIN gd_master_barang b ON a.id_barang = b.id
                                      LEFT JOIN (
                                     						 SELECT
                                     						 a.id_barang,
                                     						 SUM(a.qty) AS qty
                                     						 FROM pj_penjualan_motoris_detail a
                                     						 INNER JOIN pj_penjualan_motoris b ON a.id_penjualan_motoris = b.id
                                     						 WHERE b.tahun = '$tahun'
                                     						 GROUP BY a.id_barang
                                     						) c ON a.id_barang = c.id_barang
                                      LEFT JOIN (
                                     						 SELECT
                                     						 a.id_barang,
                                     						 SUM(a.laku) AS qty
                                     						 FROM pj_penjualan_konsinyasi_detail a
                                     						 INNER JOIN pj_penjualan_konsinyasi b ON a.id_penjualan_konsinyasi = b.id
                                     						 WHERE b.tahun_titip = '$tahun'
                                     						 GROUP BY a.id_barang
                                     					 ) d ON a.id_barang = d.id_barang
                                     ) a
                                      ");
      $res_tahun = $sql_tahun->result_array();

      $data['judul'] = $tahun;
      $data['result'] = $res_tahun;
      $data['title'] = 'Tahun';
      $this->load->view('report/laporan_produk', $data);
    }

  }
}
