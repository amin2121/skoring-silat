<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_partai_tanding extends CI_Model {
  public function tambah(){
    $row_kt = $this->db->get_where('ms_kelas_tanding', array('id' => $this->input->post('id_kelas_tanding')))->row_array();
    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();
		$data = [
      'id_kompetisi' => $this->input->post('id_kompetisi'),
      'kompetisi' => $row_km['kompetisi'],
      'tanggal' => date('d-m-Y', strtotime($this->input->post('tanggal'))),
      'gelanggang' => $this->input->post('gelanggang'),
      'id_kelas_tanding' => $this->input->post('id_kelas_tanding'),
      'kelas_tanding' => $row_kt['kelas_tanding'],
      'golongan' => $this->input->post('golongan'),
      'no_partai' => $this->input->post('no_partai'),
      'babak' => $this->input->post('babak'),
      'nama_pesilat_merah' => $this->input->post('nama_pesilat_merah'),
      'kontingen_merah' => $this->input->post('kontingen_merah'),
      'nama_pesilat_biru' => $this->input->post('nama_pesilat_biru'),
      'kontingen_biru' => $this->input->post('kontingen_biru')
		];

		$this->db->trans_begin();
		$this->db->insert('ms_jadwal_partai_tanding', $data);
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
      'jadwal_partai_tanding' => $this->input->post('jadwal_partai_tanding')
		];

		$this->db->trans_begin();
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('ms_jadwal_partai_tanding', $data);
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
		$this->db->delete('ms_jadwal_partai_tanding');
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
			$where = "AND jadwal_partai_tanding LIKE '%$search%'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE 1=1 $where")->result_array();
    return $data;
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_jadwal_partai_tanding', array('id' => $id))->row_array();
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
