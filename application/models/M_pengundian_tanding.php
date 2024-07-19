<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengundian_tanding extends CI_Model {
  public function undi(){
    $golongan = $this->input->get('golongan');
    $jenis_kelamin = $this->input->get('jenis_kelamin');
    $id_kelas_tanding = $this->input->get('id_kelas_tanding');
    $id_kompetisi = $this->input->get('id_kompetisi');
    $kategori_tanding = 'Tanding';

    $cek_peserta_undi = $this->db->query("SELECT
                                          a.*
                                          FROM ms_pengundian_tanding a
  						                            INNER JOIN ms_peserta b ON a.id_peserta = b.id
  						                            WHERE b.golongan = '$golongan'
  						                            AND b.jenis_kelamin = '$jenis_kelamin'
  						                            AND b.id_kelas_tanding = '$id_kelas_tanding'
                                          AND b.id_kompetisi = '$id_kompetisi'
                                          AND b.kategori_tanding = '$kategori_tanding'
                                         ")->result_array();

    if (count($cek_peserta_undi) <= 0) {
      $cek_peserta = $this->db->query("SELECT
                                       a.*
                                       FROM ms_peserta a
                                       WHERE a.golongan = '$golongan'
                                       AND a.jenis_kelamin = '$jenis_kelamin'
                                       AND a.id_kelas_tanding = '$id_kelas_tanding'
                                       AND a.id_kompetisi = '$id_kompetisi'
                                       AND a.status_pembayaran = '1'
                                       AND a.kategori_tanding = '$kategori_tanding'
                                       ORDER BY a.id
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
              'status' => 'Gagal Insert'
            );
            return false;
        } else {
            $this->db->trans_commit();
            $result = array(
              'status' => 'Berhasil'
            );
            return $result;
        }
      }
    }
  }

  public function tambah(){
		$data = [
      'pengundian_tanding' => $this->input->post('pengundian_tanding')
		];

		$this->db->trans_begin();
		$this->db->insert('ms_pengundian_tanding', $data);
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
      'pengundian_tanding' => $this->input->post('pengundian_tanding')
		];

		$this->db->trans_begin();
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('ms_pengundian_tanding', $data);
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
		$this->db->delete('ms_pengundian_tanding');
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
    $search = $this->input->get('search');
    $where = '';
		if($search != '') {
			$where = "AND b.nama_lengkap LIKE '%$search%'";
		}

    $data = $this->db->query("SELECT
                              a.*, b.nama_lengkap, b.golongan, b.kelas_tanding, b.kontingen
                              FROM ms_pengundian_tanding a
                              INNER JOIN ms_peserta b ON a.id_peserta = b.id
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
