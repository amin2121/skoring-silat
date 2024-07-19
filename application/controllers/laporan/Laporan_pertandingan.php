<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_pertandingan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
    $data['kompetisi'] = $this->db->get('ms_kompetisi')->result_array();
		$data['gelanggang'] = $this->db->get('ms_gelanggang')->result_array();

		$this->load->view('templates/header', $data);
    $this->load->view('laporan/laporan_pertandingan');
    $this->load->view('templates/footer');
	}

  public function cetak(){
    $kompetisi = $this->input->post('kompetisi');
    $gelanggang = $this->input->post('gelanggang');
		$status_pertandingan = $this->input->post('status_pertandingan');
		$babak = $this->input->post('babak');
    $data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();

		$where_gelanggang = '';
		if($gelanggang != 'semua') {
			$where_gelanggang = "AND gelanggang = '$gelanggang'";
		}

		$where_babak = '';
		if($babak != 'semua') {
			$where_babak = "AND babak = '$babak'";
		}

    $data_jadwal_pertandingan = $this->db->query("SELECT
	                                                    *
	                                                  FROM ms_jadwal_partai_tanding
	                                                  WHERE id_kompetisi = '$kompetisi'
																										AND status_selesai_pertandingan = $status_pertandingan
																										$where_gelanggang
																										$where_babak
	                                ")->result_array();

																	// var_dump($this->db->last_query()); die();

		$data_perolehan_nilai = [];
		foreach ($data_jadwal_pertandingan as $key => $jadwal_pertandingan) {
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

			$data_perolehan_nilai[] = [
				'kompetisi' => $jadwal_pertandingan['kompetisi'],
				'no_partai' => $jadwal_pertandingan['no_partai'],
				'gelanggang' => $jadwal_pertandingan['gelanggang'],
				'nama_pesilat_merah' => $jadwal_pertandingan['nama_pesilat_merah'],
				'kontingen_merah' => $jadwal_pertandingan['kontingen_merah'],
				'nama_pesilat_biru' => $jadwal_pertandingan['nama_pesilat_biru'],
				'kontingen_biru' => $jadwal_pertandingan['kontingen_biru'],
				'pemenang' => $nilai_sudut_biru > $nilai_sudut_merah ? $jadwal_pertandingan['nama_pesilat_biru'] : $jadwal_pertandingan['nama_pesilat_merah'],
				'nilai_sudut_biru' => $nilai_sudut_biru,
				'nilai_sudut_merah' => $nilai_sudut_merah,
			];
		}

    $data['result'] = $data_perolehan_nilai;
		$data['babak'] = $babak;
    $data['kompetisi'] = $data_kompetisi;
    $data['gelanggang'] = $gelanggang;
    $this->load->view('laporan/cetak/laporan_pertandingan', $data);
  }

	public function export_excel()
	{
		$kompetisi = $this->input->get('id_kompetisi');
		$gelanggang = $this->input->get('gelanggang');
		$status_pertandingan = $this->input->get('status_pertandingan');
		$babak = $this->input->get('babak');
		$data_kompetisi = $this->db->get_where('ms_kompetisi', ['id' => $kompetisi])->row_array();

		$where_gelanggang = '';
		if($gelanggang != 'semua') {
			$where_gelanggang = "AND gelanggang = '$gelanggang'";
		}

		$where_babak = '';
		if($babak != 'semua') {
			$where_babak = "AND babak = '$babak'";
		}

		$data_jadwal_pertandingan = $this->db->query("SELECT
																											*
																										FROM ms_jadwal_partai_tanding
																										WHERE id_kompetisi = '$kompetisi'
																										AND status_selesai_pertandingan = $status_pertandingan
																										$where_gelanggang
																										$where_babak
																	")->result_array();

		$data_perolehan_nilai = [];
		foreach ($data_jadwal_pertandingan as $key => $jadwal_pertandingan) {
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

			$data_perolehan_nilai[] = [
				'kompetisi' => $jadwal_pertandingan['kompetisi'],
				'no_partai' => $jadwal_pertandingan['no_partai'],
				'gelanggang' => $jadwal_pertandingan['gelanggang'],
				'nama_pesilat_merah' => $jadwal_pertandingan['nama_pesilat_merah'],
				'kontingen_merah' => $jadwal_pertandingan['kontingen_merah'],
				'nama_pesilat_biru' => $jadwal_pertandingan['nama_pesilat_biru'],
				'kontingen_biru' => $jadwal_pertandingan['kontingen_biru'],
				'pemenang' => $nilai_sudut_biru > $nilai_sudut_merah ? $jadwal_pertandingan['nama_pesilat_biru'] : $jadwal_pertandingan['nama_pesilat_merah'],
				'nilai_sudut_biru' => $nilai_sudut_biru,
				'nilai_sudut_merah' => $nilai_sudut_merah,
			];
		}

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

		$title = "Laporan Pertandingan";

	    $sheet->setCellValue('A1', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
	    $sheet->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
	    $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
	    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

	    $sheet->setCellValue('A3', 'Kompetisi : ' . $data_kompetisi['kompetisi']);
	    $sheet->getStyle('A3')->getFont()->setBold(true);

			$sheet->setCellValue('A4', 'Babak : ' . strtoupper($babak));
			$sheet->getStyle('A4')->getFont()->setBold(true);

	    $sheet->setCellValue('A5', 'Gelanggang : ' . strtoupper($gelanggang));
	    $sheet->getStyle('A5')->getFont()->setBold(true);

	    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$sheet->setCellValue('A7', 'No');
			$sheet->setCellValue('B7', 'Gel');
			$sheet->setCellValue('C7', 'Partai');
			$sheet->setCellValue('D7', 'Sudut Biru');
			$sheet->getStyle("D7")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('0B71E0');
			$sheet->setCellValue('E7', 'Sudut Merah');
			$sheet->getStyle("E7")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E74131');
			$sheet->setCellValue('F7', 'Nilai Sudut Biru');
			$sheet->getStyle("F7")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFDD00');
			$sheet->setCellValue('G7', 'Nilai Sudut Merah');
			$sheet->getStyle("G7")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFDD00');
			$sheet->setCellValue('H7', 'Pemenang');

	    $sheet->getStyle('A7')->applyFromArray($style_col);
	    $sheet->getStyle('B7')->applyFromArray($style_col);
	    $sheet->getStyle('C7')->applyFromArray($style_col);
	    $sheet->getStyle('D7')->applyFromArray($style_col);
	    $sheet->getStyle('E7')->applyFromArray($style_col);
			$sheet->getStyle('F7')->applyFromArray($style_col);
			$sheet->getStyle('G7')->applyFromArray($style_col);
			$sheet->getStyle('H7')->applyFromArray($style_col);

			$x = 8;
			foreach ($data_perolehan_nilai as $key => $data) {
				$y = $x + 1;
				$sheet->setCellValue("A$x", ++$key);
				$sheet->mergeCells("A$x:A$y");
				$sheet->setCellValue("B$x", $data['gelanggang']);
				$sheet->mergeCells("B$x:B$y");
				$sheet->setCellValue("C$x", $data['no_partai']);
				$sheet->mergeCells("C$x:C$y");
				$sheet->setCellValue("D$x", $data['nama_pesilat_biru']);
				$sheet->getStyle("D$x")->getFont()->setBold(true);
				$sheet->getStyle("D$x")->getFont()->getColor()->setRGB('0b71e0');
				$sheet->setCellValue("D$y", $data['kontingen_biru']);
				$sheet->getStyle("D$y")->getFont()->getColor()->setRGB('0b71e0');
				$sheet->setCellValue("E$x", $data['nama_pesilat_merah']);
				$sheet->getStyle("E$x")->getFont()->setBold(true);
				$sheet->getStyle("E$x")->getFont()->getColor()->setRGB('e74131');
				$sheet->setCellValue("E$y", $data['kontingen_merah']);
				$sheet->getStyle("E$y")->getFont()->getColor()->setRGB('e74131');
				$sheet->setCellValue("F$x", $data['nilai_sudut_biru']);
				$sheet->mergeCells("F$x:F$y");
				$sheet->setCellValue("G$x", $data['nilai_sudut_merah']);
				$sheet->mergeCells("G$x:G$y");
				$sheet->setCellValue("H$x", $data['pemenang']);
				$sheet->mergeCells("H$x:H$y");

				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      	$sheet->getStyle("A$x:A$y")->applyFromArray($style_row_center);
      	$sheet->getStyle("B$x:B$y")->applyFromArray($style_row_center);
      	$sheet->getStyle("C$x:C$y")->applyFromArray($style_row_center);
      	$sheet->getStyle("D$x")->applyFromArray($style_row_left);
				$sheet->getStyle("D$y")->applyFromArray($style_row_left);
      	$sheet->getStyle("E$x")->applyFromArray($style_row_left);
				$sheet->getStyle("E$y")->applyFromArray($style_row_left);
				$sheet->getStyle("F$x:F$y")->applyFromArray($style_row_center);
				$sheet->getStyle("G$x:G$y")->applyFromArray($style_row_center);
				$sheet->getStyle("H$x:H$y")->applyFromArray($style_row_center);

				$x++;
			}

		// Set width kolom
	    $sheet->getColumnDimension('A')->setWidth(5);
	    $sheet->getColumnDimension('B')->setWidth(10);
	    $sheet->getColumnDimension('C')->setWidth(20);
	    $sheet->getColumnDimension('D')->setWidth(20);
	    $sheet->getColumnDimension('E')->setWidth(20);
			$sheet->getColumnDimension('F')->setWidth(20);
			$sheet->getColumnDimension('G')->setWidth(20);
			$sheet->getColumnDimension('H')->setWidth(20);
	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    	$sheet->getDefaultRowDimension()->setRowHeight(-1);

    	// Set judul file excel nya
    	// $sheet->setTitle("LAPORAN ". $title);

		$writer = new Xlsx($spreadsheet);
		$filename = 'laporan-pertandingan-' . strtolower(str_replace(' ', '-', $data_kompetisi['kompetisi']));

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}

/* End of file Kompetisi.php */
/* Location: ./application/controllers/Kompetisi.php */
