<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_pertandingan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
    $data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();

		$this->load->view('templates/header', $data);
    $this->load->view('master/jadwal_pertandingan');
    $this->load->view('templates/footer');
	}

  public function cetak()
  {
    $kompetisi = $this->input->post('kompetisi');
    $tanggal = $this->input->post('tanggal');
    $tanggal = str_replace('/', '-', $tanggal);
    $gelanggang = $this->input->post('gelanggang');
		$no_partai_awal = $this->input->post('no_partai_awal');
		$no_partai_akhir = $this->input->post('no_partai_akhir');
    $data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();

    $where_gelanggang = '';
    if($gelanggang != '') {
      $where_gelanggang = "AND a.gelanggang = '$gelanggang'";
    }

		$where_no_partai = "";
		if($no_partai_awal != '' && $no_partai_akhir != '') {
			$where_no_partai = "AND no_partai BETWEEN $no_partai_awal AND $no_partai_akhir";
		} else if($no_partai_awal == '' || $no_partai_akhir == '') {
			if($no_partai_awal == '') {
				$where_no_partai = "AND no_partai BETWEEN $no_partai_akhir AND $no_partai_akhir";
			} else {
				$where_no_partai = "AND no_partai BETWEEN $no_partai_awal AND $no_partai_awal";
			}
		}


		$where_tanggal = "";
		if($tanggal != ""){
			$where_tanggal = "AND a.tanggal = '$tanggal'";

		}

    $data_jadwal_pertandingan = $this->db->query("SELECT
                                                    a.*,
                                                    b.kategori
                                                  FROM ms_jadwal_partai_tanding a
                                                  LEFT JOIN ms_kompetisi b ON a.id_kompetisi = b.id
                                                  WHERE a.id_kompetisi = '$kompetisi'
                                                  $where_gelanggang
																									$where_no_partai
																									$where_tanggal
                                ")->result_array();

    $data['result'] = $data_jadwal_pertandingan;
    $data['tanggal'] = date('D M d Y H:i:s O', strtotime($tanggal));
    $data['kompetisi'] = $data_kompetisi;
    $data['gelanggang'] = $gelanggang;
    $this->load->view('master/cetak/jadwal_pertandingan', $data);
  }
}

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
