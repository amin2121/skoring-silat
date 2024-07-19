<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengundian_tgr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_pengundian_tgr', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		$data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();

		$this->load->view('templates/header');
    $this->load->view('master/pengundian_tgr', $data);
    $this->load->view('templates/footer');
	}

	public function view_tambah(){
    $this->load->view('templates/header');
    $this->load->view('master/pengundian_tgr/tambah', $data);
    $this->load->view('templates/footer');
	}

	public function undi(){
		$data = $this->model->undi();
		echo json_encode($data);
	}

  public function view_edit($id){
    $data['row'] = $this->model->get_data_row($id);

    $this->load->view('templates/header');
    $this->load->view('master/pengundian_tgr/edit', $data);
    $this->load->view('templates/footer');
	}

  public function edit(){
		$data = $this->model->edit();
		redirect('pengundian_tgr');
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

/* End of file Pengundian_tgr.php */
/* Location: ./application/controllers/Pengundian_tgr.php */
