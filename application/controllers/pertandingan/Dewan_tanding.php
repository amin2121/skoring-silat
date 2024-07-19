<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dewan_tanding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pertandingan/M_dewan_tanding', 'model');
		date_default_timezone_set('Asia/Jakarta');
		// if (!$this->session->userdata('logged_in')) {
    //   redirect('login');
	  // }
	}

	public function index($id) {
		$j_tanding = $this->db->get_where('ms_jadwal_partai_tanding', array('id' => $id))->row_array();
    $data['j_tanding'] = $j_tanding;
	$data['ip'] = $this->db->get('st_ip')->row_array();

    $this->load->view('pertandingan/dewan_tanding', $data);
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

	public function get_jatuhan()
	{
		$response = $this->model->get_jatuhan();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function get_teguran()
	{
		$response = $this->model->get_teguran();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function get_binaan()
	{
		$response = $this->model->get_binaan();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function get_peringatan()
	{
		$response = $this->model->get_peringatan();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function undur_diri()
	{
		$response = $this->model->undur_diri();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function ambil_partai_selanjutnya() {
		$response = $this->model->ambil_partai_selanjutnya();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function selesai_pertandingan() {
		$response = $this->model->selesai_pertandingan();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function pilih_partai() {
		$response = $this->model->pilih_partai();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function tambah_nilai() {
		$response = $this->model->tambah_nilai();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function input_nilai() {
		$response = $this->model->input_nilai();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function hapus_nilai_data_sementara() {
		$response = $this->model->hapus_nilai_data_sementara();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function hapus_nilai() {
		$response = $this->model->hapus_nilai();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

  public function aksi_pertandingan(){
    $data = $this->model->aksi_pertandingan();
    echo json_encode($data);
  }

	public function tambah_teguran() {
		$response = $this->model->tambah_teguran();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function tambah_jatuhan() {
		$response = $this->model->tambah_jatuhan();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function tambah_binaan()
	{
		$response = $this->model->tambah_binaan();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function verifikasi_juri()
	{
		$response = $this->model->verifikasi_juri();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function tambah_peringatan()
	{
		$response = $this->model->tambah_peringatan();

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
