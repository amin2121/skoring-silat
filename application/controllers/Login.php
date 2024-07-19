<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index() {
		if ($this->session->userdata('logged_in')) {
      redirect('dashboard');
	  }

    $this->load->view('login');
	}

  public function aksi(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->db->get_where('st_user', ['username' => $username, 'password' => $password])->row_array();

    if(empty($user)) {
      $this->session->set_flashdata('message', 'Login Gagal <span class="text-semibold">Dilakukan</span>');
      $this->session->set_flashdata('status', 'success');
      redirect('login');
    } else {
      $data = [
        'id_user'		=> $user['id'],
        'username'	=> $user['username'],
        'password'	=> $user['password'],
        'logged_in'	=> true
      ];

      $this->session->set_userdata($data);

      $this->session->set_flashdata('message', 'Login Berhasil <span class="text-semibold">Dilakukan</span>');
      $this->session->set_flashdata('status', 'success');
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
}
