<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {
  public function jumlah_penjualan_motoris(){
    $bulan = date('m');
    $tahun = date('Y');
    $sql = $this->db->query("SELECT
                             COUNT(a.id) AS hitung,
                             a.bulan,
                             a.tahun
                             FROM pj_penjualan_motoris a
                             WHERE a.bulan = '$bulan' AND a.tahun = '$tahun'");
   return $sql->row_array();
  }

  public function jumlah_penjualan_konsinyasi(){
    $bulan = date('m');
    $tahun = date('Y');
    $sql = $this->db->query("SELECT
                             COUNT(a.id) AS hitung,
                             a.bulan_titip AS bulan,
                             a.tahun_titip AS tahun
                             FROM pj_penjualan_konsinyasi a
                             WHERE a.bulan_titip = '$bulan' AND a.tahun_titip = '$tahun'");
   return $sql->row_array();
  }

  public function chart_penjualan_bulan_sales(){
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $sql = $this->db->query("SELECT
                             a.nama_pegawai,
                             COUNT(b.id) AS jumlah
                             FROM pg_master_pegawai a
                             LEFT JOIN (SELECT a.*
                                        FROM pj_penjualan_konsinyasi a
                                        WHERE a.bulan_titip = '$bulan' AND a.tahun_titip = '$tahun') b ON a.id = b.id_pegawai
                             WHERE a.jabatan = 'Sales'
                             GROUP BY a.id
                             ");
   $data_penjualan = $sql->result_array();

   $array_penjualan = array();
   foreach ($data_penjualan as $value) {

     $array_penjualan[] = array(
       'label' => $value['nama_pegawai'],
       'y' => intval($value['jumlah'])
     );
   }

   $keluar['penjualan'] = $array_penjualan;
   return $keluar;
  }

  public function chart_penjualan_bulan_toko(){
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $sql = $this->db->query("SELECT
                             a.nama_toko,
                             COUNT(b.id) AS jumlah
                             FROM tk_master_toko a
                             LEFT JOIN (SELECT a.*
                                        FROM pj_penjualan_konsinyasi a
                                        WHERE a.bulan_titip = '$bulan' AND a.tahun_titip = '$tahun') b ON a.id = b.id_toko
                             GROUP BY a.id
                             ");
   $data_penjualan = $sql->result_array();

   $array_penjualan = array();
   foreach ($data_penjualan as $value) {

     $array_penjualan[] = array(
       'label' => $value['nama_toko'],
       'y' => intval($value['jumlah'])
     );
   }

   $keluar['penjualan'] = $array_penjualan;
   return $keluar;
  }

  public function chart_penjualan_bulan_area(){
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $sql = $this->db->query("SELECT
                             a.area,
                             COUNT(b.id) AS jumlah
                             FROM tk_area a
                             LEFT JOIN (SELECT a.*
                                        FROM pj_penjualan_konsinyasi a
                                        WHERE a.bulan_titip = '$bulan' AND a.tahun_titip = '$tahun') b ON a.id = b.id_area
                             GROUP BY a.id
                             ");
   $data_penjualan = $sql->result_array();

   $array_penjualan = array();
   foreach ($data_penjualan as $value) {

     $array_penjualan[] = array(
       'label' => $value['area'],
       'y' => intval($value['jumlah'])
     );
   }

   $keluar['penjualan'] = $array_penjualan;
   return $keluar;
  }

  public function chart_penjualan_bulan_motoris(){
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $sql = $this->db->query("SELECT
                             a.tanggal_titip AS tanggal,
                             COUNT(a.id) AS jumlah
                             FROM pj_penjualan_konsinyasi a
                             WHERE a.bulan_titip = '$bulan'
                             AND a.tahun_titip = '$tahun'
                             GROUP BY a.id
                             ");
   $data_penjualan = $sql->result_array();

   $array_penjualan = array();
   foreach ($data_penjualan as $value) {

     $array_penjualan[] = array(
       'label' => $value['tanggal'],
       'y' => intval($value['jumlah'])
     );
   }

   $keluar['penjualan'] = $array_penjualan;
   return $keluar;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
