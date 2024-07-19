<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_bagan_tanding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index() {
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
		$data['kelas_tanding'] = $this->db->get('ms_kelas_tanding')->result_array();

		$this->load->view('templates/header', $data);
    $this->load->view('laporan/laporan_bagan_tanding');
    $this->load->view('templates/footer');
	}

  public function cetak()
  {
    $id_kompetisi = $this->input->post('id_kompetisi');
    $golongan = $this->input->post('golongan');
		$kelas = $this->input->post('kelas');
		$jenis_kelamin  = $this->input->post('jenis_kelamin');
		$id_kelas_tanding  = $this->input->post('id_kelas_tanding');
		$data_kelas_tanding = $this->db->get_where('ms_kelas_tanding', ['id' => $id_kelas_tanding])->row_array();
    $data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    $data['kompetisi'] = $data_kompetisi;
		$data['kelas_tanding'] = $data_kelas_tanding;
		$data['id_kompetisi'] = $id_kompetisi;
    $data['golongan'] = $golongan;
		$data['kelas'] = $kelas;
		$data['jenis_kelamin'] = $jenis_kelamin;
		$data['id_kelas_tanding'] = $id_kelas_tanding;
    $this->load->view('laporan/cetak/laporan_bagan_tanding', $data);
  }

	public function data_undian()
	{
		$id_kompetisi = $this->input->post('id_kompetisi');
    $golongan = $this->input->post('golongan');
		$kelas = $this->input->post('kelas');
		$jenis_kelamin  = $this->input->post('jenis_kelamin');
		$id_kelas_tanding  = $this->input->post('id_kelas_tanding');
		$data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

		$where = '';
		if($id_kompetisi != 'Kosong') {
      $where .= " AND b.id_kompetisi = '$id_kompetisi'";

      if($data_kompetisi['kategori'] == 'kelas') {
        $where .= $kelas != 'Kosong' ? " AND b.kelas = '$kelas'" : "";
      } else if($data_kompetisi['kategori'] == 'umur') {
        $where .= $golongan != 'Kosong' ? " AND b.golongan = '$golongan'" : "";
      }
    }

    if($jenis_kelamin != 'Kosong') {
      $where .= " AND b.jenis_kelamin = '$jenis_kelamin'";
    }

    if($id_kelas_tanding != 'Kosong') {
      $where .= " AND b.id_kelas_tanding = '$id_kelas_tanding'";
    }

    $data_pengundian_tanding = $this->db->query("SELECT
                              a.*, b.nama_lengkap, b.golongan, b.kelas_tanding, b.kontingen, b.kelas, b.jenis_kelamin
                              FROM ms_pengundian_tanding a
                              INNER JOIN ms_peserta b ON a.id_peserta = b.id
                              WHERE 1=1
                              $where
                              ORDER BY a.no_undian")->result_array();

		// var_dump($this->db->last_query()); die();

		$team_name = array();
		$no = 0;
		foreach ($data_pengundian_tanding as $key => $row) {
			array_push($team_name, array('seed'=> $row['kontingen'], 'name' => $row['no_undian'].' . '.$row['nama_lengkap']));
			$no = $row['no_undian'];
		}

		$data['teams'] = $no;
		$data['team_names'] = $team_name;
		echo json_encode($data);

	}
}

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
