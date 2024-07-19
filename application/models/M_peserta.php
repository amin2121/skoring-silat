<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {
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

    $config['upload_path'] = 'storage/bukti_pembayaran/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file_bukti_pembayaran = '';
    if($this->upload->do_upload('bukti_pembayaran')) {
      $upload_data = $this->upload->data();
      $file_bukti_pembayaran = $upload_data['file_name'];
    }else {
    	$file_bukti_pembayaran = 'default.jpg';
    }

    $status_pembayaran = '0';
    if ($this->input->post('jumlah_transfer') != '0') {
      $status_pembayaran = '1';
    }

    $row_kt = $this->db->get_where('ms_kelas_tanding', array('id' => $this->input->post('id_kelas_tanding')))->row_array();
    $row_km = $this->db->get_where('ms_kompetisi', array('id' => $this->input->post('id_kompetisi')))->row_array();
		$data = [
      'id_kompetisi' => $this->input->post('id_kompetisi'),
      'kompetisi' => $row_km['kompetisi'],
      'foto_peserta'	=> $file_foto_peserta,
      'kategori_tanding' => $this->input->post('kategori_tanding'),
      'golongan' => $this->input->post('golongan'),
      'nama_lengkap' => $this->input->post('nama_lengkap'),
      'tanggal_lahir' => date('d-m-Y', strtotime($this->input->post('tanggal_lahir'))),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tinggi_badan' => $this->input->post('tinggi_badan'),
			'berat_badan' => $this->input->post('berat_badan'),
			'asal_sekolah' => $this->input->post('asal_sekolah'),
			'kelas' => $this->input->post('kelas'),
      'akta_kelahiran'	=> $file_akta_kelahiran,
      'ijazah'	=> $file_ijazah,
			'id_kelas_tanding' => $this->input->post('id_kelas_tanding'),
      'kelas_tanding' => $row_kt['kelas_tanding'],
      'kontingen' => $this->input->post('kontingen'),
      'status_pembayaran' => $status_pembayaran,
      'jumlah_transfer' => str_replace(',','', $this->input->post('jumlah_transfer')),
      'file_bukti_pembayaran' => $file_bukti_pembayaran
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

  public function hapus(){
    $id = $this->input->get('id');

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
		if($search != '') {
			$where = "AND nama_lengkap LIKE '%$search%'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_peserta a WHERE 1=1 $where")->result_array();
    return $data;
  }

  public function detail_data(){
    $id = $this->input->get('id');
    $data = $this->db->query("SELECT a.* FROM ms_peserta a
                              WHERE id = '$id'")->row_array();
    return $data;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
