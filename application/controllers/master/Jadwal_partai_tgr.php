<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_partai_tgr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_jadwal_partai_tgr', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		$this->load->view('templates/header');
    $this->load->view('master/jadwal_partai_tgr');
    $this->load->view('templates/footer');
	}

	public function view_tambah(){
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
    // $data['kelas_tgr'] = $this->db->get('ms_kelas_tgr')->result_array();

    $this->load->view('templates/header');
    $this->load->view('master/jadwal_partai_tgr/tambah', $data);
    $this->load->view('templates/footer');
	}

	public function tambah(){
		$data = $this->model->tambah();
		redirect('jadwal_partai_tgr');
	}

  public function view_edit($id){
    $data['row'] = $this->model->get_data_row($id);

    $this->load->view('templates/header');
    $this->load->view('master/jadwal_partai_tgr/edit', $data);
    $this->load->view('templates/footer');
	}

  public function edit(){
		$data = $this->model->edit();
		redirect('jadwal_partai_tgr');
	}

	public function hapus(){
		$data = $this->model->hapus();
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

/* End of file Jadwal_partai_tgr.php */
/* Location: ./application/controllers/Jadwal_partai_tgr.php */
