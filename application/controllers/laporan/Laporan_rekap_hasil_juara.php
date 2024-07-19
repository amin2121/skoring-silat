<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_rekap_hasil_juara extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
		$data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();

		$this->load->view('templates/header', $data);
    $this->load->view('laporan/laporan_rekap_hasil_juara');
    $this->load->view('templates/footer');
	}

	public function kontingen_result()
	{
		$id_kompetisi = $this->input->post('id_kompetisi');
		$data = $this->db->get_where('ms_kontingen', ['id_kompetisi' => $id_kompetisi])->result_array();
		echo json_encode(['data' => $data]);
	}

  public function cetak()
	{
		$filter = $this->input->post('filter');

		if($filter == 'peserta'){
			$kompetisi = $this->input->post('kompetisi');
			$babak = $this->input->post('babak');
			$golongan = $this->input->post('golongan');
			$kelas = $this->input->post('kelas');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$kontingen = $this->input->post('kontingen');
			$data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();
	
			$where_kategori = '';
			$kategorii = '';
			if($data_kompetisi['kategori'] == 'kelas') {
				$where_kategori = "AND a.kelas = '$kelas'";
				$kategorii = "$kelas";
			} else if($data_kompetisi['kategori'] == 'umur') {
				$where_kategori = "AND a.golongan = '$golongan'";
				$kategorii = "$golongan";
			}
	
			$where_jenis_kelamin = '';
			if($jenis_kelamin != 'semua') {
				$where_jenis_kelamin = "AND a.jenis_kelamin = '$jenis_kelamin'";
			}
	
			$data_jadwal_pertandingan = $this->db->query("SELECT
											a.*
											FROM ms_jadwal_partai_tanding a
											WHERE a.id_kompetisi = '$kompetisi'
											AND a.status_selesai_pertandingan = 1
											$where_kategori
											$where_jenis_kelamin
										")->result_array();
	
			$data_perolehan_nilai = [];
			foreach ($data_jadwal_pertandingan as $key => $jadwal_pertandingan) {
				$id_jadwal_pertandingan = $jadwal_pertandingan['id'];
				$babak = $jadwal_pertandingan['babak'];
	
				if ($babak == 'SEMIFINAL' || $babak == 'FINAL') {
					$hasil_tanding_teguran_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hasil_tanding_peringatan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hukuman_biru = $hasil_tanding_teguran_biru['hasil_akhir'] + $hasil_tanding_peringatan_biru['hasil_akhir'];
	
					// nilai sudut biru
					$hasil_tanding_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hasil_tanding_jatuhan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$nilai_biru = $hasil_tanding_biru['hasil_akhir'] + $hasil_tanding_jatuhan_biru['hasil_akhir'];
					$nilai_akhir_biru = $nilai_biru + $hukuman_biru;
	
					// $data_perolehan_nilai[] = [
					// 	'no_partai' => $jadwal_pertandingan['no_partai'],
					// 	'nama_pesilat' => $jadwal_pertandingan['nama_pesilat_biru'],
					// 	'kontingen' => $jadwal_pertandingan['kontingen_biru'],
					// 	'hukuman' => $hukuman_biru,
					// 	'nilai' => $nilai,
					// ];
	
					// hukuman sudut merah
					$hasil_tanding_teguran_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hasil_tanding_peringatan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hukuman_merah = $hasil_tanding_teguran_merah['hasil_akhir'] + $hasil_tanding_peringatan_merah['hasil_akhir'];
	
					// nilai sudut merah
					$hasil_tanding_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hasil_tanding_jatuhan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$nilai_merah = $hasil_tanding_merah['hasil_akhir'] + $hasil_tanding_jatuhan_merah['hasil_akhir'];
					$nilai_akhir_merah = $nilai_merah + $hukuman_merah;
	
					if ($nilai_akhir_biru > $nilai_akhir_merah) {
						$menang = 'Biru';
						$kalah = 'Merah';
					} elseif ($nilai_akhir_biru < $nilai_akhir_merah) {
						$menang = 'Merah';
						$kalah = 'Biru';
					}
	
					$nama_pesilat_menang = '';
					$nama_pesilat_kalah = '';
					$kontingen_menang = '';
					$kontingen_kalah = '';
					$skor_nilai_menang = 0;
					$skor_nilai_kalah = 0;
	
					if ($babak == 'SEMIFINAL') {
						$skor_nilai_kalah = 25;
					} elseif ($babak == 'FINAL') {
						$skor_nilai_kalah = 50;
						$skor_nilai_menang = 100;
					}
	
					if ($babak == 'SEMIFINAL') {
						if ($kalah == 'Biru') {
							$nama_pesilat_kalah = $jadwal_pertandingan['nama_pesilat_biru'];
							$kontingen_kalah = $jadwal_pertandingan['kontingen_biru'];
						} elseif ($kalah == 'Merah') {
							$nama_pesilat_kalah = $jadwal_pertandingan['nama_pesilat_merah'];
							$kontingen_kalah = $jadwal_pertandingan['kontingen_merah'];
						}
	
						// Menambahkan data pesilat yang kalah di SEMIFINAL
						$data_perolehan_nilai[] = [
							'no_partai' => $jadwal_pertandingan['no_partai'],
							'nama_pesilat' => $nama_pesilat_kalah,
							'kontingen' => $kontingen_kalah,
							'total' => $skor_nilai_kalah,
						];
					} elseif ($babak == 'FINAL') {
						$nama_pesilat_menang = '';
						$kontingen_menang = '';
	
						if ($menang == 'Biru') {
							$nama_pesilat_menang = $jadwal_pertandingan['nama_pesilat_biru'];
							$kontingen_menang = $jadwal_pertandingan['kontingen_biru'];
							$nama_pesilat_kalah = $jadwal_pertandingan['nama_pesilat_merah'];
							$kontingen_kalah = $jadwal_pertandingan['kontingen_merah'];
						} elseif ($menang == 'Merah') {
							$nama_pesilat_menang = $jadwal_pertandingan['nama_pesilat_merah'];
							$kontingen_menang = $jadwal_pertandingan['kontingen_merah'];
							$nama_pesilat_kalah = $jadwal_pertandingan['nama_pesilat_biru'];
							$kontingen_kalah = $jadwal_pertandingan['kontingen_biru'];
						}
	
						// Menambahkan data pesilat yang menang di FINAL
						$data_perolehan_nilai[] = [
							'no_partai' => $jadwal_pertandingan['no_partai'],
							'nama_pesilat' => $nama_pesilat_menang,
							'kontingen' => $kontingen_menang,
							'total' => $skor_nilai_menang,
						];
	
						// Menambahkan data pesilat yang kalah di FINAL
						$data_perolehan_nilai[] = [
							'no_partai' => $jadwal_pertandingan['no_partai'],
							'nama_pesilat' => $nama_pesilat_kalah,
							'kontingen' => $kontingen_kalah,
							'total' => $skor_nilai_kalah,
						];
					}
				}
			}
		
			$total = array_column($data_perolehan_nilai, 'total');
			array_multisort($total, SORT_DESC, $data_perolehan_nilai);
	
			$data['result'] = $data_perolehan_nilai;
			$data['kompetisi'] = $data_kompetisi;
			$data['jk'] = $jenis_kelamin;
			$data['kategori'] = $kategorii;
			$data['status'] = 'peserta';
			$this->load->view('laporan/cetak/laporan_rekap_hasil_juara', $data);
		} elseif ($filter == 'kontingen') {
			$kompetisi = $this->input->post('kompetisi_kontingen');
			$data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();

			$data_jadwal_pertandingan = $this->db->query("SELECT
												a.*
												FROM ms_jadwal_partai_tanding a
												WHERE a.id_kompetisi = '$kompetisi'
												AND a.status_selesai_pertandingan = 1
											")->result_array();

			$data_perolehan_nilai = [];
			foreach ($data_jadwal_pertandingan as $key => $jadwal_pertandingan) {
				$id_jadwal_pertandingan = $jadwal_pertandingan['id'];
				$babak = $jadwal_pertandingan['babak'];

				if ($babak == 'SEMIFINAL' || $babak == 'FINAL') {
					// hukuman sudut biru
					$hasil_tanding_teguran_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hasil_tanding_peringatan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hukuman_biru = $hasil_tanding_teguran_biru['hasil_akhir'] + $hasil_tanding_peringatan_biru['hasil_akhir'];

					// nilai sudut biru
					$hasil_tanding_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hasil_tanding_jatuhan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$nilai_biru = $hasil_tanding_biru['hasil_akhir'] + $hasil_tanding_jatuhan_biru['hasil_akhir'];
					$nilai_akhir_biru = $nilai_biru + $hukuman_biru;

					// hukuman sudut merah
					$hasil_tanding_teguran_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hasil_tanding_peringatan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hukuman_merah = $hasil_tanding_teguran_merah['hasil_akhir'] + $hasil_tanding_peringatan_merah['hasil_akhir'];

					// nilai sudut merah
					$hasil_tanding_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hasil_tanding_jatuhan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$nilai_merah = $hasil_tanding_merah['hasil_akhir'] + $hasil_tanding_jatuhan_merah['hasil_akhir'];
					$nilai_akhir_merah = $nilai_merah + $hukuman_merah;

					if ($nilai_akhir_biru > $nilai_akhir_merah) {
						$menang = 'Biru';
						$kalah = 'Merah';
					} elseif ($nilai_akhir_biru < $nilai_akhir_merah) {
						$menang = 'Merah';
						$kalah = 'Biru';
					}

					$nama_pesilat_menang = '';
					$nama_pesilat_kalah = '';
					$kontingen_menang = '';
					$kontingen_kalah = '';
					$skor_nilai_menang = 0;
					$skor_nilai_kalah = 0;

					if ($babak == 'SEMIFINAL') {
						$skor_nilai_kalah = 25;
					} elseif ($babak == 'FINAL') {
						$skor_nilai_kalah = 50;
						$skor_nilai_menang = 100;
					}

					if ($babak == 'SEMIFINAL') {
						if ($kalah == 'Biru') {
							$kontingen_kalah = $jadwal_pertandingan['kontingen_biru'];
						} elseif ($kalah == 'Merah') {
							$kontingen_kalah = $jadwal_pertandingan['kontingen_merah'];
						}

						// Menambahkan data pesilat yang kalah di SEMIFINAL
						if (isset($data_perolehan_nilai[$kontingen_kalah])) {
							$data_perolehan_nilai[$kontingen_kalah] += $skor_nilai_kalah;
						} else {
							$data_perolehan_nilai[$kontingen_kalah] = $skor_nilai_kalah;
						}
					} elseif ($babak == 'FINAL') {
						if ($menang == 'Biru') {
							$kontingen_menang = $jadwal_pertandingan['kontingen_biru'];
							$kontingen_kalah = $jadwal_pertandingan['kontingen_merah'];
						} elseif ($menang == 'Merah') {
							$kontingen_menang = $jadwal_pertandingan['kontingen_merah'];
							$kontingen_kalah = $jadwal_pertandingan['kontingen_biru'];
						}

						// Menambahkan data pesilat yang menang di FINAL
						if (isset($data_perolehan_nilai[$kontingen_menang])) {
							$data_perolehan_nilai[$kontingen_menang] += $skor_nilai_menang;
						} else {
							$data_perolehan_nilai[$kontingen_menang] = $skor_nilai_menang;
						}

						// Menambahkan data pesilat yang kalah di FINAL
						if (isset($data_perolehan_nilai[$kontingen_kalah])) {
							$data_perolehan_nilai[$kontingen_kalah] += $skor_nilai_kalah;
						} else {
							$data_perolehan_nilai[$kontingen_kalah] = $skor_nilai_kalah;
						}
					}
				}
			}

			$total = array_column($data_perolehan_nilai, 'total');
			// array_multisort($total, SORT_DESC, $data_perolehan_nilai);

			// Mengubah array asosiatif menjadi array numerik dengan kontingen dan total
			$data_perolehan_nilai_final = [];
			foreach ($data_perolehan_nilai as $kontingen => $total) {
				$data_perolehan_nilai_final[] = ['kontingen' => $kontingen, 'total' => $total];
			}

			$data['result'] = $data_perolehan_nilai_final;
			$data['kompetisi'] = $data_kompetisi;
			$data['status'] = 'kontingen';
			// $data['jk'] = $jenis_kelamin;
			// $data['kategori'] = $kategorii;
			$this->load->view('laporan/cetak/laporan_rekap_hasil_juara', $data);
		}
		
  	}

	public function export_excel()
	{
		$kompetisi = $this->input->get('kompetisi');
    $gelanggang = $this->input->get('gelanggang');
		$golongan = $this->input->get('golongan');
		$kelas = $this->input->get('kelas');
		$jenis_kelamin = $this->input->get('jenis_kelamin');
		$kontingen = $this->input->get('kontingen');
    $data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();

		$where_gelanggang = '';
		if($gelanggang != 'semua') {
			$where_gelanggang = "AND a.gelanggang = '$gelanggang'";
		}

		$where_kontingen = '';
		if($kontingen != 'semua') {
			$where_kontingen = "AND (a.kontingen_biru = '$kontingen' OR a.kontingen_merah = '$kontingen')";
		}

		$where_kategori = '';
		if($data_kompetisi['kategori'] == 'kelas') {
			$where_kategori = "AND a.kelas = '$kelas'";
		} else if($data_kompetisi['kategori'] == 'umur') {
			$where_kategori = "AND a.golongan = '$golongan'";
		}

		$where_jenis_kelamin = '';
		if($jenis_kelamin != 'semua') {
			$where_jenis_kelamin = "AND a.jenis_kelamin = '$jenis_kelamin'";
		}

    $data_jadwal_pertandingan = $this->db->query("SELECT
                                                    a.*
                                                  FROM ms_jadwal_partai_tanding a
                                                  WHERE a.id_kompetisi = '$kompetisi'
																									AND a.status_selesai_pertandingan = 1
																									$where_gelanggang
																									$where_kontingen
																									$where_kategori
																									$where_jenis_kelamin
                                ")->result_array();

		$data_perolehan_nilai = [];
		foreach ($data_jadwal_pertandingan as $key => $jadwal_pertandingan) {
			$id_jadwal_pertandingan = $jadwal_pertandingan['id'];

			if($kontingen != 'semua') {
				if($kontingen == $jadwal_pertandingan['kontingen_biru']) {
					// hukuman sudut biru
					$hasil_tanding_teguran_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hasil_tanding_peringatan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hukuman = $hasil_tanding_teguran_biru['hasil_akhir'] + $hasil_tanding_peringatan_biru['hasil_akhir'];

					// nilai sudut biru
					$hasil_tanding_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$hasil_tanding_jatuhan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
					$nilai = $hasil_tanding_biru['hasil_akhir'] + $hasil_tanding_jatuhan_biru['hasil_akhir'];
					$nilai = $nilai + $hukuman;

					$data_perolehan_nilai[] = [
						'no_partai' => $jadwal_pertandingan['no_partai'],
						'nama_pesilat' => $jadwal_pertandingan['nama_pesilat_biru'],
						'kontingen' => $jadwal_pertandingan['kontingen_biru'],
						'hukuman' => $hukuman,
						'nilai' => $nilai,
					];
				} else if($kontingen == $jadwal_pertandingan['kontingen_merah']) {
					// hukuman sudut merah
					$hasil_tanding_teguran_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hasil_tanding_peringatan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hukuman = $hasil_tanding_teguran_merah['hasil_akhir'] + $hasil_tanding_peringatan_merah['hasil_akhir'];

					// nilai sudut merah
					$hasil_tanding_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$hasil_tanding_jatuhan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
					$nilai = $hasil_tanding_merah['hasil_akhir'] + $hasil_tanding_jatuhan_merah['hasil_akhir'];
					$nilai = $nilai + $hukuman;

					$data_perolehan_nilai[] = [
						'no_partai' => $jadwal_pertandingan['no_partai'],
						'nama_pesilat' => $jadwal_pertandingan['nama_pesilat_merah'],
						'kontingen' => $jadwal_pertandingan['kontingen_merah'],
						'hukuman' => $hukuman,
						'nilai' => $nilai,
					];
				}
			} else {
				// hukuman sudut biru
				$hasil_tanding_teguran_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
				$hasil_tanding_peringatan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
				$hukuman = $hasil_tanding_teguran_biru['hasil_akhir'] + $hasil_tanding_peringatan_biru['hasil_akhir'];

				// nilai sudut biru
				$hasil_tanding_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
				$hasil_tanding_jatuhan_biru = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Biru'")->row_array();
				$nilai = $hasil_tanding_biru['hasil_akhir'] + $hasil_tanding_jatuhan_biru['hasil_akhir'];
				$nilai = $nilai + $hukuman;

				$data_perolehan_nilai[] = [
					'no_partai' => $jadwal_pertandingan['no_partai'],
					'nama_pesilat' => $jadwal_pertandingan['nama_pesilat_biru'],
					'kontingen' => $jadwal_pertandingan['kontingen_biru'],
					'hukuman' => $hukuman,
					'nilai' => $nilai,
				];

				// hukuman sudut merah
				$hasil_tanding_teguran_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_teguran a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
				$hasil_tanding_peringatan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_peringatan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
				$hukuman = $hasil_tanding_teguran_merah['hasil_akhir'] + $hasil_tanding_peringatan_merah['hasil_akhir'];

				// nilai sudut merah
				$hasil_tanding_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_monitor a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
				$hasil_tanding_jatuhan_merah = $this->db->query("SELECT SUM(a.nilai) as hasil_akhir FROM pr_hasil_tanding_jatuhan a WHERE id_jadwal_pertandingan = '$id_jadwal_pertandingan' AND sudut = 'Merah'")->row_array();
				$nilai = $hasil_tanding_merah['hasil_akhir'] + $hasil_tanding_jatuhan_merah['hasil_akhir'];
				$nilai = $nilai + $hukuman;

				$data_perolehan_nilai[] = [
					'no_partai' => $jadwal_pertandingan['no_partai'],
					'nama_pesilat' => $jadwal_pertandingan['nama_pesilat_merah'],
					'kontingen' => $jadwal_pertandingan['kontingen_merah'],
					'hukuman' => $hukuman,
					'nilai' => $nilai,
				];
			}
		}

		$nilai = array_column($data_perolehan_nilai, 'nilai');
		array_multisort($nilai, SORT_DESC, $data_perolehan_nilai);

		// setting excel
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    	$style_col = [
	      'font' => ['bold' => true], // Set font nya jadi bold
	      'alignment' => [
	        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	      ],
	      'borders' => [
	        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
	        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
	        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
	        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	      ]
	    ];
	    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	    $style_row_center = [
	      'alignment' => [
	        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
	        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
	      ],
	      'borders' => [
	        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
	        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
	        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
	        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	      ]
	    ];

	    $style_row_left = [
	      'alignment' => [
	        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
	        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
	      ],
	      'borders' => [
	        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
	        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
	        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
	        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	      ]
	    ];

		$title = "Laporan Pesilat Terbaik";

	    $sheet->setCellValue('A1', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
	    $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
	    $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
	    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

	    $sheet->setCellValue('A3', 'Kompetisi : ' . $data_kompetisi['kompetisi']);
	    $sheet->getStyle('A3')->getFont()->setBold(true);

	    $sheet->setCellValue('A4', 'Gelanggang : ' . $gelanggang);
	    $sheet->getStyle('A4')->getFont()->setBold(true);

			$sheet->setCellValue('A5', 'Kontingen : ' . $kontingen);
	    $sheet->getStyle('A5')->getFont()->setBold(true);

	    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$sheet->setCellValue('A7', 'Rank');
			$sheet->setCellValue('B7', 'Pesilat');
			$sheet->setCellValue('C7', 'Kontingen');
			$sheet->setCellValue('D7', 'Hukuman');
			$sheet->setCellValue('E7', 'Nilai');

	    $sheet->getStyle('A7')->applyFromArray($style_col);
	    $sheet->getStyle('B7')->applyFromArray($style_col);
	    $sheet->getStyle('C7')->applyFromArray($style_col);
	    $sheet->getStyle('D7')->applyFromArray($style_col);
	    $sheet->getStyle('E7')->applyFromArray($style_col);

			$x = 8;
			foreach ($data_perolehan_nilai as $key => $data) {
				$sheet->setCellValue('A'.$x, ++$key);
				$sheet->setCellValue('B'.$x, $data['nama_pesilat']);
				$sheet->setCellValue('C'.$x, $data['kontingen']);
				$sheet->setCellValue('D'.$x, $data['hukuman']);
				$sheet->setCellValue('E'.$x, $data['nilai']);

				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      	$sheet->getStyle('A'.$x)->applyFromArray($style_row_center);
      	$sheet->getStyle('B'.$x)->applyFromArray($style_row_left);
      	$sheet->getStyle('C'.$x)->applyFromArray($style_row_center);
      	$sheet->getStyle('D'.$x)->applyFromArray($style_row_center);
				$sheet->getStyle('E'.$x)->applyFromArray($style_row_center);
				$x++;
			}

		// Set width kolom
	    $sheet->getColumnDimension('A')->setWidth(5);
	    $sheet->getColumnDimension('B')->setWidth(20);
	    $sheet->getColumnDimension('C')->setWidth(20);
	    $sheet->getColumnDimension('D')->setWidth(20);
	    $sheet->getColumnDimension('E')->setWidth(20);

	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    	$sheet->getDefaultRowDimension()->setRowHeight(-1);

    	// Set judul file excel nya
    	// $sheet->setTitle("LAPORAN ". $title);

		$writer = new Xlsx($spreadsheet);
		$filename = 'laporan-pesilat-terbaik-' .strtolower(str_replace(' ', '-', $data_kompetisi['kompetisi']));

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
