<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_partai_seni_tunggal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_jadwal_partai_seni_tunggal', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		$data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
		$data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();
		$data['kontingen'] = $this->db->get('ms_kontingen')->result_array();
    	$data['kelas_tanding'] = $this->db->get('ms_kelas_tanding')->result_array();

		$this->load->view('templates/header', $data);
    	$this->load->view('master/jadwal_partai_seni_tunggal');
    	$this->load->view('templates/footer');
	}

	public function tambah(){
		$data = $this->model->tambah();
		redirect('master/jadwal_partai_seni_tunggal');
	}

  public function view_edit($id){
		$data['row'] = $this->model->get_data_row($id);
		$data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
		$data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();
		$data['kelas_tanding'] = $this->db->get('ms_kelas_tanding')->result_array();

		$this->load->view('templates/header');
		$this->load->view('master/jadwal_partai_seni_tunggal/edit', $data);
		$this->load->view('templates/footer');
	}

  public function edit(){
		$data = $this->model->edit();
		redirect('master/jadwal_partai_seni_tunggal');
	}

	public function import_excel(){
		$data = $this->model->import_excel();
		redirect('master/jadwal_partai_seni_tunggal');
	}

	public function hapus(){
		$data = $this->model->hapus();
		echo json_encode($data);
	}

	public function get_data(){
		$data = $this->model->get_data();
		echo json_encode($data);
	}

	public function kontingen_result(){
		$data = $this->model->kontingen_result();
		echo json_encode($data);
	}

	public function peserta_result(){
		$data = $this->model->peserta_result();
		echo json_encode($data);
	}

	public function detail_data(){
		$data = $this->model->detail_data();
		echo json_encode($data);
	}
}

/* End of file Jadwal_partai_tanding.php */
/* Location: ./application/controllers/Jadwal_partai_tanding.php */
