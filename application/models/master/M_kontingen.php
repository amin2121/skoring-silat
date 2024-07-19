<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kontingen extends CI_Model {

  public function tambah(){
    $this->load->library('upload');

    $config['upload_path'] = 'storage/bukti_pembayaran/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file = '';
    if($this->upload->do_upload('bukti_pembayaran')) {
      $upload_data = $this->upload->data();
      $file = $upload_data['file_name'];
    }else {
      if($this->input->post('metode_pembayaran') == 'tunai') {
        $file = '';
      } else {
    	   $file = 'default.jpg';
      }
    }

    $kompetisi = $this->db->get_where('ms_kompetisi', ['status' => 1])->row_array();

		$data = [
      'nama' => $this->input->post('nama'),
      'pelatih' => $this->input->post('pelatih'),
      'no_telepon' => $this->input->post('no_telepon'),
      'jumlah_bayar' => str_replace(',', '', $this->input->post('jumlah_bayar')),
      'metode_pembayaran' => $this->input->post('metode_pembayaran'),
      'status_pembayaran' => $this->input->post('status_pembayaran'),
      'bukti_pembayaran' => $file,
      'id_kompetisi' => $kompetisi['id'],
      'tanggal' => date('d-m-Y'),
      'waktu' => date('H:i:s'),
		];

		$this->db->trans_begin();
		$this->db->insert('ms_kontingen', $data);
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

    $kompetisi = $this->db->get_where('ms_kompetisi', ['status' => 1])->row_array();
    $kontingen = $this->db->get_where('ms_kontingen', ['id' => $this->input->post('id')])->row_array();

    $config['upload_path'] = 'storage/bukti_pembayaran/';
    $config['allowed_types'] = '*';
    $config['encrypt_name'] = true;
    $this->upload->initialize($config);

    $file = '';
    if($this->upload->do_upload('bukti_pembayaran')) {
      $upload_data = $this->upload->data();
      $file = $upload_data['file_name'];
    }else {
      $file = '';
      if($this->input->post('metode_pembayaran') == 'transfer') {
        if(!empty($kontingen)) {
          $file = $Kontingen['bukti_pembayaran'];
        } else {
          $file = 'default.jpg';
        }
      }
    }

    $data = [
      'nama' => $this->input->post('nama'),
      'pelatih' => $this->input->post('pelatih'),
      'no_telepon' => $this->input->post('no_telepon'),
      'jumlah_bayar' => str_replace(',', '', $this->input->post('jumlah_bayar')),
      'metode_pembayaran' => $this->input->post('metode_pembayaran'),
      'status_pembayaran' => $this->input->post('status_pembayaran'),
      'bukti_pembayaran' => $file,
      'id_kompetisi' => $kompetisi['id'],
		];

		$this->db->trans_begin();
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('ms_kontingen', $data);
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
		$this->db->delete('ms_kontingen');
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
    $kompetisi = $this->input->get('kompetisi');
		if($search != '') {
			$where = "AND nama LIKE '%$search%'";
		}

    if($kompetisi != '') {
      $where .= " AND id_kompetisi = '$kompetisi'";
    }

    $data = $this->db->query("SELECT a.*, b.kompetisi FROM ms_kontingen a LEFT JOIN ms_kompetisi b ON a.id_kompetisi = b.id WHERE 1=1 $where")->result_array();
    return $data;
  }

  public function get_kompetisi(){
    return $this->db->get('ms_kompetisi')->result_array();
  }

  public function get_data_row($id){
    return $this->db->get_where('ms_kontingen', array('id' => $id))->row_array();
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
