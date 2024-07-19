<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_jadwal_pertandingan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
    $data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();

		$this->load->view('templates/header', $data);
    $this->load->view('laporan/laporan_jadwal_pertandingan');
    $this->load->view('templates/footer');
	}

  public function cetak()
  {
    $kompetisi = $this->input->post('kompetisi');
    $gelanggang = $this->input->post('gelanggang');
    $data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();
    $data_jadwal_pertandingan = $this->db->query("SELECT
                                                    a.*
                                                  FROM ms_jadwal_partai_tanding a
                                                  WHERE a.id_kompetisi = '$kompetisi'
                                                  AND a.gelanggang = '$gelanggang'
                                ")->result_array();


    $data['result'] = $data_jadwal_pertandingan;
    $data['kompetisi'] = $data_kompetisi;
    $data['gelanggang'] = $gelanggang;
    $this->load->view('laporan/cetak/laporan_jadwal_pertandingan', $data);
  }
}

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
