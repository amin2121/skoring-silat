<?php
class Laporan_penjualan_motoris_detail extends CI_Controller{
  function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    header('Access-Control-Allow-Origin: *');
  }

  public function print_laporan(){
    $json = file_get_contents('php://input');
    $ambil = json_decode($json, true);

    $filter = $ambil['filter'];

    $kasir = $ambil['kasir'];
    $where_kasir = "";
    $nama_kasir = 'Semua';
    if ($kasir != 'Semua') {
      $row_a = $this->db->get_where('pg_master_pegawai', array('id' => $kasir))->row_array();
      $where_kasir = "AND a.id_user = '$kasir'";
      $nama_kasir = $row_a['nama_pegawai'];
    }

    if ($filter == 'tanggal') {
      $tanggal_dari_fix = $ambil['tanggal_dari'];
      $tanggal_sampai_fix = $ambil['tanggal_sampai'];

      $tanggal_sql = $this->db->query("SELECT
                                       a.*
                                       FROM pj_penjualan_motoris a
                                       WHERE STR_TO_DATE(a.tanggal,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                       AND STR_TO_DATE(a.tanggal,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                       $where_kasir
                                       ORDER BY STR_TO_DATE(a.tanggal, '%d-%m-%Y') ASC
                                      ");
      $res_tanggal = $tanggal_sql->result_array();

      $data['judul'] = $tanggal_dari_fix.' s/d '.$tanggal_sampai_fix;
      $data['result'] = $res_tanggal;
      $data['kasir'] = $nama_kasir;
      $data['title'] = 'Hari';
      $this->load->view('report/laporan_penjualan_motoris_detail', $data);
    }elseif ($filter == 'bulan') {
      $bulan = $ambil['filter_bulan'];
      $tahun = $ambil['filter_bulan_tahun'];

      $bulan_sql = $this->db->query("SELECT
                                     a.tanggal,
                                     SUM(a.total_harga) AS sub_total_harga
                                     FROM pj_penjualan_motoris a
                                     WHERE a.bulan = '$bulan'
                                     AND a.tahun = '$tahun'
                                     GROUP BY a.tanggal
                                     ORDER BY STR_TO_DATE(a.tanggal, '%d-%m-%Y') ASC
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
      $data['kasir'] = $nama_kasir;
      $data['title'] = 'Bulan';
      $this->load->view('report/laporan_penjualan_motoris_detail', $data);
    }elseif ($filter == 'tahun') {
      $tahun = $ambil['filter_tahun'];
      $sql_tahun = $this->db->query("SELECT
                                     a.tanggal,
                                     SUM(a.total_harga) AS sub_total_harga
                                     FROM pj_penjualan_motoris a
                                     WHERE a.tahun = '$tahun'
                                     GROUP BY a.tanggal
                                     ORDER BY STR_TO_DATE(a.tanggal, '%d-%m-%Y') ASC
                                      ");
      $res_tahun = $sql_tahun->result_array();

      $data['judul'] = $tahun;
      $data['result'] = $res_tahun;
      $data['kasir'] = $nama_kasir;
      $data['title'] = 'Tahun';
      $this->load->view('report/laporan_penjualan_motoris_detail', $data);
    }

  }
}
