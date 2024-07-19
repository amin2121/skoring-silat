<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_partai_seni_tunggal extends CI_Model {

  public function tambah() {
    $row_kt = $this->db->get_where('ms_kelas_tanding', array('id' => $this->input->post('id_kelas_tanding')))->row_array();
    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();
    $row_ps = $this->db->get_where('ms_peserta_seni_tunggal', array('id' => $this->input->post('peserta')))->row_array();
    $data_kontingen = $this->db->get_where('ms_kontingen', array('id' => $this->input->post('kontingen')))->row_array();
    $tanggal = str_replace('/', '-', $this->input->post('tanggal'));

		$data = [
            'id_peserta' => $this->input->post('peserta'),
            'nama_lengkap' => $row_ps['nama_lengkap'],
            'pool' => $this->input->post('pool'),
            'id_kompetisi' => $this->input->post('id_kompetisi'),
            'kompetisi' => $row_km['kompetisi'],
            'tanggal' => $tanggal,
            'golongan' => $this->input->post('golongan'),
            'babak' => $this->input->post('babak'),
            'id_kelas_tanding' => $this->input->post('id_kelas_tanding'),
            'kelas_tanding' => $row_kt['kelas_tanding'],
            'kelas' => $this->input->post('kelas'),
            'kategori' => $row_km['kategori'],
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'no_partai' => $this->input->post('no_partai'),
            'status' => 0,
            'id_kontingen' => $data_kontingen['id'],
            'kontingen' => $data_kontingen['nama'],
            'status_selesai_pertandingan' => 0,
            'status_mundur' => 0,
            'alasan_mundur' => '-',
		];

		$this->db->trans_begin();
		$this->db->insert('ms_jadwal_partai_seni_tunggal', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
  }

  public function edit() {
    $id = $this->input->post('id');
    $row_kt = $this->db->get_where('ms_kelas_tanding', array('id' => $this->input->post('id_kelas_tanding')))->row_array();
    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();
    $data_kontingen_biru = $this->db->get_where('ms_kontingen', array('id' => $this->input->post('kontingen_biru')))->row_array();
    $data_kontingen_merah = $this->db->get_where('ms_kontingen', array('id' => $this->input->post('kontingen_merah')))->row_array();
    $tanggal = str_replace('/', '-', $this->input->post('tanggal'));

    $data = [
      'id_kompetisi' => $this->input->post('id_kompetisi'),
      'kompetisi' => $row_km['kompetisi'],
      'kategori' => $row_km['kategori'],
      'tanggal' => $tanggal,
      'gelanggang' => $this->input->post('gelanggang'),
      'id_kelas_tanding' => $this->input->post('id_kelas_tanding'),
      'kelas_tanding' => $row_kt['kelas_tanding'],
      'golongan' => $this->input->post('golongan'),
      'kelas' => $this->input->post('kelas'),
      'no_partai' => $this->input->post('no_partai'),
      'status' => $this->input->post('status'),
      'babak' => $this->input->post('babak'),
      'nama_pesilat_merah' => $this->input->post('nama_pesilat_merah'),
      'jenis_kelamin' => $this->input->post('jenis_kelamin'),
      'kontingen_merah' => $data_kontingen_merah['nama'],
      'id_kontingen_merah' => $data_kontingen_merah['id'],
      'nama_pesilat_biru' => $this->input->post('nama_pesilat_biru'),
      'kontingen_biru' => $data_kontingen_biru['nama'],
      'id_kontingen_biru' => $data_kontingen_biru['id'],
    ];

    $this->db->trans_begin();
    $this->db->where('id', $id);
    $this->db->update('ms_jadwal_partai_seni_tunggal', $data);
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
		$this->db->delete('ms_jadwal_partai_seni_tunggal');
		$this->db->trans_complete();

	  if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
  }

  public function get_data() {
    $where = '';
    $search = $this->input->get('search');
    if ($search != '') {
        $where = "AND (nama_lengkap LIKE '%$search%')";
    }
    
    // Adjust your query to include pool information
    $data = $this->db->query("
                        SELECT a.*
                        FROM ms_jadwal_partai_seni_tunggal a 
                        WHERE 1=1 $where
                        ORDER BY a.nama_lengkap
                    ")->result_array();

    if (count($data) > 0) {
        $grouped_data = [];
        foreach ($data as $row) {
            $grouped_data[$row['pool']][] = $row;
        }

        $result = array(
            'status' => true,
            'data' => $grouped_data,
            'message' => 'Peserta Ada'
        );

        return $result;
    }

    $result = array(
        'status' => false,
        'message' => 'Peserta Tidak Ada'
    );

    return $result;
  }


  public function get_data_selesai(){
    $where = '';
    $search = $this->input->get('search');
    if($search != '') {
      $where = "AND (nama_lengkap LIKE '%$search%')";
    }

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_seni_tunggal a WHERE status_selesai_pertandingan = 1 $where")->result_array();
    return $data;
  }

  public function kontingen_result()
  {
    $id_kompetisi = $this->input->post('id_kompetisi');
    $data = $this->db->get_where('ms_kontingen', ['id_kompetisi' => $id_kompetisi])->result_array();
    return $data;
  }

  public function peserta_result()
  {
    $id_kompetisi = $this->input->post('id_kompetisi');
    $data = $this->db->get_where('ms_peserta_seni_tunggal', ['id_kompetisi' => $id_kompetisi])->result_array();
    return $data;
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_jadwal_partai_seni_tunggal', array('id' => $id))->row_array();
  }

  public function import_excel(){
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $id_kompetisi = $this->input->post('id_kompetisi');
    $kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    // var_dump(isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)); die();
    if(isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
          $arr_file = explode('.', $_FILES['file_excel']['name']);
          $extension = end($arr_file);
          if('csv' == $extension){
              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
          }elseif('xls' == $extension){
              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
          }else {
              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
          }

          $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
          $sheetData = $spreadsheet->getActiveSheet()->toArray();

          $numrow = count($sheetData);

          $data = [];
          $idx_gambar = 0;
          for ($i=1; $i < $numrow; $i++) {
            if($sheetData[$i][0] != null) {
              $tanggal = $sheetData[$i][0];
              $gelanggang = $sheetData[$i][1];
              $kelas_tanding = $sheetData[$i][2];
              $kelas = $sheetData[$i][3];
              $golongan = $sheetData[$i][4];
              $no_partai = $sheetData[$i][5];
              $babak = $sheetData[$i][6];
              $jenis_kelamin = $sheetData[$i][7];
              $nama_pesilat_biru = $sheetData[$i][8];
              $kontingen_biru = $sheetData[$i][9];
              $nama_pesilat_merah = $sheetData[$i][10];
              $kontingen_merah = $sheetData[$i][11];
              $status = $sheetData[$i][12];

              $worksheet = $spreadsheet->getActiveSheet();

              $row_kt = $this->db->query("SELECT * FROM ms_kelas_tanding WHERE kelas_tanding LIKE '%$kelas_tanding%'")->row_array();
              if (!empty($row_kt)) {
                $id_kelas_tanding = $row_kt['id'];
              }else {
                $data_kt = [
                  'kelas_tanding' => $kelas_tanding,
                ];

                $this->db->insert('ms_kelas_tanding', $data_kt);
                $id_kelas_tanding = $this->db->insert_id();
              }

              $row_kontingen_biru = $this->db->query("SELECT * FROM ms_kontingen WHERE nama LIKE '%$kontingen_biru%'")->row_array();
              if (!empty($row_kontingen_biru)) {
                $id_kontingen_biru = $row_kontingen_biru['id'];
              }else {
                $data_kontingen_biru = [
                  'nama' => $kontingen_biru,
                ];

                $this->db->insert('ms_kontingen', $data_kontingen_biru);
                $id_kontingen_biru = $this->db->insert_id();
              }

              $row_kontingen_merah = $this->db->query("SELECT * FROM ms_kontingen WHERE nama LIKE '%$kontingen_merah%'")->row_array();
              if (!empty($row_kontingen_merah)) {
                $id_kontingen_merah = $row_kontingen_merah['id'];
              }else {
                $data_kontingen_merah = [
                  'nama' => $kontingen_merah,
                ];

                $this->db->insert('ms_kontingen', $data_kontingen_merah);
                $id_kontingen_merah = $this->db->insert_id();
              }

              $data[] = [
                'id_kompetisi' => $id_kompetisi,
                'kompetisi' => $kompetisi['kompetisi'],
                'tanggal' => $tanggal,
                'kategori' => $kompetisi['kategori'],
                'gelanggang' => $gelanggang,
                'id_kelas_tanding' => $id_kelas_tanding,
                'kelas_tanding' => $kelas_tanding,
                'kelas' => $kelas,
                'golongan'	=> $golongan,
                'no_partai' => $no_partai,
                'babak' => $babak,
                'jenis_kelamin' => $jenis_kelamin,
                'nama_pesilat_merah' => $nama_pesilat_merah,
                'kontingen_merah' => $kontingen_merah,
                'id_kontingen_merah' => $id_kontingen_merah,
                'nama_pesilat_biru' => $nama_pesilat_biru,
                'kontingen_biru' => $kontingen_biru,
                'id_kontingen_biru' => $id_kontingen_biru,
                'status' => $status,
              ];
            }
          }

          return $this->db->insert_batch('ms_jadwal_partai_seni_tunggal', $data);
      }
  }

  public function undi(){
    $golongan = $this->input->get('golongan');
    $peserta_perpool = $this->input->get('peserta_perpool');
    $kelas = $this->input->get('kelas');
    $jenis_kelamin = $this->input->get('jenis_kelamin');
    $id_kelas_tanding = $this->input->get('id_kelas_tanding');
    $id_kompetisi = $this->input->get('id_kompetisi');
    $kategori_tanding = 'Tunggal';


    $kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    $where_kategori = '';
    if($kompetisi['kategori'] == 'kelas') {
      $where_kategori = "AND b.kelas = '$kelas'";
    } else if($kompetisi['kategori'] == 'umur') {
      $where_kategori = "AND b.golongan = '$golongan'";
    }
    
    // var_dump($id_kompetisi);
    // die;

    $cek_peserta_undi = $this->db->query("SELECT
                                          a.*
                                          FROM ms_pengundian_seni_tunggal a
  						                            INNER JOIN ms_peserta_seni_tunggal b ON a.id_peserta = b.id
  						                            WHERE b.jenis_kelamin = '$jenis_kelamin'
                                          AND b.id_kompetisi = '$id_kompetisi'
                                          $where_kategori
  						                            AND b.id_kelas_tanding = '$id_kelas_tanding'
                                          AND b.kategori_tanding = '$kategori_tanding'
                                         ")->result_array();

    if (count($cek_peserta_undi) <= 0) {
      $cek_peserta = $this->db->query("SELECT
                                       b.*
                                       FROM ms_peserta_seni_tunggal b
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
        // Shuffle the participants to randomize their order
        shuffle($cek_peserta);

        $data_undian = [];
        $pool_number = 1;
        $counter = 0;

        foreach ($cek_peserta as $cp) {
          $data_undian[] = array(
            'id_peserta' => $cp['id'],
            'nama_lengkap' => $cp['nama_lengkap'],
            'pool' => $pool_number,
            'id_kompetisi' => $cp['id_kompetisi'],
            'kompetisi' => $cp['kompetisi'],
            'tanggal' => date('d-m-Y'),
            'waktu' => date('H:i:s'),
            'golongan' => $cp['golongan'],
            'babak' => $cp['babak'],
            'id_kelas_tanding' => $cp['id_kelas_tanding'],
            'kelas_tanding' => $cp['kelas_tanding'],
            'kelas' => $cp['kelas'],
            'kategori' => $cp['kategori'],
            'status_selesai_pertandingan' => 0,
            'status_mundur' => 0,
            'alasan_mundur' => '-',
          );

          $counter++;
          if ($counter == $peserta_perpool) {
            $counter = 0;
            $pool_number++;
          }
        }

        $this->db->trans_begin();
        $this->db->insert_batch('ms_pengundian_seni_tunggal', $data_undian);
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

      // $result = array(
      //   'status' => false,
      //   'message' => 'Peserta Kosong'
      // );

      // return $result;

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
      'message' => 'Peserta Kosong'
    );

    return $result;
}
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
