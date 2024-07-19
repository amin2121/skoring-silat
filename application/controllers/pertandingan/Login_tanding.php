<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_tanding extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// if ($this->session->userdata('logged_in')) {
    //   redirect('dashboard');
	  // }
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();

    $this->load->view('pertandingan/login_tanding', $data);
	}

  public function masuk(){
    $juri = 'Juri';
    $partai = $this->input->post('partai');
    $juri = $this->input->post('juri');
    $masuk_sebagai = $this->input->post('masuk_sebagai');

    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();

    $user = $this->db->get_where('ms_wasit_juri', ['nama_juri' => $juri])->row_array();

    if(empty($user)) {
      redirect('pertandingan/login_tanding');
    } else {
      $data = [
        'pr_id_juri'		=> $user['id'],
        'pr_nama_juri'	=> $user['nama_juri'],
        'pr_id_kompetisi'	=> $row_km['id'],
				'pr_kompetisi'	=> $row_km['kompetisi'],
				'pr_gelanggang' => $this->input->post('gelanggang'),
				'pr_no_partai'	=> $this->input->post('partai'),
        'pr_masuk_sebagai' => $masuk_sebagai,
        'pr_logged_in'	=> true,
      ];

      $this->session->set_userdata($data);
      redirect('pertandingan/juri_tanding');
    }
  }

  public function logout() {
		$this->session->unset_userdata('pr_id_juri');
  	$this->session->unset_userdata('pr_nama_juri');
  	$this->session->unset_userdata('pr_id_kompetisi');
  	$this->session->unset_userdata('pr_kompetisi');
		$this->session->unset_userdata('pr_no_partai');
		$this->session->unset_userdata('pr_gelanggang');
		$this->session->unset_userdata('pr_masuk_sebagai');
		$this->session->unset_userdata('pr_logged_in');
  	$this->session->sess_destroy();

  	redirect('pertandingan/login_tanding');
  }

  public function res_data_partai_tanding(){
    $data_asal = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE status = '1' AND a.status_selesai_pertandingan = '0' GROUP BY no_partai")->result_array();
		$data_sort = array_column($data_asal, 'no_partai');
		array_multisort($data_sort, SORT_ASC, $data_asal);

    echo json_encode($data_asal);
  }

	public function res_data_gelanggang_tanding(){
    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE status = '1' GROUP BY a.gelanggang")->result_array();
    echo json_encode($data);
  }

  public function res_data_juri_tanding(){
    $data = $this->db->get('ms_wasit_juri')->result_array();
    echo json_encode($data);
  }
}
