<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_seni_tunggal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_peserta_seni_tunggal', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		$data['kelas_tanding'] = $this->model->get_kelas_tanding();
		$data['kompetisi'] = $this->model->get_kompetisi();

		$this->load->view('templates/header', $data);
    $this->load->view('master/peserta_seni_tunggal');
    $this->load->view('templates/footer');
	}

	public function view_tambah(){
		$data['kelas_tanding'] = $this->model->get_kelas_tanding();
		$data['kompetisi'] = $this->model->get_kompetisi();

    $this->load->view('templates/header');
    $this->load->view('master/peserta_seni_tunggal/tambah', $data);
    $this->load->view('templates/footer');
	}

	public function view_edit($id){
		$data['kelas_tanding'] = $this->model->get_kelas_tanding();
		$data['kompetisi'] = $this->model->get_kompetisi();
		$data['row'] = $this->model->get_row_data($id);

		$this->load->view('templates/header');
		$this->load->view('master/peserta_seni_tunggal/edit', $data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
		$data = $this->model->tambah();
		redirect('master/peserta_seni_tunggal');
	}

	public function edit(){
		$data = $this->model->edit();
		redirect('master/peserta_seni_tunggal');
	}

	public function hapus(){
		$data = $this->model->hapus();
		echo json_encode($data);
	}

	public function get_data(){
		$data = $this->model->get_data();
		echo json_encode($data);
	}

	public function import_excel(){
		$data = $this->model->import_excel();
		redirect('master/peserta_seni_tunggal');
	}

	public function get_kontingen(){
		$data = $this->model->get_kontingen();
		echo json_encode($data);
	}

	public function detail_data(){
		$data = $this->model->detail_data();
		echo json_encode($data);
	}
}

/* End of file Peserta.php */
/* Location: ./application/controllers/Peserta.php */
