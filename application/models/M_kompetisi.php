<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kompetisi extends CI_Model {
  public function tambah(){
		$data = [
      'kompetisi' => $this->input->post('kompetisi')
		];

		$this->db->trans_begin();
		$this->db->insert('ms_kompetisi', $data);
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
      'kompetisi' => $this->input->post('kompetisi')
		];

		$this->db->trans_begin();
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('ms_kompetisi', $data);
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

    $this->db->trans_begin();
		$this->db->where('id', $id);
		$this->db->delete('ms_kompetisi');
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
			$where = "AND kompetisi LIKE '%$search%'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_kompetisi a WHERE 1=1 $where")->result_array();
    return $data;
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_kompetisi', array('id' => $id))->row_array();
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
