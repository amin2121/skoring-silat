<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting/M_user', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		$this->load->view('templates/header');
    $this->load->view('setting/user');
    $this->load->view('templates/footer');
	}

	public function view_tambah(){
    $this->load->view('templates/header');
    $this->load->view('setting/user/tambah');
    $this->load->view('templates/footer');
	}

	public function tambah(){
		$data = $this->model->tambah();
		redirect('setting/user');
	}

  public function view_edit($id){
    $data['row'] = $this->model->get_data_row($id);

    $this->load->view('templates/header');
    $this->load->view('setting/user/edit', $data);
    $this->load->view('templates/footer');
	}

  public function edit(){
		$data = $this->model->edit();
		redirect('setting/user');
	}

	public function hapus(){
		$data = $this->model->hapus();
		echo json_encode($data);
	}

	public function get_data(){
		$data = $this->model->get_data();
		echo json_encode($data);
	}

	public function get_data_row(){
		$data = $this->model->get_data_row();
		echo json_encode($data);
	}
}

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
