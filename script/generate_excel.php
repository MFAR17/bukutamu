<?php
// Mulai sesi PHP
session_start();

// Periksa apakah admin belum login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect ke halaman login jika belum login
    header("Location: form_login_admin.php");
    exit; // Penting untuk menghentikan eksekusi skrip setelah melakukan redirect
}

// Buat koneksi ke database
include('../database/connect_data_buku_tamu.php');

// Lakukan query untuk mengambil semua data buku tamu
// $sql = "SELECT * FROM buku_tamu";
// $result = $conn->query($sql);

// Tangkap nilai pencarian nama
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Tangkap nilai bulan
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';

// Lakukan query untuk mengambil data berdasarkan pencarian dan bulan
$sql = "SELECT * FROM buku_tamu WHERE (nama LIKE '%$search%' OR email LIKE '%$search%' OR pesan LIKE '%$search%')";
if (!empty($bulan)) {
    $sql .= " AND MONTH(waktu_submit) = $bulan"; // Filter berdasarkan bulan
}

$result = $conn->query($sql);

// Load PhpSpreadsheet library
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Membuat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();

// Mendapatkan sheet aktif
$sheet = $spreadsheet->getActiveSheet();

// Menambahkan header "Daftar Tamu Diskominfo"
$sheet->mergeCells('A1:G1');
$sheet->setCellValue('A1', 'Daftar Tamu Diskominfo');

// Menambahkan nama kolom pada file Excel
$sheet->setCellValue('A3', 'No KTP')
      ->setCellValue('B3', 'Tempat')
      ->setCellValue('C3', 'Layanan')
      ->setCellValue('D3', 'Nama')
      ->setCellValue('E3', 'Email')
      ->setCellValue('F3', 'Keperluan')
      ->setCellValue('G3', 'Waktu Berkunjung');

// Mendapatkan baris awal untuk data
$row = 4;

// Mulai pengambilan data dari tabel database
while($data = $result->fetch_assoc()) {
    $sheet->setCellValueExplicit('A'.$row, $data['nomor_ktp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING)
          ->setCellValue('B'.$row, $data['tempat'])
          ->setCellValue('C'.$row, $data['layanan'])
          ->setCellValue('D'.$row, $data['nama'])
          ->setCellValue('E'.$row, $data['email'])
          ->setCellValue('F'.$row, $data['pesan'])
          ->setCellValue('G'.$row, $data['waktu_submit']);
    $row++;
}

// Menambahkan gaya pada header dan kolom nama
$headerStyleArray = [
    'font' => [
        'bold' => true,
        'size' => 14,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

$columnHeaderStyleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

$sheet->getStyle('A1:G1')->applyFromArray($headerStyleArray);
$sheet->getStyle('A3:G3')->applyFromArray($columnHeaderStyleArray);

// Menyesuaikan lebar kolom
foreach(range('A','G') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menambahkan padding dan mengatur alignment untuk sel-sel
$styleArray = [
    'alignment' => [
        'vertical' => Alignment::VERTICAL_TOP,
        'horizontal' => Alignment::HORIZONTAL_LEFT,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle('A1:G'.$row)->applyFromArray($styleArray);

// Mengatur header file Excel untuk diunduh
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="buku_tamu.xlsx"');
header('Cache-Control: max-age=0');

// Membuat objek writer Excel
$writer = new Xlsx($spreadsheet);
// Menulis file Excel ke output
$writer->save('php://output');

// Tutup koneksi dan keluar dari skrip PHP
$conn->close();
exit;
?>
