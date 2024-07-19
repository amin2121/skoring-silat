<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// if ($this->session->userdata('logged_in')) {
    //   redirect('dashboard');
	  // }

    $this->load->view('master/login');
	}

  public function masuk(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();

    $user = $this->db->get_where('ms_wasit_juri', ['nama_juri' => $juri, 'password_juri' => $password])->row_array();

    if(empty($user)) {
      // $this->session->set_flashdata('message', 'Login Tanding Gagal <span class="text-semibold">Dilakukan</span>');
      // $this->session->set_flashdata('status', 'success');
      redirect('master/login');
    } else {
      $data = [
        'pr_id_juri'		=> $user['id'],
        'pr_nama_juri'	=> $user['nama_juri'],
        'pr_id_kompetisi'	=> $row_km['id'],
				'pr_kompetisi'	=> $row_km['kompetisi'],
				'pr_no_partai'	=> $this->input->post('partai'),
        'pr_masuk_sebagai' => $masuk_sebagai,
        'pr_logged_in'	=> true
      ];

      $this->session->set_userdata($data);

      // $this->session->set_flashdata('message', 'Login Tanding Berhasil <span class="text-semibold">Dilakukan</span>');
      // $this->session->set_flashdata('status', 'success');
      redirect('master/dashboard');
    }
  }

  public function logout() {
		$this->session->unset_userdata('logged_in');
  	$this->session->unset_userdata('id_user');
  	$this->session->unset_userdata('username');
  	$this->session->unset_userdata('password');
  	$this->session->sess_destroy();

  	redirect('login');
  }

  public function res_data_partai_tanding(){
    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE status = '1'")->result_array();
    echo json_encode($data);
  }

  public function res_data_juri_tanding(){
    $data = $this->db->get('ms_wasit_juri')->result_array();
    echo json_encode($data);
  }
}
