<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pertandingan/M_monitoring_nilai', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index($id) {
		$data['tanding'] = $this->db->get_where('ms_jadwal_partai_tanding', array('id' => $id))->row_array();
		$data['ip'] = $this->db->get('st_ip')->row_array();
    $this->load->view('pertandingan/monitoring_nilai', $data);
	}

	public function get_ronde()
	{
		$response = $this->model->get_ronde();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function get_nilai_ronde()
	{
		$response = $this->model->get_nilai_ronde();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}
}

/* End of file Juri_tanding.php */
/* Location: ./application/controllers/Juri_tanding.php */
