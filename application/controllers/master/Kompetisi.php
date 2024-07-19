<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kompetisi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_kompetisi', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		$this->load->view('templates/header');
    $this->load->view('master/kompetisi');
    $this->load->view('templates/footer');
	}

	public function view_tambah(){
    $this->load->view('templates/header');
    $this->load->view('master/kompetisi/tambah');
    $this->load->view('templates/footer');
	}

	public function tambah(){
		$data = $this->model->tambah();
		redirect('master/kompetisi');
	}

  public function view_edit($id){
    $data['row'] = $this->model->get_data_row($id);

    $this->load->view('templates/header');
    $this->load->view('master/kompetisi/edit', $data);
    $this->load->view('templates/footer');
	}

  public function edit(){
		$data = $this->model->edit();
		redirect('master/kompetisi');
	}

	public function hapus(){
		$data = $this->model->hapus();
		echo json_encode($data);
	}

	public function ubah_status(){
		$data = $this->model->ubah_status();
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

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
