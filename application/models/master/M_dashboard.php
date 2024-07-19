<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

  public function get_kompetisi() {
    return $this->db->get('ms_kompetisi')->result_array();
  }

  public function get_data($kompetisi)
  {
    $peserta = $this->db->query("SELECT COUNT(id) as total_peserta FROM ms_peserta WHERE id_kompetisi = '$kompetisi'")->row_array();
    $kontingen = $this->db->query("SELECT COUNT(id) as total_kontingen FROM ms_kontingen WHERE id_kompetisi = '$kompetisi'")->row_array();

    return [
      'total_peserta' => $peserta['total_peserta'] == null ? 0 : $peserta['total_peserta'],
      'total_kontingen' => $kontingen['total_kontingen'] == null ? 0 : $kontingen['total_kontingen'],
    ];
  }

  public function ubah_ip($id, $ip)
  {

    $data = [
      'ip' => $ip
    ];

    // var_dump($data);
    // die;

    $this->db->where('id', $id);
    $this->db->update('st_ip', $data);
    
    return [
      'ip' => $ip
    ];
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
