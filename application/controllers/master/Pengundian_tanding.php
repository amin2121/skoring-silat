<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengundian_tanding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_pengundian_tanding', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
    $data['kelas_tanding'] = $this->db->get('ms_kelas_tanding')->result_array();
		$data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();

		$this->load->view('templates/header');
    $this->load->view('master/pengundian_tanding', $data);
    $this->load->view('templates/footer');
	}

	public function undi(){
		$data = $this->model->undi();
		echo json_encode($data);
	}

	public function hapus(){
		$data = $this->model->hapus();
		echo json_encode($data);
	}

	public function export_excel()
	{
		$this->model->export_excel();
	}

	public function hapus_semua_undian(){
		$data = $this->model->hapus_semua_undian();
		echo json_encode($data);
	}

	public function get_data(){
		$data = $this->model->get_data();
		echo json_encode($data);
	}

	public function detail_data(){
		$data = $this->model->detail_data();
		echo json_encode($data);
	}
}

/* End of file Pengundian_tanding.php */
/* Location: ./application/controllers/Pengundian_tanding.php */
