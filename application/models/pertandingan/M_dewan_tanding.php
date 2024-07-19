<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dewan_tanding extends CI_Model {

  public function get_ronde()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
		return $this->db->query("SELECT * FROM pr_tanding WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' LIMIT 500")->row_array();
  }

  public function ambil_partai_selanjutnya()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $jadwal_pertandingan_tanding = $this->db->query("SELECT
                                                      *
                                                    FROM ms_jadwal_partai_tanding
                                                    WHERE id != '$id_jadwal_pertandingan'
                                                    AND status_selesai_pertandingan = '0'
                                                    LIMIT 500
                                                ")->result_array();

    return [
      'result' => true,
      'data' => $jadwal_pertandingan_tanding,
    ];
  }

  public function undur_diri()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $pesilat_mundur = $this->input->post('pesilat_mundur');
    $alasan = $this->input->post('alasan');

    // update status selesai pertandingan
    $data_update = [
      'status_selesai_pertandingan' => 1,
      'pesilat_mundur' => $pesilat_mundur,
      'alasan_mundur' => $alasan,
    ];

    $this->db->where('id', $id_jadwal_pertandingan);
    $this->db->update('ms_jadwal_partai_tanding', $data_update);

    return [
      'result' => true,
    ];

  }

  public function selesai_pertandingan(){
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    // update status selesai pertandingan
    $data_update = ['status_selesai_pertandingan' => 1];
    $this->db->where('id', $id_jadwal_pertandingan);
    $this->db->update('ms_jadwal_partai_tanding', $data_update);

    return [
      'result' => true,
    ];
  }

  public function pilih_partai(){
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $id_jadwal_pertandingan_sebelumnya = $this->input->post('id_jadwal_pertandingan_sebelumnya');
    $jadwal_pertandingan_tanding = $this->db->get_where('ms_jadwal_partai_tanding', ['id' => $id_jadwal_pertandingan])->row_array();
    $id_kompetisi = $jadwal_pertandingan_tanding['id_kompetisi'];

    $data = $this->db->query("SELECT
                                *
                              FROM ms_jadwal_partai_tanding a
                              WHERE id = '$id_jadwal_pertandingan'
                              AND status_selesai_pertandingan = '0'
                              LIMIT 500
                            ")->row_array();

    $result = true;
    if(empty($data)) {
      $result = false;
    }

    $response = [
      'result' => $result,
      'data' => $data,
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan_sebelumnya,
      'id_jadwal_pertandingan_selanjutnya' => $id_jadwal_pertandingan
    ];

    /* PUSHER GANTI PARTAI */
    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    // );

    // $pusher = new Pusher\Pusher(
    //     'e636cb98a16cc38f57fe',
    //     'ea718c82a959b5591287',
    //     '1610313',
    //     $options
    // );

    // $pusher->trigger('ganti-partai', 'action-ganti-partai', ['result' => $result, 'data' => $data, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan_sebelumnya]);
    /* PUSHER GANTI PARTAI */

    return $response;
  }

  public function get_jatuhan()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $data_ronde_1 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_jatuhan
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '1'
                                      LIMIT 500
                                    ")->result_array();

    $data_ronde_2 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_jatuhan
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '2'
                                      LIMIT 500
                                    ")->result_array();

    $data_ronde_3 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_jatuhan
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '3'
                                      LIMIT 500
                                    ")->result_array();

    $response = [
      'result' => true,
      'data_ronde_1' => $data_ronde_1,
      'data_ronde_2' => $data_ronde_2,
      'data_ronde_3' => $data_ronde_3,
    ];

    return $response;
  }

  public function get_binaan(){
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $data_binaan_sudut_biru = $this->db->query("SELECT
                                                  COUNT(id) as total_binaan_sudut_biru,
                                                  ronde
                                                FROM pr_hasil_tanding_binaan
                                                WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                AND sudut = 'Biru'
                                                GROUP BY ronde
                                              ")->result_array();

    $data_binaan_sudut_merah = $this->db->query("SELECT
                                                  COUNT(id) as total_binaan_sudut_merah,
                                                  ronde
                                                FROM pr_hasil_tanding_binaan
                                                WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                AND sudut = 'Merah'
                                                GROUP BY ronde
                                              ")->result_array();

    $response = [
      'result' => true,
      'sudut_biru' => $data_binaan_sudut_biru,
      'sudut_merah' => $data_binaan_sudut_merah,
    ];

    return $response;
  }

  public function get_teguran()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $data_ronde_1 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_teguran
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '1'
                                      LIMIT 500
                                    ")->result_array();

    $data_ronde_2 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_teguran
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '2'
                                      LIMIT 500
                                    ")->result_array();

    $data_ronde_3 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_teguran
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '3'
                                      LIMIT 500
                                    ")->result_array();

    $response = [
      'result' => true,
      'data_ronde_1' => $data_ronde_1,
      'data_ronde_2' => $data_ronde_2,
      'data_ronde_3' => $data_ronde_3,
    ];

    return $response;
  }

  public function get_peringatan()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $data_ronde_1 = $this->db->query("SELECT
                                          *
                                        FROM pr_hasil_tanding_peringatan
                                        WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                        AND ronde = '1'
                                        LIMIT 500
                                      ")->result_array();

    $data_ronde_2 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_peringatan
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '2'
                                      LIMIT 500
                                    ")->result_array();

    $data_ronde_3 = $this->db->query("SELECT
                                        *
                                      FROM pr_hasil_tanding_peringatan
                                      WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                      AND ronde = '3'
                                      LIMIT 500
                                    ")->result_array();

    $response = [
      'result' => true,
      'data_ronde_1' => $data_ronde_1,
      'data_ronde_2' => $data_ronde_2,
      'data_ronde_3' => $data_ronde_3,
    ];

    return $response;
  }

  public function verifikasi_juri() {
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $pilih_verifikasi = $this->input->post('pilih_verifikasi');

    /* PUSHER VERIFIKASI JURI */
    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    // );

    // $pusher = new Pusher\Pusher(
    //     'e636cb98a16cc38f57fe',
    //     'ea718c82a959b5591287',
    //     '1610313',
    //     $options
    // );

    // $pusher->trigger('verifikasi-juri', 'action-verifikasi-juri', ['ronde' => $ronde, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'pilih_verifikasi' => $pilih_verifikasi]);
    /* PUSHER VERIFIKASI JURI */

    return ['status' => true];
  }

  public function tambah_nilai() {
    $nilai = $this->input->post('nilai');
    $id_juri = $this->input->post('id_juri');
    $nama_juri = $this->input->post('nama_juri');
    $gelanggang = $this->input->post('gelanggang');
    $ronde = $this->input->post('ronde');
    $sudut = $this->input->post('sudut');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $no_partai = $this->session->userdata('pr_no_partai');
    $id_kompetisi = $this->session->userdata('pr_pr_id_kompetisi');

    $total_nilai_data_sementara = $this->db->query("SELECT
                                                    a.*
                                                    FROM pr_hasil_tanding_sementara a
                                                    WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                   ")->num_rows();

    if($total_nilai_data_sementara == 3) {
      $this->db->where('id_jadwal_pertandingan', $id_jadwal_pertandingan);
      $this->db->delete('pr_hasil_tanding_sementara');
    }

    $data = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'id_juri' => $id_juri,
      'nama_juri' => $nama_juri,
      'ronde' => $ronde,
      'sudut' => $sudut,
      'nilai' => $nilai,
    ];

    $this->db->insert('pr_hasil_tanding_sementara', $data);

    $total_nilai_data_sementara = $this->db->query("SELECT
                                                    a.*
                                                    FROM pr_hasil_tanding_sementara a
                                                    WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                   ")->num_rows();
    if($total_nilai_data_sementara == 1) {
      return [
        'status_delay' => true
      ];
    } else {
      return [
        'status_delay' => false
      ];
    }
  }

  public function input_nilai() {
    $gelanggang = $this->input->post('gelanggang');
    $nilai = $this->input->post('nilai');
    $nama_juri = $this->input->post('juri');
    $id_juri = $this->input->post('id_juri');
    $sudut = $this->input->post('sudut');
    $partai = $this->input->post('partai');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $cek_nilai_data_sementara = $this->db->query("SELECT
                                                    a.*
                                                  FROM pr_hasil_tanding_sementara a
                                                  WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                  AND a.nilai = '$nilai'
                                                  AND a.sudut = '$sudut'
                                                 ")->result_array();

    if(count($cek_nilai_data_sementara) >= 2) {

      $data_nilai = [
        'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
        'id_juri' => $id_juri,
        'nama_juri' => $nama_juri,
        'ronde' => $ronde,
        'sudut' => $sudut,
        'nilai' => $nilai,
        'status_nilai' => 'valid'
      ];

      $this->db->insert('pr_hasil_tanding', $data_nilai);
      $id_nilai_data = $this->db->insert_id();

      $response = array(
          'status_nilai' => "valid",
          'message' => "Nilai Juri Berhasil Ditambahkan"
      );
    } else {

      $data_nilai = [
        'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
        'id_juri' => $id_juri,
        'nama_juri' => $nama_juri,
        'ronde' => $ronde,
        'sudut' => $sudut,
        'nilai' => $nilai,
        'status_nilai' => 'tidak_valid'
      ];

      $this->db->insert('pr_hasil_tanding', $data_nilai);
      $id_nilai_data = $this->db->insert_id();


      $response = array(
          'status_nilai' => "tidak_valid",
          'message' => "Nilai Juri Berhasil Ditambahkan"
      );
    }

    /* PUSHER */
    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );

    $pusher = new Pusher\Pusher(
        'e636cb98a16cc38f57fe',
        'ea718c82a959b5591287',
        '1610313',
        $options
    );

    $pusher->trigger('nilai-monitor', 'hitung-nilai-monitor', ['status_nilai_berubah' => 1, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
    /* END PUSHER */

    return $response;
  }

  public function hapus_nilai()
  {
    $sudut = $this->input->post('sudut');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $status_nilai_sudut = $this->input->post('status_nilai_sudut');

    $status_nilai_sudut_sekarang = end($status_nilai_sudut); // mengambil nilai array terakhir / nilai yg terbaru

    if(count($status_nilai_sudut) > 0) {
      array_pop($status_nilai_sudut);

      $response = [
        'result' => true,
        'status_nilai' => $status_nilai_sudut_sekarang,
        'array_status_nilai' => $status_nilai_sudut,
        'message' => 'Nilai Berhasil Dihapus',
      ];

      if($status_nilai_sudut_sekarang == 'teguran') {
        $hasil_tanding_teguran = $this->db->query("SELECT
                                                    *
                                                  FROM pr_hasil_tanding_teguran
                                                  WHERE id_jadwal_pertandingan = $id_jadwal_pertandingan
                                                  AND ronde = '$ronde'
                                                  AND sudut = '$sudut'
                                                  ORDER BY id DESC
                                                ")->row_array();

        $this->db->where('id', $hasil_tanding_teguran['id']);
        $this->db->delete('pr_hasil_tanding_teguran');
      } else if($status_nilai_sudut_sekarang == 'binaan') {
        $hasil_tanding_binaan = $this->db->query("SELECT
                                                    *
                                                  FROM pr_hasil_tanding_binaan
                                                  WHERE id_jadwal_pertandingan = $id_jadwal_pertandingan
                                                  AND ronde = '$ronde'
                                                  AND sudut = '$sudut'
                                                  ORDER BY id DESC
                                                ")->row_array();

        $this->db->where('id', $hasil_tanding_binaan['id']);
        $this->db->delete('pr_hasil_tanding_binaan');
      } else if($status_nilai_sudut_sekarang == 'jatuhan') {
        $hasil_tanding_jatuhan = $this->db->query("SELECT
                                                    *
                                                  FROM pr_hasil_tanding_jatuhan
                                                  WHERE id_jadwal_pertandingan = $id_jadwal_pertandingan
                                                  AND ronde = '$ronde'
                                                  AND sudut = '$sudut'
                                                  ORDER BY id DESC
                                                ")->row_array();

        $this->db->where('id', $hasil_tanding_jatuhan['id']);
        $this->db->delete('pr_hasil_tanding_jatuhan');
      } else if($status_nilai_sudut_sekarang == 'peringatan') {
        $hasil_tanding_peringatan = $this->db->query("SELECT
                                                    *
                                                  FROM pr_hasil_tanding_peringatan
                                                  WHERE id_jadwal_pertandingan = $id_jadwal_pertandingan
                                                  AND ronde = '$ronde'
                                                  AND sudut = '$sudut'
                                                  ORDER BY id DESC
                                                ")->row_array();

        $this->db->where('id', $hasil_tanding_peringatan['id']);
        $this->db->delete('pr_hasil_tanding_peringatan');
      }

      /* PUSHER */
      // $options = array(
      //     'cluster' => 'ap1',
      //     'useTLS' => true
      // );

      // $pusher = new Pusher\Pusher(
      //     'e636cb98a16cc38f57fe',
      //     'ea718c82a959b5591287',
      //     '1610313',
      //     $options
      // );

      // $pusher->trigger('refresh-monitor', 'action-refresh-monitor', ['refresh_monitor' => true, 'sudut' => $sudut, 'aksi' => $status_nilai_sudut_sekarang, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
      /* END PUSHER */

      return $response;
    }

    $response = [
      'result' => false,
      'message' => 'Nilai Gagal Dihapus',
    ];

    return $response;
  }

  public function aksi_pertandingan(){
    $aksi = $this->input->get('aksi');
    $sudut = $this->input->get('sudut');

    $nilai = '0';
    if ($aksi == 'Pukul') {
      $nilai = '1';
    }elseif ($aksi == 'Tendang') {
      $nilai = '2';
    }

    $data = array(
      'id_jadwal_pertandingan' => '1',
      'id_juri' => $this->session->userdata('pr_id_juri'),
      'nama_juri' => $this->session->userdata('pr_nama_juri'),
      'ronde' => '1',
      'sudut' => $sudut,
      'nilai' => $nilai
    );

    $this->db->trans_begin();
		$this->db->insert('pr_hasil_tanding', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
  }

  public function tambah_teguran() {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $nilai = 0;
    $sudut = $this->input->post('sudut');
    $ronde = $this->input->post('ronde');

    $teguran = $this->db->get_where('pr_hasil_tanding_teguran', ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'sudut' => $sudut, 'ronde' => $ronde])->num_rows();
    if($teguran == 0) {
      $nilai = -1;
    } else {
      $nilai = -2;
    }

    $data_nilai = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'ronde' => $ronde,
      'sudut' => $sudut,
      'nilai' => $nilai,
    ];

    $this->db->insert('pr_hasil_tanding_teguran', $data_nilai);

    /* PUSHER */
    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    // );

    // $pusher = new Pusher\Pusher(
    //     'e636cb98a16cc38f57fe',
    //     'ea718c82a959b5591287',
    //     '1610313',
    //     $options
    // );

    // $pusher->trigger('refresh-monitor', 'action-refresh-monitor', ['refresh_monitor' => true, 'sudut' => $sudut, 'aksi' => 'teguran', 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
    /* END PUSHER */

    $response = [
      'data' => ['nilai' => $nilai, 'sudut' => $sudut],
      'status' => true,
      'message' => 'Teguran Berhasil Ditambahkan',
    ];

    return $response;
  }

  public function tambah_jatuhan() {
    $nilai = 3;
    $sudut = $this->input->post('sudut');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $data_nilai = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'ronde' => $ronde,
      'sudut' => $sudut,
      'nilai' => $nilai,
    ];

    $this->db->insert('pr_hasil_tanding_jatuhan', $data_nilai);

    /* PUSHER */
    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    // );

    // $pusher = new Pusher\Pusher(
    //     'e636cb98a16cc38f57fe',
    //     'ea718c82a959b5591287',
    //     '1610313',
    //     $options
    // );

    // $pusher->trigger('refresh-monitor', 'action-refresh-monitor', ['refresh_monitor' => true, 'sudut' => $sudut, 'aksi' => 'jatuhan', 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
    /* END PUSHER */

    $response = [
      'data' => ['nilai' => $nilai, 'sudut' => $sudut],
      'status' => true,
      'message' => 'Jatuhan Berhasil Ditambahkan',
    ];

    return $response;
  }

  public function tambah_binaan() {
    $nilai = 0;
    $sudut = $this->input->post('sudut');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $data_nilai = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'ronde' => $ronde,
      'sudut' => $sudut,
      'nilai' => $nilai,
    ];

    $this->db->insert('pr_hasil_tanding_binaan', $data_nilai);

    /* PUSHER */
    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    // );

    // $pusher = new Pusher\Pusher(
    //     'e636cb98a16cc38f57fe',
    //     'ea718c82a959b5591287',
    //     '1610313',
    //     $options
    // );

    // $pusher->trigger('refresh-monitor', 'action-refresh-monitor', ['refresh_monitor' => true, 'sudut' => $sudut, 'aksi' => 'binaan', 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
    /* END PUSHER */

    $response = [
      'data' => ['nilai' => $nilai, 'sudut' => $sudut],
      'status' => true,
      'message' => 'Jatuhan Berhasil Ditambahkan',
    ];

    return $response;
  }

  public function tambah_peringatan() {
    $sudut = $this->input->post('sudut');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $peringatan = $this->db->get_where('pr_hasil_tanding_peringatan', ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'sudut' => $sudut])->num_rows();
    if($peringatan == 0) {
      $nilai = -5;
    } else if($peringatan == 1) {
      $nilai = -10;
    } else if($peringatan == 2) {
      $nilai = -20;
    }

    $data_nilai = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'ronde' => $ronde,
      'sudut' => $sudut,
      'nilai' => $nilai,
    ];

    $this->db->insert('pr_hasil_tanding_peringatan', $data_nilai);

    /* PUSHER */
    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    // );

    // $pusher = new Pusher\Pusher(
    //     'e636cb98a16cc38f57fe',
    //     'ea718c82a959b5591287',
    //     '1610313',
    //     $options
    // );

    // $pusher->trigger('refresh-monitor', 'action-refresh-monitor', ['refresh_monitor' => true, 'sudut' => $sudut, 'aksi' => 'peringatan', 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
    /* END PUSHER */

    $response = [
      'data' => ['nilai' => $nilai, 'sudut' => $sudut],
      'status' => true,
      'message' => 'Hukuman Berhasil Ditambahkan',
    ];

    return $response;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
