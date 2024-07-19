<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {
  public function get_kelas_tanding(){
    return $this->db->query("SELECT * FROM ms_kelas_tanding ORDER BY id ASC")->result_array();
  }

  public function get_row_data($id){
    return $this->db->query("SELECT a.* FROM ms_peserta a WHERE id = '$id'")->row_array();
  }

  public function get_kompetisi(){
    return $this->db->get('ms_kompetisi')->result_array();
  }

  public function tambah(){
    $this->load->library('upload');

    $config['upload_path'] = 'storage/peserta/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_foto_peserta = '';
    if($this->upload->do_upload('foto_peserta')) {
      $upload_data = $this->upload->data();
      $file_foto_peserta = $upload_data['file_name'];
    }else {
    	$file_foto_peserta = 'default.jpg';
    }

    $config['upload_path'] = 'storage/ijazah/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_ijazah = '';
    if($this->upload->do_upload('ijazah')) {
      $upload_data = $this->upload->data();
      $file_ijazah = $upload_data['file_name'];
    }else {
    	$file_ijazah = 'default.jpg';
    }

    $config['upload_path'] = 'storage/akta_kelahiran/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_akta_kelahiran = '';
    if($this->upload->do_upload('akta_kelahiran')) {
      $upload_data = $this->upload->data();
      $file_akta_kelahiran = $upload_data['file_name'];
    }else {
    	$file_akta_kelahiran = 'default.jpg';
    }

    $row_kt = $this->db->get_where('ms_kelas_tanding', array('id' => $this->input->post('id_kelas_tanding')))->row_array();
    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();
    $row_ktgn = $this->db->get_where('ms_kontingen', array('id' => $this->input->post('id_kontingen')))->row_array();

		$data = [
      'id_kompetisi' => $this->input->post('id_kompetisi'),
      'kompetisi' => $row_km['kompetisi'],
      'foto_peserta'	=> $file_foto_peserta,
      'kategori_tanding' => $this->input->post('kategori_tanding'),
      'golongan' => $this->input->post('golongan'),
      'nama_lengkap' => $this->input->post('nama_lengkap'),
      'tanggal_lahir' => str_replace('/', '-', $this->input->post('tanggal_lahir')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tinggi_badan' => $this->input->post('tinggi_badan'),
			'berat_badan' => $this->input->post('berat_badan'),
			'asal_sekolah' => $this->input->post('asal_sekolah'),
			'kelas' => $this->input->post('kelas'),
      'akta_kelahiran'	=> $file_akta_kelahiran,
      'ijazah'	=> $file_ijazah,
			'id_kelas_tanding' => $this->input->post('id_kelas_tanding'),
      'kelas_tanding' => $row_kt['kelas_tanding'],
      'kontingen' => $row_ktgn['nama'],
      'id_kontingen' => $this->input->post('id_kontingen'),
      'tanggal' => date('d-m-Y'),
      'waktu' => date('H:i:s'),
		];

		$this->db->trans_begin();
		$this->db->insert('ms_peserta', $data);
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
    $this->load->library('upload');

    $config['upload_path'] = 'storage/peserta/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $id_peserta = $this->input->post('id');
    $peserta = $this->db->get_where('ms_peserta', ['id' => $id_peserta])->row_array();

    $file_foto_peserta = '';
    if($this->upload->do_upload('foto_peserta')) {
      $upload_data = $this->upload->data();
      $file_foto_peserta = $upload_data['file_name'];
    }else {
      $file_foto_peserta = 'default.jpg';
      if($peserta['foto_peserta'] != 'default.jpg') {
          $file_foto_peserta = $peserta['foto_peserta'];
      }
    }

    $config['upload_path'] = 'storage/ijazah/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_ijazah = '';
    if($this->upload->do_upload('ijazah')) {
      $upload_data = $this->upload->data();
      $file_ijazah = $upload_data['file_name'];
    }else {
      $file_ijazah = 'default.jpg';
      if($peserta['ijazah'] != 'default.jpg') {
          $file_ijazah = $peserta['ijazah'];
      }
    }

    $config['upload_path'] = 'storage/akta_kelahiran/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_akta_kelahiran = '';
    if($this->upload->do_upload('akta_kelahiran')) {
      $upload_data = $this->upload->data();
      $file_akta_kelahiran = $upload_data['file_name'];
    }else {
    	$file_akta_kelahiran = 'default.jpg';
      if($peserta['akta_kelahiran'] != 'default.jpg') {
          $file_akta_kelahiran = $peserta['akta_kelahiran'];
      }
    }

    $row_kt = $this->db->get_where('ms_kelas_tanding', array('id' => $this->input->post('id_kelas_tanding')))->row_array();
    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();
    $row_ktgn = $this->db->get_where('ms_kontingen', array('id' => $this->input->post('id_kontingen')))->row_array();

		$data = [
      'id_kompetisi' => $this->input->post('id_kompetisi'),
      'kompetisi' => $row_km['kompetisi'],
      'foto_peserta'	=> $file_foto_peserta,
      'kategori_tanding' => $this->input->post('kategori_tanding'),
      'golongan' => $this->input->post('golongan'),
      'nama_lengkap' => $this->input->post('nama_lengkap'),
      'tanggal_lahir' => str_replace('/', '-', $this->input->post('tanggal_lahir')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tinggi_badan' => $this->input->post('tinggi_badan'),
			'berat_badan' => $this->input->post('berat_badan'),
			'asal_sekolah' => $this->input->post('asal_sekolah'),
			'kelas' => $this->input->post('kelas'),
      'akta_kelahiran'	=> $file_akta_kelahiran,
      'ijazah'	=> $file_ijazah,
			'id_kelas_tanding' => $this->input->post('id_kelas_tanding'),
      'kelas_tanding' => $row_kt['kelas_tanding'],
      'kontingen' => $row_ktgn['nama'],
      'id_kontingen' => $this->input->post('id_kontingen'),
		];

		$this->db->trans_begin();
    $this->db->where('id', $id_peserta);
		$this->db->update('ms_peserta', $data);
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
    $peserta = $this->db->get_where('ms_peserta', ['id' => $id])->row_array();
    @unlink(FCPATH . 'storage/peserta/'. $peserta['foto_peserta']);
    @unlink(FCPATH . 'storage/akta_kelahiran/'. $peserta['akta_kelahiran']);
    @unlink(FCPATH . 'storage/ijazah/'. $peserta['ijazah']);

    $this->db->trans_begin();
		$this->db->where('id', $id);
		$this->db->delete('ms_peserta');
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
			$where = "AND nama_lengkap LIKE '%$search%'";
		}

    if($id_kompetisi != 'semua') {
      $where .= " AND id_kompetisi = '$id_kompetisi'";

      if($kompetisi['kategori'] == 'kelas') {
        $where .= $kelas != 'semua' ? " AND kelas = '$kelas'" : "";
      } else if($kompetisi['kategori'] == 'umur') {
        $where .= $golongan != 'semua' ? " AND golongan = '$golongan'" : "";
      }

    }

    if($jenis_kelamin != 'semua') {
      $where .= " AND jenis_kelamin = '$jenis_kelamin'";
    }

    if($id_kelas_tanding != 'semua') {
      $where .= " AND id_kelas_tanding = '$id_kelas_tanding'";
    }

    $data = $this->db->query("SELECT a.*, b.kategori FROM ms_peserta a LEFT JOIN ms_kompetisi b ON a.id_kompetisi = b.id WHERE 1=1 $where ORDER BY id DESC")->result_array();
    return $data;
  }

  public function get_kontingen(){
    $id_kompetisi = $this->input->get('id_kompetisi');
    $data = $this->db->query("SELECT a.* FROM ms_kontingen a WHERE id_kompetisi = '$id_kompetisi'")->result_array();
    return $data;
  }

  public function detail_data(){
    $id = $this->input->get('id');
    $data = $this->db->query("SELECT a.* FROM ms_peserta a
                              WHERE id = '$id'")->row_array();
    return $data;
  }

  public function import_excel(){
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $id_kompetisi = $this->input->post('id_kompetisi');
    $kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $id_kompetisi])->row_array();

    // var_dump($kompetisi); die();

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
              $nama_lengkap = $sheetData[$i][0];
              $kategori_tanding = $sheetData[$i][1];
              $tanggal_lahir = $sheetData[$i][2];
              $jenis_kelamin = $sheetData[$i][3];
              $tinggi_badan = $sheetData[$i][4];
              $berat_badan = $sheetData[$i][5];
              $golongan = $sheetData[$i][6];
              $kelas_tanding = $sheetData[$i][7];
              $kontingen = $sheetData[$i][8];
              $kelas = $sheetData[$i][9];
              $asal_sekolah = $sheetData[$i][10];
              $foto_peserta = 'default.jpg';
              $scan_akta_kelahiran = 'default.jpg';
              $scan_ijazah = 'default.jpg';

              $kontingen = strtoupper($kontingen);
              $row_k = $this->db->query("SELECT * FROM ms_kontingen WHERE id_kompetisi = $id_kompetisi AND nama LIKE '%$kontingen%'")->row_array();
              if (!empty($row_k)) {
                $id_kontingen = $row_k['id'];
              }else {
                $data_k = [
                  'nama' => $kontingen,
                  'id_kompetisi' => $id_kompetisi,
                  'tanggal' => date('d-m-Y'),
                  'waktu' => date('H:i:s'),
                  'status_pembayaran' => 0,
                ];

                $this->db->insert('ms_kontingen', $data_k);
                $id_kontingen = $this->db->insert_id();
              }

              $kelas_tanding = strtoupper($kelas_tanding);
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

              $data[] = [
                'id_kompetisi' => $id_kompetisi,
                'kompetisi' => $kompetisi['kompetisi'],
                'foto_peserta' => $foto_peserta,
                'nama_lengkap' => $nama_lengkap,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => ucfirst($jenis_kelamin),
                'tinggi_badan'	=> $tinggi_badan,
                'berat_badan' => $berat_badan,
                'asal_sekolah' => $asal_sekolah,
                'kelas' => strtoupper($kelas),
                'ijazah' => $scan_ijazah,
                'akta_kelahiran' => $scan_akta_kelahiran,
                'id_kelas_tanding' => $id_kelas_tanding,
                'kelas_tanding' => $kelas_tanding,
                'id_kontingen' => $id_kontingen,
                'kontingen' => $kontingen,
                'golongan' => ucfirst($golongan),
                'kategori_tanding' => $kategori_tanding,
                'tanggal' => date('d-m-Y'),
                'waktu' => date('H:i:s'),
              ];
            }
          }

          return $this->db->insert_batch('ms_peserta', $data);
      }
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
