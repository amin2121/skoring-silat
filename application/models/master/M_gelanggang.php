<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gelanggang extends CI_Model {

  public function tambah(){
    $this->load->library('upload');

    $config['upload_path'] = 'storage/gong/';
    $config['allowed_types'] = 'mp3';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_gong = '';
    if($this->upload->do_upload('gong')) {
      $upload_data = $this->upload->data();
      $file_gong = $upload_data['file_name'];
    }else {
      $file_gong = 'default.mp3';
    }

		$data = [
      'gelanggang' => $this->input->post('gelanggang'),
      'gong' => $file_gong,
      'tanggal' => date('d-m-Y'),
      'waktu' => date('H:i:s'),
		];

		$this->db->trans_begin();
		$this->db->insert('ms_gelanggang', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
  }

  public function edit(){
    $this->load->library('upload');

    $config['upload_path'] = 'storage/gong/';
    $config['allowed_types'] = 'mp3';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $id_gelanggang = $this->input->post('id');
    $gelanggang = $this->db->get_where('ms_gelanggang', ['id' => $id_gelanggang])->row_array();

    $file_gong = '';
    if($this->upload->do_upload('gong')) {
      $upload_data = $this->upload->data();
      $file_gong = $upload_data['file_name'];
    }else {
      $file_gong = 'default.mp3';
      if($gelanggang['gong'] != 'default.pm3') {
          $file_gong = $gelanggang['file_gong'];
      }
    }

		$data = [
      'gelanggang' => $this->input->post('gelanggang'),
      'gong' => $file_gong,
		];

		$this->db->trans_begin();
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('ms_gelanggang', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
  }

  public function hapus(){
    $id = $this->input->get('id');
    $gelanggang = $this->db->get_where('ms_gelanggang', ['id' => $id])->row_array();
    @unlink(FCPATH . 'storage/gong/'. $gelanggang['gong']);

    $this->db->trans_begin();
		$this->db->where('id', $id);
		$this->db->delete('ms_gelanggang');
		$this->db->trans_complete();

	  if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
  }

  public function get_data(){
    $where = '';
    $search = $this->input->get('search');
		if($search != '') {
			$where = "AND gelanggang LIKE '%$search%'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_gelanggang a WHERE 1=1 $where")->result_array();
    return $data;
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_gelanggang', array('id' => $id))->row_array();
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
