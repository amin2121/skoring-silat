<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dashboard', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index(){
		// $data['jumlah_penjualan_motoris'] = $this->model->jumlah_penjualan_motoris();
		// $data['jumlah_penjualan_konsinyasi'] = $this->model->jumlah_penjualan_konsinyasi();

    $this->load->view('templates/header');
    $this->load->view('dashboard');
    $this->load->view('templates/footer');
	}

	public function chart_penjualan_bulan_sales(){
		$data = $this->model->chart_penjualan_bulan_sales();
		echo json_encode($data);
	}

	public function chart_penjualan_bulan_toko(){
		$data = $this->model->chart_penjualan_bulan_toko();
		echo json_encode($data);
	}

	public function chart_penjualan_bulan_area(){
		$data = $this->model->chart_penjualan_bulan_area();
		echo json_encode($data);
	}

	public function chart_penjualan_bulan_motoris(){
		$data = $this->model->chart_penjualan_bulan_motoris();
		echo json_encode($data);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
