<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_monitoring_nilai extends CI_Model {

  public function get_ronde()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    return $this->db->query("SELECT * FROM pr_tanding WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' LIMIT 500")->row_array();
  }

  public function get_nilai_ronde()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $data['data_nilai_juri'] = $this->db->query("SELECT
                                          a.*
                                        FROM pr_hasil_tanding a
                                        WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                    ")->result_array();

    $data['data_valid_juri'] = $this->db->query("SELECT
                                            a.*
                                          FROM pr_hasil_tanding_monitor a
                                          WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                    ")->result_array();

    $data['data_jatuhan'] = $this->db->query("SELECT * FROM pr_hasil_tanding_jatuhan WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'")->result_array();
    $data['data_peringatan'] = $this->db->query("SELECT * FROM pr_hasil_tanding_peringatan WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'")->result_array();
    $data['data_teguran'] = $this->db->query("SELECT * FROM pr_hasil_tanding_teguran WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'")->result_array();
    return $data;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
