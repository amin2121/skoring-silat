<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_monitor_tanding extends CI_Model {

  public function get_ronde()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
		return $this->db->query("SELECT * FROM pr_tanding WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' LIMIT 500")->row_array();
  }

  public function get_nilai_juri()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $id_round = $this->input->post('id_round');
    $sudut = $this->input->post('sudut');

    $hasil_tanding_monitor_biru = $this->db->query("SELECT
                                                      SUM(a.nilai) as hasil_akhir
                                                    FROM pr_hasil_tanding_monitor a
                                                    WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                    AND sudut = 'Biru'
                                                    AND ronde != 0
                                                ")->row_array();

    $hasil_tanding_monitor_merah = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_monitor a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Merah'
                                                      AND ronde != 0
                                                  ")->row_array();

    $hasil_tanding_jatuhan_biru = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_jatuhan a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Biru'
                                                      AND ronde != 0
                                                  ")->row_array();

    $hasil_tanding_jatuhan_merah = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_jatuhan a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Merah'
                                                      AND ronde != 0
                                                  ")->row_array();

    $hasil_tanding_teguran_biru = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_teguran a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Biru'
                                                      AND ronde != 0
                                                  ")->row_array();

    $hasil_tanding_teguran_merah = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_teguran a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Merah'
                                                      AND ronde != 0
                                                  ")->row_array();

    $hasil_tanding_peringatan_biru = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_peringatan a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Biru'
                                                      AND ronde != 0
                                                  ")->row_array();

    $hasil_tanding_peringatan_merah = $this->db->query("SELECT
                                                        SUM(a.nilai) as hasil_akhir
                                                      FROM pr_hasil_tanding_peringatan a
                                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND sudut = 'Merah'
                                                      AND ronde != 0
                                                  ")->row_array();

    $data['hasil_akhir_sudut_biru'] = $hasil_tanding_monitor_biru['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_monitor_biru['hasil_akhir'];
    $data['hasil_akhir_sudut_merah'] = $hasil_tanding_monitor_merah['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_monitor_merah['hasil_akhir'];
    $data['hasil_tanding_jatuhan_biru'] = $hasil_tanding_jatuhan_biru['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_jatuhan_biru['hasil_akhir'];
    $data['hasil_tanding_jatuhan_merah'] = $hasil_tanding_jatuhan_merah['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_jatuhan_merah['hasil_akhir'];
    $data['hasil_tanding_teguran_biru'] = $hasil_tanding_teguran_biru['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_teguran_biru['hasil_akhir'];
    $data['hasil_tanding_teguran_merah'] = $hasil_tanding_teguran_merah['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_teguran_merah['hasil_akhir'];
    $data['hasil_tanding_peringatan_biru'] = $hasil_tanding_peringatan_biru['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_peringatan_biru['hasil_akhir'];
    $data['hasil_tanding_peringatan_merah'] = $hasil_tanding_peringatan_merah['hasil_akhir'] == null ? 0 : (int) $hasil_tanding_peringatan_merah['hasil_akhir'];
    return $data;
  }

  public function get_binaan()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $id_round = $this->input->post('id_round');
    $sudut = $this->input->post('sudut');

    $data_nilai = $this->db->query("SELECT
                                        a.*
                                      FROM pr_hasil_tanding_binaan a
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '$id_round'
                                      AND sudut = '$sudut'
                                    ")->num_rows();

    $data['total_data'] = $data_nilai;
    return $data;
  }

  public function get_teguran()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $id_round = $this->input->post('id_round');
    $sudut = $this->input->post('sudut');

    $data_nilai = $this->db->query("SELECT
                                        a.*
                                      FROM pr_hasil_tanding_teguran a
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '$id_round'
                                      AND sudut = '$sudut'
                                  ")->num_rows();

    $data['total_data'] = $data_nilai;
    return $data;
  }

  public function get_peringatan()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $id_round = $this->input->post('id_round');
    $sudut = $this->input->post('sudut');

    $data_nilai = $this->db->query("SELECT
                                        a.*
                                      FROM pr_hasil_tanding_peringatan a
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND sudut = '$sudut'
                                  ")->num_rows();

    $data['total_data'] = $data_nilai;
    return $data;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
