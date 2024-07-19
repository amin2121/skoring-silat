<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function get_data($search = ''){
		$where = '';
		if($search != '') {
			$where = "AND user LIKE '%$search%'";
		}

		return $this->db->query("SELECT * FROM st_user WHERE 1=1 $where LIMIT 500")->result_array();
	}

	public function tambah() {
		$data = [
			'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'id_level' => '1',
      'level' => 'Admin',
		];

		$this->db->trans_begin();
		$this->db->insert('st_user', $data);
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
		$data = [
			'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'id_level' => '1',
      'level' => 'Admin',
		];

		$this->db->trans_begin();
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('st_user', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
	        $this->db->trans_rollback();
	        return false;
	    } else {
	        $this->db->trans_commit();
	        return true;
	    }
	}

	public function hapus($id){
		$this->db->trans_begin();
		$this->db->where('id', $id);
		$this->db->delete('st_user');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
	        $this->db->trans_rollback();
	        return false;
	    } else {
	        $this->db->trans_commit();
	        return true;
	    }
	}

	public function get_data_row($id){
		return $this->db->get_where('st_user', array('id' => $id))->row_array();
	}
}

/* End of file M_user.php */
/* Location: ./application/models/kepegawaian/M_user.php */
