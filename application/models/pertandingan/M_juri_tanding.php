<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_juri_tanding extends CI_Model {

  public function get_ronde()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
		return $this->db->query("SELECT * FROM pr_tanding WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' LIMIT 500")->row_array();
  }

  public function get_nilai_juri() {
    $id_juri = $this->input->post('id_juri');
    $nama_juri = $this->input->post('nama_juri');
    $gelanggang = $this->input->post('gelanggang');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $data = $this->db->query("SELECT
                                a.*
                              FROM pr_hasil_tanding a
                              WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                              AND a.ronde = '$ronde'
                              AND a.id_juri = '$id_juri'
                            ")->result_array();

    $response = [
      'result' => true,
      'data' => $data,
    ];

    return $response;
  }

  public function ganti_partai($no_partai, $gelanggang) {
    $data = [
      'pr_id_juri'		=> $this->session->userdata('pr_id_juri'),
      'pr_nama_juri'	=> $this->session->userdata('pr_nama_juri'),
      'pr_id_kompetisi'	=> $this->session->userdata('pr_id_kompetisi'),
      'pr_kompetisi'	=> $this->session->userdata('pr_kompetisi'),
      'pr_gelanggang' => $gelanggang,
      'pr_no_partai'	=> $no_partai,
      'pr_masuk_sebagai' => $this->session->userdata('pr_masuk_sebagai'),
      'pr_logged_in'	=> true,
    ];

    $this->session->set_userdata($data);
  }

  public function hapus_nilai()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    $ronde = $this->input->post('ronde');
    $id_juri = $this->input->post('id_juri');
    $id_nilai = $this->input->post('id_nilai');
    $nilai_sudut_sementara = $this->input->post('nilai_sudut_sementara');
    $nilai_sudut_sementara_sekarang = end($nilai_sudut_sementara); // mengambil nilai array terakhir / nilai yg terbaru

    if(count($nilai_sudut_sementara) > 0) {
      array_pop($nilai_sudut_sementara);

      $response = [
        'result' => true,
        'sudut_sekarang' => $nilai_sudut_sementara_sekarang,
        'nilai_sudut_sementara' => $nilai_sudut_sementara,
        'message' => 'Nilai Berhasil Dihapus',
      ];

      if($nilai_sudut_sementara_sekarang['sudut'] == 'Biru') {
        $sudut = $nilai_sudut_sementara_sekarang['sudut'];
        $nilai_sementara_biru = $this->db->query("SELECT
                                                    *
                                                  FROM pr_hasil_tanding_sementara
                                                  WHERE id_jadwal_pertandingan = $id_jadwal_pertandingan
                                                  AND ronde = '$ronde'
                                                  AND id_juri = '$id_juri'
                                                  AND sudut = '$sudut'
                                                  AND status_validasi = '0'
                                                  ORDER BY id DESC
                                                ")->row_array();

        $this->db->where('id', $nilai_sementara_biru['id']);
        $this->db->delete('pr_hasil_tanding_sementara');
      } else if($nilai_sudut_sementara_sekarang['sudut'] == 'Merah') {
        $sudut = $nilai_sudut_sementara_sekarang['sudut'];
        $nilai_sementara_merah = $this->db->query("SELECT
                                                    *
                                                  FROM pr_hasil_tanding_sementara
                                                  WHERE id_jadwal_pertandingan = $id_jadwal_pertandingan
                                                  AND ronde = '$ronde'
                                                  AND id_juri = '$id_juri'
                                                  AND sudut = '$sudut'
                                                  AND status_validasi = '0'
                                                  ORDER BY id DESC
                                                ")->row_array();

        $this->db->where('id', $nilai_sementara_merah['id']);
        $this->db->delete('pr_hasil_tanding_sementara');
      }

      return $response;
    }

    $response = [
      'result' => false,
      'message' => 'Nilai Gagal Dihapus',
    ];

    return $response;

  }

  public function tambah_nilai() {
    $nilai = $this->input->post('nilai');
    $id_juri = $this->input->post('id_juri');
    $nama_juri = $this->input->post('nama_juri');
    $gelanggang = $this->input->post('gelanggang');
    $ronde = $this->input->post('ronde');
    $sudut = $this->input->post('sudut');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $data = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'id_juri' => $id_juri,
      'nama_juri' => $nama_juri,
      'ronde' => $ronde,
      'sudut' => $sudut,
      'nilai' => $nilai,
    ];

    $this->db->insert('pr_hasil_tanding_sementara', $data);
    $id_hasil_tanding = $this->db->insert_id();

    $total_nilai_data_sementara = $this->db->query("SELECT
                                                    a.*
                                                    FROM pr_hasil_tanding_sementara a
                                                    WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                    AND a.ronde = '$ronde'
                                                    AND a.status_validasi = 0
                                                   ")->num_rows();

     /* PUSHER ACTIVE JURI */
    //  $options = array(
    //      'cluster' => 'ap1',
    //      'useTLS' => true
    //  );

    //  $pusher = new Pusher\Pusher(
    //      'e636cb98a16cc38f57fe',
    //      'ea718c82a959b5591287',
    //      '1610313',
    //      $options
    //  );

    //  $pusher->trigger('active-juri', 'action-active-juri', ['juri' => $id_juri, 'sudut' => $sudut, 'nilai' => $nilai, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
     /* END PUSHER ACTIVE JURI */

    if($total_nilai_data_sementara == 1) {
      return [
        'status_delay' => true,
        'total' => $total_nilai_data_sementara,
        'id' => $id_hasil_tanding,
      ];
    } else {
      return [
        'status_delay' => false,
        'id' => $id_hasil_tanding,
      ];
    }
  }

  public function input_nilai() {
    $gelanggang = $this->input->post('gelanggang');
    $nilai = $this->input->post('nilai');
    $nama_juri = $this->input->post('nama_juri');
    $id_juri = $this->input->post('id_juri');
    $sudut = $this->input->post('sudut');
    $partai = $this->input->post('partai');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $cek_hasil_tanding_sementara = $this->db->query("SELECT
                                                        a.*
                                                      FROM pr_hasil_tanding_sementara a
                                                      WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND a.ronde = '$ronde'
                                                      AND a.status_validasi = 0
                                                     ")->result_array();

    // biru
    $hasil_juri_1_biru = [];
    $hasil_juri_2_biru = [];
    $hasil_juri_3_biru = [];

    // merah
    $hasil_juri_1_merah = [];
    $hasil_juri_2_merah = [];
    $hasil_juri_3_merah = [];

    $update_status_hasil_tanding_sementara = [];
    foreach ($cek_hasil_tanding_sementara as $key => $hts) {

      // biru
      if($hts['sudut'] == 'Biru') {
        if($hts['id_juri'] == 1) {
          $hasil_juri_1_biru[] = $hts['nilai'];
        } else if($hts['id_juri'] == 2) {
          $hasil_juri_2_biru[] = $hts['nilai'];
        } else if($hts['id_juri'] == 3) {
          $hasil_juri_3_biru[] = $hts['nilai'];
        }

      // merah
      } elseif($hts['sudut'] == 'Merah') {
        if($hts['id_juri'] == 1) {
          $hasil_juri_1_merah[] = $hts['nilai'];
        } else if($hts['id_juri'] == 2) {
          $hasil_juri_2_merah[] = $hts['nilai'];
        } else if($hts['id_juri'] == 3) {
          $hasil_juri_3_merah[] = $hts['nilai'];
        }
      }

      $update_status_hasil_tanding_sementara[] = [
        'id' => $hts['id'],
        'status_validasi' => 1,
      ];
    }

    if(count($update_status_hasil_tanding_sementara) > 0) {
      $this->db->update_batch('pr_hasil_tanding_sementara', $update_status_hasil_tanding_sementara, 'id');
    }
    // sort($hasil_juri_1_biru);
    // sort($hasil_juri_2_biru);
    // sort($hasil_juri_3_biru);
    //
    // sort($hasil_juri_1_merah);
    // sort($hasil_juri_2_merah);
    // sort($hasil_juri_3_merah);

    $hasil_juri_biru = $this->hasil_juri('Biru', $id_jadwal_pertandingan, $ronde, $hasil_juri_1_biru, $hasil_juri_2_biru, $hasil_juri_3_biru);
    $hasil_juri_merah = $this->hasil_juri('Merah', $id_jadwal_pertandingan, $ronde, $hasil_juri_1_merah, $hasil_juri_2_merah, $hasil_juri_3_merah);

    $data_hasil_tanding_monitor_biru = $hasil_juri_biru['hasil_monitor'];
    $data_hasil_tanding_biru = $hasil_juri_biru['hasil_tanding'];

    $data_hasil_tanding_monitor_merah = $hasil_juri_merah['hasil_monitor'];
    $data_hasil_tanding_merah = $hasil_juri_merah['hasil_tanding'];

    if(count($data_hasil_tanding_monitor_biru) > 0) {
      $this->db->insert_batch('pr_hasil_tanding_monitor', $data_hasil_tanding_monitor_biru);
    }

    if(count($data_hasil_tanding_biru) > 0) {
      $this->db->insert_batch('pr_hasil_tanding', $data_hasil_tanding_biru);
    }

    if(count($data_hasil_tanding_monitor_merah) > 0) {
      $this->db->insert_batch('pr_hasil_tanding_monitor', $data_hasil_tanding_monitor_merah);
    }

    if(count($data_hasil_tanding_merah) > 0) {
      $this->db->insert_batch('pr_hasil_tanding', $data_hasil_tanding_merah);
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

    // $pusher->trigger('refresh-monitor', 'action-refresh-monitor', ['refresh_monitor' => true, 'sudut' => $sudut, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan]);
    /* END PUSHER */

    $response = array(
      'status_nilai' => "valid",
      'message' => "Nilai Juri Berhasil Ditambahkan",
      'data' => $data_hasil_tanding_biru,
    );

    return $response;
  }

  public function hasil_juri($sudut, $id_jadwal_pertandingan, $ronde, $hasil_juri_1, $hasil_juri_2, $hasil_juri_3) {
    $data_hasil_tanding = [];
    $data_hasil_tanding_monitor = [];

    // juri 1
    $nilai_akhir_juri_1 = [];

    $perbandingan_nilai_juri_2 = $hasil_juri_2;
    $perbandingan_nilai_juri_3 = $hasil_juri_3;
    foreach ($hasil_juri_1 as $key => $nilai) {
      $idx_nilai_juri_2 = array_search($nilai, $perbandingan_nilai_juri_2);
      $idx_nilai_juri_3 = array_search($nilai, $perbandingan_nilai_juri_3);

      if($idx_nilai_juri_2 !== false && $idx_nilai_juri_3 !== false) {
        $nilai_akhir_juri_1[] = (int) $nilai;
        $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
        array_splice($perbandingan_nilai_juri_2, $idx_nilai_juri_2, 1);
        array_splice($perbandingan_nilai_juri_3, $idx_nilai_juri_3, 1);
      } else {
        if($idx_nilai_juri_2 !== false) {
          $nilai_akhir_juri_1[] = (int) $nilai;
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
          array_splice($perbandingan_nilai_juri_2, $idx_nilai_juri_2, 1);
        } else if($idx_nilai_juri_3 !== false) {
          $nilai_akhir_juri_1[] = (int) $nilai;
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
          array_splice($perbandingan_nilai_juri_3, $idx_nilai_juri_3, 1);
        } else {
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'tidak_valid'];
        }
      }

    }

    // juri 2
    $nilai_akhir_juri_2 = [];

    $perbandingan_nilai_juri_3 = $hasil_juri_3;
    $perbandingan_nilai_juri_1 = $hasil_juri_1;
    foreach ($hasil_juri_2 as $key => $nilai) {
      $idx_nilai_juri_3 = array_search($nilai, $perbandingan_nilai_juri_3);
      $idx_nilai_juri_1 = array_search($nilai, $perbandingan_nilai_juri_1);

      if($idx_nilai_juri_3 !== false && $idx_nilai_juri_1 !== false) {
        $nilai_akhir_juri_2[] = (int) $nilai;
        $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
        array_splice($perbandingan_nilai_juri_3, $idx_nilai_juri_3, 1);
        array_splice($perbandingan_nilai_juri_1, $idx_nilai_juri_1, 1);
      } else {
        if($idx_nilai_juri_3 !== false) {
          $nilai_akhir_juri_2[] = (int) $nilai;
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
          array_splice($perbandingan_nilai_juri_3, $idx_nilai_juri_3, 1);
        } else if($idx_nilai_juri_1 !== false) {
          $nilai_akhir_juri_2[] = (int) $nilai;
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
          array_splice($perbandingan_nilai_juri_1, $idx_nilai_juri_1, 1);
        } else {
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'tidak_valid'];
        }
      }
    }

    // juri 3
    $nilai_akhir_juri_3 = [];

    $perbandingan_nilai_juri_1 = $hasil_juri_1;
    $perbandingan_nilai_juri_2 = $hasil_juri_2;
    // $idx_1 = []; $idx_ = [];
    foreach ($hasil_juri_3 as $key => $nilai) {
      $idx_nilai_juri_1 = array_search($nilai, $perbandingan_nilai_juri_1);
      $idx_nilai_juri_2 = array_search($nilai, $perbandingan_nilai_juri_2);

      if($idx_nilai_juri_1 !== false && $idx_nilai_juri_2 !== false) {
        $nilai_akhir_juri_3[] = (int) $nilai;
        $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
        array_splice($perbandingan_nilai_juri_1, $idx_nilai_juri_1, 1);
        array_splice($perbandingan_nilai_juri_2, $idx_nilai_juri_2, 1);
      } else {
        if($idx_nilai_juri_1 !== false) {
          $nilai_akhir_juri_3[] = (int) $nilai;
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
          array_splice($perbandingan_nilai_juri_1, $idx_nilai_juri_1, 1);
        } else if($idx_nilai_juri_2 !== false) {
          $nilai_akhir_juri_3[] = (int) $nilai;
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'valid'];
          array_splice($perbandingan_nilai_juri_2, $idx_nilai_juri_2, 1);
        } else {
          $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai, 'status_nilai' => 'tidak_valid'];
        }
      }

    }

    $total_nilai_juri_1 = array_sum($nilai_akhir_juri_1);
    $total_nilai_juri_2 = array_sum($nilai_akhir_juri_2);
    $total_nilai_juri_3 = array_sum($nilai_akhir_juri_3);

    $nilai_terbanyak = max($total_nilai_juri_1, $total_nilai_juri_2, $total_nilai_juri_3);

    if($nilai_terbanyak == $total_nilai_juri_1) {
      foreach ($nilai_akhir_juri_1 as $key => $nilai_akhir) {
          $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_akhir];
      }
    } else if($nilai_terbanyak == $total_nilai_juri_2) {
      foreach ($nilai_akhir_juri_2 as $key => $nilai_akhir) {
          $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_akhir];
      }
    } else if($nilai_terbanyak == $total_nilai_juri_3) {
      foreach ($nilai_akhir_juri_3 as $key => $nilai_akhir) {
          $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_akhir];
      }
    }

    return [
      'hasil_monitor' => $data_hasil_tanding_monitor,
      'hasil_tanding' => $data_hasil_tanding,
    ];

  }

  // public function hasil_juri($sudut, $id_jadwal_pertandingan, $ronde, $hasil_juri_1, $hasil_juri_2, $hasil_juri_3){
  //   $panjang_hasil_juri_1 = sizeof($hasil_juri_1);
  //   $panjang_hasil_juri_2 = sizeof($hasil_juri_2);
  //   $panjang_hasil_juri_3 = sizeof($hasil_juri_3);
  //
  //   $hasil_terpanjang = max($panjang_hasil_juri_1, $panjang_hasil_juri_2, $panjang_hasil_juri_3);
  //
  //   $data_hasil_tanding_monitor = [];
  //   $data_hasil_tanding = [];
  //
  //   $data_hasil_tanding = [];
  //   $data_hasil_tanding_monitor = [];
  //   for ($i=0; $i < $hasil_terpanjang; $i++) {
  //     // sudut biru
  //     $nilai_juri_1 = !isset($hasil_juri_1[$i]) ? 0 : $hasil_juri_1[$i];
  //     $nilai_juri_2 = !isset($hasil_juri_2[$i]) ? 0 : $hasil_juri_2[$i];
  //     $nilai_juri_3 = !isset($hasil_juri_3[$i]) ? 0 : $hasil_juri_3[$i];
  //
  //     $array_nilai_juri = [
  //       '1' => $nilai_juri_1,
  //       '2' => $nilai_juri_2,
  //       '3' => $nilai_juri_3
  //     ];
  //
  //     // nilai sama
  //     $counts = array_count_values($array_nilai_juri);
  //     $array_nilai_valid = array_filter($array_nilai_juri, function ($value) use ($counts) {
  //         return $counts[$value] > 1;
  //     });
  //
  //     $no = 0;
  //     foreach ($array_nilai_valid as $key => $nilai_valid) {
  //
  //       if($key == 1) {
  //
  //         if($nilai_valid != 0) {
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_valid, 'status_nilai' => 'valid'];
  //
  //           // nilai monitor
  //           if($no == 0) {
  //             $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_valid];
  //           }
  //         }
  //
  //       } else if($key == 2) {
  //
  //         if($nilai_valid != 0) {
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_valid, 'status_nilai' => 'valid'];
  //
  //           // nilai monitor
  //           if($no == 0) {
  //             $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_valid];
  //           }
  //         }
  //
  //       } else if($key == 3) {
  //
  //         if($nilai_valid != 0) {
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_valid, 'status_nilai' => 'valid'];
  //
  //           // nilai monitor
  //           if($no == 0) {
  //             $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_valid];
  //           }
  //         }
  //
  //       }
  //
  //       $no++;
  //     }
  //
  //     // nilai beda
  //     $nilai_juri_unik = array_unique($array_nilai_juri);
  //     $nilai_juri_duplicate = array_diff_assoc($array_nilai_juri, $nilai_juri_unik);
  //     $array_nilai_tidak_valid = array_diff($array_nilai_juri, $nilai_juri_duplicate);
  //
  //     foreach ($array_nilai_tidak_valid as $key => $nilai_tidak_valid) {
  //
  //       if($key == 1) {
  //
  //         if($nilai_tidak_valid != 0) {
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_tidak_valid, 'status_nilai' => 'tidak_valid'];
  //
  //           // nilai monitor
  //           if($no == 0) {
  //             $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_tidak_valid];
  //           }
  //         }
  //
  //       } else if($key == 2) {
  //
  //         if($nilai_tidak_valid != 0) {
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_tidak_valid, 'status_nilai' => 'tidak_valid'];
  //
  //           // nilai monitor
  //           if($no == 0) {
  //             $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_tidak_valid];
  //           }
  //         }
  //
  //       } else if($key == 3) {
  //
  //         if($nilai_tidak_valid != 0) {
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_tidak_valid, 'status_nilai' => 'tidak_valid'];
  //
  //           // nilai monitor
  //           if($no == 0) {
  //             $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_tidak_valid];
  //           }
  //         }
  //
  //       }
  //     }
  //
  //   }
  //
  //   return [
  //     'hasil_monitor' => $data_hasil_tanding_monitor,
  //     'hasil_tanding' => $data_hasil_tanding,
  //   ];
  //
  // }

  // public function hasil_juri($sudut, $id_jadwal_pertandingan, $ronde, $hasil_juri_1, $hasil_juri_2, $hasil_juri_3)
  // {
  //   $panjang_hasil_juri_1 = sizeof($hasil_juri_1);
  //   $panjang_hasil_juri_2 = sizeof($hasil_juri_2);
  //   $panjang_hasil_juri_3 = sizeof($hasil_juri_3);
  //
  //   $hasil_terpanjang = max($panjang_hasil_juri_1, $panjang_hasil_juri_2, $panjang_hasil_juri_3);
  //
  //   $data_hasil_tanding_monitor = [];
  //   $data_hasil_tanding = [];
  //
  //   for ($i=0; $i < $hasil_terpanjang; $i++) {
  //     // sudut biru
  //     $nilai_juri_1 = !isset($hasil_juri_1[$i]) ? 0 : $hasil_juri_1[$i];
  //     $nilai_juri_2 = !isset($hasil_juri_2[$i]) ? 0 : $hasil_juri_2[$i];
  //     $nilai_juri_3 = !isset($hasil_juri_3[$i]) ? 0 : $hasil_juri_3[$i];
  //
  //     $counts = array_count_values($array);
  //
  //     $filtered = array_filter($array, function ($value) use ($counts) {
  //         return $counts[$value] > 1;
  //     });
  //
  //     if(($nilai_juri_1 == $nilai_juri_2) && ($nilai_juri_2 == $nilai_juri_3)) {
  //       // hasil monitor
  //       $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1];
  //
  //       // data hasil tanding
  //       $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1, 'status_nilai' => 'valid'];
  //       $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_2, 'status_nilai' => 'valid'];
  //       $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_3, 'status_nilai' => 'valid'];
  //
  //     } else {
  //       if($nilai_juri_1 == $nilai_juri_2) {
  //         if($nilai_juri_1 == 0 || $nilai_juri_2 == 0) {
  //           // data hasil tanding
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_3, 'status_nilai' => 'tidak_valid'];
  //         } else {
  //           // hasil monitor
  //           $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1];
  //
  //           // data hasil tanding
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1, 'status_nilai' => 'valid'];
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_2, 'status_nilai' => 'valid'];
  //           if($nilai_juri_3 != 0) {
  //               $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_3, 'status_nilai' => 'tidak_valid'];
  //           }
  //         }
  //
  //       } else if($nilai_juri_2 == $nilai_juri_3) {
  //         if($nilai_juri_2 == 0 && $nilai_juri_3 == 0) {
  //           // data hasil tanding
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1, 'status_nilai' => 'tidak_valid'];
  //         } else {
  //           // hasil monitor
  //           $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_2];
  //
  //           // data hasil tanding
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_2, 'status_nilai' => 'valid'];
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_3, 'status_nilai' => 'valid'];
  //           if($nilai_juri_1 != 0) {
  //               $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1, 'status_nilai' => 'tidak_valid'];
  //           }
  //         }
  //
  //       } else if($nilai_juri_3 == $nilai_juri_1) {
  //         if($nilai_juri_2 == 0 && $nilai_juri_3 == 0) {
  //           // data hasil tanding
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_2, 'status_nilai' => 'tidak_valid'];
  //         } else {
  //           // hasil monitor
  //           $data_hasil_tanding_monitor[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_3];
  //
  //           // data hasil tanding
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 1, 'nama_juri' => 'JURI 1', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_1, 'status_nilai' => 'valid'];
  //           $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 3, 'nama_juri' => 'JURI 3', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_3, 'status_nilai' => 'valid'];
  //           if($nilai_juri_2 != 0) {
  //               $data_hasil_tanding[] = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'id_juri' => 2, 'nama_juri' => 'JURI 2', 'ronde' => $ronde, 'sudut' => $sudut, 'nilai' => $nilai_juri_2, 'status_nilai' => 'tidak_valid'];
  //           }
  //         }
  //
  //       }
  //     }
  //   }
  //
  //   return [
  //     'hasil_monitor' => $data_hasil_tanding_monitor,
  //     'hasil_tanding' => $data_hasil_tanding,
  //   ];
  //
  // }

  public function tambah_verifikasi() {
    $verifikasi = $this->input->post('verifikasi');
    $id_juri = $this->input->post('id_juri');
    $nama_juri = $this->input->post('nama_juri');
    $gelanggang = $this->input->post('gelanggang');
    $ronde = $this->input->post('ronde');
    $sudut = $this->input->post('sudut');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $total_nilai_data_sementara = $this->db->query("SELECT
                                                    a.*
                                                    FROM pr_hasil_tanding_sementara_verifikasi a
                                                    WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                   ")->num_rows();

    $data = [
      'id_jadwal_pertandingan' => $id_jadwal_pertandingan,
      'id_juri' => $id_juri,
      'nama_juri' => $nama_juri,
      'verifikasi' => $verifikasi,
      'ronde' => $ronde,
      'sudut' => $sudut,
    ];

    $this->db->insert('pr_hasil_tanding_sementara_verifikasi', $data);

    $total_nilai_data_sementara = $this->db->query("SELECT
                                                    a.*
                                                    FROM pr_hasil_tanding_sementara_verifikasi a
                                                    WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                    AND a.ronde = '$ronde'
                                                   ")->num_rows();

     if($total_nilai_data_sementara >= 1) {
       return [
         'status_delay' => true,
         'total_nilai' => $total_nilai_data_sementara,
       ];
     } else {
       return [
         'status_delay' => false,
         'total_nilai' => $total_nilai_data_sementara,
       ];
     }
  }

  public function kirim_hasil_verifikasi() {
    $gelanggang = $this->input->post('gelanggang');
    $verifikasi = $this->input->post('verifikasi');
    $nama_juri = $this->input->post('nama_juri');
    $id_juri = $this->input->post('id_juri');
    $sudut = $this->input->post('sudut');
    $partai = $this->input->post('partai');
    $ronde = $this->input->post('ronde');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

    $cek_hasil_tanding_sementara = $this->db->query("SELECT
                                                        a.*
                                                      FROM pr_hasil_tanding_sementara_verifikasi a
                                                      WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                      AND a.ronde = '$ronde'
                                                     ")->result_array();

    if(count($cek_hasil_tanding_sementara) >= 2) {

      $data_hasil_verifikasi = $this->db->query("SELECT
                                                    a.*
                                                  FROM pr_hasil_tanding_sementara_verifikasi a
                                                  WHERE a.id_jadwal_pertandingan = '$id_jadwal_pertandingan'
                                                  AND ronde = '$ronde'
                                                  ORDER BY id_juri ASC
                                                ")->result_array();
                  
      $response = array(
        'result' => true,
        'hasil_verifikasi'=> $data_hasil_verifikasi,
        'message' => "Verifiaksi Juri Berhasil Ditambahkan"
    );                              
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

      // $pusher->trigger('hasil-verifikasi', 'tampil-hasil-verifikasi', ['gelanggang' => $gelanggang, 'partai' => $partai, 'id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'hasil_verifikasi' => $data_hasil_verifikasi]);
      /* END PUSHER */
    }else {
      $response = array(
          'result' => false,
          'message' => "Verifikasi Juri Gagal Ditambahkan"
      );
    }

    $this->db->where('id_jadwal_pertandingan', $id_jadwal_pertandingan);
    $this->db->delete('pr_hasil_tanding_sementara_verifikasi');
    return $response;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
