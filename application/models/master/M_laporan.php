<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {
  public function get_data(){
    $id_level = $this->session->userdata('id_level');
    return $this->db->query("SELECT
                             a.*
                             FROM st_list_menu a
                             WHERE a.id_level = '$id_level'
                             AND a.group = 'laporan'")->result_array();
  }

  public function pilih_konsinyasi_area($id_area){
    return $this->db->get_where('tk_master_toko', array('id_area' => $id_area))->result_array();
  }
}

/* End of file M_laporan.php */
/* Location: ./application/models/kepegawaian/M_laporan.php */
