<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_partai_tanding extends CI_Model {

  public function tambah() {
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
      'status' => 0,
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
		$this->db->insert('ms_jadwal_partai_tanding', $data);
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
    $this->db->update('ms_jadwal_partai_tanding', $data);
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
		$this->db->delete('ms_jadwal_partai_tanding');
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
		if($search != '') {
			$where = "AND (nama_pesilat_biru LIKE '%$search%' OR nama_pesilat_merah LIKE '%$search%')";
		}

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE 1=1 $where")->result_array();
    return $data;
  }

  public function get_data_selesai(){
    $where = '';
    $search = $this->input->get('search');
    if($search != '') {
      $where = "AND (nama_pesilat_biru LIKE '%$search%' OR nama_pesilat_merah LIKE '%$search%')";
    }

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE status_selesai_pertandingan = 1 $where")->result_array();
    return $data;
  }

  public function kontingen_result()
  {
    $id_kompetisi = $this->input->post('id_kompetisi');
    $data = $this->db->get_where('ms_kontingen', ['id_kompetisi' => $id_kompetisi])->result_array();
    return $data;
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_jadwal_partai_tanding', array('id' => $id))->row_array();
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

          return $this->db->insert_batch('ms_jadwal_partai_tanding', $data);
      }
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
