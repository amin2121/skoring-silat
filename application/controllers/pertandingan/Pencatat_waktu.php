<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencatat_waktu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pertandingan/M_pencatat_waktu', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

  public function index($id){
		$data['tanding'] = $this->db->get_where('ms_jadwal_partai_tanding', array('id' => $id))->row_array();
		$data['gelanggang'] = $this->db->get_where('ms_gelanggang', ['gelanggang' => $data['tanding']['gelanggang']])->row_array();
		$data['ip'] = $this->db->get('st_ip')->row_array();
    $this->load->view('pertandingan/pencatat_waktu_tanding', $data);
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

	// public function setting_waktu_monitor(){
	// 	$status_waktu = $this->input->post('status_waktu');
	// 	$waktu = $this->input->post('waktu');
	// 	$id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

	// 	$options = array(
	// 	  'cluster' => 'ap1',
	// 	  'useTLS' => true
	// 	);

	// 	$pusher = new Pusher\Pusher(
	// 		'e636cb98a16cc38f57fe',
	// 		'ea718c82a959b5591287',
	// 		'1610313',
	// 		$options
	// 	);

	// 	$data['status_waktu'] = $status_waktu;
	// 	$data['waktu'] = $waktu;
	// 	$data['id_jadwal_pertandingan'] = $id_jadwal_pertandingan;

	// 	$pusher->trigger('waktu-monitor', 'setting-waktu-monitor', $data);

	// 	$this->output
	// 		->set_status_header(200)
	// 		->set_content_type('application/json', 'utf-8')
	// 		->set_output(json_encode(['status' => true],  JSON_PRETTY_PRINT))
	// 		->_display();
	// 		exit;
	// }

	public function setting_waktu_monitor() {
	
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode(['status' => true],  JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	public function setting_round(){
		$response = $this->model->setting_round();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

  public function setting_waktu_awal(){
    $response = $this->model->setting_waktu_awal();

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response,  JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

}
