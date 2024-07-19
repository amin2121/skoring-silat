<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_seni_tunggal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pertandingan/M_juri_tanding', 'model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index() {
        $id_kompetisi = $this->session->userdata('pr_id_kompetisi');
        $no_partai = $this->session->userdata('pr_no_partai');
            $gelanggang = $this->session->userdata('pr_gelanggang');

            $j_tanding = $this->db->get_where('ms_jadwal_partai_tanding', array('id_kompetisi' => $id_kompetisi, 'no_partai' => $no_partai, 'gelanggang' => $gelanggang))->row_array();

            if(empty($j_tanding)) {
                redirect('pertandingan/login_tanding');
            }

        $data['j_tanding'] = $j_tanding;
        $this->load->view('pertandingan/nilai_seni_tunggal', $data);
	}

	public function hapus_nilai(){
		$response = $this->model->hapus_nilai();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function get_ronde(){
		$response = $this->model->get_ronde();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function ganti_partai($no_partai, $gelanggang){
		$this->model->ganti_partai($no_partai, $gelanggang);
		redirect('pertandingan/juri_tanding');
	}

	public function get_nilai_juri()
	{
		$response = $this->model->get_nilai_juri();

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

	public function tambah_verifikasi()
	{
		$response = $this->model->tambah_verifikasi();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response,  JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function kirim_hasil_verifikasi()
	{
		$response = $this->model->kirim_hasil_verifikasi();

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

  public function aksi_pertandingan(){
    $data = $this->model->aksi_pertandingan();
    echo json_encode($data);
  }
}

/* End of file Juri_tanding.php */
/* Location: ./application/controllers/Juri_tanding.php */
