<?php
class Laporan_keuangan extends CI_Controller{
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

      $row_konsinyasi = $this->db->query("SELECT
                                          SUM(a.total_harga_laku) AS total_harga
                                          FROM pj_penjualan_konsinyasi a
                                          WHERE STR_TO_DATE(a.tanggal_laku,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                          AND STR_TO_DATE(a.tanggal_laku,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                         ")->row_array();

      $row_motoris = $this->db->query("SELECT
                                         SUM(a.total_harga) AS total_harga
                                         FROM pj_penjualan_motoris a
                                         WHERE STR_TO_DATE(a.tanggal,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                         AND STR_TO_DATE(a.tanggal,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                        ")->row_array();

      $row_pemasukan = $this->db->query("SELECT
                                         SUM(a.nominal) AS nominal
                                         FROM ku_pemasukan a
                                         WHERE STR_TO_DATE(a.tanggal,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                         AND STR_TO_DATE(a.tanggal,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                        ")->row_array();

      $row_pengeluaran = $this->db->query("SELECT
                                         SUM(a.nominal) AS nominal
                                         FROM ku_pengeluaran a
                                         WHERE STR_TO_DATE(a.tanggal,'%d-%m-%Y') >= STR_TO_DATE('$tanggal_dari_fix','%d-%m-%Y')
                                         AND STR_TO_DATE(a.tanggal,'%d-%m-%Y') <= STR_TO_DATE('$tanggal_sampai_fix','%d-%m-%Y')
                                        ")->row_array();

      $data['judul'] = $tanggal_dari_fix.' s/d '.$tanggal_sampai_fix;
      $data['title'] = 'Hari';
      $data['row_konsinyasi'] = $row_konsinyasi;
      $data['row_motoris'] = $row_motoris;
      $data['row_pemasukan'] = $row_pemasukan;
      $data['row_pengeluaran'] = $row_pengeluaran;
      $this->load->view('report/laporan_keuangan', $data);
    }elseif ($filter == 'bulan') {
      $bulan = $ambil['filter_bulan'];
      $tahun = $ambil['filter_bulan_tahun'];

      $row_konsinyasi = $this->db->query("SELECT
                                          SUM(a.total_harga_laku) AS total_harga
                                          FROM pj_penjualan_konsinyasi a
                                          WHERE a.bulan_laku = '$bulan'
                                          AND a.tahun_laku = '$tahun'
                                         ")->row_array();

      $row_motoris = $this->db->query("SELECT
                                         SUM(a.total_harga) AS total_harga
                                         FROM pj_penjualan_motoris a
                                         WHERE a.bulan = '$bulan'
                                         AND a.tahun = '$tahun'
                                        ")->row_array();

      $row_pemasukan = $this->db->query("SELECT
                                         SUM(a.nominal) AS nominal
                                         FROM ku_pemasukan a
                                         WHERE a.bulan = '$bulan'
                                         AND a.tahun = '$tahun'
                                        ")->row_array();

      $row_pengeluaran = $this->db->query("SELECT
                                         SUM(a.nominal) AS nominal
                                         FROM ku_pengeluaran a
                                         WHERE a.bulan = '$bulan'
                                         AND a.tahun = '$tahun'
                                        ")->row_array();

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
      $data['row_konsinyasi'] = $row_konsinyasi;
      $data['row_motoris'] = $row_motoris;
      $data['row_pemasukan'] = $row_pemasukan;
      $data['row_pengeluaran'] = $row_pengeluaran;
      $data['title'] = 'Bulan';
      $this->load->view('report/laporan_keuangan', $data);
    }elseif ($filter == 'tahun') {
      $tahun = $ambil['filter_tahun'];

      $row_konsinyasi = $this->db->query("SELECT
                                          SUM(a.total_harga_laku) AS total_harga
                                          FROM pj_penjualan_konsinyasi a
                                          WHERE a.tahun_laku = '$tahun'
                                         ")->row_array();

      $row_motoris = $this->db->query("SELECT
                                         SUM(a.total_harga) AS total_harga
                                         FROM pj_penjualan_motoris a
                                         WHERE a.tahun = '$tahun'
                                        ")->row_array();

      $row_pemasukan = $this->db->query("SELECT
                                         SUM(a.nominal) AS nominal
                                         FROM ku_pemasukan a
                                         WHERE a.tahun = '$tahun'
                                        ")->row_array();

      $row_pengeluaran = $this->db->query("SELECT
                                         SUM(a.nominal) AS nominal
                                         FROM ku_pengeluaran a
                                         WHERE a.tahun = '$tahun'
                                        ")->row_array();

      $data['judul'] = $tahun;
      $data['row_konsinyasi'] = $row_konsinyasi;
      $data['row_motoris'] = $row_motoris;
      $data['row_pemasukan'] = $row_pemasukan;
      $data['row_pengeluaran'] = $row_pengeluaran;
      $data['title'] = 'Tahun';
      $this->load->view('report/laporan_keuangan', $data);
    }

  }
}
