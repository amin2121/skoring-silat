<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_pertandingan_tanding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pertandingan/M_jadwal_pertandingan_tanding', 'model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
		$data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();

		$this->load->view('templates_pertandingan/header');
    $this->load->view('pertandingan/jadwal_pertandingan_tanding', $data);
    $this->load->view('templates_pertandingan/footer');
	}

	public function view_pencatat_waktu($id){
		$data['tanding'] = $this->db->get_where('ms_jadwal_partai_tanding', array('id' => $id))->row_array();
		$data['gelanggang'] = $this->db->get_where('ms_gelanggang', ['gelanggang' => $data['tanding']['gelanggang']])->row_array();
    $this->load->view('pertandingan/pencatat_waktu_tanding', $data);
	}

	public function get_data(){
		$data = $this->model->get_data();
		echo json_encode($data);
	}

	public function get_data_tanding_selesai(){
		$data = $this->model->get_data_tanding_selesai();
		echo json_encode($data);
	}

	public function get_round(){
		$response = $this->model->get_round();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}
}

/* End of file Jadwal_pertandingan_tanding.php */
/* Location: ./application/controllers/Jadwal_pertandingan_tanding.php */
