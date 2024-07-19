<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pencatat_waktu extends CI_Model {

  public function get_round()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    return $this->db->query("SELECT * FROM pr_tanding WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' LIMIT 500")->row_array();
  }

  public function setting_round(){
		$round = $this->input->post('round');
		$waktu_awal = $this->input->post('waktu_awal');
		$id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

		// $options = array(
		//   'cluster' => 'ap1',
		//   'useTLS' => true
		// );

		// $pusher = new Pusher\Pusher(
		//   'e636cb98a16cc38f57fe',
		//   'ea718c82a959b5591287',
		//   '1610313',
		//   $options
		// );

		$data['round'] = $round;
		$data['reset_waktu'] = $waktu_awal;
		$data['id_jadwal_pertandingan'] = $id_jadwal_pertandingan;

		$data_tanding = ['id_jadwal_pertandingan' => $id_jadwal_pertandingan, 'ronde_berjalan' => $round];
		$tanding = $this->db->get_where('pr_tanding', ['id_jadwal_pertandingan' => $id_jadwal_pertandingan])->num_rows();

		if($tanding > 0) {
			$this->db->where('id_jadwal_pertandingan', $id_jadwal_pertandingan);
			$this->db->update('pr_tanding', $data_tanding);
		} else {
			$this->db->insert('pr_tanding', $data_tanding);
		}

		// $pusher->trigger('round', 'setting-round', $data);

		$response = array(
			'result' => "true",
      		'data' => $data,
			'message' => "Round Berhasil Disetting"
		);

		return $response;
	}

  public function setting_waktu_awal(){
    $waktu = $this->input->post('waktu');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

	$data['waktu_awal'] = $waktu;
    $data['id_jadwal_pertandingan'] = $id_jadwal_pertandingan;

	$response = array(
		'result' => "true",
		'data' => $data,
		'message' => "Setting Waktu Awal Berhasil Disetting"
	);

	return $response;
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
