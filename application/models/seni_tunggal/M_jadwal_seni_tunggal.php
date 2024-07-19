<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_seni_tunggal extends CI_Model {

  public function get_data() {
    $where = '';
    $search = $this->input->get('search');
		if($search != '') {
			$where .= "AND (a.nama_pesilat_biru LIKE '%$search%' OR a.nama_pesilat_merah LIKE '%$search%')";
		}

    $gelanggang = $this->input->get('gelanggang');
    if($gelanggang != '') {
			$where .= "AND a.gelanggang = '$gelanggang'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE a.status = '1' AND status_selesai_pertandingan = '0' $where")->result_array();

    $data_perolehan_nilai = [];
		foreach ($data as $key => $jadwal_pertandingan) {
			$id_jadwal_pertandingan = $jadwal_pertandingan['id'];
			// hukuman sudut biru
			$hasil_tanding_teguran_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$hasil_tanding_peringatan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$hukuman_sudut_biru = $hasil_tanding_teguran_biru['hasil_akhir'] + $hasil_tanding_peringatan_biru['hasil_akhir'];

			// nilai sudut biru
			$hasil_tanding_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$hasil_tanding_jatuhan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$nilai_sudut_biru = $hasil_tanding_biru['hasil_akhir'] + $hasil_tanding_jatuhan_biru['hasil_akhir'];
			$nilai_sudut_biru = $nilai_sudut_biru + $hukuman_sudut_biru;

			// hukuman sudut merah
			$hasil_tanding_teguran_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$hasil_tanding_peringatan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$hukuman_sudut_merah = $hasil_tanding_teguran_merah['hasil_akhir'] + $hasil_tanding_peringatan_merah['hasil_akhir'];

			// nilai sudut merah
			$hasil_tanding_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$hasil_tanding_jatuhan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$nilai_sudut_merah = $hasil_tanding_merah['hasil_akhir'] + $hasil_tanding_jatuhan_merah['hasil_akhir'];
			$nilai_sudut_merah = $nilai_sudut_merah + $hukuman_sudut_merah;

      $pemenang = '';
      if($nilai_sudut_biru > $nilai_sudut_merah) {
        $pemenang = 'Biru';
      } else if($nilai_sudut_merah > $nilai_sudut_biru) {
        $pemenang = 'Merah';
      } else {
        $pemenang = '-';
      }

			$data_perolehan_nilai[] = [
        'id' => $jadwal_pertandingan['id'],
				'kompetisi' => $jadwal_pertandingan['kompetisi'],
				'no_partai' => $jadwal_pertandingan['no_partai'],
        'kelas_tanding' => $jadwal_pertandingan['kelas_tanding'],
        'kategori' => $jadwal_pertandingan['kategori'],
        'kelas' => $jadwal_pertandingan['kelas'],
        'golongan' => $jadwal_pertandingan['golongan'],
				'gelanggang' => $jadwal_pertandingan['gelanggang'],
				'nama_pesilat_merah' => $jadwal_pertandingan['nama_pesilat_merah'],
				'kontingen_merah' => $jadwal_pertandingan['kontingen_merah'],
				'nama_pesilat_biru' => $jadwal_pertandingan['nama_pesilat_biru'],
				'kontingen_biru' => $jadwal_pertandingan['kontingen_biru'],
				'pemenang' => $pemenang,
				'nilai_sudut_biru' => $nilai_sudut_biru,
				'nilai_sudut_merah' => $nilai_sudut_merah,
			];
		}

    return $data_perolehan_nilai;
  }

  public function get_data_tanding_selesai() {
    $where = '';
    $search = $this->input->get('search');
		if($search != '') {
			$where .= "AND (a.nama_pesilat_biru LIKE '%$search%' OR a.nama_pesilat_merah LIKE '%$search%')";
		}

    $gelanggang = $this->input->get('gelanggang');
    if($gelanggang != '') {
			$where .= "AND a.gelanggang = '$gelanggang'";
		}

    $data = $this->db->query("SELECT a.* FROM ms_jadwal_partai_tanding a WHERE a.status_selesai_pertandingan = '1' $where")->result_array();

    $data_perolehan_nilai = [];
		foreach ($data as $key => $jadwal_pertandingan) {
			$id_jadwal_pertandingan = $jadwal_pertandingan['id'];
			// hukuman sudut biru
			$hasil_tanding_teguran_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$hasil_tanding_peringatan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$hukuman_sudut_biru = $hasil_tanding_teguran_biru['hasil_akhir'] + $hasil_tanding_peringatan_biru['hasil_akhir'];

			// nilai sudut biru
			$hasil_tanding_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$hasil_tanding_jatuhan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
			$nilai_sudut_biru = $hasil_tanding_biru['hasil_akhir'] + $hasil_tanding_jatuhan_biru['hasil_akhir'];
			$nilai_sudut_biru = $nilai_sudut_biru + $hukuman_sudut_biru;

			// hukuman sudut merah
			$hasil_tanding_teguran_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$hasil_tanding_peringatan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$hukuman_sudut_merah = $hasil_tanding_teguran_merah['hasil_akhir'] + $hasil_tanding_peringatan_merah['hasil_akhir'];

			// nilai sudut merah
			$hasil_tanding_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$hasil_tanding_jatuhan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
			$nilai_sudut_merah = $hasil_tanding_merah['hasil_akhir'] + $hasil_tanding_jatuhan_merah['hasil_akhir'];
			$nilai_sudut_merah = $nilai_sudut_merah + $hukuman_sudut_merah;

      $pemenang = '';
      if($nilai_sudut_biru > $nilai_sudut_merah) {
        $pemenang = $jadwal_pertandingan['nama_pesilat_biru'];
      } else if($nilai_sudut_merah > $nilai_sudut_biru) {
        $pemenang = $jadwal_pertandingan['nama_pesilat_merah'];
      } else {
        $pemenang = '-';
      }

      $pesilat_sudut_undur_diri = $jadwal_pertandingan['pesilat_mundur'];
      if($pesilat_sudut_undur_diri == 'Biru') {
        $pemenang = $jadwal_pertandingan['nama_pesilat_merah'];
      } else if($pesilat_sudut_undur_diri == 'Merah') {
        $pemenang = $jadwal_pertandingan['nama_pesilat_biru'];
      }

			$data_perolehan_nilai[] = [
        'id' => $jadwal_pertandingan['id'],
				'kompetisi' => $jadwal_pertandingan['kompetisi'],
				'no_partai' => $jadwal_pertandingan['no_partai'],
        'kelas_tanding' => $jadwal_pertandingan['kelas_tanding'],
        'kategori' => $jadwal_pertandingan['kategori'],
        'kelas' => $jadwal_pertandingan['kelas'],
        'golongan' => $jadwal_pertandingan['golongan'],
				'gelanggang' => $jadwal_pertandingan['gelanggang'],
				'nama_pesilat_merah' => $jadwal_pertandingan['nama_pesilat_merah'],
				'kontingen_merah' => $jadwal_pertandingan['kontingen_merah'],
				'nama_pesilat_biru' => $jadwal_pertandingan['nama_pesilat_biru'],
				'kontingen_biru' => $jadwal_pertandingan['kontingen_biru'],
				'pemenang' => $pemenang,
        'sudut_undur_diri' => $pesilat_sudut_undur_diri,
				'nilai_sudut_biru' => $nilai_sudut_biru,
				'nilai_sudut_merah' => $nilai_sudut_merah,
			];
		}

    return $data_perolehan_nilai;
  }

  public function get_round()
  {
    $id_jadwal_pertandingan = $this->input->post('id_jadwal_pertandingan');
    return $this->db->query("SELECT * FROM pr_tanding WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' LIMIT 500")->row_array();
  }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/kepegawaian/M_dashboard.php */
