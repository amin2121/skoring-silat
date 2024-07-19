<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_pengundian_tanding extends CI_Model {

  public function undi(){
    $golongan = $this->input->get('golongan');
    $kelas = $this->input->get('kelas');
    $jenis_kelamin = $this->input->get('jenis_kelamin');
    $id_kelas_tanding = $this->input->get('id_kelas_tanding');
    $id_kompetisi = $this->input->get('id_kompetisi');
    $kategori_tanding = 'Tanding';

    $kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    $where_kategori = '';
    if($kompetisi['kategori'] == 'kelas') {
      $where_kategori = "AND b.kelas = '$kelas'";
    } else if($kompetisi['kategori'] == 'umur') {
      $where_kategori = "AND b.golongan = '$golongan'";
    }

    $cek_peserta_undi = $this->db->query("SELECT
                                          a.*
                                          FROM ms_pengundian_tanding a
  						                            INNER JOIN ms_peserta b ON a.id_peserta = b.id
  						                            WHERE b.jenis_kelamin = '$jenis_kelamin'
                                          AND b.id_kompetisi = '$id_kompetisi'
                                          $where_kategori
  						                            AND b.id_kelas_tanding = '$id_kelas_tanding'
                                          AND b.kategori_tanding = '$kategori_tanding'
                                         ")->result_array();

    if (count($cek_peserta_undi) <= 0) {
      $cek_peserta = $this->db->query("SELECT
                                       b.*
                                       FROM ms_peserta b
                                       LEFT JOIN ms_kontingen c ON b.id_kontingen = c.id
                                       WHERE b.jenis_kelamin = '$jenis_kelamin'
                                       AND b.id_kelas_tanding = '$id_kelas_tanding'
                                       AND b.id_kompetisi = '$id_kompetisi'
                                       $where_kategori
                                       AND b.kategori_tanding = '$kategori_tanding'
                                       AND c.status_pembayaran = '1'
                                       ORDER BY b.id
                                      ")->result_array();

      if (count($cek_peserta) > 0) {
        $no_undian = range(1, count($cek_peserta));
      	shuffle($no_undian);

        $data_undian = [];
        foreach ($cek_peserta as $key => $cp) {
          $data_undian[] = array(
            'id_peserta' =>  $cp['id'],
            'no_undian' => $no_undian[$key]
          );
        }

        $this->db->trans_begin();
        $this->db->insert_batch('ms_pengundian_tanding', $data_undian);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = array(
              'status' => false,
              'message' => 'Peserta Kosong',
            );

            return $result;
        } else {
            $this->db->trans_commit();
            $result = array(
              'status' => true,
              'message' => 'Peserta Berhasil Diundi'
            );
            return $result;
        }
      }

      $result = array(
        'status' => false,
        'message' => 'Peserta Kosong'
      );

      return $result;

    }

    if(count($cek_peserta_undi) > 0) {
      $result = array(
        'status' => false,
        'message' => 'Peserta Sudah Diundi'
      );

      return $result;
    }

    $result = array(
      'status' => false,
      'message' => 'Pesert aKosong'
    );

    return $result;
  }

  public function hapus_semua_undian(){
    $golongan = $this->input->get('golongan');
    $kelas = $this->input->get('kelas');
    $jenis_kelamin = $this->input->get('jenis_kelamin');
    $id_kelas_tanding = $this->input->get('id_kelas_tanding');
    $id_kompetisi = $this->input->get('id_kompetisi');
    $kategori_tanding = 'Tanding';
    
    $kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    $where_kategori = '';
    if(!empty($kompetisi)) {
      if($kompetisi['kategori'] == 'kelas') {
        $where_kategori = "AND b.kelas = '$kelas'";
      } else if($kompetisi['kategori'] == 'umur') {
        $where_kategori = "AND b.golongan = '$golongan'";
      }
    }

    $peserta_undi = $this->db->query("SELECT
                                          a.*
                                          FROM ms_pengundian_tanding a
                                          INNER JOIN ms_peserta b ON a.id_peserta = b.id
                                          WHERE b.jenis_kelamin = '$jenis_kelamin'
                                          AND b.id_kompetisi = '$id_kompetisi'
                                          $where_kategori
                                          AND b.id_kelas_tanding = '$id_kelas_tanding'
                                          AND b.kategori_tanding = '$kategori_tanding'
                                         ")->result_array();

    $array_id_undian_tanding = [];
    foreach ($peserta_undi as $key => $pu) {
      $array_id_undian_tanding[] = $pu['id'];
    }

    $this->db->trans_begin();
    if(count($array_id_undian_tanding) > 0) {
      $this->db->where_in('id', $array_id_undian_tanding);
      $this->db->delete('ms_pengundian_tanding');
    }

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
    $id_kompetisi = $this->input->get('id_kompetisi');
    $golongan = $this->input->get('golongan');
    $kelas = $this->input->get('kelas');
    $jenis_kelamin = $this->input->get('jenis_kelamin');
    $id_kelas_tanding = $this->input->get('id_kelas_tanding');

    $kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    if($search != '') {
      $where = "AND b.nama_lengkap LIKE '%$search%'";
    }

    if($id_kompetisi != 'Kosong') {
      $where .= " AND b.id_kompetisi = '$id_kompetisi'";

      if($kompetisi['kategori'] == 'kelas') {
        $where .= $kelas != 'Kosong' ? " AND b.kelas = '$kelas'" : "";
      } else if($kompetisi['kategori'] == 'umur') {
        $where .= $golongan != 'Kosong' ? " AND b.golongan = '$golongan'" : "";
      }

    }

    if($jenis_kelamin != 'Kosong') {
      $where .= " AND b.jenis_kelamin = '$jenis_kelamin'";
    }

    if($id_kelas_tanding != 'Kosong') {
      $where .= " AND b.id_kelas_tanding = '$id_kelas_tanding'";
    }

    $data = $this->db->query("SELECT
                              a.*, b.nama_lengkap, b.golongan, b.kelas_tanding, b.kontingen, b.kelas, b.jenis_kelamin, c.kategori
                              FROM ms_pengundian_tanding a
                              INNER JOIN ms_peserta b ON a.id_peserta = b.id
                              INNER JOIN ms_kompetisi c ON b.id_kompetisi = c.id
                              WHERE 1=1
                              $where
                              ORDER BY a.no_undian")->result_array();
    return $data;
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_pengundian_tanding', array('id' => $id))->row_array();
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
