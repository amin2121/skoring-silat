<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_dashboard', 'model');
		date_default_timezone_set('Asia/Jakarta');
		if (!$this->session->userdata('logged_in')) {
      redirect('login');
	  }
	}

	public function index(){
		$data['kompetisi'] = $this->model->get_kompetisi();
		$data['ip'] = $this->db->get('st_ip')->row_array();

    $this->load->view('templates/header');
    $this->load->view('master/dashboard', $data);
    $this->load->view('templates/footer');
	}

	public function get_kompetisi()
	{
		$data = $this->model->get_kompetisi();
		echo json_encode($data);
	}

	public function get_data()
	{
		$kompetisi = $this->input->get('kompetisi');
		$data = $this->model->get_data($kompetisi);
		echo json_encode($data);
	}

	public function ubah_ip()
	{
		$ip = $this->input->post('ip');
		$id = $this->input->post('id');
		$data = $this->model->ubah_ip($id, $ip);
		echo json_encode($data);
	}

	// public function run_server() 
	// {
	// 	$command = $this->input->post('command');
	// 	if ($command) {
	// 		echo json_encode(['status' => 'success', 'message' => 'Command executed']);
	// 	} else {
	// 		echo json_encode(['status' => 'error', 'message' => 'No command provided']);
	// 	}
	// }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
