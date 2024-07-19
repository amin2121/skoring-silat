<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_pertandingan_tanding extends CI_Model {
  public function get_data(){
    $where = '';
    $search = $this->input->get('search');
		if($search != '') {
			$where = "AND golongan LIKE '%$search%'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE a.status = '1' $where")->result_array();
    return $data;
  }

  public function setting_round(){
		$round = $this->input->post('round');
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');

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

		$data['round'] = $round;

    $data_tanding = ['ronde_berjalan' => $round];
    $this->db->where('id', $id_jadwal_pertandingan);
    $this->db->update('pr_tanding', $data_tanding);

		$pusher->trigger('round', 'setting-round', $data);

		$response = array(
			'result' => "true",
			'message' => "Round Berhasil Disetting"
		);

		return $response;
	}
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
